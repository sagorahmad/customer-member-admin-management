<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin' && Auth::guard('admin')->user()->hasVerifiedEmail()) {
            return $next($request);
        }

        return redirect('/admin/login')->with('error', 'Unauthorized access or email not verified.');
    }
}

