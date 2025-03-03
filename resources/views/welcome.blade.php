@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <h1>Welcome to Our Website!</h1>
        <p>Manage your profile or log in to access your account.</p>
        @guest
       
        <div class="mt-4 py-3 px-4">
            <a href="{{ route('login') }}" class="btn btn-primary d-block d-md-inline-block mb-3 mb-md-0 mx-md-2">User Login</a>
            <a href="{{ url('/entry') }}" class="btn btn-success d-block d-md-inline-block mb-3 mb-md-0 mx-md-2">User Register</a>
            <a href="{{ route('admin.login') }}" class="btn btn-warning d-block d-md-inline-block mb-3 mb-md-0 mx-md-2">Admin Login</a>
            <a href="{{ route('admin.register') }}" class="btn btn-info d-block d-md-inline-block mb-3 mb-md-0 mx-md-2">Admin Registration</a>
        </div>
       
        
        

        
        @endguest
        @auth('web')
        <div class="mt-4 py-3 px-4">
            <a href="{{ url('/home') }}" 
            class="btn btn-primary d-block d-md-inline-block mb-3 mb-md-0 mx-md-2">
            GO HOME </a>
            
        </div>
        @endauth

    </div>
</div>
@endsection
