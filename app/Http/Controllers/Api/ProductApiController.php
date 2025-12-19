<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::select(
            'category_id',
            'category_position_id',
            'brand_id',
            'model_name',
            'slug',
            'miles',
            'seats',
            'price',
            'stock_status',
            'featured',
            'description',
            'thumbnail'
        )->latest()->get();

        return response()->json([
            'status'  => true,
            'message' => $products->isEmpty()
                ? 'Data produk belum tersedia'
                : 'Data produk berhasil diambil',
            'data' => $products
        ]);
    }


    // DETAIL PRODUK LENGKAP
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with([
                'technologies',
                'features',
                'colors',
                'specifications',
                'powers',
                'dimensis',
                'suspensis',
                'fiturs',
                'details'
            ])
            ->firstOrFail();

        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }

    // ===== OPTIONAL SUB ENDPOINT =====
    public function technologies($slug)
    {
        return $this->singleRelation($slug, 'technologies');
    }

    public function features($slug)
    {
        return $this->singleRelation($slug, 'features');
    }

    public function colors($slug)
    {
        return $this->singleRelation($slug, 'colors');
    }

    public function specifications($slug)
    {
        return $this->singleRelation($slug, 'specifications');
    }

    public function powers($slug)
    {
        return $this->singleRelation($slug, 'powers');
    }

    public function dimensis($slug)
    {
        return $this->singleRelation($slug, 'dimensis');
    }

    public function suspensis($slug)
    {
        return $this->singleRelation($slug, 'suspensis');
    }

    public function fiturs($slug)
    {
        return $this->singleRelation($slug, 'fiturs');
    }

    public function details($slug)
    {
        return $this->singleRelation($slug, 'details');
    }

    private function singleRelation($slug, $relation)
    {
        $product = Product::where('slug', $slug)
            ->with($relation)
            ->firstOrFail();

        return response()->json([
            'status' => true,
            'data' => $product->$relation
        ]);
    }
}
