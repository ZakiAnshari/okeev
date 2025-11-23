<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $brands = Brand::orderBy('name_brand', 'asc')->get(); // ambil semua brand
        // Ambil input pencarian & jumlah item per halaman
        $search = $request->input('search');
        $paginate = $request->input('itemsPerPage', 5); // default 5

        // Query awal: sort terbaru di atas
        $query = Product::orderBy('created_at', 'desc');

        // Pencarian berdasarkan name_category dan slug
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('model_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('slug', 'LIKE', '%' . $search . '%');
            });
        }

        // Eksekusi query + paginasi
        $products = $query->paginate($paginate)->withQueryString();

        return view('admin.product.index', compact('user', 'products', 'brands'));
    }

    public function store(Request $request)
    {

        $request->merge([
            'regular_price' => $request->regular_price ? str_replace('.', '', $request->regular_price) : null,
            'sale_price'    => $request->sale_price ? str_replace('.', '', $request->sale_price) : null,
        ]);

        // Validasi input
        $validated = $request->validate([
            'brand' => 'required|string|max:255', // ini nanti dari select
            'model_name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'slug' => 'nullable|string|max:255',
            'miles' => 'required|integer',
            'type' => 'required|in:electric,hybrid,fuel',
            'seats' => 'required|integer',
            'cc' => 'nullable|integer',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'stock_status' => 'required|in:in_stock,out_of_stock',
            'featured' => 'nullable|boolean',
            'image_wallpaper' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'image_detail_1' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'image_detail_2' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'image_detail_3' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar jika ada
        foreach (['image_wallpaper', 'image', 'image_detail_1', 'image_detail_2', 'image_detail_3'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $validated[$imgField] = $request->file($imgField)->store('images', 'public');
            }
        }

        // Generate slug jika kosong
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['brand'] . ' ' . ($validated['model_name'] ?? ''));
        }

        // Simpan ke database
        Product::create($validated);

        Alert::success('Success', 'Product berhasil ditambahkan');
        return back();
    }
}
