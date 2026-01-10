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
    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    }

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
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

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
        $apiInstance = new InvoiceApi();
        $invoice = $apiInstance->createInvoice(
            new CreateInvoiceRequest([
                'external_id' => $externalId,
                'amount'      => (int) $grandTotal,
                'currency'    => 'IDR',
                'description' => 'Order ' . $product->model_name,

                // 🔥 Redirect ke route lokal setelah bayar / gagal
                'success_redirect_url' => route('payment.va', $order->id),
                'failure_redirect_url' => route('payment.va', $order->id),
            ])
        );

        // 6️⃣ UPDATE invoice_url di order
        $order->update([
            'invoice_url' => $invoice['invoice_url'],
        ]);

        // 7️⃣ REDIRECT KE XENDIT
        return redirect()->route('payment.va', $order->id); // ✅ user ke halaman virtual account kamu

    }
}
