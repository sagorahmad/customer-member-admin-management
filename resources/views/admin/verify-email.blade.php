@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Verification') }}</div>

                <div class="card-body text-center">
                @if (!auth('admin')->user()->hasVerifiedEmail())
                <h1>Email Verification Required</h1>
                
                  <p>Your email is not verified. Please check your inbox.</p>
                  <form method="POST" action="{{ route('admin.verification.send') }}">
                     @csrf
                     <button type="submit">Resend Verification Email</button>
                  </form>
               @else
                  <h4>Your email has been verified! <a href="{{ url('/admin/dashboard') }}">Go to Dashboard</a></h4>
               @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


















