<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function virtualAccount(Order $order)
    {
        // 🔐 keamanan: pastikan order milik user login
        abort_if($order->user_id !== auth()->id(), 403);

        // Tidak ada query kategori lagi

        return view('mobile.payment.virtual-account', compact('order'));
    }

    public function success(Request $request)
    {
        $externalId = $request->query('external_id');
        if (! $externalId) {
            return redirect()->route('mobile.home')->with('error', 'Invalid payment reference');
        }

        $order = Order::where('external_id', $externalId)
            ->where('user_id', auth()->id())
            ->first();

        if (! $order) {
            return redirect()->route('mobile.home')->with('error', 'Order not found');
        }

        $justCompleted = false;
        if ($order->status === 'PENDING') {
            $order->update(['status' => 'Completed']);
            $justCompleted = true;
            Alert::success('Pembayaran Berhasil', 'Pesanan Anda sedang diproses.');
        }

        return view('mobile.payment.success', compact('order', 'justCompleted'));
    }

    public function failed(Request $request)
    {
        $externalId = $request->query('external_id');
        if (! $externalId) {
            return redirect()->route('mobile.home')->with('error', 'Invalid payment reference');
        }

        $order = Order::where('external_id', $externalId)
            ->where('user_id', auth()->id())
            ->first();

        if (! $order) {
            return redirect()->route('mobile.home')->with('error', 'Order not found');
        }

        $justFailed = false;
        if ($order->status === 'PENDING') {
            $order->update(['status' => 'Failed']);
            $justFailed = true;
            Alert::error('Pembayaran Gagal', 'Pembayaran gagal atau dibatalkan. Silakan coba lagi.');
        }

        return view('mobile.payment.failed', compact('order', 'justFailed'));
    }
}
