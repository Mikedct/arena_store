<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

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
}
