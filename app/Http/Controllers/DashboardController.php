<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = Category::count();
        $brandCount = Brand::count();
        $productCount = Product::count();
        $userCount = User::count();

        return view('admin.dashboard.index',[
            'category_count' => $categoryCount,
            'brand_count' => $brandCount,
            'product_count' => $productCount,
            'user_count' => $userCount,
        ]);
    }
}
