<?php

namespace App\Services;

use App\Notifications\PasswordResetNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetService
{
    private int $expiryMinutes = 60;

    public function sendResetLink(string $email): bool
    {
        if (strtolower($email) !== strtolower(config('auth.admin_email'))) {
            return false; // silently fail — don't reveal admin email
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens_custom')->updateOrInsert(
            ['email' => $email],
            ['token' => Hash::make($token), 'expires_at' => Carbon::now()->addMinutes($this->expiryMinutes), 'created_at' => now(), 'updated_at' => now()]
        );

        $resetUrl = config('app.frontend_url', env('FRONTEND_URL')) . '/admin/reset-password?token=' . $token . '&email=' . urlencode($email);

        // Best-effort: a mail outage must not turn into a 500 here, since that
        // would leak (via status code) whether $email is the admin account.
        try {
            Notification::route('mail', $email)
                ->notify(new PasswordResetNotification($resetUrl, $this->expiryMinutes));
        } catch (\Throwable $e) {
            report($e);
        }

        return true;
    }

    public function reset(string $email, string $token, string $newPassword): array
    {
        $record = DB::table('password_reset_tokens_custom')->where('email', $email)->first();

        if (!$record) {
            return ['success' => false, 'message' => 'طلب إعادة التعيين غير موجود.'];
        }

        if (Carbon::parse($record->expires_at)->isPast()) {
            DB::table('password_reset_tokens_custom')->where('email', $email)->delete();
            return ['success' => false, 'message' => 'انتهت صلاحية رابط إعادة التعيين.'];
        }

        if (!Hash::check($token, $record->token)) {
            return ['success' => false, 'message' => 'الرمز غير صحيح.'];
        }

        // Update admin password hash in .env-style config at runtime only
        // In production: update DB or .env value
        $hashedPassword = Hash::make($newPassword);
        // Write to settings table for persistence
        \App\Models\SiteSetting::setValue('admin_password_hash', $hashedPassword);

        DB::table('password_reset_tokens_custom')->where('email', $email)->delete();

        return ['success' => true, 'message' => 'تم تحديث كلمة المرور بنجاح.'];
    }
}
