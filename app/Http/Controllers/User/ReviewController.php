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
        $review = $response->successful() ? $response->json() : [];

        return response()->json($review);
    }

    public function store(Request $request, $id)
    {
        $response = Http::post("http://localhost/game_store/review.php", [
            'userID' => 1, // nanti diganti sesuai user login
            'username' => 'guest', // ganti dengan auth user
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
