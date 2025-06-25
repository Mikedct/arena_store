<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    // ===== GET Game =====
    public function index(Request $request)
    {
        $query = DB::table('game');

        $filters = ['gameID', 'gameCode', 'title', 'genre', 'developer', 'publisher', 'platform'];

        foreach ($filters as $filter) {
            if ($request->has($filter) && $request->$filter !== '') {
                if ($filter == 'gameID') {
                    $query->where($filter, $request->$filter);
                } else {
                    $query->where($filter, 'like', '%' . $request->$filter . '%');
                }
                break;
            }
        }

        $games = $query->get();
        return response()->json($games);
    }

    // ===== POST Game (Create) =====
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'gameCode'    => 'required|string|unique:game',
            'title'       => 'required|string|unique:game',
            'genre'       => 'required|string',
            'platform'    => 'required|string',
            'price'       => 'required',
            'releaseDate' => 'required|date_format:Y-m-d',
            'developer'   => 'required|string',
            'publisher'   => 'required|string',
            'description' => 'required|string',
            'adminID'     => 'required|integer'
        ]);

        if ($validated->fails()) {
            return response()->json(['status' => 'error', 'message' => $validated->errors()], 422);
        }

        $priceInput = $request->input('price');
        $price = strtolower($priceInput) === "free" ? 0.0 : floatval($priceInput);

        $id = DB::table('game')->insertGetId([
            'gameCode'    => $request->gameCode,
            'title'       => $request->title,
            'genre'       => $request->genre,
            'platform'    => $request->platform,
            'price'       => $price,
            'releaseDate' => $request->releaseDate,
            'developer'   => $request->developer,
            'publisher'   => $request->publisher,
            'description' => $request->description,
            'adminID'     => $request->adminID,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Game berhasil ditambahkan', 'gameID' => $id]);
    }

    // ===== PUT Game (Update) =====
    public function update(Request $request)
    {
        $data = $request->all();
        $results = ['updated' => [], 'failed' => []];

        $games = isset($data['gameID']) ? [$data] : $data;

        foreach ($games as $game) {
            if (!isset($game['gameID'])) {
                $results['failed'][] = ['gameID' => null, 'message' => 'gameID tidak ditemukan'];
                continue;
            }

            $exists = DB::table('game')->where('gameID', $game['gameID'])->exists();
            if (!$exists) {
                $results['failed'][] = ['gameID' => $game['gameID'], 'message' => 'game ID tidak ditemukan'];
                continue;
            }

            if (isset($game['releaseDate']) && !\DateTime::createFromFormat('Y-m-d', $game['releaseDate'])) {
                $results['failed'][] = ['gameID' => $game['gameID'], 'message' => 'Format releaseDate salah'];
                continue;
            }

            $updateData = collect($game)->except('gameID')->toArray();
            DB::table('game')->where('gameID', $game['gameID'])->update($updateData);

            $results['updated'][] = ['message' => "Game ID {$game['gameID']} berhasil diperbarui"];
        }

        return response()->json(array_filter($results));
    }

    // ===== DELETE Game =====
    public function destroy(Request $request)
    {
        $gameID = $request->input('gameID');

        if (!$gameID || !is_numeric($gameID)) {
            return response()->json(['message' => 'game ID tidak valid.'], 400);
        }

        $exists = DB::table('game')->where('gameID', $gameID)->exists();

        if (!$exists) {
            return response()->json(['message' => 'game ID tidak ditemukan.'], 404);
        }

        DB::table('game')->where('gameID', $gameID)->delete();

        return response()->json(['message' => 'Game berhasil dihapus.', 'id' => $gameID]);
    }
}
