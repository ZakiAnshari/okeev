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
        /* =======================
     * 1. VALIDASI INPUT
     * ======================= */
        $validated = $request->validate([
            'qty'   => ['required', 'integer', 'min:1'],
            'color' => ['required', 'string'],
        ]);

        /* =======================
     * 2. SET API KEY XENDIT
     * ======================= */
        Configuration::setXenditKey(config('services.xendit.secret_key'));

        /* =======================
     * 3. HITUNG TOTAL (BACKEND)
     * ======================= */
        $qty        = $validated['qty'];
        $price      = $product->price;
        $serviceFee = 2000;

        $grandTotal = ($price * $qty) + $serviceFee;
        $externalId = 'INV-' . uniqid();

        /* =======================
     * 4. CREATE INVOICE XENDIT
     * ======================= */
        $invoiceApi = new InvoiceApi();

        $invoice = $invoiceApi->createInvoice(
            new CreateInvoiceRequest([
                'external_id' => $externalId,
                'amount'      => (int) $grandTotal,
                'currency'    => 'IDR',
                'description' => 'Order ' . $product->model_name,
            ])
        );

        /* =======================
     * 5. SIMPAN ORDER
     * ======================= */
        Order::create([
            'user_id'        => Auth::id(),
            'product_id'     => $product->id,
            'external_id'    => $externalId,
            'no_transaction' => $externalId,
            'model_name'     => $product->model_name,
            'color'          => $validated['color'],
            'qty'            => $qty,
            'price'          => $price,
            'invoice_url'    => $invoice['invoice_url'],
            'grand_total'    => $grandTotal,
            'status'         => 'PENDING',
        ]);

        /* =======================
     * 6. REDIRECT KE XENDIT
     * ======================= */
        return redirect()->away($invoice['invoice_url']);
    }
}
