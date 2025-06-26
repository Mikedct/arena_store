<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    public function create()
    {
        return view('game.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gameCode'     => 'required|string',
            'title'        => 'required|string',
            'genre'        => 'required|string',
            'platform'     => 'required|string',
            'price'        => 'required|numeric',
            'releaseDate'  => 'required|date',
            'developer'    => 'required|string',
            'publisher'    => 'required|string',
            'description'  => 'required|string',
            'adminID'      => 'required|integer',
        ]);

        // Kirim ke API
        $response = Http::post('http://localhost/game_store/game_store/game.php', $data);

        if ($response->successful()) {
            return redirect('/dashboard1')->with('success', 'Game berhasil ditambahkan!');
        } else {
            return back()->withErrors(['message' => 'Gagal menambahkan game.']);
        }
    }
}
