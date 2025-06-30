<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Game;

class AdminController extends Controller
{
    public function dashboardSummary()
    {
        $totalGames = Game::count();
        $totalUsers = User::count();

        $statusCounts = DB::table('http_logs') // pastikan kamu punya tabel http_logs
            ->selectRaw('
                SUM(CASE WHEN status_code BETWEEN 200 AND 299 THEN 1 ELSE 0 END) as success_2xx,
                SUM(CASE WHEN status_code BETWEEN 300 AND 399 THEN 1 ELSE 0 END) as redirect_3xx,
                SUM(CASE WHEN status_code BETWEEN 400 AND 499 THEN 1 ELSE 0 END) as client_error_4xx,
                SUM(CASE WHEN status_code BETWEEN 500 AND 599 THEN 1 ELSE 0 END) as server_error_5xx
            ')
            ->first();

        return response()->json([
            'totalGames' => $totalGames,
            'totalUsers' => $totalUsers,
            'httpStatus' => $statusCounts,
        ]);
    }
}

