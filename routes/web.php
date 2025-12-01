<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SetupController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

// Forgot Password
Route::get('/reset-password', [ResetPasswordController::class, 'create'])->name('password-reset.create');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password-reset.store');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])->name('password-reset.show');
Route::patch('/reset-password', [ResetPasswordController::class, 'update'])->name('password-reset.update');

// App Setup
Route::get('/setup/admin', [SetupController::class, 'show'])->name('setup.admin.show');
Route::post('/setup/admin', [SetupController::class, 'store'])->name('setup.admin.store');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

// 404
Route::match(['get', 'post', 'put', 'patch', 'delete', 'options'], '{fallbackPlaceholder?}', function () {
    return Inertia::render('404');
})
    ->where('fallbackPlaceholder', '.*')
    ->fallback()
    ->name('404');
