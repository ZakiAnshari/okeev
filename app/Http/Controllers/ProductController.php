<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $brands = Brand::orderBy('name_brand', 'asc')->get(); // ambil semua brand
        // Ambil input pencarian & jumlah item per halaman
        $search = $request->input('search');
        $paginate = $request->input('itemsPerPage', 5); // default 5

        // Query awal: sort terbaru di atas
        $query = Product::orderBy('created_at', 'desc');

        // Pencarian berdasarkan name_category dan slug
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('model_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('slug', 'LIKE', '%' . $search . '%');
            });
        }

        // Eksekusi query + paginasi
        $products = $query->paginate($paginate)->withQueryString();

        return view('admin.product.index', compact('user', 'products', 'brands'));
    }
}
