<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'short_description'];

    protected $fillable = [
        'id',
        'title',
        'description',
        'short_description',
        'external_url',
        'internal_url',
        'user_id',
        'active',
        'cover_image',
        'created_at',
        'updated_at',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
