<?php
use App\Http\Controllers\GameViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return 'Homepage berhasil!';
});

Route::get('/game', function () {
    return view('game');
});

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
?>
