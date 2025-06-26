<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $game = Game::all();
        return view('user.game', compact('game'));
    }


    public function show($id)
    {
        return response()->json(Game::with('reviews')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $game = Game::create($request->all());
        return response()->json($game, 201);
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->update($request->all());
        return response()->json($game);
    }

    public function destroy($id)
    {
        Game::destroy($id);
        return response()->json(['message' => 'Game deleted']);
    }
}