<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testdrive extends Model
{
    protected $fillable = [
        'product_id',
        'first_name',
        'second_name',
        'telp',
        'email',
        'city',
        'dealer',
        'status',   // tambahkan ini
    ];


    /**
     * Relasi ke produk
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
