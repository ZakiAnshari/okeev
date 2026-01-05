<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Brand;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('brand')
            ->where('category_id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $brands = Brand::all();

        // kirim flag biasa
        return view('mobile.home', [
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    // ______________________________________________________________________
    // MOBIL
    public function showcard()
    {
        // Brand Vehicle
        $vehicleBrands = Brand::where('category_id', 1)
            ->orderBy('name_brand', 'asc')
            ->limit(100)
            ->get();

        // Product Vehicle
        $products = Product::with('brand')
            ->where('category_id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.show', compact('vehicleBrands', 'products'));
    }
    // MOTOR
    public function showmotorcycles()
    {
        // Brand Vehicle
        $vehicleBrands = Brand::where('category_id', 2)
            ->orderBy('name_brand', 'asc')
            ->limit(100)
            ->get();

        // Product Vehicle
        $products = Product::with('brand')
            ->where('category_id', 2)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.showmotor', compact('vehicleBrands', 'products'));
    }
    // ELECTRIC
    public function showelectric()
    {
        // Brand Vehicle
        $vehicleBrands = Brand::where('category_position_id', 2)
            ->orderBy('name_brand', 'asc')
            ->limit(100)
            ->get();

        // Product Vehicle
        $products = Product::with('brand')
            ->where('category_position_id', 2)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.showelectric', compact('vehicleBrands', 'products'));
    }

    //ACCESSORIES
    public function showaccessories()
    {
        // Brand Accessories (category_position_id = 3 & 4)
        $vehicleBrands = Brand::whereIn('category_position_id', [3, 4])
            ->orderBy('name_brand', 'asc')
            ->limit(100)
            ->get();

        // Product Accessories
        $products = Product::with('brand')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.showaccessories', compact('vehicleBrands', 'products'));
    }


    // ______________________________________________________________________
    // MOBIL BRAND
    public function showBrandVehicle($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mobile.brand.detail', compact('brand', 'sameBrandProducts'));
    }
    // MOTOR BRAND
    public function showBrandmotor($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mobile.brand.detailmotor', compact('brand', 'sameBrandProducts'));
    }
    // ELECTRIC BRAND
    public function showBrandelectric($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mobile.brand.detailelectric', compact('brand', 'sameBrandProducts'));
    }
    // ACCESSORIES BRAND
    public function showBrandaccessories($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mobile.brand.detailaccessories', compact('brand', 'sameBrandProducts'));
    }

    // ______________________________________________________________________

    public function showVehicleDetail($productSlug)
    {
        // Ambil product berdasarkan slug
        $product = \App\Models\Product::where('slug', $productSlug)
            ->with(['features', 'technologies', 'colors', 'specifications', 'details']) // load relasi langsung
            ->firstOrFail();

        // Ambil feature & technology khusus product ini
        $features = $product->features;
        $technologies = $product->technologies;
        $colors = $product->colors;
        $specifications = $product->specifications;
        $details = $product->details;

        // Kirim data ke view
        return view('mobile.vehicle.detail', compact('product', 'features', 'technologies', 'colors', 'specifications', 'details'));
    }







    public function transaksi()
    {
        // Kembalikan view tanpa data
        return view('mobile.transaksi.index');
    }

    public function newss()
    {
        // Kembalikan view tanpa data
        return view('mobile.news.index');
    }

    public function newssdetail()
    {
        // Kembalikan view tanpa data
        return view('mobile.news.detail');
    }

    public function profilm()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Kirim data user ke view
        return view('mobile.profil.index', compact('user'));
    }

    public function about()
    {
        // Kembalikan view tanpa data
        return view('mobile.about.index');
    }

    public function contact()
    {
        // Kembalikan view tanpa data
        return view('mobile.contact.index');
    }
}
