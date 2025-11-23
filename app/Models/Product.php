<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        // MAIN INFO
        'brand',
        'model_name',
        'category',
        'slug',
        'miles',
        'type',
        'seats',
        'cc',
        // PRICES
        'regular_price',
        'sale_price',
        // INVENTORY
        'quantity',
        'stock_status',
        // FLAGS
        'featured',
        // IMAGES
        'image_wallpaper',
        'image',
        'image_detail_1',
        'image_detail_2',
        'image_detail_3',
    ];


    use HasSlug;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_category')
            ->saveSlugsTo('slug');
    }
}
