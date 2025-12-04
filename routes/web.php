<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Chat\ChannelController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\Chat\MessageReactionController;
use App\Http\Controllers\Chat\MessageReadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SetupController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

    // Chat API
    Route::prefix('api/chat')->group(function () {
        // Channels
        Route::get('/channels', [ChannelController::class, 'index']);
        Route::post('/channels', [ChannelController::class, 'store']);
        Route::get('/channels/{channel}', [ChannelController::class, 'show']);
        Route::put('/channels/{channel}', [ChannelController::class, 'update']);
        Route::delete('/channels/{channel}', [ChannelController::class, 'destroy']);
        Route::post('/channels/{channel}/members', [ChannelController::class, 'addMember']);
        Route::delete('/channels/{channel}/members', [ChannelController::class, 'removeMember']);
        Route::post('/channels/direct/find-or-create', [ChannelController::class, 'findOrCreateDirect']);

        // Messages
        Route::get('/channels/{channel}/messages', [MessageController::class, 'index']);
        Route::post('/channels/{channel}/messages', [MessageController::class, 'store']);
        Route::put('/messages/{message}', [MessageController::class, 'update']);
        Route::delete('/messages/{message}', [MessageController::class, 'destroy']);

        // Reactions
        Route::post('/messages/{message}/reactions', [MessageReactionController::class, 'store']);
        Route::delete('/reactions/{messageReaction}', [MessageReactionController::class, 'destroy']);

        // Read receipts
        Route::post('/channels/{channel}/reads', [MessageReadController::class, 'store']);
    });
});

// 404
Route::match(['get', 'post', 'put', 'patch', 'delete', 'options'], '{fallbackPlaceholder?}', function () {
    return Inertia::render('404');
})
    ->where('fallbackPlaceholder', '.*')
    ->fallback()
    ->name('404');
