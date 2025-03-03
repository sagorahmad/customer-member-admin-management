@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Email Verification') }}</div>

                <div class="card-body text-center">
                    @if (auth()->check() && auth()->user()->hasVerifiedEmail())
                        <h4>Your email has already been verified!</h4>
                        <a href="{{ url('/home') }}" class="btn btn-primary">Go to Dashboard</a>
                    @elseif (auth()->check())
                        <h1>Email Verification Required</h1>
                        <p>Your email is not verified. Please check your inbox.</p>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                        </form>
                        @if (session('message'))
                            <p class="text-success mt-2">{{ session('message') }}</p>
                        @endif
                    @else
                        <h4>You need to log in to access this page.</h4>
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
