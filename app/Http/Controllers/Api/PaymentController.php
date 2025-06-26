<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Payment::all());
    }

    public function store(Request $request)
    {
        $payment = Payment::create($request->all());
        return response()->json($payment, 201);
    }

    public function show($id)
    {
        return response()->json(Payment::findOrFail($id));
    }
}

