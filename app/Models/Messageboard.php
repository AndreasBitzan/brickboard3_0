<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class Messageboard extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'description', 'slug'];

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

    protected $with = ['last_topic'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function last_topic()
    {
        return $this->belongsTo(Topic::class, 'last_topic_id');
    }

    public function messageboard_group()
    {
        return $this->belongsTo(MessageboardGroup::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        // Default field to query if no parameter field is specified
        $field = $field ?: $this->getRouteKeyName();

        // If the parameter field is 'slug',
        // lets query a JSON field with translations
        if ('slug' === $field) {
            $field .= '->'.App::getLocale();
        }

        // Perform the query to find the parameter value in the database
        return $this->where($field, $value)->firstOrFail();
    }
}
