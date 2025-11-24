<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Specification;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SpecificationController extends Controller
{
    public function index($slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil semua teknologi milik produk
        $specifications = $product->specifications;

        return view('admin.specification.index', compact('product', 'specifications'));
    }

    public function store(Request $request, $slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'section' => 'required|string|max:255',
            'title'   => 'required|string|max:255',
            'value'   => 'required|string|max:255',
        ]);

        // Simpan specification
        Specification::create([
            'product_id' => $product->id,
            'section'    => $validated['section'],
            'title'      => $validated['title'],
            'value'      => $validated['value'],
        ]);

        // Alert sukses
        Alert::success('Success', 'Specification berhasil ditambahkan');

        // Redirect ke index specification
        return redirect()->route('specifications.index', $product->slug);
    }


    public function edit($product_slug, $id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi berdasarkan ID dan pastikan milik produk tersebut
        $specifications = Specification::where('id', $id)
                                ->where('product_id', $product->id)
                                ->firstOrFail();

        return view('admin.specification.edit', compact('product', 'specifications'));
    }

    public function update(Request $request, $product_slug, $id)
{
    // Ambil product
    $product = Product::where('slug', $product_slug)->firstOrFail();

    // Ambil data specification
    $spec = Specification::where('id', $id)
        ->where('product_id', $product->id)
        ->firstOrFail();

    // Validasi input
    $validated = $request->validate([
        'section' => "required|string|max:255",
        'title'   => 'required|string|max:255',
        'value'   => 'required|string|max:255',
    ]);

    // Update data
    $spec->update([
        'section' => $validated['section'],
        'title'   => $validated['title'],
        'value'   => $validated['value'],
    ]);

    // Alert sukses
    Alert::success('Success', 'Specification berhasil diperbarui');

    // Redirect kembali
    return redirect()->route('specifications.index', $product->slug);
}

public function destroy($product_slug, $id)
{
    $product = Product::where('slug', $product_slug)->firstOrFail();

    $spec = Specification::where('id', $id)
        ->where('product_id', $product->id)
        ->firstOrFail();

    $spec->delete();

    Alert::success('Success', 'Specification berhasil dihapus.');

    return redirect()->route('specifications.index', $product->slug);
}


}
