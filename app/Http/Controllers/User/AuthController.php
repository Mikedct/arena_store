<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $response = Http::post('http://localhost/game_store/login_user.php', [
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ]);

        $data = $response->json();

        if ($response->successful() && isset($data['token'])) {
            Session::put('jwt_token', $data['token']);
            Session::put('user', [
                'userID' => $data['userID'],
                'username' => $credentials['username']
            ]);
            return redirect()->route('user.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['message' => $data['message'] ?? 'Login gagal.']);
    }

    public function logout()
    {
        Session::forget('jwt_token');
        Session::forget('user');
        return redirect()->route('user.login')->with('success', 'Logout berhasil.');
    }

    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

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
            return redirect()->route('user.login')->with('success', 'Registrasi berhasil. Silakan login.');
        }

        return back()->withErrors(['message' => 'Registrasi gagal.'])->withInput();
    }
}
