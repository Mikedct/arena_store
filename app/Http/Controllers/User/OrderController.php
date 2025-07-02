<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
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

    public function purchase(Request $request)
    {
        $token = Session::get('jwt_token');
        $user = Session::get('user');

        if (!$token || !$user) {
            return redirect()->route('user.login')->withErrors(['message' => 'Silakan login terlebih dahulu.']);
        }

        $request->validate([
            'gameID' => 'required|integer',
            'title' => 'required|string',
            'totalPrice' => 'required|numeric',
            'paymentID' => 'required|in:1,2,3',
        ]);

        $payload = [
            'userID' => $user['userID'],
            'username' => $user['username'],
            'gameID' => $request->input('gameID'),
            'title' => $request->input('title'),
            'paymentID' => $request->input('paymentID') ?? null,
            'totalPrice' => $request->input('totalPrice'),
            'orderDate' => now()->format('Y-m-d'),
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->post('http://localhost/game_store/order.php', $payload);

        if ($response->successful()) {
            return redirect()->route('user.dashboard')->with('success', 'Game berhasil dibeli!');
        }

        return back()->withErrors(['message' => 'Gagal melakukan pembelian.']);
    }

}


