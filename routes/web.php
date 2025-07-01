<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\GameController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Models\Game;

Route::redirect('/', '/user/login');

// AUTH ROUTES
Route::view('/user/login', 'user.auth.login')->name('user.login');
Route::view('/user/register', 'user.auth.register')->name('user.register');
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login.submit');
Route::post('/user/register', [AuthController::class, 'register'])->name('user.register.submit');
Route::post('/user/logout', function () {
    session()->flush();
    return redirect()->route('user.login')->with('success', 'Logout berhasil');
})->name('user.logout');
Route::middleware('auth.bearer')->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');
});


// USER ROUTES (dengan auth middleware)
Route::prefix('user')->name('user.')->middleware('auth.bearer')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/game/{id}', [GameController::class, 'show'])->name('game.show');
    Route::post('/game/{id}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::view('/orders', 'user.orders')->name('orders');
    Route::view('/payment', 'user.payment')->name('payment');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Game Management
    Route::get('/game/{id}', [GameController::class, 'adminShow'])->name('game.show');
    Route::get('/game/edit/{id}', [GameController::class, 'edit'])->name('game.edit');
    Route::delete('/game/delete/{id}', [GameController::class, 'destroy'])->name('game.delete');

    // Review Management
    Route::get('/review/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/review/edit/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/delete/{id}', [ReviewController::class, 'destroy'])->name('review.delete');

    // Static pages (if needed)
    Route::get('/games', function () {
        $games = Game::all();
        return view('admin.games', compact('games'));
    })->name('games');

    Route::view('/orders', 'admin.orders')->name('orders');
    Route::view('/payment', 'admin.payment')->name('payment');
    Route::view('/review', 'admin.review')->name('review.overview');
});
