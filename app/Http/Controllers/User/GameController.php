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

        return view('dashboard_user', compact('games'));
    }

    public function show($id)
    {
        $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login
        if (!$token) {
            return redirect('/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get("http://localhost/game_store/game.php?gameID=$id");

        if ($response->successful() && !empty($response->json())) {
            $game = $response->json()[0];
            return view('user.game-detail', compact('game'));
        }

        return abort(404, 'Game tidak ditemukan');
    }
}