<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'image',
        'url',
        'status'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function like_users()
    {
        return $this->belongsToMany(User::class, 'likes', 'review_id', 'user_id');
    }
}
