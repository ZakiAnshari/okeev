<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
         $products = Product::all();
        // Ambil semua brand unik beserta slug dan image dari tabel Product
        $brands = Product::select('brand', 'slug', 'image')
                        ->orderBy('brand', 'asc')
                        ->get()
                        ->unique('brand') // pastikan hanya satu brand per nama
                        ->values();

        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);
        
        return view('landing.home', compact('products','brands', 'brandChunks'));
    }


    public function showBrand($slug)
    {
        // Ambil semua brand unik untuk navbar
        $brands = Product::select('brand', 'slug')
                    ->orderBy('brand', 'asc')
                    ->get()
                    ->unique('brand')  // pastikan hanya satu brand per nama
                    ->values();
        $brandChunks = $brands->chunk(4);

        // Ambil brand berdasarkan slug (ambil produk pertama dengan slug tersebut)
        $brand = Product::where('slug', $slug)->firstOrFail();

        // Ambil semua produk yang memiliki brand yang sama
        $products = Product::where('brand', $brand->brand)->get();

        return view('landing.brand-detail', compact('brand', 'products', 'brandChunks'));
    }

    public function showProduct($productSlug)
    {
        $products = Product::all();
        // Ambil semua brand unik untuk navbar
        $brands = Product::select('brand', 'slug')
                    ->orderBy('brand', 'asc')
                    ->get()
                    ->unique('brand')
                    ->values();
        $brandChunks = $brands->chunk(4);

        // Ambil product berdasarkan slug sekaligus load relasi
        $product = Product::with(['technologies', 'features', 'colors', 'specifications'])
                        ->where('slug', $productSlug)
                        ->firstOrFail();

        return view('landing.product-detail', compact('product','products', 'brandChunks'));
    }













    public function wuling()
    {
        return view('landing.wuling');
    }

    public function detailwuling()
    {
        return view('landing.detailwuling');
    }

    public function testdrive()
    {
        return view('landing.testdrive');
    }

    public function cart()
    {
        return view('landing.cart');
    }

    public function contact()
    {
            $brands = Product::select('brand', 'slug', 'image')
                        ->orderBy('brand', 'asc')
                        ->get()
                        ->unique('brand') // pastikan hanya satu brand per nama
                        ->values();

        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);
        return view('landing.contact',compact('brands', 'brandChunks'));
    }


     public function about()
    {
            $brands = Product::select('brand', 'slug', 'image')
                        ->orderBy('brand', 'asc')
                        ->get()
                        ->unique('brand') // pastikan hanya satu brand per nama
                        ->values();

        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);
        return view('landing.about',compact('brands', 'brandChunks'));
    }
}
