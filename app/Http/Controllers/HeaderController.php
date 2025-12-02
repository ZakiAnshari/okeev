<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function getHeaderData()
    {
        // Ambil brand yang hanya category_id = 1
        $brands = Brand::where('category_id', 1)
            ->orderBy('name_brand', 'asc')
            ->get();

        // Bagi menjadi chunk 4 untuk grid
        $brandChunks = $brands->chunk(4);

        // Kirim ke view
        return view('layout.partials.header', compact('brandChunks'));
    }
}
