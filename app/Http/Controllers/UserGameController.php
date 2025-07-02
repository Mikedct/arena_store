<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class UserGameController extends Controller
{
    public function dashboard(Request $request)
{
    $query = $request->query('search');
    $games = [];

    if ($query) {
        $responseTitle = Http::get("http://localhost/game_store/game.php?title=$query");
        $responseGenre = Http::get("http://localhost/game_store/game.php?genre=$query");
        $responsePlatform = Http::get("http://localhost/game_store/game.php?platform=$query");

        $allResults = array_merge(
            $responseTitle->successful() ? $responseTitle->json() : [],
            $responseGenre->successful() ? $responseGenre->json() : [],
            $responsePlatform->successful() ? $responsePlatform->json() : []
        );

        $games = collect($allResults)->unique('gameID')->values()->all();
    } else {
        $response = Http::get("http://localhost/game_store/game.php");
        $games = $response->successful() ? $response->json() : [];
    }

    $userId = Auth::id();
    $payments = Payment::with('game')->where('user_id', $userId)->get();

    return view('dashboard_user', compact('games', 'payments'));
}

    public function show($id)
    {
        $response = Http::get("http://localhost/game_store/game.php?gameID=$id");

        if ($response->successful() && !empty($response->json())) {
            $game = $response->json()[0];
            return view('user.game-detail', compact('game'));
        }

        return abort(404, 'Game tidak ditemukan');
    }
}
