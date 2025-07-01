<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = $request->query('search');
        $games = [];
        $user = session('user'); // Ambil user dari session

        if ($query) {
            $responseTitle = Http::get("http://localhost/Game_Store/game.php?title=$query");
            $responseGenre = Http::get("http://localhost/Game_Store/game.php?genre=$query");
            $responsePlatform = Http::get("http://localhost/Game_Store/game.php?platform=$query");

            $allResults = array_merge(
                $responseTitle->successful() ? $responseTitle->json() : [],
                $responseGenre->successful() ? $responseGenre->json() : [],
                $responsePlatform->successful() ? $responsePlatform->json() : []
            );

            $games = collect($allResults)->unique('gameID')->values()->all();
        } else {
            $response = Http::get("http://localhost/Game_Store/game.php");
            $games = $response->successful() ? $response->json() : [];
        }

        return view('user.dashboard', compact('games', 'user'));
    }

    public function show($id)
    {
        $response = Http::get("http://localhost/game_store/game.php?gameID=$id");

        if ($response->successful() && !empty($response->json())) {
            $game = $response->json()[0];
            return view('user.game', compact('game'));
        }

        return abort(404, 'Game tidak ditemukan');
    }
}

