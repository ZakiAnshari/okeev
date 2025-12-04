<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeUserController extends Controller
{


    public function index()
    {
        $products = Product::all();
        $product = Product::first();
        // Ambil semua brand dari tabel brands
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);


        return view('home.index', compact('brands', 'brandChunks','products','product'));
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
