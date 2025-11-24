<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'seats' => 'nullable|integer',
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
    

        // Simpan ke database
        Product::create($validated);

        Alert::success('Success', 'Product berhasil ditambahkan');
        return back();
    }

        public function edit($slug)
        {
            // Ambil data produk berdasarkan slug
            $products = Product::where('slug', $slug)->first();

            // Jika produk tidak ditemukan
            if (!$products) {
                return redirect()->route('product.index')
                                ->with('error', 'Data Product tidak ditemukan.');
            }

            // Ambil semua brand untuk dropdown
            $brands = Brand::orderBy('name_brand', 'asc')->get();

            // Kirim data ke view
            return view('admin.product.edit', compact('products', 'brands'));
        }

        public function update(Request $request, $slug)
        {
            // Ambil data produk berdasarkan slug
            $product = Product::where('slug', $slug)->firstOrFail();

            // Format harga: hapus titik
            $request->merge([
                'regular_price' => $request->regular_price ? str_replace('.', '', $request->regular_price) : null,
                'sale_price'    => $request->sale_price ? str_replace('.', '', $request->sale_price) : null,
            ]);

            // Validasi input (mirip store, tapi semua image boleh nullable)
            $validated = $request->validate([
                'brand' => 'required|string|max:255',
                'model_name' => 'required|string|max:255',
                'category' => 'required|string|max:100',
                'slug' => 'nullable|string|max:255',
                'miles' => 'required|integer',
                'type' => 'required|in:electric,hybrid,fuel',
                'seats' => 'required_if:category,cars|nullable|integer',
                'cc' => 'required_if:category,motorcycles|nullable|integer',
                'regular_price' => 'required|numeric',
                'sale_price' => 'nullable|numeric',
                'quantity' => 'required|integer',
                'stock_status' => 'required|in:in_stock,out_of_stock',
                'featured' => 'nullable|boolean',

                // image boleh kosong saat update
                'image_wallpaper' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'image_detail_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'image_detail_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'image_detail_3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // ============================
            // UPLOAD IMAGE + HAPUS LAMA
            // ============================
            $imageFields = [
                'image_wallpaper',
                'image',
                'image_detail_1',
                'image_detail_2',
                'image_detail_3'
            ];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {

                    // hapus file lama jika ada
                    if (!empty($product->$field)) {
                        Storage::disk('public')->delete($product->$field);
                    }

                    // upload file baru
                    $validated[$field] = $request->file($field)->store('images', 'public');
                } else {
                    // tetap pakai gambar lama jika tidak update
                    $validated[$field] = $product->$field;
                }
            }

            // ============================
            // HANDLE SLUG
            // ============================
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['brand'] . ' ' . $validated['model_name']);
            }

            // Update data
            $product->update($validated);

            Alert::success('Success', 'Product berhasil diperbarui.');

            return redirect()->route('product.index');
        }

        public function destroy($slug)
        {
            $product = Product::where('slug', $slug)->firstOrFail();
            $product->delete();

            Alert::success('Success', 'Data berhasil di Hapus');
            return redirect()->route('product.index');
        }

    public function show($slug)
    {
        // Ambil product berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Kirim data ke view
        return view('admin.product.show', compact('product'));
    }



}
