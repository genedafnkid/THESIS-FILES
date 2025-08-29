<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Score extends Model
{
    protected $fillable = ['user_id', 'score','game_number', 'meter_score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
