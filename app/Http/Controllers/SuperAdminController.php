<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
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

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard'); // Create a view for super admin dashboard
    }



    
    // public function createMember()
    // {
    //     $Admins = User::where('is_admin', 1)->get(); 
    //     return view('admin.member', compact('Admins'));
    // }
    public function createAdmin()
    {
        //$Admins = User::where('is_admin', 1)->get(); // Fetch all superadmins
        return view('admin.create_admin');
    }

    // Store a new super admin in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            
        ]);


        return redirect()->back()->with('success', 'Admin created successfully.');
    }

    //========== Show form for viewing or editing,export csv, search a super admin======

    


// Admin List with Search and Pagination
    public function members(Request $request)
    {
        // Start the query
        //$query = Admin::query()->where('role', 'admin');  //if only admin need to show

        $query = Admin::query();

        // Apply search functionality if search input exists
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        // Fetch admins with pagination (10 items per page)
        $admins = $query->paginate(10);

        // Return the view with the paginated admins
        return view('admin.member', compact('admins'));
    }

// CSV Export Functionality
    public function exportToCSV()
    {
    $admins = Admin::all(['name', 'email', 'role', 'created_at']); // Fetch necessary fields

    // Streamed response for CSV download
    $response = new StreamedResponse(function () use ($admins) {
        $handle = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($handle, ['Name', 'Email', 'Role', 'Created At']);

        // Add rows
        foreach ($admins as $admin) {
            fputcsv($handle, [
                $admin->name,
                $admin->email,
                $admin->role,
                $admin->created_at->format('Y-m-d H:i:s')
            ]);
        }

        fclose($handle);
    });

    // Set response headers
    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', 'attachment; filename="admins.csv"');

    return $response;
}

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admin.edit', compact('admin'));
    }

    // Update an existing super admin
    public function update(Request $request, $id)
    {
        $superAdmin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $superAdmin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $superAdmin->password,
        ]);

        return redirect()->route('admin.member')->with('success', 'Updated successfully.');
    }

    // Delete a super admin
    public function delete($id)
    {
        $superAdmin = Admin::findOrFail($id);
        $superAdmin->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Super Admin deleted successfully.');
    }
}

