<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil semua user dari API
        $response = Http::get('http://localhost/game_store/user.php');
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal terhubung ke server.']);
        }

        $users = $response->json();

        // Cari user yang cocok
        $user = collect($users)->first(function ($u) use ($credentials) {
            return $u['username'] === $credentials['username']
                && $u['password'] === md5($credentials['password']); // asumsikan password di-hash md5
        });

        if (!$user) {
            return back()->withErrors(['message' => 'Username atau password salah.']);
        }

        // Simpan data user ke session
        Session::put('user', $user);

        return redirect('/user/dashboard')->with('success', 'Login berhasil!');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/login')->with('success', 'Logout berhasil.');
    }

    // ✅ Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ✅ Proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'dateOfBirth' => 'required|date',
            'phoneNumber' => 'required|string',
            'password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required|string|min:6',
        ]);

        unset($validated['confirm_password']);

        $response = Http::post('http://localhost/game_store/user.php', $validated);

        if ($response->successful()) {
            return redirect()->route('login.form')->with('success', 'Registrasi berhasil. Silakan login.');
        }

        return back()->withErrors(['message' => 'Registrasi gagal.'])->withInput();
    }
}

?>