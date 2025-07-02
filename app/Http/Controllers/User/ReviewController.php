<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function index($id)
    {
        $token = session('jwt_token');

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get("http://localhost/game_store/review.php?gameID=$id");

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json(['error' => 'Gagal mengambil data review'], 500);
    }

    public function store(Request $request, $id)
    {
        $token = Session::get('jwt_token');
        $user  = Session::get('user');

        $userID   = $user['userID'] ?? null;
        $username = $user['username'] ?? null;

        if (!$token || !$userID || !$username) {
            return redirect('/user/login')->withErrors(['message' => 'Sesi login tidak valid.']);
        }

        $validated = $request->validate([
            'text'   => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Ambil title game
        $gameResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get("http://localhost/game_store/game.php?gameID=$id");

        if (!$gameResponse->successful()) {
            return back()->with('error', 'Gagal mengambil data game untuk review.');
        }

        $game = $gameResponse->json();
        $title = $game['title'] ?? 'Tanpa Judul';

        $payload = [
            'userID'   => $userID,
            'username' => $username,
            'gameID'   => $id,
            'title'    => $title,
            'Text'     => $validated['text'],
            'Rating'   => $validated['rating'],
            'Date'     => now()->toDateString(),
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->post("http://localhost/game_store/review.php", $payload);

        return $response->successful()
            ? back()->with('success', 'Review berhasil dikirim.')
            : back()->with('error', 'Gagal mengirim review.');
    }
}
