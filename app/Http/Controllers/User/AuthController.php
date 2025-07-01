<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Proses login user
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil user dari API
        $res = Http::get('http://localhost/game_store/user.php?username=' . $request->username);
        $users = $res->json();

        if (!$users || count($users) === 0) {
            return back()->with('error', 'User tidak ditemukan');
        }

        $user = $users[0];

        if ($user['password'] !== md5($request->password)) {
            return back()->with('error', 'Password salah');
        }

        // ✅ Generate token random
        $token = bin2hex(random_bytes(32));

        // 🔒 Simpan token & user ke session
        session([
            'user_token' => $token,
            'user_id' => $user['userID'],
            'user_data' => $user,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Login berhasil');
    }

    /**
     * Proses registrasi user
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'username' => 'required|string|max:50|alpha_num',
            'email' => 'required|email',
            'dateOfBirth' => 'required|date',
            'phoneNumber' => 'required|string|max:20',
            'password' => 'required|min:6',
        ]);

        // Kirim data ke API
        $response = Http::post('http://localhost/game_store/user.php', [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'username' => $request->username,
            'email' => $request->email,
            'dateOfBirth' => $request->dateOfBirth,
            'phoneNumber' => $request->phoneNumber,
            'password' => md5($request->password),
        ]);

        if ($response->successful()) {
            return redirect()->route('user.login')->with('success', 'Registrasi berhasil! Silakan login.');
        }

        return back()->with('error', 'Registrasi gagal. Coba lagi.');
    }

    /**
     * Proses logout user
     */
    public function logout()
    {
        session()->forget(['user_token', 'user_id', 'user_data']);
        session()->flush(); // bersihkan semua session

        return redirect()->route('user.login')->with('success', 'Logout berhasil.');
    }
}
