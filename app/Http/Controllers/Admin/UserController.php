<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function show($id)
    {
        $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login

        if (!$token) {
            return redirect('/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }
        
        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get("http://localhost/game_store/user.php?userID=$id");

        if ($response->successful() && !empty($response->json())) {
            $user = $response->json()[0]; // karena API mengembalikan array
            return view('user.user-detail', compact('user'));
        }

        abort(404, 'User tidak ditemukan');
    }
    public function index()
    {
        $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login

        if (!$token) {
            return redirect('/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }
        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get('http://localhost/game_store/user.php');

        if ($response->successful()) {
            $users = $response->json();
            return view('admin.users', compact('users'));
        }

        return view('admin.users', ['users' => []])->withErrors(['message' => 'Gagal memuat data user.']);
    }

    public function destroy($id)
    {
        $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login

        if (!$token) {
            return redirect('/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->send('DELETE', 'http://localhost/game_store/user.php', [
                    'json' => [
                        'userID' => (int) $id,
                    ],
                ]);

        if ($response->successful()) {
            return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
        }

        return back()->withErrors(['message' => 'Gagal menghapus user.']);
    }
}