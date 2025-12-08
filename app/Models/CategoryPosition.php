<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPosition extends Model
{
    protected $fillable = [
        'category_position'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'category_position_id');
    }
}
