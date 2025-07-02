<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Login dan ambil token dari endpoint login_admin.php
        $response = Http::post('http://localhost/game_store/login_admin.php', [
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ]);

        $data = $response->json();

        if (!$response->successful() || !isset($data['token'])) {
            return back()->withErrors([
                'message' => $data['message'] ?? 'Login gagal. Cek username dan password.'
            ]);
        }

        // Simpan data admin ke session
        Session::put('jwt_token', $data['token']);
        Session::put('admin_token', $data['token']);
        Session::put('admin_id', $data['adminID'] ?? null);
        Session::put('admin_username', $data['username'] ?? $credentials['username']);

        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
    }

    public function logout()
    {
        Session::forget(['jwt_token', 'admin_token', 'admin_id', 'admin_username']);
        return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
    }
}
