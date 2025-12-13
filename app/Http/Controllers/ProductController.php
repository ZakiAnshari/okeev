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
    public function getBrands($category_id)
    {
        $brands = Brand::where('category_id', $category_id)->get();
        return response()->json($brands);
    }

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
        $products = $query->get(); // bisa juga ->paginate()

        // Contoh pakai helper shopping: hitung total harga semua produk
        $items = $products->map(function ($product) {
            return [
                'qty' => 1,           // misal qty default 1
                'price' => $product->price,  // pastikan field price ada di tabel
            ];
        })->toArray();

        $totalHarga = countTotal($items); // helper countTotal
        $totalHargaFormatted = formatRupiah($totalHarga); // helper formatRupiah

        return view('admin.product.index', compact('user', 'products', 'brands', 'categories', 'totalHargaFormatted'));
    }

    public function store(Request $request)
    {
        // Bersihkan harga dari titik
        $request->merge([
            'price' => $request->price ? str_replace('.', '', $request->price) : null,
        ]);

        // Validasi
        $validated = $request->validate([
            'category_id'   => 'required|integer|exists:categories,id',
            'brand_id'      => 'required|integer|exists:brands,id',
            'model_name'    => 'required|string|max:255',
            'slug'          => 'nullable|string|max:255',
            'miles'         => 'nullable|integer',
            'seats'         => 'nullable|integer',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price'         => 'required|numeric',
            'stock_status'  => 'required|in:in_stock,out_of_stock',
            'featured'      => 'nullable|boolean',
            'description'   => 'nullable|string',
            'images.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔥 AMBIL CATEGORY
        $category = Category::findOrFail($validated['category_id']);

        // 🔥 SET category_position_id OTOMATIS
        $validated['category_position_id'] = $category->category_position_id;

        // Bersihkan HTML pada deskripsi
        if (!empty($validated['description'])) {
            $validated['description'] = Purifier::clean($validated['description']);
        }

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('images', 'public');
        }

        // Simpan produk
        $product = Product::create($validated);

        // Upload Multiple Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $image->store('images', 'public'),
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

        // Ambil kategori untuk dropdown (tidak difilter)
        $categories = Category::orderBy('name_category', 'asc')->get();

        // FILTER brand berdasarkan category_id dari produk
        $brands = Brand::where('category_id', $products->category_id)
            ->orderBy('name_brand', 'asc')
            ->get();

        // Kirim data ke view
        return view('admin.product.edit', compact('products', 'brands', 'categories'));
    }


    public function update(Request $request, $slug)
    {
        // Ambil produk
        $product = Product::where('slug', $slug)->firstOrFail();

        // Bersihkan harga dari titik
        $request->merge([
            'price' => $request->price ? str_replace('.', '', $request->price) : null,
        ]);

        // Validasi
        $validated = $request->validate([
            'category_id'    => 'required|integer|exists:categories,id',
            'brand_id'       => 'required|integer|exists:brands,id',
            'model_name'     => 'required|string|max:255',
            'slug'           => 'nullable|string|max:255',
            'miles'          => 'nullable|integer',
            'seats'          => 'nullable|integer',
            'price'          => 'required|numeric',
            'stock_status'   => 'required|in:in_stock,out_of_stock',
            'featured'       => 'nullable|boolean',
            'description'    => 'nullable|string',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔥 AMBIL CATEGORY BARU
        $category = Category::findOrFail($validated['category_id']);

        // 🔥 SINKRON category_position_id
        $validated['category_position_id'] = $category->category_position_id;

        // Bersihkan HTML deskripsi
        if (!empty($validated['description'])) {
            $validated['description'] = Purifier::clean($validated['description']);
        }

        // HANDLE SLUG
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['model_name']);
        }

        // ============================
        // UPDATE DATA PRODUK
        // ============================
        $product->update($validated);

        // ============================
        // UPDATE MULTIPLE IMAGES (OPTIONAL)
        // ============================
        if ($request->hasFile('images')) {

            // Hapus gambar lama
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->image);
                $img->delete();
            }

            // Upload gambar baru
            foreach ($request->file('images') as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $image->store('images', 'public'),
                ]);
            }
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
        // Ambil produk + relasi gambar
        $product = Product::with('images')->where('slug', $slug)->firstOrFail();
        // Tab aktif (default = technology)
        $activeTab = request()->get('tab', 'technology');

        // Pagination tiap relasi (ID pagination harus unik!)
        $technologies = $product->technologies()
            ->paginate(3, ['*'], 'tech_page')
            ->appends(['tab' => 'technology']);

        $features = $product->features()
            ->paginate(3, ['*'], 'feature_page')
            ->appends(['tab' => 'feature']);

        $colors = $product->colors()
            ->paginate(3, ['*'], 'color_page')
            ->appends(['tab' => 'color']);

        $specifications = $product->specifications()
            ->paginate(3, ['*'], 'spec_page')
            ->appends(['tab' => 'specification']);

        $powers = $product->powers()
            ->paginate(3, ['*'], 'power_page')
            ->appends(['tab' => 'power']);

        $dimensis = $product->dimensis()
            ->paginate(3, ['*'], 'dimensi_page')
            ->appends(['tab' => 'dimensi']);

        $suspensis = $product->suspensis()
            ->paginate(3, ['*'], 'suspensi_page')
            ->appends(['tab' => 'suspensi']);

        $fiturs = $product->fiturs()
            ->paginate(3, ['*'], 'fitur_page')
            ->appends(['tab' => 'fitur']);

        $details = $product->details()
            ->paginate(3, ['*'], 'detail_page')
            ->appends(['tab' => 'detail']);

        return view('admin.product.show', compact(
            'product',
            'technologies',
            'features',
            'colors',
            'specifications',
            'powers',
            'activeTab',
            'dimensis',
            'suspensis',
            'fiturs',
            'details'
        ));
    }
}
