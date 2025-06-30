<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    // 🔹 GET /api/games
    public function index()
    {
        return response()->json(Game::all());
    }

    // 🔹 GET /api/games/{id}
    public function show($id)
    {
        $game = Game::find($id);
        return $game ? response()->json($game) : response()->json(['message' => 'Game not found'], 404);
    }

    // 🔹 POST /api/games
    public function store(Request $request)
    {
        $game = Game::create($request->all());
        return response()->json($game, 201);
    }

    // 🔹 PUT /api/games/{id}
    public function update(Request $request, $id)
    {
        $game = Game::find($id);
        if (!$game) return response()->json(['message' => 'Game not found'], 404);

        $game->update($request->all());
        return response()->json($game);
    }

    // 🔹 DELETE /api/games/{id}
    public function destroy($id)
    {
        $game = Game::find($id);
        if (!$game) return response()->json(['message' => 'Game not found'], 404);

        $game->delete();
        return response()->json(['message' => 'Game deleted successfully']);
    }
}
