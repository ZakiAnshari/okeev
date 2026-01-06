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
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
        // dd(
        //     env('XENDIT_SECRET_KEY'),
        //     config('services.xendit.secret_key')
        // );

        // 3️⃣ HITUNG TOTAL (JANGAN DARI FORM!)
        $qty        = $request->qty;
        $price      = $product->price;
        $serviceFee = 2000;
        $grandTotal = ($price * $qty) + $serviceFee;

        $externalId = 'INV-' . uniqid();

        // 4️⃣ CREATE INVOICE KE XENDIT
        $apiInstance = new InvoiceApi();
        $invoice = $apiInstance->createInvoice(
            new CreateInvoiceRequest([
                'external_id' => $externalId,
                'amount'      => (int) $grandTotal,
                'currency'    => 'IDR',
                'description' => 'Order ' . $product->model_name,
            ])
        );

        // 5️⃣ SIMPAN ORDER KE DATABASE (PER USER)
        Order::create([
            'user_id'        => Auth::id(), // 🔥 INI PENTING
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

        // 6️⃣ REDIRECT KE XENDIT
        return redirect($invoice['invoice_url']);
    }
}
