<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MovieAuthor extends Pivot
{
    protected $fillable = ['id', 'topic_id', 'user_id', 'movie_role_id'];

    protected $with = ['movieRole'];

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
}
