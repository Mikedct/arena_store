<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_BASE_URL', 'http://localhost/game_store') . '/user.php';
    }

    public function show($id)
    {
        $token = Session::get('jwt_token');

        if (!$token) {
            return redirect()->route('user.login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get("{$this->apiUrl}?userID=$id");

        if ($response->successful() && !empty($response->json())) {
            $user = $response->json()[0];
            return view('user.user-detail', compact('user'));
        }

        abort(404, 'User tidak ditemukan');
    }

    public function edit($id)
    {
        $token = Session::get('jwt_token');

        if (!$token) {
            return redirect()->route('user.login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get("{$this->apiUrl}?userID=$id");

        if ($response->successful() && !empty($response->json())) {
            $user = $response->json()[0];
            return view('user.edit-account', compact('user'));
        }

        abort(404, 'User tidak ditemukan');
    }

    public function update(Request $request, $id)
    {
        $token = Session::get('jwt_token');

        if (!$token) {
            return redirect()->route('user.login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        $validated = $request->validate([
            'firstName'    => 'required|string|max:255',
            'lastName'     => 'required|string|max:255',
            'username'     => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phoneNumber'  => 'required|string|max:20',
            'dateOfBirth'  => 'required|date',
        ]);

        $payload = array_merge($validated, ['userID' => (int) $id]);

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->put($this->apiUrl, $payload);

        if ($response->successful()) {
            return redirect()->route('user.dashboard')->with('success', 'Akun berhasil diperbarui.');
        }

        return back()->withErrors(['message' => 'Gagal memperbarui akun.']);
    }

    public function destroy($id)
    {
        $token = Session::get('jwt_token');

        if (!$token) {
            return redirect()->route('user.login')->withErrors(['message' => 'Token tidak ditemukan. Harap login kembali.']);
        }

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->send('DELETE', $this->apiUrl, [
            'json' => ['userID' => (int) $id],
        ]);

        if ($response->successful()) {
            Session::forget('jwt_token');
            Session::forget('user_id');
            Session::forget('username');
            return redirect()->route('user.login')->with('success', 'Akun berhasil dihapus.');
        }

        return back()->withErrors(['message' => 'Gagal menghapus akun.']);
    }
}
