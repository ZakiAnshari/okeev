<?php

namespace App\Http\Controllers;

use id;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    // public function success(Order $order)
    // {
    //     // 🔐 keamanan: pastikan order milik user login

    //     // kategori header
    //     $categoriesPosition1 = Category::with('brands')
    //         ->where('category_position_id', 1)
    //         ->orderBy('name_category', 'asc')
    //         ->get();

    //     $categoriesPosition2 = Category::with('brands')
    //         ->where('category_position_id', 2)
    //         ->orderBy('name_category', 'asc')
    //         ->get();

    //     $categoriesPosition3 = Category::with('brands')
    //         ->whereIn('category_position_id', [3, 4])
    //         ->orderBy('name_category', 'asc')
    //         ->get();

    //     return view('landing.payment.virtual-account', compact(
    //         'order',
    //         'categoriesPosition1',
    //         'categoriesPosition2',
    //         'categoriesPosition3'
    //     ));
    // }

    public function success(Request $request)
    {
        // 🔐 Validasi external_id dari Xendit
        $externalId = $request->query('external_id');

        if (!$externalId) {
            return redirect()->route('cart')->with('error', 'Invalid payment reference');
        }

        // Ambil order berdasarkan external_id
        $order = Order::where('external_id', $externalId)
            ->where('user_id', Auth::id())
            ->first();

        // Jika order tidak ditemukan atau bukan milik user
        if (!$order) {
            return redirect()->route('cart')->with('error', 'Order not found');
        }

        // ✅ Update status ke Completed (Xendit sudah redirect ke sini = pembayaran berhasil)
        if ($order->status === 'PENDING') {
            $order->update([
                'status' => 'Completed'
            ]);
        }

        // RealRashid SweetAlert notification (flash ke session)
        if ($order->status === 'Completed') {
            Alert::success('Pembayaran Berhasil', 'Pesanan Anda sedang diproses.');
        }

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

        return view('payment.success', compact('order', 'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3'));
    }

    public function failed(Request $request)
    {
        // 🔐 Validasi external_id dari Xendit
        $externalId = $request->query('external_id');

        if (!$externalId) {
            return redirect()->route('cart')->with('error', 'Invalid payment reference');
        }

        // Ambil order berdasarkan external_id
        $order = Order::where('external_id', $externalId)
            ->where('user_id', Auth::id())
            ->first();

        // Jika order tidak ditemukan atau bukan milik user
        if (!$order) {
            return redirect()->route('cart')->with('error', 'Order not found');
        }

        // ❌ Update status ke Failed
        if ($order->status === 'PENDING') {
            $order->update([
                'status' => 'Failed'
            ]);

            // RealRashid SweetAlert notification
            Alert::error('Pembayaran Gagal', 'Pembayaran gagal atau dibatalkan. Silahkan coba lagi.');
        }

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

        return view('payment.failed', compact('order', 'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3'));
    }

    public function virtualAccount(Order $order)
    {
        // 🔐 Pastikan order milik user yang login
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('cart')->with('error', 'Unauthorized access');
        }

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

        return view('payment.success', compact('order', 'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3'));
    }
}
