<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost/game_store/game_store/game.php');

        if ($response->successful()) {
            $games = $response->json(); // bisa array tunggal atau array banyak
        } else {
            $games = [];
        }

        return view('dashboard1', compact('games'));
    }
}
