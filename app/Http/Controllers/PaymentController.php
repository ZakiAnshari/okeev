<?php

namespace App\Http\Controllers;

use id;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function virtualAccount(Order $order)
    {
        // 🔐 keamanan: pastikan order milik user login
        abort_if($order->user_id !== auth()->id(), 403);

        // kategori header
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        $categoriesPosition3 = Category::with('brands')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('name_category', 'asc')
            ->get();

        return view('landing.payment.virtual-account', compact(
            'order',
            'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3'
        ));
    }
}
