<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'last_user_id',
        'title',
        'slug',
        'posts_count',
        'last_post_at',
        'created_at',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function chatters()
    {
        return $this->belongsToMany(User::class, 'private_topic_user');
    }

    public function messages()
    {
        return $this->hasMany(PrivatePost::class);
    }
}
