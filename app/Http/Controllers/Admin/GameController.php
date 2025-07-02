<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    public function create()
    {
        return view('admin.game-create');
    }

    public function store(Request $request)
    {
        $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login

        if (!$token) {
            return redirect('/admin/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }
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
        ]);

        $admin = Session::get('admin');

        if (!$admin || !isset($admin['adminID'])) {
            return redirect('/admin/login')->withErrors(['message' => 'Admin belum login.']);
        }

        $data['adminID'] = $admin['adminID'];


        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

            $request->file('image')->move(public_path('images/games'), $filename);

            // Tambahkan nama file ke data yang akan dikirim ke API
            $data['image'] = $filename;
        } else {
            // Jika tidak upload gambar, tetap isi kosong atau default
            $data['image'] = null;
        }

        if (isset($data['videolink']) && str_contains($data['videolink'], 'watch?v=')) {
            $data['videolink'] = str_replace('watch?v=', 'embed/', $data['videolink']);
        }

        // Kirim ke API
        $response = Http::withHeaders(headers: [
            'Authorization' => 'Bearer ' . $token
        ])->post("http://localhost/game_store/game.php", $data);

        if ($response->successful()) {
            return redirect('/admin/dashboard')->with('success', 'Game berhasil ditambahkan!');
        } else {
            return back()->withErrors(['message' => 'Gagal menambahkan game.']);
        }
    }

    public function edit($id)
    {
        $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login

        if (!$token) {
            return redirect('/admin/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        $response = Http::withHeaders(headers: [
            'Authorization' => 'Bearer ' . $token
        ])->get("http://localhost/game_store/game.php?gameID=$id");

        if ($response->successful()) {
            $game = $response->json();

            // Jika API mengembalikan array object
            if (isset($game[0])) {
                $game = $game[0];
            }

            return view('admin.game-edit', compact('game'));
        }

        return redirect('/admin/dashboard')->withErrors(['message' => 'Gagal memuat data game.']);
    }

    public function update(Request $request, $id)
    {
        $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login

        if (!$token) {
            return redirect('/admin/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }
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
            'videolink' => 'nullable|string'
        ]);

        $data['gameID'] = (int) $id;

        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

            $request->file('image')->move(public_path('images/games'), $filename);

            // Tambahkan nama file ke data yang akan dikirim ke API
            $data['image'] = $filename;
        } else {
            // Jika tidak upload gambar, tetap isi kosong atau default
            $data['image'] = null;
        }

        if (isset($data['videolink']) && str_contains($data['videolink'], 'watch?v=')) {
            $data['videolink'] = str_replace('watch?v=', 'embed/', $data['videolink']);
        }


        // Kirim ke game.php via PUT (asForm → x-www-form-urlencoded)
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->put('http://localhost/game_store/game.php', $data);

        if ($response->successful()) {
            return redirect('/admin/dashboard')->with('success', 'Game berhasil diperbarui!');
        }

        return back()->withErrors(['message' => 'Gagal memperbarui game.']);
    }

    public function destroy($id)
    {
        $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login

        if (!$token) {
            return redirect('/admin/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token

        ])->send('DELETE', 'http://localhost/game_store/game.php', [
                    'json' => [
                        'gameID' => $id,
                    ]
                ]);

        if ($response->successful()) {
            return redirect('/admin/dashboard')->with('success', 'Game berhasil dihapus.');
        }

        return back()->withErrors(['message' => 'Gagal menghapus game.']);
    }
}