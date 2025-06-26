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
            'gameCode' => 'required|string',
            'title' => 'required|string',
            'genre' => 'required|string',
            'platform' => 'required|string',
            'price' => 'required|numeric',
            'releaseDate' => 'required|date',
            'developer' => 'required|string',
            'publisher' => 'required|string',
            'description' => 'required|string',
            'adminID' => 'required|integer',
        ]);

        // Kirim ke API
        $response = Http::post('http://localhost/game_store/game_store/game.php', $data);

        if ($response->successful()) {
            return redirect('/dashboard1')->with('success', 'Game berhasil ditambahkan!');
        } else {
            return back()->withErrors(['message' => 'Gagal menambahkan game.']);
        }
    }

    public function edit($id)
    {
        $response = Http::get("http://localhost/game_store/game_store/game.php?gameID=$id");

        if ($response->successful()) {
            $game = $response->json();

            // Jika API mengembalikan array object
            if (isset($game[0])) {
                $game = $game[0];
            }

            return view('game.edit', compact('game'));
        }

        return redirect('/dashboard1')->withErrors(['message' => 'Gagal memuat data game.']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'gameCode' => 'required|string',
            'title' => 'required|string',
            'genre' => 'required|string',
            'platform' => 'required|string',
            'price' => 'required|numeric',
            'releaseDate' => 'required|date',
            'developer' => 'required|string',
            'publisher' => 'required|string',
            'description' => 'required|string',
            'adminID' => 'required|integer',
        ]);

        $data['gameID'] = (int) $id;

        // Kirim ke game.php via PUT (asForm → x-www-form-urlencoded)
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->put('http://localhost/game_store/game_store/game.php', $data);

        if ($response->successful()) {
            return redirect('/dashboard1')->with('success', 'Game berhasil diperbarui!');
        }

        return back()->withErrors(['message' => 'Gagal memperbarui game.']);
    }
}
