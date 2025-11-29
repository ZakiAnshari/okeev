<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TechnologyController extends Controller
{
    public function index($slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil semua teknologi milik produk
        $technologies = $product->technologies;

        return view('admin.technologies.index', compact('product', 'technologies'));
    }

    public function store(Request $request, $slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public'); 
            // disimpan di: storage/app/public/image/…
        }

        // Simpan teknologi
        Technology::create([
            'product_id'  => $product->id,
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image'       => $imagePath,
        ]);

        // Alert sukses
        Alert::success('Success', 'Technology berhasil ditambahkan');

        // Redirect ke index teknologi
        return redirect()->route('product.show', $product->slug)->with('tab', 'technology');
    }

    public function edit($product_slug, $id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi berdasarkan ID dan pastikan milik produk tersebut
        $technology = Technology::where('id', $id)
                                ->where('product_id', $product->id)
                                ->firstOrFail();

        return view('admin.technologies.edit', compact('product', 'technology'));
    }

    public function update(Request $request, $slug, $id)
{
    // Ambil produk berdasarkan slug
    $product = Product::where('slug', $slug)->firstOrFail();

    // Ambil teknologi yang ingin diupdate
    $technology = Technology::where('id', $id)
                            ->where('product_id', $product->id)
                            ->firstOrFail();

    // Validasi input
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload gambar baru jika ada
    if ($request->hasFile('image')) {
        // Hapus file lama jika ada
        if ($technology->image && Storage::disk('public')->exists($technology->image)) {
            Storage::disk('public')->delete($technology->image);
        }

        $imagePath = $request->file('image')->store('image', 'public');
        $technology->image = $imagePath;
    }

    // Update data teknologi
    $technology->name = $validated['name'];
    $technology->description = $validated['description'] ?? null;
    $technology->save();

        // Alert sukses
    Alert::success('Success', 'Technology berhasil diupdate');

    // Redirect ke index teknologi
    return redirect()->route('technologies.index', $product->slug);
}
    public function destroy($product_slug, $technology_id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi
        $technology = Technology::where('id', $technology_id)
                                ->where('product_id', $product->id)
                                ->firstOrFail();

        // Hapus file gambar jika ada
        if ($technology->image && Storage::disk('public')->exists($technology->image)) {
            Storage::disk('public')->delete($technology->image);
        }

        // Hapus data teknologi
        $technology->delete();

        // Alert sukses
        Alert::success('Success', 'Technology berhasil dihapus');

        // Redirect ke index teknologi produk
        return redirect()->route('product.show', $product->slug);
    }


}
