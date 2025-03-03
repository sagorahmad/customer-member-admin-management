<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in using the 'admin' guard
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        // Attempt to log in with the 'web' guard
        // if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
        //     $user = Auth::guard('web')->user();
        //     return redirect()->route('home');
            
        // }

        


        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function logout()
    {
        // Logout the admin using the 'admin' guard
        Auth::guard('admin')->logout();

        // Redirect to the admin login page
        return redirect('/admin/login')->with('success', 'Logged out successfully.');
    }
}

