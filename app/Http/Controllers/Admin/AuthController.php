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

        $response = Http::get('http://localhost/game_store/admin.php');

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal terhubung ke server.']);
        }

        $admins = $response->json();

        // Cek kredensial dengan md5
        $admin = collect($admins)->first(function ($a) use ($credentials) {
            return $a['username'] === $credentials['username'] &&
                   $a['password'] === md5($credentials['password']);
        });

        if (!$admin) {
            return back()->withErrors(['message' => 'Username atau password salah.']);
        }

        Session::put('admin', $admin);

        return redirect('/admin/dashboard')->with('success', 'Login berhasil!');
    }

    public function logout()
    {
        Session::forget('admin');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
    }
}