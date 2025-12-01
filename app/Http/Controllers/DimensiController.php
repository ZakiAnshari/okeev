<?php

namespace App\Http\Controllers;

use App\Models\Dimensi;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DimensiController extends Controller
{
    public function store(Request $request, $slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Validasi input multiple rows
        $validated = $request->validate([
            'dimensis' => 'required|array',
            'dimensis.*.label' => 'required|string|max:255',
            'dimensis.*.nilai' => 'required|string|max:255',
        ]);

        // Simpan setiap baris Dimensi
        foreach ($validated['dimensis'] as $dimensiData) {
            Dimensi::create([
                'product_id' => $product->id,
                'label' => $dimensiData['label'],
                'nilai' => $dimensiData['nilai'],
            ]);
        }

        Alert::success('Success', 'Dimensi berhasil ditambahkan');

        // Redirect kembali ke produk dan buka tab "dimensi"
        return redirect()->route('product.show', $product->slug)->with('tab', 'dimensi');
    }


    public function edit($product_slug, $id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi berdasarkan ID dan pastikan milik produk tersebut
        $dimensis = Dimensi::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        return view('admin.dimensi.edit', compact('product', 'dimensis'))->with('tab', 'dimensi');
    }

    public function update(Request $request, $slug, $id)
    {
        // Ambil product berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil data Dimensi berdasarkan ID dan product_id
        $dimensi = Dimensi::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'nilai' => 'required|string|max:255',
        ]);

        // Update data Dimensi
        $dimensi->update([
            'label' => $validated['label'],
            'nilai' => $validated['nilai'],
        ]);

        Alert::success('Success', 'Dimensi berhasil diperbarui');

        // Redirect kembali ke produk dan tetap di tab "dimensi"
        return redirect()->route('product.show', $product->slug)->with('tab', 'dimensi');
    }


    public function destroy($product_slug, $dimensi_id)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil data Dimensi berdasarkan ID & pastikan milik produk tersebut
        $dimensi = Dimensi::where('id', $dimensi_id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Hapus data Dimensi
        $dimensi->delete();

        // Alert sukses
        Alert::success('Success', 'Dimensi berhasil dihapus.');

        // Redirect kembali ke tab Dimensi
        return redirect()->route('product.show', $product->slug)->with('tab', 'dimensi');
    }
}
