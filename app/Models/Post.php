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
}
