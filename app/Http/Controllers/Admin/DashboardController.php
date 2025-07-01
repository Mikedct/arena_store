<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost/game_store/game.php');

        if ($response->successful()) {
            $game = $response->json();
        } else {
            $game = [];
        }

        return view('admin.dashboard', compact('game'));
    }
}
