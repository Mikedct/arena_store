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

        return $response->successful()
            ? response()->json($response->json())
            : response()->json([], 500);
    }

    public function store(Request $request, $id)
    {
        $token    = session('jwt_token');
        $userID   = session('user_id');
        $username = session('username');

        if (!$token || !$userID || !$username) {
            return redirect('/user/login')->withErrors(['message' => 'Sesi login tidak valid.']);
        }

        $request->validate([
            'title'  => 'required|string|max:255',
            'text'   => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->post(env('API_BASE_URL') . "/review.php", [
            'userID'   => $userID,
            'username' => $username,
            'gameID'   => $id,
            'title'    => $request->input('title'),
            'Text'     => $request->input('text'),
            'Rating'   => $request->input('rating'),
            'Date'     => now()->toDateString()
        ]);

        return $response->successful()
            ? back()->with('success', 'Review berhasil dikirim.')
            : back()->with('error', 'Gagal mengirim review.');
    }
}
