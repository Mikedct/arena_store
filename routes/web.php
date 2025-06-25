<?php
use App\Http\Controllers\GameViewController;

Route::get('/db-check', function () {
    try {
        \DB::connection()->getPdo();
        return "✅ Koneksi berhasil ke database: " . \DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "❌ Gagal konek DB: " . $e->getMessage();
    }
});

Route::get('/game-view', [GameViewController::class, 'index']);
?>