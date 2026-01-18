<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use Xendit\Configuration;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\InvoiceItem;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Xendit\Invoice\CreateInvoiceRequest;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{

    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    }

    public function show(Product $product)
    {
        // kategori tetap
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

        // product dipilih berdasarkan slug
        $product->load('colors');
        return view('landing.order.show', compact(
            'product',
            'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3',
        ));
    }

    public function createInvoice(Request $request, Product $product)
    {
        // 1️⃣ VALIDASI
        $rules = [
            'qty' => 'required|integer|min:1',
        ];

        // Hanya wajibkan warna jika produk memang memiliki opsi warna
        if ($product->colors->isNotEmpty()) {
            $rules['color'] = 'required|string';
        } else {
            $rules['color'] = 'nullable|string';
        }

        $request->validate($rules);

        // 2️⃣ HITUNG TOTAL
        $qty        = $request->qty;
        $price      = $product->price;
        $serviceFee = 2000;
        $grandTotal = ($price * $qty) + $serviceFee;

        $externalId = 'INV-' . uniqid();

        // 3️⃣ SET API KEY XENDIT
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

        // 4️⃣ CREATE INVOICE (tangani error agar tidak silent fail)
        try {
            $apiInstance = new InvoiceApi();
            $invoice = $apiInstance->createInvoice(
                new CreateInvoiceRequest([
                    'external_id'          => $externalId,
                    'amount'               => (int) $grandTotal,
                    'currency'             => 'IDR',
                    'description'          => 'Order ' . $product->model_name,
                    'success_redirect_url' => route('payment.success', ['external_id' => $externalId]),
                    'failure_redirect_url' => route('payment.failed', ['external_id' => $externalId]),
                ])
            );
        } catch (\Throwable $e) {
            // Log error and redirect back with message so frontend user tahu kenapa tidak redirect
            report($e);
            return back()->with('error', 'Gagal membuat invoice pembayaran. Silakan coba lagi atau hubungi admin. (' . $e->getMessage() . ')');
        }

        // 5️⃣ SIMPAN ORDER
        // Pastikan kita tidak menyimpan NULL ke kolom yang tidak menerima null
        $colorInput = $request->color ?? null;
        if ($product->colors->isNotEmpty() && empty($colorInput)) {
            // fallback ke warna pertama jika tersedia
            $colorInput = optional($product->colors->first())->name ?? '';
        }

        // final fallback ke empty string agar tidak melanggar constraint
        $colorInput = $colorInput ?? '';

        $order = Order::create([
            'user_id'        => Auth::id(),
            'product_id'     => $product->id,
            'external_id'    => $externalId,
            'no_transaction' => $externalId,
            'model_name'     => $product->model_name,
            'color'          => $colorInput,
            'qty'            => $qty,
            'price'          => $price,
            'invoice_url'    => $invoice['invoice_url'],
            'grand_total'    => $grandTotal,
            'status'         => 'PENDING',
            'status_transaksi' => 'pending',
        ]);

        // 6️⃣ REDIRECT KE XENDIT (buka di tab yang sama)
        return redirect()->away($invoice['invoice_url']);
    }

    /**
     * Create an invoice for multiple cart items and return the Xendit invoice URL as JSON.
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

        $carts = Cart::with(['product', 'color'])
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

        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

        try {
            $apiInstance = new InvoiceApi();
            $invoice = $apiInstance->createInvoice(
                new CreateInvoiceRequest([
                    'external_id' => $externalId,
                    'amount' => (int) $grandTotal,
                    'currency' => 'IDR',
                    'description' => 'Order (cart)',
                    'success_redirect_url' => route('payment.success', ['external_id' => $externalId]),
                    'failure_redirect_url' => route('payment.failed', ['external_id' => $externalId]),
                ])
            );
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['error' => 'Failed to create invoice: ' . $e->getMessage()], 500);
        }

        // Create order records linked by the same external_id
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


    public function notificationCallback(Request $request)
    {
        $getToken = $request->headers->get('x-callback-token');
        $callbackToken = env('XENDIT_CALLBACK_TOKEN');

        try {
            // Find all orders that belong to the same invoice (external_id)
            $orders = Order::where('external_id', $request->external_id)->get();

            if (!$callbackToken) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Callback token xendit not exist',

                ], Response::HTTP_NOT_FOUND);
            }

            if ($getToken !== $callbackToken) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Token Callback invalid',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            if ($orders->isNotEmpty()) {
                foreach ($orders as $ord) {
                    if ($request->status === 'PAID') {
                        $ord->update(['status' => 'Completed']);
                    } else {
                        $ord->update(['status' => 'Failed']);
                    }
                }
            }

            return response()->json([
                'status' => 'Response::HTTP_OK',
                'message' => 'callback sent',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // ---------------------------------------------------------------------------------

    public function index()
    {
        // Ambil semua order terbaru, diurutkan dari terbaru ke terlama
        $orders = Order::orderBy('created_at', 'desc')->get();

        // Jika ingin paginate, misal 10 per halaman
        // $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id)
    {
        $orders = Order::where('id', $id)->firstOrFail();

        return view('admin.orders.edit', [
            'orders' => $orders
        ]);
    }

    public function update(Request $request, $id)
    {
        $orders = Order::findOrFail($id);

        $request->validate([
            // accept both legacy 'new' and 'pending' as initial states
            'status_transaksi' => 'required|in:pending,new,processing,being_sent,to_the_location,delivered,cancelled',
        ]);

        $newStatus = $request->input('status_transaksi');
        $orders->status_transaksi = $newStatus;
        $orders->save();

        if ($newStatus === 'processing') {
            Alert::info('Info', 'Order masuk proses — Anda dapat mengubah status selanjutnya.');
            return redirect()->route('orders.edit', $orders->id)->with('status_transaksi', 'processing');
        }

        Alert::success('Success', 'Order berhasil diperbarui');
        return redirect()->route('orders.edit', $orders->id);
    }

    /**
     * Return the latest pending order id for the authenticated user and given product slug.
     * Used by frontend to redirect back to the payment page when returning from Xendit.
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
     * Show printable invoice for an order.
     */
    public function print($id)
    {
        $order = Order::with(['user', 'product'])->findOrFail($id);

        return view('admin.orders.print', compact('order'));
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
            Alert::error('Gagal', 'Tidak dapat membatalkan pesanan yang sudah dibayar.');
            return back();
        }

        $order->status_transaksi = 'cancelled';
        $order->save();

        Alert::success('Berhasil', 'Pesanan Anda berhasil dibatalkan.');
        return back();
    }
}
