<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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

        // Ambil semua brand (optional, jika ingin menampilkan di grid lain)
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        return view('home.index', compact(
            'products',
            'categoriesPosition1',
            'categoriesPosition2',
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

        return view('home.profil', compact('brands', 'brandChunks'));
    }

    public function cart()
    {
        // Ambil semua brand dari tabel brands
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);


        return view('home.cart', compact('brands', 'brandChunks'));
    }
}
