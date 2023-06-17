<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageboardGroup extends Model
{
    use HasFactory;

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
