<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class GameViewController extends Controller
{
    public function index()
    {
        $games = DB::table('game')->get();
        return view('game-view', compact('games'));
    }
}
