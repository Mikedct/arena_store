<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class UserPaymentController extends Controller
{
    public function index()
    {
        // Misalnya ambil payment berdasarkan user login
        $user = session('user');
        $payments = Payment::with('game')
            ->where('user_id', $user['userID'] ?? null)
            ->get();

        return view('user.payment', compact('payments'));
    }
}
