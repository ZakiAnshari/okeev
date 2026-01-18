<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->input('q');

        $query = Product::query();

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('model_name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $products = $query->orderBy('model_name')->paginate(12)->appends(['q' => $q]);

        return view('search.results', compact('products', 'q'));
    }
}
