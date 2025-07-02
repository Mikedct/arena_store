<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticatedAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('admin')) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
