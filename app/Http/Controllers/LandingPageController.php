<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testdrive;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil semua product beserta relasi category
        $products = Product::with('category')->get();

        // Ambil kategori khusus category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori khusus category_position_id = 2 beserta brand-nya
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil semua brand (optional, tetap untuk grid)
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Chunk brands untuk grid
        $brandChunks = $brands->chunk(4);

        // Kirim semua variabel ke view
        return view('landing.home', compact(
            'products',
            'categoriesPosition1',
            'categoriesPosition2',
            'brands',
            'brandChunks'
        ));
    }

    public function showBrand($slug)
    {
        // Ambil semua brand untuk navbar
        $brands = Brand::select('name_brand', 'slug')->orderBy('name_brand', 'asc')->get();
        $brandChunks = $brands->chunk(4);

        // Ambil brand berdasarkan slug
        $brand = Brand::where('slug', $slug)->firstOrFail();

        // Ambil semua produk yang memiliki brand yang sama sekaligus load relasi category
        $products = Product::with('category')
            ->where('brand_id', $brand->id)
            ->get();

        // Ambil kategori khusus category_position_id = 1 dan 2 untuk navbar
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        return view('landing.brand-detail', compact(
            'brand',
            'products',
            'brandChunks',
            'categoriesPosition1',
            'categoriesPosition2'
        ));
    }

    public function showProduct($productSlug)
    {
        // Ambil semua brand untuk navbar
        $brands = Brand::orderBy('name_brand', 'asc')->get();
        $brandChunks = $brands->chunk(4);

        // Ambil kategori khusus category_position_id = 1 dan 2 untuk navbar
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

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
            'details',
            'categoriesPosition1',
            'categoriesPosition2'
        ));
    }

    // public function wuling()
    // {
    //     return view('landing.wuling');
    // }

    // public function detailwuling()
    // {
    //     return view('landing.detailwuling');
    // }

    public function testdrive($productSlug)
    {
        // Ambil semua brand untuk header
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get();

        $brandChunks = $brands->chunk(4);

        // Ambil produk yang benar berdasarkan slug
        $product = Product::where('slug', $productSlug)->firstOrFail();

        // Ambil kategori khusus category_position_id = 1 dan 2 untuk navbar
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        return view('landing.testdrive', compact(
            'product',
            'brands',
            'brandChunks',
            'categoriesPosition1',
            'categoriesPosition2'
        ));
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

    public function about()
    {
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get()
            ->unique('name_brand')
            ->values();

        // Ambil kategori khusus category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori khusus category_position_id = 2 beserta brand-nya
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil semua brand (optional, tetap untuk grid)
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Chunk brands untuk grid
        $brandChunks = $brands->chunk(4);

        // Pecah menjadi chunks untuk grid (4 per baris)
        $brandChunks = $brands->chunk(4);

        return view('landing.about', compact(
            'brands',
            'brandChunks',
            'categoriesPosition1',
            'categoriesPosition2'
        ));
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

        // Ambil kategori khusus category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori khusus category_position_id = 2 beserta brand-nya
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil semua brand (optional, tetap untuk grid)
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Pecah menjadi 4 item per kolom
        $brandChunks = $brands->chunk(4);

        return view('landing.contact', compact(
            'brands',
            'brandChunks',
            'categoriesPosition1',
            'categoriesPosition2'
        ));
    }

    public function newss()
    {
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get()
            ->unique('name_brand')
            ->values();
        // Ambil kategori khusus category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori khusus category_position_id = 2 beserta brand-nya
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil semua brand (optional, tetap untuk grid)
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Pecah menjadi chunks untuk grid (4 per baris)
        $brandChunks = $brands->chunk(4);
        $news = News::latest()->get();
        return view('landing.news', compact(
            'brands',
            'brandChunks',
            'categoriesPosition1',
            'categoriesPosition2',
            'news'
        ));
    }

    public function newsDetail($slug)
    {
        // Ambil 1 data news berdasarkan slug
        $news = News::where('slug', $slug)->firstOrFail();

        // Ambil kategori posisi 1 dan brand
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori posisi 2 dan brand
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        return view('landing.news-detail', compact(
            'news',
            'categoriesPosition1',
            'categoriesPosition2'
        ));
    }
}
