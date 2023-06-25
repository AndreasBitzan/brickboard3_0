<?php

namespace App\Models;

use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    use BroadcastsEvents;

    protected $fillable = [
        'id',
        'user_id',
        'last_user_id',
        'title',
        'slug',
        'messageboard_id',
        'posts_count',
        'sticky',
        'moderation_state_id',
        'last_post_at',
        'topic_type_id',
        'video_url',
        'view_count',
        'movie_created_at',
        'category',
        'likes_count',
        'includes_peter',
    ];

    protected $with = ['author', 'last_user'];

    protected $casts = [
        'last_post_at' => 'datetime:Y-m-d',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function messageboard()
    {
        return $this->belongsTo(Messageboard::class, 'messageboard_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function last_user()
    {
        return $this->belongsTo(User::class, 'last_user_id');
    }

    public function broadCastOn(string $event): array
    {
        return [$this, $this->posts];
    }

    protected static function booted(): void
    {
        static::created(function (Topic $topic) {
            error_log('TOPIC WAS CREATED DISPACHT JOB OR ASSING BADGE?');

            Messageboard::where('id', $topic->messageboard_id)->incrementEach(['topics_count' => 1, 'posts_count' => 1], ['last_topic_id' => $topic->id]);
        });
    }
}
