<?php
use App\Http\Controllers\GameViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

Route::get('/login', fn() => view('auth.login'));
Route::get('/register', fn() => view('auth.register'));
Route::get('/dashboard', fn() => view('dashboard'));

// Route::get('/games', [GameController::class, 'index']);
// Route::get('/games/{id}', [GameController::class, 'show']);

// Route::get('/order', [OrderController::class, 'show']);
// Route::post('/payment', [PaymentController::class, 'show']);
// Route::post('/payment/process', [PaymentController::class, 'process']);


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/', function () {
    if (!session()->has('admin')) {
        return redirect('/login');
    }

    return view('dashboard');
});

Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/game-view', [GameViewController::class, 'index']);

Route::get('/dashboard1', [DashboardController::class, 'index']);
?>
