<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicTypes extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function posts()
    {
        $this->hasMany(Post::class);
    }
}
