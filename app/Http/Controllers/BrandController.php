<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil input pencarian dan jumlah item per halaman
        $search = $request->input('search');
        $paginate = $request->input('itemsPerPage', 5); // default 5
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

        // Eksekusi query + paginasi
        $brands = $query->paginate($paginate)->withQueryString();

        return view('admin.brand.index', compact('user', 'brands', 'categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name_brand'  => 'required|string|max:255|unique:brands,name_brand',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'wallpaper'   => 'required|image|mimes:jpg,jpeg,png|max:10240', // max 10MB
        ]);

        // Upload image umum
        $imagePath = $request->file('image')->store('images', 'public');

        // Upload wallpaper slider
        $wallpaperPath = $request->file('wallpaper')->store('wallpapers', 'public');

        // Simpan ke database
        Brand::create([
            'name_brand'  => $validated['name_brand'],
            'category_id' => $validated['category_id'],
            'image'       => $imagePath,
            'wallpaper'   => $wallpaperPath,
        ]);

        Alert::success('Success', 'Brand berhasil ditambahkan');
        return back();
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
        // Ambil data brand berdasarkan slug
        $brand = Brand::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'name_brand' => 'required|string|max:255|unique:brands,name_brand,' . $brand->id,
            'category_id' => 'required|exists:categories,id',

            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'wallpaper'  => 'nullable|image|mimes:jpg,jpeg,png|max:10240', // 10MB
        ]);

        /* ------------------------------------
        HANDLE IMAGE UPDATE
    ------------------------------------ */

        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }

            // Upload baru
            $validated['image'] = $request->file('image')->store('images', 'public');
        } else {
            $validated['image'] = $brand->image;
        }

        /* ------------------------------------
        HANDLE WALLPAPER UPDATE
    ------------------------------------ */

        if ($request->hasFile('wallpaper')) {

            // Hapus wallpaper lama jika ada
            if ($brand->wallpaper) {
                Storage::disk('public')->delete($brand->wallpaper);
            }

            // Upload baru
            $validated['wallpaper'] = $request->file('wallpaper')->store('wallpapers', 'public');
        } else {
            $validated['wallpaper'] = $brand->wallpaper;
        }

        /* ------------------------------------
        UPDATE DATA
    ------------------------------------ */

        $brand->update([
            'name_brand'  => $validated['name_brand'],
            'category_id' => $validated['category_id'],
            'image'       => $validated['image'],
            'wallpaper'   => $validated['wallpaper'],
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

    
}
