<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $adminEmail = config('auth.admin_email');

        if (! $user || ! $adminEmail || strtolower($user->email) !== strtolower($adminEmail)) {
            return response()->json(['success' => false, 'message' => 'غير مصرح.'], 403);
        }

        return $next($request);
    }
}
