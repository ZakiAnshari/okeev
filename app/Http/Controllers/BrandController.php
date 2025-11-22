<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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

        return view('admin.brand.index', compact('user', 'brands'));
    }

    public function store(Request $request)
    {
        // Validasi input sesuai model
        $validated = $request->validate([
            'name_brand' => 'required|string|max:255|unique:brands,name_brand',
            'image'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar ke folder images
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Simpan ke database
        Brand::create([
            'name_brand' => $validated['name_brand'],
            'image'      => $imagePath
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

        // Kirim ke view
        return view('admin.brand.edit', [
            'brands' => $brands
        ]);
    }


    public function update(Request $request, $slug)
    {
        // Ambil data brand berdasarkan slug
        $brand = Brand::where('slug', $slug)->firstOrFail();

        // Validasi: name_brand tidak boleh sama dengan brand lain
        $validated = $request->validate([
            'name_brand' => 'required|string|max:255|unique:brands,name_brand,' . $brand->id,
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika ada upload gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }

            // Upload gambar baru → folder images
            $validated['image'] = $request->file('image')->store('images', 'public');
        } else {
            // Jika tidak mengupload → tetap pakai yang lama
            $validated['image'] = $brand->image;
        }

        // Update data
        $brand->update($validated);

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
