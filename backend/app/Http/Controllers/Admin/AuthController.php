<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Models\User;
use App\Services\OtpService;
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function __construct(
        private readonly OtpService $otpService,
        private readonly PasswordResetService $passwordResetService
    ) {}

    /**
     * Step 1: Verify credentials → send OTP
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $key = 'login:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "محاولات كثيرة. حاول بعد {$seconds} ثانية.",
            ], 429);
        }

        $adminEmail = strtolower(config('auth.admin_email'));
        $inputEmail = strtolower($request->email);

        // Only allow the designated admin email
        if ($inputEmail !== $adminEmail) {
            RateLimiter::hit($key, 60);
            return response()->json(['success' => false, 'message' => 'بيانات الاعتماد غير صحيحة.'], 401);
        }

        // The admin password is sourced from site_settings (set on password reset)
        // or, before any reset has happened, from ADMIN_PASSWORD_HASH. The `users`
        // table row is only used to hold the Sanctum token, never the credential.
        $storedHash = \App\Models\SiteSetting::getValue('admin_password_hash')
            ?? config('auth.admin_password_hash');

        $passwordValid = $storedHash && Hash::check($request->password, $storedHash);

        if (!$passwordValid) {
            RateLimiter::hit($key, 60);
            return response()->json(['success' => false, 'message' => 'بيانات الاعتماد غير صحيحة.'], 401);
        }

        RateLimiter::clear($key);

        // Send OTP
        $this->otpService->generate($adminEmail);

        return response()->json([
            'success' => true,
            'message' => 'تم إرسال رمز التحقق إلى بريدك الإلكتروني.',
            'step'    => 'otp_required',
        ]);
    }

    /**
     * Step 2: Verify OTP → issue token
     */
    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
    {
        $result = $this->otpService->verify($request->email, $request->code);

        if (!$result['success']) {
            $status = isset($result['retry_after']) ? 429 : 422;
            return response()->json(['success' => false, 'message' => $result['message']], $status);
        }

        // Issue Sanctum token
        $user = User::firstOrCreate(
            ['email' => $request->email],
            ['name' => 'Admin', 'password' => Hash::make(\Str::random(32))]
        );

        // Revoke old tokens
        $user->tokens()->delete();

        $token = $user->createToken('admin-panel', ['admin'], now()->addDays(7))->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح.',
            'token'   => $token,
            'user'    => ['id' => $user->id, 'email' => $user->email, 'name' => $user->name],
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['success' => true, 'message' => 'تم تسجيل الخروج.']);
    }

    /**
     * Get current user
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'user'    => $request->user()->only(['id', 'name', 'email']),
        ]);
    }

    /**
     * Forgot password: send reset link
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $key = 'forgot-password:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            return response()->json(['success' => false, 'message' => 'محاولات كثيرة. حاول لاحقاً.'], 429);
        }

        RateLimiter::hit($key, 300);

        // Always respond 200 to avoid email enumeration
        $this->passwordResetService->sendResetLink($request->email);

        return response()->json([
            'success' => true,
            'message' => 'إذا كان هذا البريد مسجلاً، سيصلك رابط إعادة التعيين.',
        ]);
    }

    /**
     * Reset password with token
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $result = $this->passwordResetService->reset(
            $request->email,
            $request->token,
            $request->password
        );

        $status = $result['success'] ? 200 : 422;
        return response()->json($result, $status);
    }
}
