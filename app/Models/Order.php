<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'external_id',
        'no_transaction',
        'model_name',
        'color',
        'qty',
        'price',
        'invoice_url',
        'grand_total',
        'status',
        'status_transaksi'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Order belongs to Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
}
