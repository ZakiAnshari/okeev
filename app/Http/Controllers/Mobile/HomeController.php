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

    public function showBrandVehicle($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        // Ambil semua produk brand ini
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.detail', compact('brand', 'sameBrandProducts'));
    }
}
