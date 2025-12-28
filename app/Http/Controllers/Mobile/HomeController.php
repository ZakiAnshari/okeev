<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('mobile.home', compact('brands'));
    }


    public function showcard()
    {
        return view('mobile.brand.show');
    }
}
