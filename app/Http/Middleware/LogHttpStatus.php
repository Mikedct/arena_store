<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogHttpStatus
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        DB::table('http_logs')->insert([
            'status_code' => $response->getStatusCode(),
            'path' => $request->path(),
            'method' => $request->method(),
            'created_at' => now()
        ]);

        return $response;
    }
}
