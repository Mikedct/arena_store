<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Game;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(Admin::all());
    }

    public function show($id)
    {
        return response()->json(Admin::findOrFail($id));
    }

    public function store(Request $request)
    {
        $admin = Admin::create($request->all());
        return response()->json($admin, 201);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update($request->all());
        return response()->json($admin);
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return response()->json(['message' => 'Admin deleted']);
    }

    public function adminDashboard()
    {
        $totalGames = Game::count();

        $httpStatusCounts = DB::table('http_logs')
            ->selectRaw('
                SUM(CASE WHEN status_code BETWEEN 200 AND 299 THEN 1 ELSE 0 END) as success_2xx,
                SUM(CASE WHEN status_code BETWEEN 300 AND 399 THEN 1 ELSE 0 END) as redirect_3xx,
                SUM(CASE WHEN status_code BETWEEN 400 AND 499 THEN 1 ELSE 0 END) as client_error_4xx,
                SUM(CASE WHEN status_code BETWEEN 500 AND 599 THEN 1 ELSE 0 END) as server_error_5xx
            ')
            ->first();

        return view('admin.dashboard', compact('totalGames', 'httpStatusCounts'));
    }
}
