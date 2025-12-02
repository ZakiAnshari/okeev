<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name_brand',
        'slug',
        'image',
        'category_id',
    ];

    use HasSlug;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_brand')
            ->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'brand_id');
    }

  
   
}
