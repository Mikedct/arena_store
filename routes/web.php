<?php

use Illuminate\Support\Facades\Route;
use App\Models\Game;

// Akses game_store.test → redirect ke user login
Route::redirect('/', '/user/login');

/**
 * ===========================
 * AUTH - LOGIN & REGISTER
 * ===========================
 */

// User login & register
Route::view('/user/login', 'user.auth.login')->name('user.login');
Route::view('/user/register', 'user.auth.register')->name('user.register');

// Admin login (via game_store.test/admin/login)
Route::view('/admin/login', 'admin.auth.login')->name('admin.login');

/**
 * ===========================
 * USER 
 * ===========================
 */

Route::prefix('user')->group(function () {
    Route::view('/dashboard', 'user.dashboard')->name('user.dashboard');

    Route::get('/games', function () {
        $games = Game::all();
        return view('user.games', compact('games'));
    });

    Route::view('/orders', 'user.orders')->name('user.orders');
    Route::view('/payment', 'user.payment')->name('user.payment');
    Route::view('/reviews', 'user.reviews')->name('user.reviews');
});

/**
 * ===========================
 * ADMIN
 * ===========================
 */

Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::get('/games', function () {
        $games = Game::all();
        return view('admin.games', compact('games'));
    });

    Route::view('/orders', 'admin.orders')->name('admin.orders');
    Route::view('/payment', 'admin.payment')->name('admin.payment');
    Route::view('/reviews', 'admin.reviews')->name('admin.reviews');
});
