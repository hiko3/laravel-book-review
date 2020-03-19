<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likes()
    {
        return $this->belongsToMany(Review::class, 'likes', 'user_id', 'review_id');
    }

    public function like($reviewId)
    {
        $exist = $this->is_like($reviewId);
        if($exist) {
            return false;
        } else {
            $this->likes()->attach($reviewId);
            return true;
        }
    }

    public function unlike($reviewId)
    {
        $exist = $this->is_like($reviewId);
        if ($exist) {
            $this->likes()->detach($reviewId);
            return true;
        } else {
            return false;
        }
    }

    public function is_like($reviewId)
    {
        return $this->likes()->where('review_id', $reviewId)->exists();
    }
}
