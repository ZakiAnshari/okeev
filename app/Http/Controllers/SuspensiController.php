<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Suspensi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SuspensiController extends Controller
{
    public function store(Request $request, $slug)
    {
        // Ambil product berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Validasi input multiple rows
        $validated = $request->validate([
            'suspensis' => 'required|array',
            'suspensis.*.label' => 'required|string|max:255',
            'suspensis.*.nilai' => 'required|string|max:255',
        ]);

        // Simpan setiap baris Power
        foreach ($validated['suspensis'] as $powerData) {
            Suspensi::create([
                'product_id' => $product->id,
                'label' => $powerData['label'],
                'nilai' => $powerData['nilai'],
            ]);
        }

        Alert::success('Success', 'Power berhasil ditambahkan');

        // Redirect kembali ke produk dan buka tab "power"
        return redirect()->route('product.show', $product->slug)->with('tab', 'suspensi');
    }

    public function edit($product_slug, $id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi berdasarkan ID dan pastikan milik produk tersebut
        $suspensis = Suspensi::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        return view('admin.suspensi.edit', compact('product', 'suspensis'))->with('tab', 'suspensi');
    }

    public function update(Request $request, $slug, $id)
    {
        // Ambil product berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil data power berdasarkan ID dan product_id
        $suspensi = Suspensi::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'nilai' => 'required|string|max:255',
        ]);

        // Update data
        $suspensi->update([
            'label' => $validated['label'],
            'nilai' => $validated['nilai'],
        ]);

        Alert::success('Success', 'Suspensi berhasil diperbarui');

        // Redirect kembali ke produk dan tetap di tab "power"
        return redirect()->route('product.show', $product->slug)->with('tab', 'suspensi');
    }

    public function destroy($product_slug, $power_id)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil data power berdasarkan ID & pastikan milik produk tersebut
        $suspensis = Suspensi::where('id', $power_id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Hapus data power
        $suspensis->delete();

        // Alert sukses
        Alert::success('Success', 'Suspensi berhasil dihapus.');

        // Redirect kembali ke tab power
        return redirect()->route('product.show', $product->slug)->with('tab', 'suspensi');
    }
}
