<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    // Allow mass assignment of content and user_id
    protected $fillable = ['content'];

    // Define relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
