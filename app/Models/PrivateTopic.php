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

    protected $casts = [
        'last_post_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function chatters()
    {
        return $this->belongsToMany(User::class, 'private_topic_user');
    }

    public function chatters_connected()
    {
        return $this->chatters()->where('user_id', '!=', auth()->id());
    }

    public function messages()
    {
        return $this->hasMany(PrivatePost::class);
    }
}
