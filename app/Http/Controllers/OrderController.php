<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Xendit\Configuration;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\InvoiceItem;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Xendit\Invoice\CreateInvoiceRequest;

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
        ]);

        // 6️⃣ REDIRECT KE XENDIT (buka di tab yang sama)
        return redirect()->away($invoice['invoice_url']);
    }


    public function notificationCallback(Request $request)
    {
        $getToken = $request->headers->get('x-callback-token');
        $callbackToken = env('XENDIT_CALLBACK_TOKEN');

        try {
            $order = Order::where('external_id', $request->external_id)->first();

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

            if ($order) {
                if ($request->status === 'PAID') {
                    $order->update([
                        'status' => 'Completed'
                    ]);
                } else {
                    $order->update([
                        'status' => 'Failed'
                    ]);
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
}
