<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
        public function index(Request $request)
        {
            $search = $request->search;

            $categories = Category::orderBy('name_category')->get();
            $brands = Brand::orderBy('name_brand', 'asc')->get(); 
            $user = Auth::user();

            // Query awal dengan sort terbaru di atas
            $query = Product::orderBy('created_at', 'desc');

            // Jika ada pencarian
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('model_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('slug', 'LIKE', '%' . $search . '%');
                });
            }

            // Eksekusi query
            $products = $query->get(); // atau paginate()

            return view('admin.product.index', compact('user', 'products', 'brands', 'categories'));
        }

        public function store(Request $request)
        {
            // Bersihkan harga
            $request->merge([
                'price' => $request->price ? str_replace('.', '', $request->price) : null,
            ]);

            // Validasi produk
            $validated = $request->validate([
                'category_id' => 'required|integer|exists:categories,id',
                'brand_id'    => 'required|string|max:255',
                'model_name'  => 'required|string|max:255',
                'slug'        => 'nullable|string|max:255',
                'miles'       => 'nullable|integer',
                'seats'       => 'nullable|integer',
                'price'       => 'required|numeric',
                'stock_status'=> 'required|in:in_stock,out_of_stock',
                'featured'    => 'nullable|boolean',
                'description' => 'string|nullable',
                'images.*'    => 'required|image|mimes:jpg,jpeg,png|max:2048', // multiple
            ]);

            //Bersihkan HTML dari CKEditor agar aman
                if (!empty($validated['description'])) {
                    $validated['description'] = Purifier::clean($validated['description']);
                }

            $validated['description'] = Purifier::clean($validated['description']);

            // Simpan data produk utama
            $product = Product::create($validated);

            // Upload multiple image
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');

                    // Simpan ke tabel `product_images`
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $path,
                    ]);
                }
            }

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

            // Ambil semua brand dan category untuk dropdown
            $brands = Brand::orderBy('name_brand', 'asc')->get();
            $categories = Category::orderBy('name_category', 'asc')->get();

            // Kirim data ke view (pastikan view memakai variable $categories dan $brands)
            return view('admin.product.edit', compact('products', 'brands', 'categories'));
        }

        public function update(Request $request, $slug)
        {
            // Ambil data produk berdasarkan slug
            $product = Product::where('slug', $slug)->firstOrFail();

            // Format harga: hilangkan titik
            $request->merge([
                'price' => $request->price ? str_replace('.', '', $request->price) : null,
            ]);

            // Validasi input (mirip STORE)
            $validated = $request->validate([
                'category_id' => 'required|integer|exists:categories,id',
                'brand_id'    => 'required|string|max:255',
                'model_name'  => 'required|string|max:255',
                'slug'        => 'nullable|string|max:255',
                'miles'       => 'nullable|integer',
                'seats'       => 'nullable|integer',
                'price'       => 'required|numeric',
                'stock_status'=> 'required|in:in_stock,out_of_stock',
                'featured'    => 'nullable|boolean',
                'description' => 'nullable|string',

                // Multiple image, boleh kosong saat update
                'images.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Bersihkan HTML CKEditor
            if (!empty($validated['description'])) {
                $validated['description'] = Purifier::clean($validated['description']);
            }

            // ============================
            // UPDATE DATA PRODUK
            // ============================
            $product->update($validated);

            // ============================
            // UPLOAD MULTIPLE IMAGES (OPTIONAL)
            // ============================
            if ($request->hasFile('images')) {

                // Hapus gambar lama
                foreach ($product->images as $img) {
                    Storage::disk('public')->delete($img->image);
                    $img->delete();
                }

                // Upload gambar baru
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $path,
                    ]);
                }
            }

            // ============================
            // HANDLE SLUG
            // ============================
            if (empty($validated['slug'])) {
                $product->update([
                    'slug' => Str::slug($validated['model_name'])
                ]);
            }

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
            // Ambil produk + semua gambar terkait
            $product = Product::with('images')->where('slug', $slug)->firstOrFail();

            // Ambil relasi dengan pagination
            $technologies = $product->technologies()->paginate(3);
            $features     = $product->features()->paginate(3);
            $colors       = $product->colors()->paginate(3);

            // Kirim semua data ke view
            return view('admin.product.show', compact('product', 'technologies', 'features', 'colors'));
        }





}
