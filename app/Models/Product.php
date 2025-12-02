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
        'category_id',
        'brand_id',
        'model_name',
        'slug',
        'miles',
        'seats',
        'price',
        'stock_status',
        'featured',
        'description',
    ];

    use HasSlug;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('model_name')
            ->saveSlugsTo('slug');
    }

    public function testdrives()
    {
        return $this->hasMany(Testdrive::class, 'product_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'product_id', 'id');
    }

    public function fiturs()
    {
        return $this->hasMany(Fitur::class, 'product_id', 'id');
    }

    public function suspensis()
    {
        return $this->hasMany(Suspensi::class, 'product_id', 'id');
    }

    public function dimensis()
    {
        return $this->hasMany(Dimensi::class, 'product_id', 'id');
    }

    public function powers()
    {
        return $this->hasMany(Power::class, 'product_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // 🔥 Relasi: satu product milik satu category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function technologies()
    {
        return $this->hasMany(Technology::class, 'product_id', 'id');
    }

    public function features()
    {
        return $this->hasMany(Feature::class, 'product_id', 'id');
    }

    public function colors()
    {
        return $this->hasMany(Color::class, 'product_id', 'id');
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class, 'product_id', 'id');
    }
}
