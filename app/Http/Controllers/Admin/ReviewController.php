<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function show($id)
    {
        $game = Http::get("http://localhost/game_store/game.php?gameID=$id")->json()[0] ?? null;

        if (!$game) {
            return redirect()->route('admin.dashboard')->with('error', 'Game tidak ditemukan.');
        }

        // Ambil review hanya untuk game ini saja
        $reviews = Http::get("http://localhost/game_store/review.php?gameID=$id")->json();

        return view('admin.game', [
            'game' => $game,
            'reviews' => is_array($reviews) ? $reviews : [],
        ]);
    }
}