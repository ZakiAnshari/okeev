<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Testdrive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DriveController extends Controller
{
    public function index($productSlug)
    {
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get();

        $product = Product::where('slug', $productSlug)->firstOrFail();

        $testdrives = Testdrive::all();

        return view('mobile.drive.index', compact('testdrives', 'product', 'brands'));
    }

    public function store(Request $request, $productSlug)
    {
        // Ambil produk
        $product = Product::where('slug', $productSlug)->firstOrFail();

        // Validasi data
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'second_name'  => 'required|string|max:255',
            'telp'         => 'required|string|max:20',
            'email'        => 'required|email|max:255',
            'city'         => 'required|string|max:255',
            'dealer'       => 'required|string|max:255',
        ]);

        // ==========================
        // Cek duplikasi
        // ==========================
        $exists = Testdrive::where('first_name', $validated['first_name'])
            ->where('telp', $validated['telp'])
            ->where('email', $validated['email'])
            ->exists();

        if ($exists) {
            Alert::info('Sudah Terdaftar', 'Permintaan test drive Anda sebelumnya sudah tercatat. Silakan menunggu konfirmasi melalui email.');
            return back()->withInput();
        }


        // Simpan data
        Testdrive::create([
            'product_id'   => $product->id,
            'first_name'   => $validated['first_name'],
            'second_name'  => $validated['second_name'],
            'telp'         => $validated['telp'],
            'email'        => $validated['email'],
            'city'         => $validated['city'],
            'dealer'       => $validated['dealer'],
        ]);

        Alert::success('Success', 'Permintaan test drive berhasil dikirim!');
        return back();
    }
}
