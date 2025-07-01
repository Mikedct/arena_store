<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user')) {
            return redirect('/login')->withErrors(['login' => 'Harap login terlebih dahulu']);
        }

        return $next($request);
    }
}