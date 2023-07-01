<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'latest_activity_at',
        'posts_count',
        'movies_count',
        'last_seen_at',
        'profile_description',
        'occupation',
        'location',
        'camera',
        'cutting_program',
        'sound',
        'lighting',
        'website_url',
        'youtube_url',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'tiktok_url',
        'interests',
        'received_likes_movies',
        'banner_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
