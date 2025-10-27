<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; // Role & Permission management
use App\Models\Post;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all posts created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getNameAttribute()
    {
        return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::random(10);
            }
        });
    }
    public function badges()
    {
        return $this->belongsToMany(Badge::class)->withPivot('earned_at')->withTimestamps();
    }
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['firstName'] = ucwords(strtolower($value));
    }


    public function setLastNameAttribute($value)
    {
        $this->attributes['lastName'] = ucfirst(strtolower($value));
    }

    public function getDisplayNameAttribute()
    {
        $first = ucwords(strtolower($this->firstName ?? ''));
        $last = ucfirst(strtolower($this->lastName ?? ''));
        return trim("{$first} {$last}");
    }



    public $incrementing = false;
    protected $keyType = 'string';

}
