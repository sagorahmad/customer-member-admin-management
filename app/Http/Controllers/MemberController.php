<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming members are stored in the 'users' table
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    // Display a list of members
    public function index()
    {
        $members = User::where('is_admin', 0)->get();
        return view('admin.members.index', compact('members'));
    }

    // Show form for creating a new member
    public function create()
    {
        return view('admin.members.create');
    }

    // Store a new member in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0, // Mark this user as a member
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Member created successfully.');
    }

    // Show form for editing an existing member
    public function edit($id)
    {
        $member = User::where('is_admin', 0)->findOrFail($id);
        return view('admin.members.edit', compact('member'));
    }

    // Update a member in the database
    public function update(Request $request, $id)
    {
        $member = User::where('is_admin', 0)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $member->password,
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Member updated successfully.');
    }

    // Delete a member from the database
    public function destroy($id)
    {
        $member = User::where('is_admin', 0)->findOrFail($id);
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member deleted successfully.');
    }
}
