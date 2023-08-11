<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivatePost extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'user_id', 'content', 'private_topic_id', 'created_at', 'updated_at',
    ];

    public function private_topic()
    {
        return $this->belongsTo(PrivateTopic::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function booted(): void
    {
        static::created(function (PrivatePost $post) {
            PrivateTopic::where('id', $post->private_topic_id)->incrementEach(['posts_count' => 1], ['last_post_at' => $post->created_at, 'last_user_id' => $post->user_id]);
            // ReadState::where('topic_id', $post->topic_id)->where('user_id', '!=', $post->user_id)->increment('unread_posts_count');
        });
    }
}
