<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Score extends Model
{
    protected $fillable = ['user_id', 'score', 'game_number', 'meter_score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // app/Models/Score.php
    public function getFinalPercentAttribute(): float
    {
        $quizMax = 5;
        $meterMax = 100;
        $wq = 0.5;
        $wm = 0.5;

        $quizPct = $quizMax > 0 ? (max(0, (float) $this->score) / $quizMax) * 100 : 0;
        $meterPct = $meterMax > 0 ? (max(0, (float) $this->meter_score) / $meterMax) * 100 : 0;

        return round(($quizPct * $wq) + ($meterPct * $wm), 2);
    }

}
