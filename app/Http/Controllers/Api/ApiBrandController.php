<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::query()
            ->select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Daftar brand berhasil diambil',
            'data'    => $brands
        ], 200);
    }

    public function byCategory($category_id)
    {
        $brands = Brand::query()
            ->select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->where('category_id', $category_id)
            ->orderBy('name_brand', 'asc')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Daftar brand berdasarkan kategori',
            'data'    => $brands
        ], 200);
    }
}
