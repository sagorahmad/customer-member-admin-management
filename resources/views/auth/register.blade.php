@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Register') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/entry') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name (Optional)') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Custom Text -->
                        <div class="row mb-3">
                            <label for="custom_text" class="col-md-4 col-form-label text-md-end">{{ __('Custom Text (Optional)') }}</label>
                            <div class="col-md-6">
                                <input id="custom_text" type="text" class="form-control @error('custom_text') is-invalid @enderror" name="custom_text" value="{{ old('custom_text') }}">
                                @error('custom_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                @error('gender')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Preferences -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Preferences') }}</label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="preferences[]" id="preference1" value="option1" {{ is_array(old('preferences')) && in_array('option1', old('preferences')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="preference1">Option 1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="preferences[]" id="preference2" value="option2" {{ is_array(old('preferences')) && in_array('option2', old('preferences')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="preference2">Option 2</label>
                                </div>
                                @error('preferences')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Favorite Color -->
                        <div class="row mb-3">
                            <label for="color" class="col-md-4 col-form-label text-md-end">{{ __('Favorite Color') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('color') is-invalid @enderror" name="color" id="color" required>
                                    <option value="">Select</option>
                                    <option value="Red" {{ old('color') == 'Red' ? 'selected' : '' }}>Red</option>
                                    <option value="Green" {{ old('color') == 'Green' ? 'selected' : '' }}>Green</option>
                                    <option value="Yellow" {{ old('color') == 'Yellow' ? 'selected' : '' }}>Yellow</option>
                                    <option value="Blue" {{ old('color') == 'Blue' ? 'selected' : '' }}>Blue</option>
                                </select>
                                @error('color')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Profile Picture -->
                        <div class="row mb-3">
                            <label for="profile_picture" class="col-md-4 col-form-label text-md-end">{{ __('Profile Picture (Optional)') }}</label>
                            <div class="col-md-6">
                                <input id="profile_picture" type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture">
                                @error('profile_picture')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
