<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $fillable = [
        'product_id',
        'section',
        'title',
        'value',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
