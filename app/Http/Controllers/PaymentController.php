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
        $platform = $request->query('platform');

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
        $justCompleted = false;
        if ($order->status === 'PENDING') {
            $order->update([
                'status' => 'Completed'
            ]);
            $justCompleted = true;
        }
        
        // Jika datang dari mobile, redirect ke mobile success page
        if ($platform === 'mobile') {
            return redirect()->route('mobile.payment.success', ['external_id' => $externalId]);
        }

        // RealRashid SweetAlert notification (flash ke session)
        // Only show the success alert when the status was changed in THIS request
        if ($justCompleted) {
            // Keep session alert for normal flows (localhost), but some external
            // redirects (payment gateway) may lose the session cookie. To make
            // the success notification reliable on server redirects, we also
            // pass a view flag (`showSuccessAlert`) that the blade will use to
            // render SweetAlert client-side immediately in this request.
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

        // Flag to instruct the view to show the SweetAlert immediately (works
        // even when session cookie is not preserved during external redirects)
        $showSuccessAlert = $justCompleted && (bool) $externalId;

        return view('payment.success', compact('order', 'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3', 'showSuccessAlert'));
    }

    public function failed(Request $request)
    {
        // 🔐 Validasi external_id dari Xendit
        $externalId = $request->query('external_id');
        $platform = $request->query('platform');

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
        $justFailed = false;
        if ($order->status === 'PENDING') {
            $order->update([
                'status' => 'Failed'
            ]);

            $justFailed = true;
            // Keep session alert for normal flows
            Alert::error('Pembayaran Gagal', 'Pembayaran gagal atau dibatalkan. Silahkan coba lagi.');
        }
        
        // Jika datang dari mobile, redirect ke mobile failed page
        if ($platform === 'mobile') {
            return redirect()->route('mobile.payment.failed', ['external_id' => $externalId]);
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

        $showFailedAlert = $justFailed && (bool) $externalId;

        return view('payment.failed', compact('order', 'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3', 'showFailedAlert'));
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
