<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    // POST /api/scores
    public function store(Request $req)
    {
        \Log::info('🔥 HIT /api/scores', ['payload' => $req->all(), 'headers' => $req->headers->all()]);

        $data = $req->validate([
            'score' => 'required|integer',
            'meter_score' => 'nullable|numeric',
            'game_number' => 'required|integer',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $score = Score::create([
            'user_id' => $data['user_id'] ?? null,
            'score' => $data['score'],
            'game_number' => $data['game_number'],
            'meter_score' => $data['meter_score'] ?? null,
        ]);

        return response()->json([
            'status' => 'ok',
            'saved' => $score,
        ]);
    }

    // GET /api/scores/latest
    public function latest(Request $req)
    {
        $score = Score::when(auth()->check(), fn($q) => $q->where('user_id', auth()->id()))
            ->latest()->first();
        return response()->json($score);
    }

    // GET /api/scores/leaderboard
    public function leaderboard()
    {
        return Score::select('user_id', 'score', 'created_at')
            ->orderByDesc('score')->limit(20)->get();
    }
}
