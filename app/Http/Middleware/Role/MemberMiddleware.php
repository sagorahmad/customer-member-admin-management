<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->hasVerifiedEmail()) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Access denied or email not verified.');
    }
}

