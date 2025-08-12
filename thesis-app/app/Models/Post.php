<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'parent_id',
    ];

    // The user who created the post
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Parent post (if this is a reply)
    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    // Replies to this post
    public function replies()
{
    return $this->hasMany(Reply::class);
}
}
