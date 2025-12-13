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
            'title' => 'required|string|max:255',

            // wajib array
            'specs' => 'required|array',

            // setiap baris wajib memiliki label dan value
            'specs.*.label' => 'required|string|max:255',
            'specs.*.value' => 'required|string|max:255',
        ]);

        // simpan banyak row
        foreach ($validated['specs'] as $spec) {
            Specification::create([
                'product_id' => $product->id,
                'title'      => $validated['title'],
                'label'      => $spec['label'],   // sesuaikan nama field di database kalau ada
                'value'      => $spec['value'],
            ]);
        }

        Alert::success('Success', 'Specification berhasil ditambahkan');

        return redirect()->route('product.show', $product->slug)->with('tab', 'specification');
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
        // Ambil product berdasar slug
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Cari specification milik product tersebut
        $spec = Specification::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        // Update data
        $spec->update([
            'title' => $validated['title'],
            'label' => $validated['label'],
            'value' => $validated['value'],
        ]);
        Alert::success('Success', 'Specification berhasil diperbarui');
        return redirect()->route('product.show', $product->slug)->with('tab', 'spesification');
    }



    public function destroy($product_slug, $id)
    {
        $product = Product::where('slug', $product_slug)->firstOrFail();

        $spec = Specification::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();
        $spec->delete();
        Alert::success('Success', 'Specification berhasil dihapus.');
        return redirect()->route('product.show', $product->slug)->with('tab', 'specification');
    }
}
