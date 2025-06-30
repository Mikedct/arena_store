<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\AuthController;
// use App\Http\Controllers\Api\AdminController;
// use App\Http\Controllers\Api\GameController;
// use App\Http\Controllers\Api\OrderController;
// use App\Http\Controllers\Api\PaymentController;
// use App\Http\Controllers\Api\ReviewController;

// // ====== AUTH (User & Admin) ======
// Route::prefix('auth')->group(function () {
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('login', [AuthController::class, 'login']);
// });

// // ====== GAMES ======
// Route::get('games', [GameController::class, 'index']);
// Route::get('games/{id}', [GameController::class, 'show']);
// Route::post('games', [GameController::class, 'store']);           // biasanya untuk admin
// Route::put('games/{id}', [GameController::class, 'update']);      // admin
// Route::delete('games/{id}', [GameController::class, 'destroy']);  // admin

// // ====== ORDERS ======
// Route::get('orders', [OrderController::class, 'index']);
// Route::post('orders', [OrderController::class, 'store']);

// // ====== PAYMENTS ======
// Route::post('payments', [PaymentController::class, 'store']);

// // ====== REVIEWS ======
// Route::get('games/{id}/reviews', [ReviewController::class, 'index']);
// Route::post('games/{id}/reviews', [ReviewController::class, 'store']); -->
