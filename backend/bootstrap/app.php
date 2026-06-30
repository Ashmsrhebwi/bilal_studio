<?php

use App\Http\Middleware\EnsureAdminMiddleware;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias for admin gate
        $middleware->alias([
            'admin' => EnsureAdminMiddleware::class,
        ]);

        $middleware->append(SecurityHeaders::class);

        // This is an API-only app with no 'login' named route. Without this,
        // Authenticate::redirectTo() throws RouteNotFoundException for any
        // unauthenticated request that lacks an explicit Accept: application/json
        // header (i.e. doesn't pass expectsJson()), turning a 401 into a 500.
        $middleware->redirectGuestsTo(fn () => null);

        // Rate limiters are registered in AppServiceProvider::boot(), not here —
        // see comment there for why.
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Always return JSON for API routes
        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) => $request->is('api/*'),
        );

        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['success' => false, 'message' => 'غير مصادق.'], 401);
            }
        });

        $exceptions->render(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['success' => false, 'message' => 'العنصر غير موجود.'], 404);
            }
        });

        $exceptions->render(function (\Illuminate\Validation\ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'بيانات غير صحيحة.',
                    'errors'  => $e->errors(),
                ], 422);
            }
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['success' => false, 'message' => 'المسار غير موجود.'], 404);
            }
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['success' => false, 'message' => 'الطريقة غير مسموحة.'], 405);
            }
        });

        $exceptions->render(function (\Illuminate\Auth\Access\AuthorizationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['success' => false, 'message' => 'غير مصرح.'], 403);
            }
        });

        // Catch-all: never leak stack traces / internal error details for API routes,
        // even when APP_DEBUG=true, for any exception type not explicitly handled above.
        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ في الخادم. حاول مرة أخرى لاحقاً.',
                ], 500);
            }
        });
    })->create();
