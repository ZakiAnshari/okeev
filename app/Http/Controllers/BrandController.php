<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil input pencarian
        $search = $request->input('search');
        $categories = Category::orderBy('name_category')->get();

        // Query awal
        $query = Brand::query();

        // Pencarian berdasarkan brand / model / id
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'LIKE', '%' . $search . '%')
                    ->orWhere('model', 'LIKE', '%' . $search . '%')
                    ->orWhere('id', 'LIKE', '%' . $search . '%');
            });
        }

        // Eksekusi tanpa paginate
        $brands = $query->orderBy('id', 'desc')->get();

        return view('admin.brand.index', compact('user', 'brands', 'categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_brand'  => 'required|string|max:255|unique:brands,name_brand',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'wallpaper'   => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        // AMBIL CATEGORY
        $category = Category::findOrFail($validated['category_id']);

        // UPLOAD FILE
        $imagePath = $request->file('image')->store('brands/images', 'public');
        $wallpaperPath = $request->file('wallpaper')->store('brands/wallpapers', 'public');

        // SIMPAN BRAND
        Brand::create([
            'name_brand'           => $validated['name_brand'],
            'slug'                 => Str::slug($validated['name_brand']),
            'category_id'          => $category->id,
            'category_position_id' => $category->category_position_id, // 🔥 INI PENTING
            'image'                => $imagePath,
            'wallpaper'            => $wallpaperPath,
        ]);
        Alert::success('Success', 'Brand berhasil ditambah.');
        return back()->with('success', 'Brand berhasil ditambahkan');
    }



    public function edit($slug)
    {
        // Ambil data brand berdasarkan slug
        $brands = Brand::where('slug', $slug)->first();

        // Jika brand tidak ditemukan
        if (!$brands) {
            return redirect()->route('brands.index')
                ->with('error', 'Data brand tidak ditemukan.');
        }

        // Ambil semua kategori untuk select option
        $categories = Category::orderBy('name_category')->get();

        // Kirim data ke view
        return view('admin.brand.edit', compact('brands', 'categories'));
    }



    public function update(Request $request, $slug)
    {
        // Ambil data brand
        $brand = Brand::where('slug', $slug)->firstOrFail();

        // Validasi
        $validated = $request->validate([
            'name_brand'  => 'required|string|max:255|unique:brands,name_brand,' . $brand->id,
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'wallpaper'   => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        // 🔥 Ambil category baru
        $category = Category::findOrFail($validated['category_id']);

        /* ===============================
       HANDLE IMAGE
    =============================== */
        if ($request->hasFile('image')) {
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }
            $validated['image'] = $request->file('image')->store('brands/images', 'public');
        } else {
            $validated['image'] = $brand->image;
        }

        /* ===============================
       HANDLE WALLPAPER
    =============================== */
        if ($request->hasFile('wallpaper')) {
            if ($brand->wallpaper) {
                Storage::disk('public')->delete($brand->wallpaper);
            }
            $validated['wallpaper'] = $request->file('wallpaper')->store('brands/wallpapers', 'public');
        } else {
            $validated['wallpaper'] = $brand->wallpaper;
        }

        /* ===============================
       UPDATE BRAND
    =============================== */
        $brand->update([
            'name_brand'           => $validated['name_brand'],
            'slug'                 => Str::slug($validated['name_brand']),
            'category_id'          => $category->id,
            'category_position_id' => $category->category_position_id, // 🔥 PENTING
            'image'                => $validated['image'],
            'wallpaper'            => $validated['wallpaper'],
        ]);

        Alert::success('Success', 'Brand berhasil diperbarui.');
        return redirect()->route('brands.index');
    }


    public function destroy($slug)
    {
        $brands = Brand::where('slug', $slug)->firstOrFail();
        $brands->delete();

        Alert::success('Success', 'Data berhasil di Hapus');
        return redirect()->route('brands.index');
    }

    public function getBrands($category_id)
    {
        $brands = Brand::where('category_id', $category_id)->get();

        return response()->json($brands);
    }
}
