<?php
use App\Http\Controllers\GameViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    if (!session()->has('user')) {
        return redirect('/login');
    }
    return view('user.dashboard');
});

// Admin
Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
Route::post('/game/store', [GameController::class, 'store'])->name('game.store');

//User

Route::get('/login', fn() => view('auth.login'));
Route::get('/register', fn() => view('auth.register'));
Route::get('/dashboard', fn() => view('dashboard'));

Route::get('/user/dashboard', function (\Illuminate\Http\Request $request) {
    $query = $request->query('search');
    $games = [];

    if ($query) {
        // Coba filter berdasarkan title, genre, atau platform
        $responseTitle = Http::get("http://localhost/game_store/game_store/game.php?title=$query");
        $responseGenre = Http::get("http://localhost/game_store/game_store/game.php?genre=$query");
        $responsePlatform = Http::get("http://localhost/game_store/game_store/game.php?platform=$query");

        $allResults = array_merge(
            $responseTitle->successful() ? $responseTitle->json() : [],
            $responseGenre->successful() ? $responseGenre->json() : [],
            $responsePlatform->successful() ? $responsePlatform->json() : []
        );

        // Hapus duplikat berdasarkan gameID
        $games = collect($allResults)->unique('gameID')->values()->all();
    } else {
        $response = Http::get("http://localhost/game_store/game_store/game.php");
        $games = $response->successful() ? $response->json() : [];
    }

    return view('dashboard_user', compact('games'));
});

Route::get('/user/game-detail/{id}', function ($id) {
    $response = Http::get("http://localhost/game_store/game_store/game.php?gameID=$id");

    if ($response->successful() && !empty($response->json())) {
        $game = $response->json()[0]; // karena API mengembalikan array
        return view('user.game-detail', compact('game'));
    }

    return abort(404, 'Game tidak ditemukan');
});

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
