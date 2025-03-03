<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated via 'admin' guard
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        
        // Redirect unauthorized users
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}

