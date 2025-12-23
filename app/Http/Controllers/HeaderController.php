<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function getHeaderData()
    {
        
        $brands = Brand::where('category_id', 1)
            ->orderBy('name_brand', 'asc')
            ->get();

        $brandChunks = $brands->chunk(4);
        return view('layout.partials.header', compact('brandChunks'));
    }
}
