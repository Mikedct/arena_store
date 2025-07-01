<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\GameController as UserGameController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\GameController; // ✅ untuk route auth.user terakhir
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
// USER ROUTES (BUTUH LOGIN)
// ============================
Route::prefix('user')->name('user.')->middleware('auth.user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/game/{id}', [UserGameController::class, 'show'])->name('game.show');
    Route::post('/game/{id}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::view('/orders', 'user.orders')->name('orders');
    Route::view('/payment', 'user.payment')->name('payment');
});

// ============================
// ADMIN ROUTES (tidak pakai middleware di sini, tapi bisa ditambah nanti)
// ============================
Route::prefix('admin')->name('admin.')->group(function () {
    // Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Game Management
    Route::get('/game/{id}', [AdminGameController::class, 'show'])->name('game.show');
    Route::get('/game/edit/{id}', [AdminGameController::class, 'edit'])->name('game.edit');
    Route::delete('/game/delete/{id}', [AdminGameController::class, 'destroy'])->name('game.delete');

    // Review Management
    Route::get('/review/edit/{id}', [AdminReviewController::class, 'edit'])->name('review.edit');
    Route::put('/review/update/{id}', [AdminReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/delete/{id}', [AdminReviewController::class, 'destroy'])->name('review.delete');

    // Static Pages
    Route::get('/games', function () {
        $games = Game::all();
        return view('admin.games', compact('games'));
    })->name('games');

    Route::view('/orders', 'admin.orders')->name('orders');
    Route::view('/payment', 'admin.payment')->name('payment');
    Route::view('/review', 'admin.review')->name('review.overview');
});

// ============================
// OPSIONAL: Tambahan route proteksi token khusus
// (jika tidak mau digabung ke atas, bisa simpan sini)
// ============================
/*
Route::middleware(['auth.user'])->group(function () {
    Route::get('/game/{id}', [GameController::class, 'show']);
    // Tambahkan route lain yang ingin dilindungi token di sini
});
*/
