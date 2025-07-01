<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
{
    $token = Session::get('jwt_token'); // pastikan token sudah disimpan saat login

    if (!$token) {
        return redirect('/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token
    ])->get('http://localhost/game_store/game.php');

    if ($response->successful()) {
        $games = $response->json();
        return view('admin.dashboard', compact('games'));
    }

    return view('admin.dashboard')->withErrors(['message' => 'Gagal mengambil data game.']);
}
}