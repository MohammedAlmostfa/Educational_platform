<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $routeName = $request->route()->getName();

        if ($user && $routeName && !$user->can($routeName)) {
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
