<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserOwnsData
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $authUserID = session('user_id'); // dari session login
        $targetID = $request->route('id'); // parameter URL: /user/profile/{id}

        if (!$authUserID || $authUserID != $targetID) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses data ini.');
        }

        return $next($request);
    }
}
