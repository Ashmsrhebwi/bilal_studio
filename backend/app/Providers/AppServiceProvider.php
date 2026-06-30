<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Rate limiters must be registered here (not in bootstrap/app.php's
        // withMiddleware closure) — that closure fires via afterResolving()
        // before facades are bootstrapped, which throws "A facade root has
        // not been set."
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip())->response(function () {
                return response()->json([
                    'success' => false,
                    'message' => 'محاولات تسجيل دخول كثيرة. حاول بعد دقيقة.',
                ], 429);
            });
        });

        RateLimiter::for('contact', function (Request $request) {
            // Keyed by IP + path so the contact, consultation, and newsletter
            // forms each get their own budget instead of sharing one — a user
            // submitting one form shouldn't get blocked from the others.
            return Limit::perMinutes(10, 3)->by($request->ip() . '|' . $request->path())->response(function () {
                return response()->json([
                    'success' => false,
                    'message' => 'أرسلت طلبات كثيرة. حاول بعد قليل.',
                ], 429);
            });
        });
    }
}
