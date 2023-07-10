<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'content',
        'source',
        'topic_id',
        'messageboard_id',
        'moderation_state_id',
    ];

    protected $with = ['author', 'topic', 'moderation_state'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function moderation_state()
    {
        return $this->belongsTo(ModerationState::class);
    }

    protected static function booted(): void
    {
        static::created(function (Post $post) {
            error_log('CREATED CALLED WITH');
            error_log(json_encode($post));
            Topic::where('id', $post->topic_id)->incrementEach(['posts_count' => 1], ['last_post_at' => $post->created_at, 'last_user_id' => $post->user_id]);
            Messageboard::where('id', $post->messageboard_id)->increment('posts_count');
            UserDetail::where('user_id', $post->user_id)->increment('posts_count');
            ReadState::where('topic_id', $post->topic_id)->where('user_id', '!=', $post->user_id)->increment('unread_posts_count');
        });

        static::deleted(function (Post $post) {
            Topic::where('id', $post->topic_id)->decrement('posts_count');
            Messageboard::where('id', $post->messageboard_id)->decrement('posts_count');
            UserDetail::where('user_id', $post->user_id)->decrement('posts_count');
        });
    }
}
