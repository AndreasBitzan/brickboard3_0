<?php

namespace App\Models;

use App\Http\Enums\ModerationStateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'last_user_id',
        'title',
        'slug',
        'messageboard_id',
        'posts_count',
        'sticky',
        'locked',
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
        'movie_created_at' => 'datetime:Y-m-d',
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

    public function latestPost()
    {
        return $this->posts()->where('moderation_state_id', ModerationStateEnum::APPROVED->value)->latest()->first();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_topic_follows');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'topic_user_read_states')->withPivot('messageboard_id', 'unread_posts_count', 'read_posts_count');
    }

    public function brickfilm_categories()
    {
        return $this->belongsToMany(BrickfilmCategory::class);
    }

    public function movie_authors()
    {
        return $this->hasMany(MovieAuthor::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function reactors()
    {
        return $this->hasMany(User::class);
    }

    protected static function booted(): void
    {
        static::created(function (Topic $topic) {
            if ($topic->moderation_state_id == ModerationStateEnum::APPROVED->value) {
                Messageboard::where('id', $topic->messageboard_id)->incrementEach(['topics_count' => 1, 'posts_count' => 1], ['last_topic_id' => $topic->id]);
            }
            ReadState::create([
                'messageboard_id' => $topic->messageboard_id,
                'user_id' => $topic->user_id,
                'topic_id' => $topic->id,
                'read_posts_count' => 1,
            ]);
            $topic->followers()->attach($topic->user_id);
        });

        static::updated(function (Topic $topic) {
            if (isset($topic->getChanges()['moderation_state_id']) && $topic->moderation_state_id == ModerationStateEnum::APPROVED->value) {
                Messageboard::where('id', $topic->messageboard_id)->incrementEach(['topics_count' => 1, 'posts_count' => 1], ['last_topic_id' => $topic->id]);
            }
        });

        static::deleted(function (Topic $topic) {
            // TODO Make sure you clean up nicely
            $messageboard = $topic->messageboard;
            Messageboard::where('id', $topic->messageboard_id)->decrementEach(['topics_count' => 1, 'posts_count' => $topic->posts_count], ['last_topic_id' => $messageboard->latestTopic->id]);

            // Check if the topic was a movie, if yes, reduce the counts on likes and movies
            if (4 == $topic->messageboard_id) {
                // Destory it like this, it will fire events correctly
                foreach ($topic->movie_authors as $author) {
                    MovieAuthor::destroy($author->id);
                }
                UserDetail::where('user_id', $topic->user_id)->decrement('received_likes_movies', $topic->likes_count);
            }
        });
    }
}
