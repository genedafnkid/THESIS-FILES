<?php
// app/Http/Controllers/LeaderboardController.php
namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Validate inputs
        $validated = $request->validate([
            'game' => ['nullable', Rule::in(['1', '2', '3'])],
            'period' => ['nullable', Rule::in(['all', 'month', 'week', 'day'])],
        ]);

        // 2. Inputs with defaults
        $game = $validated['game'] ?? '1';
        $period = $validated['period'] ?? 'all';

        // 3. Date filter
        $from = match ($period) {
            'day' => now()->subDay(),
            'week' => now()->subWeek(),
            'month' => now()->subMonth(),
            default => null,
        };

        // 4. Weighting constants
        $QUIZ_MAX = 5;
        $METER_MAX = 100;
        $WEIGHT_Q = 0.5; // 50%
        $WEIGHT_M = 0.5; // 50%

        // 5. Cache key (unique per game + period)
        $cacheKey = "lb:g{$game}:p{$period}";

        // 6. Query
        $leaders = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($game, $from, $QUIZ_MAX, $METER_MAX, $WEIGHT_Q, $WEIGHT_M) {
            $q = Score::query()->with('user')
                ->where('game_number', (int) $game);

            if ($from) {
                $q->where('created_at', '>=', $from);
            }

            // Compute weighted final % (quiz + meter)
            $q->select('scores.*')
                ->selectRaw(
                    '(
                (COALESCE(scores.score,0) / ?) * 100 * ?
                +
                (COALESCE(scores.meter_score,0) / ?) * 100 * ?
            ) as final_percent',
                    [$QUIZ_MAX, $WEIGHT_Q, $METER_MAX, $WEIGHT_M]
                )
                ->orderByDesc('final_percent')
                ->orderBy('created_at'); // earlier attempt wins tie

            return $q->limit(200)->get()
                ->unique('user_id') // best per user
                ->values();
        });

        // 7. Counts for tabs
        $counts = [
            'all' => Score::where('game_number', $game)->count(),
            'month' => Score::where('game_number', $game)->where('created_at', '>=', now()->subMonth())->count(),
            'week' => Score::where('game_number', $game)->where('created_at', '>=', now()->subWeek())->count(),
            'day' => Score::where('game_number', $game)->where('created_at', '>=', now()->subDay())->count(),
        ];

        return view('leaderboards', compact('leaders', 'game', 'period', 'counts', 'QUIZ_MAX', 'METER_MAX'));
    }

}
