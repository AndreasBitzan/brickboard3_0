<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieAuthor extends Model
{
    protected $fillable = ['id', 'topic_id', 'user_id', 'movie_role_id'];

    protected $with = ['movieRole', 'user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function movieRole()
    {
        return $this->belongsTo(MovieRole::class);
    }

    protected static function booted(): void
    {
        static::created(function (MovieAuthor $author) {
            UserDetail::where('user_id', $author->user_id)->increment('movies_count');
        });

        static::deleted(function (MovieAuthor $author) {
            UserDetail::where('user_id', $author->user_id)->decrement('movies_count');
        });
    }
}
