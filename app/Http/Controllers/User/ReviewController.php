<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function index($id)
    {
        $response = Http::get(env('API_BASE_URL') . "/review.php?gameID=$id");

        if ($response->successful()) {
            return $response->json(); // Jika pakai AJAX
        }

        return response()->json(['error' => 'Gagal mengambil data review'], 500);
    }

   public function store(Request $request, $id)
    {
        $token    = session('jwt_token');
        $userID   = session('user_id');
        $username = session('username');

        if (!$token || !$userID || !$username) {
            return redirect('/user/login')->withErrors(['message' => 'Sesi login tidak valid.']);
        }

        $validated = $request->validate([
            'title'  => 'required|string|max:255', // tambahkan ini
            'text'   => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $payload = [
            'userID'   => $userID,
            'username' => $username,
            'gameID'   => $id,
            'Title'    => $validated['title'],     // tambahkan ini
            'Text'     => $validated['text'],
            'Rating'   => $validated['rating'],
            'Date'     => now()->toDateString(),
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->post(env('API_BASE_URL') . "/review.php", $payload);

        return $response->successful()
            ? back()->with('success', 'Review berhasil dikirim.')
            : back()->with('error', 'Gagal mengirim review.');
    }
}
