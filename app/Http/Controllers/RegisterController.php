<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstName'    => 'required|string|max:100',
            'lastName'     => 'required|string|max:100',
            'username'     => 'required|string|max:50|unique:admin,username',
            'email'        => 'required|email|unique:admin,email',
            'phoneNumber'  => 'required|string|max:20',
            'dateOfBirth'  => 'required|date',
            'password'     => 'required|min:6|confirmed',
        ]);

        Admin::create([
            'firstName'    => $request->firstName,
            'lastName'     => $request->lastName,
            'username'     => $request->username,
            'email'        => $request->email,
            'phoneNumber'  => $request->phoneNumber,
            'dateOfBirth'  => $request->dateOfBirth,
            'password'     => md5($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
