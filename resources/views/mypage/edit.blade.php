@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Edit Profile</h1>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('mypage.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Custom Text -->
                        <div class="mb-3">
                            <label for="custom_text" class="form-label">Custom Text</label>
                            <input type="text" class="form-control @error('custom_text') is-invalid @enderror" id="custom_text" name="custom_text" value="{{ old('custom_text', $user->custom_text) }}">
                            @error('custom_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preferences -->
                        <div class="mb-3">
                            <label for="preferences" class="form-label">Preferences</label>
                            <div>
                                @foreach (['option1', 'option2'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="preferences[]" value="{{ $option }}" {{ in_array($option, old('preferences', json_decode($user->preferences, true) ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ ucfirst($option) }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('preferences')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div class="mb-3">
                            <label for="color" class="form-label">Favorite Color</label>
                            <select class="form-control @error('color') is-invalid @enderror" name="color" id="color" required>
                                <option value="">Select</option>
                                @foreach (['Red', 'Green', 'Yellow', 'Blue'] as $color)
                                    <option value="{{ $color }}" {{ old('color', $user->colors) == $color ? 'selected' : '' }}>{{ $color }}</option>
                                @endforeach
                            </select>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
                            @if($user->profile_picture)
                                <div class="mt-2">
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            @endif
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Dummy hidden field -->
                        <input type="text" style="display:none" autocomplete="username">
                        <input type="password" style="display:none" autocomplete="new-password">
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
