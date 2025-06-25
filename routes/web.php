<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Homepage berhasil!';
});

Route::get('/game', function () {
    return view('game');
});
