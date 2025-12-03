<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Testdrive;
use Illuminate\Http\Request;

class TestDriveController extends Controller
{
    public function index()
    {
        // Ambil semua produk
        $product = Product::all();

        // Ambil semua test drive
        $testdrives = Testdrive::all();

        return view('admin.testdrive.index', compact('testdrives', 'product'));
    }

    public function show($id)
    {
        // Ambil data test drive beserta relasi product
        $testdrives = Testdrive::with('product')->findOrFail($id);
        
        return view('admin.testdrive.show', compact('testdrives'));
    }
}
