<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('mypage.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'custom_text' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'preferences' => 'required|array|min:1',
            'preferences.*' => 'string|max:255',
            'color' => 'required|string|in:Red,Green,Yellow,Blue',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update profile picture if uploaded
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        // Update other fields
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'custom_text' => $request->custom_text,
            'gender' => $request->gender,
            'preferences' => json_encode($request->preferences),
            'colors' => $request->color,
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('mypage.edit')->with('success', 'Profile updated successfully!');
    }
}
