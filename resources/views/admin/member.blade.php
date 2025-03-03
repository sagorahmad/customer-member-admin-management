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
    <form method="GET" action="{{ url('admin/member') }}" class="mb-4">
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
    <a href="{{ route('admin.export') }}" class="btn btn-success mb-4">Export to CSV</a>

    <!-- Admin List Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->role }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ url('admin/member/' . $admin->id . '/edit') }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No admins found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
    <div>
        {{ $admins->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
    </div>
</div>


@endsection
