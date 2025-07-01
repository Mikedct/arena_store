<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthBearerUser
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah token dan data user tersedia di session
        if (!session()->has('user_token') || !session()->has('user_data')) {
            return redirect()->route('user.login')->with('error', 'Silakan login terlebih dahulu');
        }
        return $next($request);
    }
}
