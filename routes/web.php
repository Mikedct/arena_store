<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\GameController as UserGameController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;

use App\Models\Game;

// Redirect default route ke login
Route::redirect('/', '/user/login');

// ============================
// AUTH ROUTES (USER)
// ============================
Route::view('/user/login', 'user.auth.login')->name('user.login');
Route::view('/user/register', 'user.auth.register')->name('user.register');

Route::post('/user/login', [AuthController::class, 'login'])->name('user.login.submit');
Route::post('/user/register', [AuthController::class, 'register'])->name('user.register.submit');

Route::post('/user/logout', function () {
    session()->flush();
    return redirect()->route('user.login')->with('success', 'Logout berhasil');
})->name('user.logout');

// ============================
// USER ROUTES (LOGIN REQUIRED)
// ============================
Route::prefix('user')->name('user.')->middleware('auth.user')->group(function () {
    // Dashboard & Game
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/game/{id}', [UserGameController::class, 'show'])->name('game.show');
    Route::post('/game/{id}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/game/{id}/reviews', [ReviewController::class, 'index'])->name('review.index');


    // Akun Pribadi
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');

    // Orders & Payment
    Route::view('/orders', 'user.orders')->name('orders');
    Route::post('/payment', [AdminPaymentController::class, 'store'])->name('payment.store');

});

// ============================
// AUTH ROUTES (USER)
// ============================
Route::view('/admin/login', 'admin.auth.login')->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::post('/admin/logout', function () {
    session()->flush();
    return redirect()->route('admin.login')->with('success', 'Logout berhasil');
})->name('admin.logout');

// ============================
// ADMIN ROUTES
// ============================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Game Management
    Route::get('/game/create/', [AdminGameController::class, 'create'])->name('game.create');
    Route::post('/game/store', [AdminGameController::class, 'store'])->name('game.store');
    Route::get('/game/{id}', [AdminGameController::class, 'show'])->name('game.show');
    Route::put('/game/edit/{id}', [AdminGameController::class, 'update'])->name('admin.game.update');
    Route::get('/game/edit/{id}', [AdminGameController::class, 'edit'])->name('game.edit');
    Route::delete('/game/delete/{id}', [AdminGameController::class, 'destroy'])->name('game.delete');

    // Review Management
    Route::put('/review/edit/{id}', [AdminReviewController::class, 'edit'])->name('review.edit');
    Route::put('/review/update/{id}', [AdminReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/delete/{id}', [AdminReviewController::class, 'destroy'])->name('review.delete');

    // Static Pages
    Route::get('/games', fn() => view('admin.games', ['games' => Game::all()]))->name('games');
    Route::view('/orders', 'admin.orders')->name('orders');
    Route::view('/payment', 'admin.payment')->name('payment');
    Route::view('/review', 'admin.review')->name('review.overview');

    //Payment
    Route::get('/admin/payment', [AdminPaymentController::class, 'index'])->name('admin.payment');

});
