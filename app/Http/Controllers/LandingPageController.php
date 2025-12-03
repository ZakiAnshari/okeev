<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Testdrive;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $product = Product::first();
        // Ambil semua brand unik
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Chunk untuk grid
        $brandChunks = $brands->chunk(4);

        return view('landing.home', compact('products', 'brands', 'brandChunks', 'product'));
    }

    public function showBrand($slug)
    {
        // Ambil semua brand untuk navbar
        $brands = Brand::select('name_brand', 'slug')->orderBy('name_brand', 'asc')->get();
        $brandChunks = $brands->chunk(4);

        // Ambil brand berdasarkan slug
        $brand = Brand::where('slug', $slug)->firstOrFail();

        // Ambil semua produk yang memiliki brand yang sama
        $products = Product::where('brand_id', $brand->id)->get();
        return view('landing.brand-detail', compact('brand', 'products', 'brandChunks'));
    }



    public function showProduct($productSlug)
    {
        // Ambil semua brand untuk navbar
        $brands = Brand::orderBy('name_brand', 'asc')->get();
        $brandChunks = $brands->chunk(4);

        // Ambil produk berdasarkan slug sekaligus load relasi
        $product = Product::with([
            'brand',          // relasi brand() di model Product
            'technologies',
            'features',
            'colors',
            'specifications', // load semua spesifikasi
            'images'          // load semua gambar produk
        ])->where('slug', $productSlug)->firstOrFail();

        // Opsional: ambil semua produk untuk carousel/list
        $products = Product::all();
        $powers = $product->powers;
        $dimensis = $product->dimensis;
        $suspensis = $product->suspensis;
        $fiturs = $product->fiturs;
        $details = $product->details;
        // Kirim data ke view
        return view('landing.product-detail', compact(
            'product',
            'products',
            'brandChunks',
            'powers',
            'dimensis',
            'suspensis',
            'fiturs',
            'details'
        ));
    }




    public function wuling()
    {
        return view('landing.wuling');
    }

    public function detailwuling()
    {
        return view('landing.detailwuling');
    }

    public function testdrive($productSlug)
    {
        // Ambil semua brand untuk header
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get();

        $brandChunks = $brands->chunk(4);

        // Ambil produk yang benar berdasarkan slug
        $product = Product::where('slug', $productSlug)->firstOrFail();


        return view('landing.testdrive', compact('product', 'brands', 'brandChunks'));
    }

    public function store(Request $request, $productSlug)
    {
        // Ambil produk
        $product = Product::where('slug', $productSlug)->firstOrFail();

        // Validasi data
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'second_name'  => 'required|string|max:255',
            'telp'         => 'required|string|max:20',
            'email'        => 'required|email|max:255',
            'city'         => 'required|string|max:255',
            'dealer'       => 'required|string|max:255',
        ]);

        // ==========================
        // Cek duplikasi
        // ==========================
        $exists = Testdrive::where('first_name', $validated['first_name'])
            ->where('telp', $validated['telp'])
            ->where('email', $validated['email'])
            ->exists();

        if ($exists) {
            Alert::info('Sudah Terdaftar', 'Permintaan test drive Anda sebelumnya sudah tercatat. Silakan menunggu konfirmasi melalui email.');
            return back()->withInput();
        }


        // Simpan data
        Testdrive::create([
            'product_id'   => $product->id,
            'first_name'   => $validated['first_name'],
            'second_name'  => $validated['second_name'],
            'telp'         => $validated['telp'],
            'email'        => $validated['email'],
            'city'         => $validated['city'],
            'dealer'       => $validated['dealer'],
        ]);

        Alert::success('Success', 'Permintaan test drive berhasil dikirim!');
        return back();
    }




    public function cart()
    {
        return view('landing.cart');
    }

    public function contact()
    {
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get()
            ->unique('name_brand')
            ->values();

        // Pecah menjadi 4 item per kolom
        $brandChunks = $brands->chunk(4);

        return view('landing.contact', compact('brands', 'brandChunks'));
    }



    public function about()
    {
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get()
            ->unique('name_brand')
            ->values();

        // Pecah menjadi chunks untuk grid (4 per baris)
        $brandChunks = $brands->chunk(4);

        return view('landing.about', compact('brands', 'brandChunks'));
    }
}
