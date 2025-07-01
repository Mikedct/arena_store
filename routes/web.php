<?php
use App\Http\Controllers\GameViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserGameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;


Route::get('/', function () {
    return redirect('/user/dashboard');
});

Route::get('/user', function () {
    return redirect('/user/dashboard');
});

// Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/user/detail/{id}', [UserController::class, 'show'])->name('user.user-detail');

    // Game CRUD (jika admin perlu akses ini)
    Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
    Route::post('/game/store', [GameController::class, 'store'])->name('game.store');
    Route::get('/game/{id}/edit', [GameController::class, 'edit'])->name('game.edit');
    Route::put('/game/{id}/update', [GameController::class, 'update'])->name('game.update');
    Route::delete('/game/{id}', [GameController::class, 'destroy'])->name('game.destroy');
    
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

});


Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
Route::post('/game/store', [GameController::class, 'store'])->name('game.store');

//User
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::middleware(['user.auth'])->group(function () {
    Route::get('/user/dashboard', [UserGameController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/game-detail/{id}', [UserGameController::class, 'show'])->name('user.game-detail');

});

Route::get('/game/{id}/edit', [GameController::class, 'edit'])->name('game.edit');
Route::put('/game/{id}/update', [GameController::class, 'update'])->name('game.update');

Route::delete('/game/{id}', [GameController::class, 'destroy'])->name('game.destroy');
?>