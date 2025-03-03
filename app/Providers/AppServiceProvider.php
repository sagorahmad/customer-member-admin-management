<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CheckIsAdmin;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::aliasMiddleware('superAdmin', \App\Http\Middleware\Role\SuperAdminMiddleware::class);
        Route::aliasMiddleware('admin', \App\Http\Middleware\Role\AdminMiddleware::class);
        Route::aliasMiddleware('adminOrSuperAdmin', \App\Http\Middleware\Role\AdminOrSuperAdminMiddleware::class);
        Route::aliasMiddleware('member', \App\Http\Middleware\Role\MemberMiddleware::class);
        Route::aliasMiddleware('verified', \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class); // Ensure this is included
    }

}
