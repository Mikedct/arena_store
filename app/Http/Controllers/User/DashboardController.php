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
        $user = session('user');
        $token = session('jwt_token');
        $games = [];

        if (!$token) {
            return redirect('/user/login')->withErrors(['message' => 'Harap login kembali']);
        }

        $baseUrl = "http://localhost/game_store/game.php";

        if ($query) {
            $responseTitle = Http::withHeaders(['Authorization' => "Bearer $token"])
                ->get("$baseUrl?title=$query");
            $responseGenre = Http::withHeaders(['Authorization' => "Bearer $token"])
                ->get("$baseUrl?genre=$query");
            $responsePlatform = Http::withHeaders(['Authorization' => "Bearer $token"])
                ->get("$baseUrl?platform=$query");

            $allResults = array_merge(
                $responseTitle->successful() ? $responseTitle->json() : [],
                $responseGenre->successful() ? $responseGenre->json() : [],
                $responsePlatform->successful() ? $responsePlatform->json() : []
            );

            $games = collect($allResults)->unique('gameID')->values()->all();
        } else {
            $response = Http::withHeaders(['Authorization' => "Bearer $token"])
                ->get($baseUrl);
            $games = $response->successful() ? $response->json() : [];
        }

        return view('user.dashboard', compact('games', 'user'));
    }

    public function show($id)
    {
        $token = session('jwt_token');
        if (!$token) {
            return redirect('/user/login')->withErrors(['message' => 'Harap login kembali']);
        }

        $response = Http::withHeaders(['Authorization' => "Bearer $token"])
            ->get("http://localhost/game_store/game.php?gameID=$id");

        if ($response->successful() && !empty($response->json())) {
            $game = $response->json()[0];
            return view('user.game', compact('game'));
        }

        return abort(404, 'Game tidak ditemukan');
    }
}