<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\User; // Assuming admins are stored in the 'users' table
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Display a list of customers
    // Admin List with Search and Pagination
    public function members(Request $request)
    {
        // Start the query
        //$query = Admin::query()->where('role', 'admin');  //if only admin need to show

        $query = User::query();

        // Apply search functionality if search input exists
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        // Fetch admins with pagination (10 items per page)
        $users = $query->paginate(10);

        // Return the view with the paginated admins
        return view('admin.customer.member', compact('users'));
    }

// CSV Export Functionality
    public function exportToCSV()
    {
    $users = User::all(['name', 'email','custom_text','gender','preferences','colors', 'created_at']); // Fetch necessary fields

    // Streamed response for CSV download
    $response = new StreamedResponse(function () use ($users) {
        $handle = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($handle, ['Name', 'Email','Custom_text','Gender','Preferences','Colors',  'Created At']);

        // Add rows
        foreach ($users as $user) {
            fputcsv($handle, [
                $user->name,
                $user->email,
                $user->custom_text,
                $user->gender,
                
                $user->gender,
                $user->preferences,
                $user->colors,
                $user->created_at->format('Y-m-d H:i:s')
            ]);
        }

        fclose($handle);
    });

    // Set response headers
    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', 'attachment; filename="admins.csv"');

    return $response;
}
   

    // Show form for creating a new admin
    public function create()
    {
        return view('admin.customer.create');
    }

    // Store a new user in the database
    public function store(Request $request)
{
    $request->validate([
        'name' => ['nullable', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'custom_text' => ['nullable', 'string', 'max:255'],
        'gender' => ['required', 'in:male,female'],
        'preferences' => ['required', 'array', 'min:1'], // Ensure at least one preference is selected
        'preferences.*' => ['string', 'max:255'],
        'color' => ['required', 'string', 'in:Red,Green,Yellow,Blue'],
        'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // 2MB max
    ]);

    // Handle file upload for profile picture
    $profilePicturePath = null;
    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'custom_text' => $request->custom_text,
        'gender' => $request->gender,
        'preferences' => json_encode($request->preferences),
        'colors' => $request->color,
        'profile_picture' => $profilePicturePath,
        'email_verified_at' => now(),
    ]);

    return redirect()->route('admin.customer.create')->with('success', 'Customer created successfully.');
}


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.customer.edit', compact('user'));
    }

    // Update an existing customer
    public function update(Request $request, $id)
{
    $customer = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:6|confirmed',
        'custom_text' => 'nullable|string|max:255',
        'gender' => 'nullable|in:male,female',
        'preferences' => 'nullable|array',
        'preferences.*' => 'string|max:255',
        'colors' => 'nullable|string|in:Red,Green,Yellow,Blue',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
    ]);

    // Handle file upload for profile picture
    if ($request->hasFile('profile_picture')) {
        // Delete old profile picture if exists
        if ($customer->profile_picture && Storage::disk('public')->exists($customer->profile_picture)) {
            Storage::disk('public')->delete($customer->profile_picture);
        }

        // Upload new profile picture
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $customer->profile_picture = $profilePicturePath;
    }

    // Update customer details
    $customer->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $customer->password,
        'custom_text' => $request->custom_text,
        'gender' => $request->gender,
        'preferences' => $request->preferences ? json_encode($request->preferences) : $customer->preferences,
        'colors' => $request->colors ?? $customer->colors, // Retain old value if not updated
    ]);

    return redirect()->route('admin.customer')->with('success', 'Customer updated successfully.');
}



    // Delete a super admin
    public function delete($id)
    {
        $superAdmin = Admin::findOrFail($id);
        $superAdmin->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Super Admin deleted successfully.');
    }
}




