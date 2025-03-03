@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 class="text-center mb-4">Welcome! Thank you for logging in.</h1>
                    <p class="text-center">Click below to edit or update your profile.</p>

                    <div class="text-center">
                        <a href="{{ route('mypage.edit') }}" class="btn btn-info btn-lg" style="font-size:1.5rem;font-weight:500;">
                            Edit or Update Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
