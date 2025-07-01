<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function index($id)
    {
        $response = Http::get("http://localhost/game_store/review.php?gameID=$id");

        return $response->successful()
            ? response()->json($response->json())
            : response()->json([], 500);
    }

    public function store(Request $request, $id)
    {
        $token = session('jwt_token');
        $userID = session('user_id');
        $username = session('user');

        if (!$token || !$userID || !$username) {
            return redirect('/user/login')->withErrors(['message' => 'Sesi login tidak valid.']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->post("http://localhost/game_store/review.php", [
            'userID' => $userID,
            'username' => $username,
            'gameID' => $id,
            'title' => $request->input('title'),
            'Text' => $request->input('text'),
            'Rating' => $request->input('rating'),
            'Date' => now()->toDateString()
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Review berhasil dikirim');
        }

        return back()->with('error', 'Gagal mengirim review');
    }
}
