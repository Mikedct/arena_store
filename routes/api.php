<?php
use App\Http\Controllers\GameController;

Route::get('/game', [GameController::class, 'index']);        // GET
Route::post('/game', [GameController::class, 'store']);       // POST
Route::put('/game', [GameController::class, 'update']);       // PUT
Route::delete('/game', [GameController::class, 'destroy']);   // DELETE
?>