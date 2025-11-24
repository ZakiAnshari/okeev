<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'description',
        'image',
    ];

    // Relasi: Feature dimiliki satu Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
