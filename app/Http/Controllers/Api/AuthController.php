<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'username' => $request->username,
            'email' => $request->email,
            'dateOfBirth' => $request->dateOfBirth,
            'phoneNumber' => $request->phoneNumber,
            'password' => md5($request->password),
        ]);

        return response()->json([
            'message' => 'Register success',
            'user' => $user
        ], 201);
    }

    // Login
    public function login(Request $request)
    {
        $user = User::where('username', $request->username)
            ->where('password', md5($request->password))
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate API Token
        $token = md5($user->username . now());
        $user->update(['api_token' => $token]);

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }
}
