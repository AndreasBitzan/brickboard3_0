<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Badge extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'id',
        'title',
        'description',
        'secret',
        'position',
        'image_path',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
