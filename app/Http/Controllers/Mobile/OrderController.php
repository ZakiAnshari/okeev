<?php

namespace App\Http\Controllers\mobile;

use App\Models\Order;
use App\Models\Product;
use Xendit\Configuration;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Xendit\Invoice\CreateInvoiceRequest;

class OrderController extends Controller
{
    // API key will be configured in each method to ensure proper initialization

    public function show($slug)
    {
        // Ambil product berdasarkan slug, sekaligus relasi colors
        $product = Product::with('colors')->where('slug', $slug)->firstOrFail();

        return view('mobile.order.show', compact('product'));
    }

    public function createInvoice(Request $request, Product $product)
    {
        // 1️⃣ VALIDASI INPUT
        $request->validate([
            'qty'   => 'required|integer|min:1',
            'color' => 'required|string',
        ]);

        // 2️⃣ SET XENDIT API KEY
        $apiKey = env('XENDIT_SECRET_KEY');
        if (empty($apiKey)) {
            throw new \Exception('Xendit API key is not configured. Please check your XENDIT_SECRET_KEY environment variable.');
        }
        Configuration::setXenditKey($apiKey);

        // 3️⃣ HITUNG TOTAL
        $qty        = $request->qty;
        $price      = $product->price;
        $serviceFee = 2000; // bisa ubah sesuai kebutuhan
        $grandTotal = ($price * $qty) + $serviceFee;

        $externalId = 'INV-' . uniqid();

        // ===================================================
        // 4️⃣ SIMPAN ORDER DULU (Wajib sebelum createInvoice)
        // ===================================================
        $order = Order::create([
            'user_id'        => auth()->id(),
            'product_id'     => $product->id,
            'external_id'    => $externalId,
            'no_transaction' => $externalId,
            'model_name'     => $product->model_name,
            'color'          => $request->color,
            'qty'            => $qty,
            'price'          => $price,
            'grand_total'    => $grandTotal,
            'status'         => 'PENDING',
        ]);

        // ===================================================
        // 5️⃣ CREATE INVOICE KE XENDIT
        // ===================================================
        try {
            $apiInstance = new InvoiceApi();
            $apiInstance->setApiKey($apiKey);  // Explicitly set the API key on the instance
            
            $invoice = $apiInstance->createInvoice(
                new CreateInvoiceRequest([
                    'external_id' => $externalId,
                    'amount'      => (int) $grandTotal,
                    'currency'    => 'IDR',
                    'description' => 'Order ' . $product->model_name,

                    // Redirect ke route mobile setelah bayar / gagal (pakai full URL)
                    'success_redirect_url' => route('mobile.payment.success', ['external_id' => $externalId], true),
                    'failure_redirect_url' => route('mobile.payment.failed', ['external_id' => $externalId], true),
                ])
            );
        } catch (\Throwable $e) {
            report($e);
            \Log::error('Failed to create Xendit invoice for mobile', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal membuat invoice pembayaran: ' . $e->getMessage());
        }

        // 6️⃣ UPDATE invoice_url di order
        $order->update([
            'invoice_url' => $invoice['invoice_url'],
        ]);

        // 7️⃣ REDIRECT KE XENDIT
        return redirect()->away($invoice['invoice_url']); // buka Xendit

    }

    /**
     * Check if there's a pending order for the authenticated user and product slug.
     * Used by frontend to redirect back to payment page when returning from Xendit.
     */
    public function checkPendingForProduct($productSlug)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['found' => false], 200);
        }

        $product = Product::where('slug', $productSlug)->first();
        if (!$product) {
            return response()->json(['found' => false], 200);
        }

        $order = Order::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->where(function ($q) {
                $q->where('status', 'PENDING')
                  ->orWhere('status_transaksi', 'pending');
            })
            ->latest()
            ->first();

        if ($order) {
            return response()->json(['found' => true, 'order_id' => $order->id], 200);
        }

        return response()->json(['found' => false], 200);
    }

    /**
     * Allow the owning user to cancel their order. This sets `status_transaksi` to 'cancelled'.
     */
    public function cancel(Request $request, Order $order)
    {
        // Ensure the action is performed by the owner
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Prevent cancelling already-paid orders
        if (strtolower($order->status) === 'completed') {
            return back()->with('error', 'Tidak dapat membatalkan pesanan yang sudah dibayar.');
        }

        $order->status_transaksi = 'cancelled';
        $order->save();

        return redirect()->route('mobile.home')->with('success', 'Pesanan Anda berhasil dibatalkan.');
    }

    /**
     * Create invoice for cart items (mobile)
     */
    public function createInvoiceCart(Request $request)
    {
        $request->validate([
            'cart_ids' => 'required|array|min:1',
            'cart_ids.*' => 'integer'
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $cartIds = $request->input('cart_ids', []);

        $carts = \App\Models\Cart::with(['product', 'color'])
            ->whereIn('id', $cartIds)
            ->where('user_id', $userId)
            ->get();

        if ($carts->isEmpty()) {
            return response()->json(['error' => 'No cart items found'], 400);
        }

        $serviceFee = 2000;
        $grandTotal = 0;
        foreach ($carts as $c) {
            $price = $c->product->price ?? 0;
            $qty = $c->quantity ?? 1;
            $grandTotal += ($price * $qty);
        }
        $grandTotal = (int) $grandTotal + (int) $serviceFee;

        $externalId = 'INV-' . uniqid();

        // Properly configure Xendit API key
        $apiKey = env('XENDIT_SECRET_KEY');
        if (empty($apiKey)) {
            return response()->json(['error' => 'Xendit API key is not configured'], 500);
        }
        Configuration::setXenditKey($apiKey);

        try {
            $apiInstance = new InvoiceApi();
            $apiInstance->setApiKey($apiKey);  // Explicitly set the API key on the instance
            
            $invoice = $apiInstance->createInvoice(
                new CreateInvoiceRequest([
                    'external_id' => $externalId,
                    'amount' => (int) $grandTotal,
                    'currency' => 'IDR',
                    'description' => 'Order (cart)',
                    'success_redirect_url' => route('mobile.payment.success', ['external_id' => $externalId], true),
                    'failure_redirect_url' => route('mobile.payment.failed', ['external_id' => $externalId], true),
                ])
            );
        } catch (\Throwable $e) {
            report($e);
            \Log::error('Failed to create Xendit invoice for mobile cart', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create invoice: ' . $e->getMessage()], 500);
        }

        // Create orders for each cart item linked by same external_id
        foreach ($carts as $c) {
            $price = $c->product->price ?? 0;
            $qty = $c->quantity ?? 1;
            $colorName = $c->color_name ?? optional($c->color)->name ?? '';

            Order::create([
                'user_id' => $userId,
                'product_id' => $c->product->id,
                'external_id' => $externalId,
                'no_transaction' => $externalId,
                'model_name' => $c->product->model_name ?? $c->product->name ?? '',
                'color' => $colorName,
                'qty' => $qty,
                'price' => $price,
                'invoice_url' => $invoice['invoice_url'] ?? '',
                'grand_total' => ($price * $qty),
                'status' => 'PENDING',
                'status_transaksi' => 'pending',
            ]);
        }

        return response()->json(['invoice_url' => $invoice['invoice_url']]);
    }
}