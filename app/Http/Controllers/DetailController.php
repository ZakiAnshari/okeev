<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DetailController extends Controller
{
    public function store(Request $request, $slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'nilai' => 'required|string', // tidak batasi panjang karena bisa HTML
        ]);

        // Simpan data Detail
        Detail::create([
            'product_id' => $product->id,
            'label'      => $validated['label'],
            'nilai'      => $validated['nilai'],
        ]);

        Alert::success('Success', 'Detail berhasil ditambahkan');

        // Redirect kembali ke produk dan tetap di tab "detail"
        return redirect()->route('product.show', $product->slug)->with('tab', 'detail');
    }

    public function edit($product_slug, $id)
    {
        // Ambil produk
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil teknologi berdasarkan ID dan pastikan milik produk tersebut
        $details = Detail::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        return view('admin.detail.edit', compact('product', 'details'))->with('tab', 'detail');
    }

    public function update(Request $request, $slug, $id)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Ambil data Detail berdasarkan ID dan product_id
        $detail = Detail::where('id', $id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'nilai' => 'required|string', // HTML dari CKEditor
        ]);

        // Update data
        $detail->update([
            'label' => $validated['label'],
            'nilai' => $validated['nilai'],
        ]);

        Alert::success('Success', 'Detail berhasil diperbarui');

        // Redirect kembali ke produk dan tetap di tab "detail"
        return redirect()->route('product.show', $product->slug)->with('tab', 'detail');
    }

    public function destroy($product_slug, $detail_id)
    {
        // Ambil produk berdasarkan slug
        $product = Product::where('slug', $product_slug)->firstOrFail();

        // Ambil data Dimensi berdasarkan ID & pastikan milik produk tersebut
        $detail = Detail::where('id', $detail_id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Hapus data detail
        $detail->delete();

        // Alert sukses
        Alert::success('Success', 'Detail berhasil dihapus.');

        // Redirect kembali ke tab detail
        return redirect()->route('product.show', $product->slug)->with('tab', 'detail');
    }
}
