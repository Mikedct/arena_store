<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($gameID)
    {
        return response()->json(Review::where('gameID', $gameID)->get());
    }

    public function store(Request $request, $gameID)
    {
        $data = $request->all();
        $data['gameID'] = $gameID;

        $review = Review::create($data);
        return response()->json($review, 201);
    }
}

