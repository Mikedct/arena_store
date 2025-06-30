<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'videolink' => 'nullable|string',
            'adminID' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

            $request->file('image')->move(public_path('images/games'), $filename);
            $data['image'] = $filename;
        } else {
            $data['image'] = null;
        }

        if (isset($data['videolink']) && str_contains($data['videolink'], 'watch?v=')) {
            $data['videolink'] = str_replace('watch?v=', 'embed/', $data['videolink']);
        }

        $response = Http::asJson()->post('http://localhost/game_store/game.php', $data);

        if ($response->successful()) {
            return redirect('/admin/dashboard')->with('success', 'Game berhasil ditambahkan!');
        } else {
            return back()->withErrors(['message' => 'Gagal menambahkan game.']);
        }
    }

    public function edit($id)
    {
        $response = Http::get("http://localhost/game_store/game.php?gameID=$id");

        if ($response->successful()) {
            $game = $response->json();
            if (isset($game[0])) {
                $game = $game[0];
            }
            return view('game.edit', compact('game'));
        }

        return redirect('/admin/dashboard')->withErrors(['message' => 'Gagal memuat data game.']);
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
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'videolink' => 'nullable|string',
            'adminID' => 'required|integer',
        ]);

        $data['gameID'] = (int) $id;

        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

            $request->file('image')->move(public_path('images/games'), $filename);
            $data['image'] = $filename;
        } else {
            $data['image'] = null;
        }

        if (isset($data['videolink']) && str_contains($data['videolink'], 'watch?v=')) {
            $data['videolink'] = str_replace('watch?v=', 'embed/', $data['videolink']);
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->put('http://localhost/game_store/game.php', $data);

        if ($response->successful()) {
            return redirect('/admin/dashboard')->with('success', 'Game berhasil diperbarui!');
        }

        return back()->withErrors(['message' => 'Gagal memperbarui game.']);
    }

    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->send('DELETE', 'http://localhost/game_store/game.php', [
            'json' => ['gameID' => $id]
        ]);

        if ($response->successful()) {
            return redirect('/admin/dashboard')->with('success', 'Game berhasil dihapus.');
        }

        return back()->withErrors(['message' => 'Gagal menghapus game.']);
    }
}
