<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show()
    {
        // Ambil kategori dengan category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori dengan category_position_id = 2 (misal untuk Electric Motorcycles)
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori khusus category_position_id = 3 dan 4 beserta brand-nya
        $categoriesPosition3 = Category::with('brands')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('name_category', 'asc')
            ->get();

        return view('landing.order.show', compact(
            'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3',
        ));
    }
}
