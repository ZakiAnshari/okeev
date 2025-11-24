<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Product;
use Ramsey\Uuid\FeatureSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class FeatureController extends Controller
{
    public function index($slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil semua teknologi milik produk
        $features = $product->features;

        return view('admin.feature.index', compact('product', 'features'));
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
        Feature::create([
            'product_id'  => $product->id,
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image'       => $imagePath,
        ]);

        // Alert sukses
        Alert::success('Success', 'Technology berhasil ditambahkan');

        // Redirect ke index teknologi
        return redirect()->route('features.index', $product->slug);
    }

    public function edit($product_slug, $id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi berdasarkan ID dan pastikan milik produk tersebut
        $features = Feature::where('id', $id)
                                ->where('product_id', $product->id)
                                ->firstOrFail();

        return view('admin.feature.edit', compact('product', 'features'));
    }

    public function update(Request $request, $slug, $id)
{
    // Ambil produk berdasarkan slug
    $product = Product::where('slug', $slug)->firstOrFail();

    // Ambil feature yang ingin diupdate
    $feature = Feature::where('id', $id)
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
        if ($feature->image && Storage::disk('public')->exists($feature->image)) {
            Storage::disk('public')->delete($feature->image);
        }

        $feature->image = $request->file('image')->store('image', 'public');
    }

    // Update data feature
    $feature->name = $validated['name'];
    $feature->description = $validated['description'] ?? null;
    $feature->save();

    // Alert sukses
    Alert::success('Success', 'Feature berhasil diupdate');

    // Redirect ke index feature
    return redirect()->route('features.index', $product->slug);
    }

    public function destroy($product_slug, $feature_id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil feature yang ingin dihapus
        $feature = Feature::where('id', $feature_id)
                        ->where('product_id', $product->id)
                        ->firstOrFail();

        // Hapus file gambar jika ada
        if ($feature->image && Storage::disk('public')->exists($feature->image)) {
            Storage::disk('public')->delete($feature->image);
        }

        // Hapus data feature
        $feature->delete();

        // Alert sukses
        Alert::success('Success', 'Feature berhasil dihapus');

        // Redirect ke index feature
        return redirect()->route('features.index', $product->slug);
    }

}
