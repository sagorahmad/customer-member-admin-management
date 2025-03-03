<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use RoleCheckTrait;

    public function index(){

        if ($this->isSuperAdmin()) {
            return view('admin.dashboard');
        } elseif ($this->isAdmin()) {
            return view('admin.dashboard');
        } elseif ($this->isMember()) {
            return view('member.dashboard');
        }

        return redirect('/')->with('error', 'Unauthorized');
    }
}
