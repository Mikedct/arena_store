<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    public function show($id)
    {
        $token = Session::get('jwt_token');

        if (!$token) {
            return redirect('/user/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get("http://localhost/game_store/game.php?gameID=$id");

        if ($response->successful() && !empty($response->json())) {
            $game = $response->json()[0];
            return view('user.game', compact('game'));
        }

        return abort(404, 'Game tidak ditemukan');
    }
}