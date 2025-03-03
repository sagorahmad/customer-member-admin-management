<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RoleCheckTrait
{
    public function isSuperAdmin()
    {
        return Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'super-admin' && Auth::guard('admin')->user()->hasVerifiedEmail();
    }

    public function isAdmin()
    {
        return Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin' && Auth::guard('admin')->user()->hasVerifiedEmail();
    }

    public function isMember()
    {
        return Auth::guard('web')->check() && Auth::guard('web')->user()->hasVerifiedEmail();
    }
}


