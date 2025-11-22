<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing.home');
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
