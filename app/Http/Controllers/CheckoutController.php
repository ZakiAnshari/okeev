<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show()
    {
        // Ambil item cart berdasarkan user dan cart id
        

        // Ambil kategori & brand seperti biasa
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        $categoriesPosition3 = Category::with('brands')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('name_category', 'asc')
            ->get();

        return view('landing.checkout.show', [
          
            'categoriesPosition1' => $categoriesPosition1,
            'categoriesPosition2' => $categoriesPosition2,
            'categoriesPosition3' => $categoriesPosition3,
        ]);
    }
}
