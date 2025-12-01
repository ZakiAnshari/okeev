<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dimensi extends Model
{
    protected $fillable = [
        'product_id',
        'label',
        'nilai',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
