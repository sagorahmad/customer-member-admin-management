<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOrSuperAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() && in_array(Auth::guard('admin')->user()->role, ['admin', 'super-admin']) && Auth::guard('admin')->user()->hasVerifiedEmail()) {
            return $next($request);
        }

        return redirect('/admin/login')->with('error', 'Unauthorized access or email not verified.');
    }
}

