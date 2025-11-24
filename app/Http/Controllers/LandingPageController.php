<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('name_brand')->get();
        $brandChunks = $brands->chunk(4); // 4 item per kolom

        return view('landing.home', compact('brands', 'brandChunks'));
    }

    public function wuling()
    {
        return view('landing.wuling');
    }

    public function detailwuling()
    {
        return view('landing.detailwuling');
    }

    public function testdrive()
    {
        return view('landing.testdrive');
    }

    public function cart()
    {
        return view('landing.cart');
    }

    public function contact()
    {
        return view('landing.contact');
    }
}
