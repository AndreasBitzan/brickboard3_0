<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MessageboardGroup extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'position',
        'active',
        'created_at',
        'updated_at',
    ];

    protected $with = ['messageboards'];

    public function messageboards()
    {
        return $this->hasMany(Messageboard::class);
    }
}
