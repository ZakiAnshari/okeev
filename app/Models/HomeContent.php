<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        'title',
        'description',
        'button_text',
        'button_link',
        'image',
        'is_active',
        'position',
        'why_items',
        'collaboration'
    ];

    protected $casts = [
        'why_items' => 'array',
        'collaboration' => 'array',
        'is_active' => 'boolean'
    ];
}
