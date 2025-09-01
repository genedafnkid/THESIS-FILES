<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'icon_url',
        'category',
        'description',
        'points',
        'hint',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('earned_at')->withTimestamps();
    }
    public function user()
    {
        return $this->belongsToMany(User::class)->withPivot('earned_at');
    }

}
