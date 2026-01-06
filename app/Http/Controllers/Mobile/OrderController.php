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
        // 1️⃣ VALIDASI
        $request->validate([
            'qty'   => 'required|integer|min:1',
            'color' => 'required|string',
        ]);

        // 2️⃣ SET API KEY
        Configuration::setXenditKey(config('services.xendit.secret_key'));

        // 3️⃣ HITUNG TOTAL (JANGAN DARI FORM!)
        $qty        = (int) $request->qty;
        $price      = (int) $product->price;
        $serviceFee = 2000;
        $grandTotal = ($price * $qty) + $serviceFee;

        // 🔑 external_id
        $externalId = 'INV-' . uniqid();

        // 4️⃣ CREATE INVOICE KE XENDIT + REDIRECT URL
        $apiInstance = new InvoiceApi();
        $invoice = $apiInstance->createInvoice(
            new CreateInvoiceRequest([
                'external_id'          => $externalId,
                'amount'               => $grandTotal,
                'currency'             => 'IDR',
                'description'          => 'Order ' . $product->model_name,

                // 🔥 REDIRECT SETELAH BAYAR
                'success_redirect_url' => route('payment.vam', $externalId),
                'failure_redirect_url' => route('payment.vam', $externalId),
            ])
        );

        // 5️⃣ SIMPAN ORDER KE DATABASE
        Order::create([
            'user_id'        => Auth::id(),
            'product_id'     => $product->id,
            'external_id'    => $externalId,
            'no_transaction' => $externalId,
            'model_name'     => $product->model_name,
            'color'          => $request->color,
            'qty'            => $qty,
            'price'          => $price,
            'invoice_url'    => $invoice['invoice_url'],
            'grand_total'    => $grandTotal,
            'status'         => 'PENDING',
        ]);

        // 6️⃣ REDIRECT KE HALAMAN BAYAR XENDIT
        return redirect()->away($invoice['invoice_url']);
    }
}
