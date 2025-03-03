@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        
        <!-- ===================== Super Admin Management =================== -->
        @auth('admin') <!-- Check if the user is logged in via the 'admin' guard -->
        @if (Auth::guard('admin')->user()->role === 'super-admin')  
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header text-center">
                <h1>Admin Member Management</h1>
            </div>

            <div class="card-body text-center py-5">
                
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-primary" type="button">
                        <h3><a href="{{ url('admin/member') }}">View or Edit Existing Admins</a></h3>
                    </button>
                    <button class="btn btn-primary" type="button">
                        <h3><a href="{{ url('admin/member/new') }}">Add New Admins</a></h3>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
    @endif
    @endauth
    <!-- ====================Member Management================== -->
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header text-center">
                   <h1>Customer Management</h1> 
                </div>

                <div class="card-body text-center py-5">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-primary" type="button">
                            
                        <h3><a href="{{url('admin/customer')}}">View or Edit Existing Customers</a></h3>
                    
                        </button>
                        <button class="btn btn-primary" type="button">
                        <h3><a href="{{url('/admin/customer/new')}}">Add New Customers</a></h3>
                        </button>
                        
                    </div>  

                </div>
            </div>
                    
        </div>
        
    </div>
</div>



@endsection


















