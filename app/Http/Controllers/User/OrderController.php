<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function history()
    {
        $token = Session::get('jwt_token');
        $user = Session::get('user');

        if (!$token || !$user) {
            return redirect()->route('user.login')->withErrors(['message' => 'Harap login terlebih dahulu.']);
        }

        $userID = $user['userID'];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("http://localhost/game_store/order.php?userID=$userID");

        if ($response->successful()) {
            $orders = $response->json();
            return view('user.payment-history', compact('orders'));
        }

        return back()->withErrors(['message' => 'Gagal mengambil histori pembayaran.']);
    }
}


