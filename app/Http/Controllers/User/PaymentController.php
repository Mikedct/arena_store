<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,gameID',
            'paymentMethod' => 'required|string',
        ]);

        $userId = Auth::id();

        $order = Order::where('userID', $userId)
                      ->where('gameID', $request->game_id)
                      ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order tidak ditemukan untuk game ini.');
        }

        $payment = Payment::create([
            'user_id' => $userId,
            'game_id' => $request->game_id,
            'paymentMethod' => $request->paymentMethod,
            'paymentStatus' => 'Completed',
        ]);

        $order->paymentID = $payment->paymentID;
        $order->save();

        return redirect()->route('user.dashboard')->with('success', 'Pembayaran berhasil!');
    }
}
