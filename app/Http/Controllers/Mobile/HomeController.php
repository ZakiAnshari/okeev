<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Product Vehicle
        $products = Product::with('brand')
            ->where('category_id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $brands = Brand::all();
        return view('mobile.home', compact('brands', 'products'));
    }

    public function showcard()
    {
        // Brand Vehicle
        $vehicleBrands = Brand::where('category_id', 1)
            ->orderBy('name_brand', 'asc')
            ->limit(8)
            ->get();

        // Product Vehicle
        $products = Product::with('brand')
            ->where('category_id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.show', compact('vehicleBrands', 'products'));
    }

    public function showVehicleDetail($slug)
    {
        // Ambil product detail beserta brand
        $product = Product::with('brand')->where('slug', $slug)->firstOrFail();

        // Ambil brand dari relasi
        $brand = $product->brand;

        // Ambil semua product dengan brand yang sama
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)       // hanya brand yang sama
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.detail', compact('product', 'brand', 'sameBrandProducts'));
    }
}
