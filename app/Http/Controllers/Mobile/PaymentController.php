<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function virtualAccount(Order $order)
    {
        // 🔐 keamanan: pastikan order milik user login
        abort_if($order->user_id !== auth()->id(), 403);

        // Tidak ada query kategori lagi

        return view('mobile.payment.virtual-account', compact('order'));
    }
}
