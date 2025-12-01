<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FiturController extends Controller
{
    public function store(Request $request, $slug)
    {
        // Ambil product berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Validasi input multiple rows
        $validated = $request->validate([
            'fiturs' => 'required|array',
            'fiturs.*.label' => 'required|string|max:255',
            'fiturs.*.nilai' => 'required|string|max:255',
        ]);

        // Simpan setiap baris Power
        foreach ($validated['fiturs'] as $powerData) {
            Fitur::create([
                'product_id' => $product->id,
                'label' => $powerData['label'],
                'nilai' => $powerData['nilai'],
            ]);
        }

        Alert::success('Success', 'Power berhasil ditambahkan');

        // Redirect kembali ke produk dan buka tab "power"
        return redirect()->route('product.show', $product->slug)->with('tab', 'fitur');
    }

    public function edit($product_slug, $id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi berdasarkan ID dan pastikan milik produk tersebut
        $fiturs = Fitur::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();
        return view('admin.fitur.edit', compact('product', 'fiturs'))->with('tab', 'fitur');
    }

    public function update(Request $request, $slug, $id)
    {
        // Ambil product berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil data power berdasarkan ID dan product_id
        $fitur = Fitur::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'nilai' => 'required|string|max:255',
        ]);

        // Update data
        $fitur->update([
            'label' => $validated['label'],
            'nilai' => $validated['nilai'],
        ]);

        Alert::success('Success', 'Fitur berhasil diperbarui');

        // Redirect kembali ke produk dan tetap di tab "power"
        return redirect()->route('product.show', $product->slug)->with('tab', 'fitur');
    }

    public function destroy($product_slug, $power_id)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil data power berdasarkan ID & pastikan milik produk tersebut
        $fiturs = Fitur::where('id', $power_id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Hapus data power
        $fiturs->delete();

        // Alert sukses
        Alert::success('Success', 'Fitur berhasil dihapus.');

        // Redirect kembali ke tab power
        return redirect()->route('product.show', $product->slug)->with('tab', 'fitur');
    }
}
