@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Management</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Bar -->
    <form method="GET" action="{{ url('admin/customer') }}" class="mb-4">
        <div class="input-group">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Search by name or email..." 
                value="{{ request('search') }}"
            >
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <!-- Export to CSV -->
    <a href="{{ route('customer.export') }}" class="btn btn-success mb-4">Export to CSV</a>

    <!-- Admin List Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Custom Text</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Preferences</th>
                <th>Favorite Color</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->custom_text }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->preferences }}</td>
                    <td>{{ $user->colors }}</td>
                    <td><img src="{{ asset('storage/' . $user->profile_picture) }}" alt="" style="max-width: 100px;"></td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ url('admin/customer/' . $user->id . '/edit') }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
    <div>
        {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
    </div>
</div>


@endsection
