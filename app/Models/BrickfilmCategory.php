<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BrickfilmCategory extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $fillable = [
        'id',
        'name',
        'description',
        'position',
        'locked',
        'visible',
        'assignable',
        'main_category',
        'badge_id',
        'image',
        'created_at',
        'updated_at',
    ];

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
