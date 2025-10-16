<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $routeName = $request->route()->getName();

        if ($user && $routeName && !$user->can($routeName)) {
            // ✳️ Log التفاصيل لمعرفة السبب
            Log::warning('🚫 Unauthorized access attempt', [
                'user_id' => $user->id ?? null,
                'user_email' => $user->email ?? null,
                'route_name' => $routeName,
                'user_permissions' => $user->getAllPermissions()->pluck('name')->toArray(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'غير مسموح بهذا الإجراء',
                'error_code' => 'UNAUTHORIZED',
                'status' => 403,
            ], 403);
        }

        return $next($request);
    }
}
