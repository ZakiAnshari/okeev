<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_category',
        'slug',
        'category_position_id',
    ];


    use HasSlug;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_category')
            ->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id', 'id');
    }
    public function position()
    {
        return $this->belongsTo(CategoryPosition::class, 'category_position_id');
    }

  
}
