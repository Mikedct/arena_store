<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('jwt_token')) {
            return redirect('/user/login')->withErrors(['message' => 'Harap login terlebih dahulu']);
        }

        return $next($request);
    }
}
