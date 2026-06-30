<?php

namespace App\Services;

use App\Models\AdminOtp;
use App\Notifications\OtpNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Carbon\Carbon;

class OtpService
{
    private int $expiryMinutes;
    private int $maxAttempts;

    public function __construct()
    {
        $this->expiryMinutes = (int) env('OTP_EXPIRY_MINUTES', 10);
        $this->maxAttempts   = (int) env('OTP_MAX_ATTEMPTS', 5);
    }

    public function generate(string $email): AdminOtp
    {
        // Invalidate previous OTPs for this email
        AdminOtp::where('email', $email)->update(['used' => true]);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $otp = AdminOtp::create([
            'email'      => $email,
            'code'       => $code,
            'expires_at' => Carbon::now()->addMinutes($this->expiryMinutes),
            'used'       => false,
            'attempts'   => 0,
        ]);

        // Send notification (best-effort: the OTP record is already persisted,
        // so a mail outage shouldn't fail the login request with a 500)
        try {
            Notification::route('mail', $email)
                ->notify(new OtpNotification($code, $this->expiryMinutes));
        } catch (\Throwable $e) {
            report($e);
        }

        return $otp;
    }

    public function verify(string $email, string $code): array
    {
        $rateLimiterKey = 'otp-verify:' . $email;

        if (RateLimiter::tooManyAttempts($rateLimiterKey, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            return ['success' => false, 'message' => "محاولات كثيرة. حاول بعد {$seconds} ثانية.", 'retry_after' => $seconds];
        }

        $otp = AdminOtp::where('email', $email)
            ->where('used', false)
            ->orderByDesc('created_at')
            ->first();

        if (!$otp) {
            RateLimiter::hit($rateLimiterKey, 60 * (int) env('OTP_COOLDOWN_MINUTES', 15));
            return ['success' => false, 'message' => 'رمز OTP غير صالح أو منتهي الصلاحية.'];
        }

        $otp->incrementAttempts();

        if ($otp->expires_at->isPast()) {
            return ['success' => false, 'message' => 'انتهت صلاحية رمز OTP. اطلب رمزاً جديداً.'];
        }

        if ($otp->attempts > $this->maxAttempts) {
            RateLimiter::hit($rateLimiterKey, 60 * (int) env('OTP_COOLDOWN_MINUTES', 15));
            return ['success' => false, 'message' => 'تجاوزت الحد الأقصى للمحاولات.'];
        }

        if (!hash_equals($otp->code, $code)) {
            RateLimiter::hit($rateLimiterKey, 60);
            $remaining = $this->maxAttempts - $otp->attempts;
            return ['success' => false, 'message' => "رمز خاطئ. متبقي {$remaining} محاولة."];
        }

        $otp->update(['used' => true]);
        RateLimiter::clear($rateLimiterKey);

        return ['success' => true, 'message' => 'تم التحقق بنجاح.'];
    }
}
