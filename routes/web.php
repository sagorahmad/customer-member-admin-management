<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});



// Email verification routes
Auth::routes(['verify' => true]);

// Replace the default registration route
Route::get('/entry', [RegisterController::class, 'showRegistrationForm'])->name('entry');
Route::post('/entry', [RegisterController::class, 'register']);
// ===================user registration verification========



// Email verification notice
// Email verification notice
// Email verification notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');



// Email verification handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('message', 'Your email has been verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email
// Resend verification email
// Resend verification email
Route::post('/email/verification-notification', function (Request $request) {
    $user = $request->user(); // Get the authenticated user

    if (!$user) {
        return redirect('/login')->withErrors('You must be logged in to resend the verification email.');
    }

    if ($user->hasVerifiedEmail()) {
        return redirect('/home')->with('message', 'Your email is already verified.');
    }

    $user->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// User-Specific Routes
Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('member.dashboard');
    Route::get('/mypage/edit', [UserController::class, 'edit'])->name('mypage.edit');
    Route::put('/mypage/edit', [UserController::class, 'update'])->name('mypage.update');
});

// Admin & SuperAdmin Shared Routes
Route::middleware(['auth:admin', 'adminOrSuperAdmin', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Customer Management
    Route::get('/admin/customer', [AdminController::class, 'members'])->name('admin.customer');
    Route::get('/admin/customer/export', [AdminController::class, 'exportToCSV'])->name('customer.export');
    Route::get('/admin/customer/{id}/edit', [AdminController::class, 'edit'])->name('admin.customer.edit');
    Route::put('/admin/customer/{id}', [AdminController::class, 'update'])->name('admin.customer.update');
    Route::get('/admin/customer/new', [AdminController::class, 'create'])->name('admin.customer.create');
    Route::post('/admin/customer/new', [AdminController::class, 'store'])->name('admin.customer.store');
});

// SuperAdmin-Specific Routes
Route::middleware(['auth:admin', 'superAdmin', 'verified'])->group(function () {
    Route::get('/admin/member/new', [SuperAdminController::class, 'createAdmin'])->name('super-admin.createAdmin');
    Route::post('/admin/member/new', [SuperAdminController::class, 'store'])->name('super-admin.store');
    Route::get('/admin/member', [SuperAdminController::class, 'members'])->name('admin.member');
    Route::get('/admin/member/export', [SuperAdminController::class, 'exportToCSV'])->name('admin.export');
    Route::get('/admin/member/{id}/edit', [SuperAdminController::class, 'edit'])->name('admin.member.edit');
    Route::put('/admin/member/{id}', [SuperAdminController::class, 'update'])->name('admin.member.update');
});

// Admin Authentication
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Admin Registration
    Route::get('/register', [AdminRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AdminRegisterController::class, 'register']);

    // Email Verification for Admins
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/email/verify', function () {
            return view('admin.verify-email');
        })->name('verification.notice');

        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            return redirect()->route('admin.dashboard')->with('success', 'Email verified!');
        })->middleware(['signed'])->name('verification.verify');

        Route::post('/email/verification-notification', function (Request $request) {
            auth('admin')->user()->sendEmailVerificationNotification();
            return back()->with('message', 'Verification link sent!');
        })->middleware('throttle:6,1')->name('verification.send');
    });
});
