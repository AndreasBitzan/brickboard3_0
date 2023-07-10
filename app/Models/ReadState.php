<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadState extends Model
{
    use HasFactory;

    protected $table = 'topic_user_read_states';

    protected $fillable = ['topic_id', 'user_id', 'messageboard_id', 'unread_posts_count', 'read_posts_count'];
}
