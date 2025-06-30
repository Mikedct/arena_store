<?php
use App\Http\Controllers\GameViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserGameController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    if (!session()->has('user')) {
        return redirect('/login');
    }
    return view('user.dashboard');
});

// Admin
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('/user/detail/{id}', [UserController::class, 'show'])->name('user.user-detail');


Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
Route::post('/game/store', [GameController::class, 'store'])->name('game.store');

//User

Route::get('/login', fn() => view('auth.login'));
Route::get('/register', fn() => view('auth.register'));
Route::get('/dashboard', fn() => view('dashboard'));

Route::get('/user/dashboard', [UserGameController::class, 'dashboard'])->name('user.dashboard');
Route::get('/user/game-detail/{id}', [UserGameController::class, 'show'])->name('user.game-detail');

// Route::get('/games', [GameController::class, 'index']);
// Route::get('/games/{id}', [GameController::class, 'show']);

// Route::get('/order', [OrderController::class, 'show']);
// Route::post('/payment', [PaymentController::class, 'show']);
// Route::post('/payment/process', [PaymentController::class, 'process']);


// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::get('/logout', [LoginController::class, 'logout']);



// Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// Route::get('/game-view', [GameViewController::class, 'index']);

Route::get('/game/{id}/edit', [GameController::class, 'edit'])->name('game.edit');
Route::put('/game/{id}/update', [GameController::class, 'update'])->name('game.update');

Route::delete('/game/{id}', [GameController::class, 'destroy'])->name('game.destroy');
?>
