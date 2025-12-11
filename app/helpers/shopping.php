<?php

use Illuminate\Support\Str;

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('generateCartCode')) {
    function generateCartCode()
    {
        return 'CART-' . Str::upper(Str::random(6));
    }
}

if (!function_exists('countTotal')) {
    function countTotal($items)
    {
        return collect($items)->sum(fn($item) => $item['qty'] * $item['price']);
    }
}
