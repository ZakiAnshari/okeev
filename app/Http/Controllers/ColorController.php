<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ColorController extends Controller
{
    public function index($slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil semua teknologi milik produk
        $colors = $product->colors;


        return view('admin.color.index', compact('product', 'colors'));
    }

    public function store(Request $request, $slug)
{
    // Ambil produk berdasarkan slug
    $product = Product::where('slug', $slug)->firstOrFail();

    // Validasi input
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'hex'   => 'required|string|max:7', // #FFFFFF
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload gambar jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('color', 'public'); 
        // disimpan di: storage/app/public/color/…
    }

    // Simpan color
    Color::create([
        'product_id' => $product->id,
        'name'       => $validated['name'],
        'hex'        => $validated['hex'],
        'image'      => $imagePath,
    ]);

    // Alert sukses
    Alert::success('Success', 'Color berhasil ditambahkan');

    // Redirect ke index color
    return redirect()->route('product.show', $product->slug)->with('tab', 'color');
}


    public function edit($product_slug, $id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi berdasarkan ID dan pastikan milik produk tersebut
        $colors = Color::where('id', $id)
                                ->where('product_id', $product->id)
                                ->firstOrFail();

        return view('admin.color.edit', compact('product', 'colors'))->with('tab', 'color');
    }

    public function update(Request $request, $slug, $id)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil color yang ingin diupdate
        $color = Color::where('id', $id)
                        ->where('product_id', $product->id)
                        ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'hex'   => 'required|string|max:7', // #FFFFFF
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($color->image && Storage::disk('public')->exists($color->image)) {
                Storage::disk('public')->delete($color->image);
            }

            $color->image = $request->file('image')->store('color', 'public');
        }

        // Update data color
        $color->name = $validated['name'];
        $color->hex  = $validated['hex'];
        $color->save();

        // Alert sukses
        Alert::success('Success', 'Color berhasil diupdate');

        // Redirect ke index color
        return redirect()->route('product.show', $product->slug)->with('tab', 'color');
    }

    public function destroy($product_slug, $color_id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil color yang ingin dihapus
        $colors = Color::where('id', $color_id)
                    ->where('product_id', $product->id)
                    ->firstOrFail();

        // Hapus file gambar jika ada
        if ($colors->image && Storage::disk('public')->exists($colors->image)) {
            Storage::disk('public')->delete($colors->image);
        }

        // Hapus data color
        $colors->delete();

        // Alert sukses
        Alert::success('Success', 'Color berhasil dihapus');

        // Redirect ke index color
        return redirect()->route('product.show', $product->slug)->with('tab', 'color');
    }


}
