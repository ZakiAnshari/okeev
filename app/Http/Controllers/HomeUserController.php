<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeUserController extends Controller
{


      public function index()
    {
        // Ambil semua brand unik beserta slug dan image dari tabel Product
        $brands = Product::select('brand', 'slug', 'image')
                        ->orderBy('brand', 'asc')
                        ->get()
                        ->unique('brand') // pastikan hanya satu brand per nama
                        ->values();

        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);

        return view('home.index', compact('brands', 'brandChunks'));
    }


    public function showProfile($slug)
    
    {

            $brands = Product::select('brand', 'slug', 'image')
                        ->orderBy('brand', 'asc')
                        ->get()
                        ->unique('brand') // pastikan hanya satu brand per nama
                        ->values();

        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);
        $user = User::where('slug', $slug)->firstOrFail();

        return view('home.profil', compact('brands', 'brandChunks'));
    }

}
