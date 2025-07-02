<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $token = Session::get('jwt_token');

        if (!$token) {
            return redirect('admin/login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('http://localhost/game_store/game.php');

        if ($response->successful()) {
            $games = $response->json(); // ubah nama variabel ke jamak agar lebih konsisten
            return view('admin.dashboard', compact('games'));
        }

        return view('admin.dashboard')->with('error', 'Gagal mengambil data game.');
    }
}
