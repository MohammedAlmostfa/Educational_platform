<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string   $permission
     */


        public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $routeName = $request->route()->getName();

        if ($routeName && !$user->can($routeName)) {
                return response()->json([
                    'success' => 'error',
                    'message' => 'غير مسموح بهذا الإجراء',
                    'error_code' => 'UNAUTHORIZED',
                    'status' => 403
                ], 403);
        }

        return $next($request);
    }
    }

