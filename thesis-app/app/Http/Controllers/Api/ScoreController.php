<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    // POST /api/scores
    public function store(Request $req) {
        $data = $req->validate([
            'score' => 'required|integer',
        ]);

        $score = Score::create([
            'user_id' => auth()->id(), // null if not logged in
            'score'   => $data['score'],
        ]);

        return response()->json(['status' => 'ok', 'id' => $score->id]);
    }

    // GET /api/scores/latest
    public function latest(Request $req) {
        $score = Score::when(auth()->check(), fn($q)=>$q->where('user_id', auth()->id()))
                      ->latest()->first();
        return response()->json($score);
    }

    // GET /api/scores/leaderboard
    public function leaderboard() {
        return Score::select('user_id','score','created_at')
                    ->orderByDesc('score')->limit(20)->get();
    }
}
