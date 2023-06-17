<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messageboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'topics_count',
        'posts_count',
        'last_topic_id',
        'messageboard_group_id',
        'locked',
        'cover_image',
        'created_at',
        'updated_at',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function messageboard_group()
    {
        return $this->belongsTo(MessageboardGroup::class);
    }
}
