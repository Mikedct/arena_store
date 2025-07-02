<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah admin sudah login
        if (!Session::has('admin')) {
            return redirect()->route('admin.login')->withErrors([
                'message' => 'Harap login sebagai admin terlebih dahulu'
            ]);
        }
        return $next($request);
    }
}
