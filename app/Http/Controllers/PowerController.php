<?php

namespace App\Http\Controllers;

use App\Models\Power;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PowerController extends Controller
{
    public function store(Request $request, $slug)
    {
        // Ambil product berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Validasi input multiple rows
        $validated = $request->validate([
            'powers' => 'required|array',
            'powers.*.label' => 'required|string|max:255',
            'powers.*.nilai' => 'required|string|max:255',
        ]);

        // Simpan setiap baris Power
        foreach ($validated['powers'] as $powerData) {
            Power::create([
                'product_id' => $product->id,
                'label' => $powerData['label'],
                'nilai' => $powerData['nilai'],
            ]);
        }

        Alert::success('Success', 'Power berhasil ditambahkan');

        // Redirect kembali ke produk dan buka tab "power"
        return redirect()->route('product.show', $product->slug)->with('tab', 'power');
    }

    public function edit($product_slug, $id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi berdasarkan ID dan pastikan milik produk tersebut
        $powers = Power::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        return view('admin.power.edit', compact('product', 'powers'))->with('tab', 'power');
    }

    public function update(Request $request, $slug, $id)
    {
        // Ambil product berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil data power berdasarkan ID dan product_id
        $power = Power::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'nilai' => 'required|string|max:255',
        ]);

        // Update data
        $power->update([
            'label' => $validated['label'],
            'nilai' => $validated['nilai'],
        ]);

        Alert::success('Success', 'Power berhasil diperbarui');

        // Redirect kembali ke produk dan tetap di tab "power"
        return redirect()->route('product.show', $product->slug)->with('tab', 'power');
    }

    public function destroy($product_slug, $power_id)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil data power berdasarkan ID & pastikan milik produk tersebut
        $powers = Power::where('id', $power_id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Hapus data power
        $powers->delete();

        // Alert sukses
        Alert::success('Success', 'Power berhasil dihapus.');

        // Redirect kembali ke tab power
        return redirect()->route('product.show', $product->slug)->with('tab', 'power');
    }
}
