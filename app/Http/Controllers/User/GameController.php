<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = $request->query('search');
        $games = [];
        $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login

        if (!$token) {
            return redirect('/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        if ($query) {
            $responseTitle = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get("http://localhost/game_store/game.php?title=$query");
            $responseGenre = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get("http://localhost/game_store/game.php?genre=$query");
            $responsePlatform = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get("http://localhost/game_store/game.php?platform=$query");

            $allResults = array_merge(
                $responseTitle->successful() ? $responseTitle->json() : [],
                $responseGenre->successful() ? $responseGenre->json() : [],
                $responsePlatform->successful() ? $responsePlatform->json() : []
            );

            $games = collect($allResults)->unique('gameID')->values()->all();
        } else {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get('http://localhost/game_store/game.php');

            $games = $response->successful() ? $response->json() : [];
        }

        return view('dashboard', compact('games'));
    }

    public function show($id)
    {
        $token = Session::get('jwt_token');

        if (!$token) {
            return redirect('/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        // Ambil detail game
        $gameResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get("http://localhost/game_store/game.php?gameID=$id");

        // Ambil review untuk game ini
        $reviewResponse = Http::get("http://localhost/game_store/review.php?gameID=$id");

        if ($gameResponse->successful() && !empty($gameResponse->json())) {
            $game = $gameResponse->json()[0];
            $reviews = $reviewResponse->successful() ? $reviewResponse->json() : [];

            return view('user.game', compact('game', 'reviews'));
        }

        return abort(404, 'Game tidak ditemukan');
    }
}