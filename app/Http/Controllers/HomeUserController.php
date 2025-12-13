<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class HomeUserController extends Controller
{
    public function index()
    {
        // Ambil semua product beserta relasi category
        $products = Product::with('category')->get();

        // Ambil kategori dengan category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori dengan category_position_id = 2 (misal untuk Electric Motorcycles)
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();
        // Ambil kategori khusus category_position_id = 3 beserta brand-nya
        $categoriesPosition3 = Category::with('brands')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('name_category', 'asc')
            ->get();


        // Ambil semua brand (optional, jika ingin menampilkan di grid lain)
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        return view('home.index', compact(
            'products',
            'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3',
            'brands'
        ));
    }

    public function showProfile($slug)
    {
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get();
        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);

        // Ambil kategori dengan category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori dengan category_position_id = 2 (misal untuk Electric Motorcycles)
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori khusus category_position_id = 3 beserta brand-nya
        $categoriesPosition3 = Category::with('brands')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('name_category', 'asc')
            ->get();


        // Ambil semua brand (optional, jika ingin menampilkan di grid lain)
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();


        return view('home.profil', compact(
            'brands',
            'brandChunks',
            'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3',
        ));
    }

    public function cart()
    {
        // Ambil semua brand dari tabel brands
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);

        // Ambil kategori dengan category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori dengan category_position_id = 2 (misal untuk Electric Motorcycles)
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();
        $products = Product::orderBy('created_at', 'desc')->get();

        // Ambil kategori khusus category_position_id = 3 beserta brand-nya
        $categoriesPosition3 = Category::with('brands')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('name_category', 'asc')
            ->get();


        return view('home.cart', compact(
            'brands',
            'brandChunks',
            'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3',
            'products'
        ));
    }

    // HomeUserController.php
    public function addToCart(Request $request)
    {
        // logika menambahkan ke keranjang
        // Contoh sederhana, bisa disesuaikan dengan implementasi cart-mu
        $cart = session()->get('cart', []);
        $cart[$request->product_id] = [
            "name" => $request->product_name,
            "price" => $request->price,
            "image" => $request->image,
            "quantity" => 1
        ];
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }
}
