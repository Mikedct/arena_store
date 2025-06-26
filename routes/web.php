<?php
<?php

use Illuminate\Support\Facades\Route;

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

// DASHBOARD ADMIN
Route::get('/admin/login', function () {
    return view('auth.login'); // bisa pakai login yang sama
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

// GAME PAGE USER
Route::get('/games', function () {
    return view('user.games');
});

Route::get('/games/{id}', function ($id) {
    return view('user.game-detail', ['id' => $id]);
});

// ORDER & PAYMENT
Route::get('/order', function () {
    return view('user.order');
});

Route::get('/payment', function () {
    return view('user.payment');
});

