<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'description',
        'image',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
