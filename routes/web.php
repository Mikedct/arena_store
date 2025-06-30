<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReviewController;
use App\Models\Game;

// Redirect ke user login
Route::redirect('/', '/user/login');

/**
 * ===========================
 * AUTH - LOGIN & REGISTER
 * ===========================
 */
Route::view('/user/login', 'user.auth.login')->name('user.login');
Route::view('/user/register', 'user.auth.register')->name('user.register');
Route::view('/admin/login', 'admin.auth.login')->name('admin.login');

/**
 * ===========================
 * USER ROUTES
 * ===========================
 */
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/game/{id}', [DashboardController::class, 'show'])->name('game.show');

    // Review Game
    Route::post('/game/{id}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/game/{id}/review', [ReviewController::class, 'index'])->name('review.index');

    // Dummy pages (jika belum dibuat controller)
    Route::view('/orders', 'user.orders')->name('orders');
    Route::view('/payment', 'user.payment')->name('payment');
});

/**
 * ===========================
 * ADMIN ROUTES
 * ===========================
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

    Route::get('/games', function () {
        $games = Game::all();
        return view('admin.games', compact('games'));
    })->name('games');

    Route::view('/orders', 'admin.orders')->name('orders');
    Route::view('/payment', 'admin.payment')->name('payment');
    Route::view('/reviews', 'admin.review')->name('review');
});