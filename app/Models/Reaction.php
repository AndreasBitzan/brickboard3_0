<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = [
        'user_id', 'topic_id', 'reaction_type_id',
    ];

    protected $with = ['reaction_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function reaction_type()
    {
        return $this->belongsTo(ReactionType::class);
    }

    protected static function booted(): void
    {
        static::created(function (Reaction $reaction) {
            UserDetail::where('user_id', $reaction->topic->user_id)->increment('received_likes_movies');
            Topic::where('id', $reaction->topic_id)->increment('likes_count');
        });

        static::deleted(function (Reaction $reaction) {
            UserDetail::where('user_id', $reaction->topic->user_id)->decrement('received_likes_movies');
            Topic::where('id', $reaction->topic_id)->decrement('likes_count');
        });
    }
}
