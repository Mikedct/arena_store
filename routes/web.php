<?php

use Illuminate\Support\Facades\Route;
use App\Models\Game;
// HOME / LANDING PAGE
Route::get('/', function () {
    return view('welcome'); // atau halaman home custom
});

// AUTH USER (Login & Register Page)
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

// DASHBOARD USER
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/game', function () {
    $game = Game::all();
    return view('user.game', compact('game'));
});

// DASHBOARD ADMIN
Route::get('/admin/login', function () {
    return view('auth.login'); // bisa pakai login yang sama
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/game/{id}', function ($id) {
    return view('user.game-detail', ['id' => $id]);
});

// ORDER & PAYMENT
Route::get('/order', function () {
    return view('user.order');
});

Route::get('/payment', function () {
    return view('user.payment');
});

