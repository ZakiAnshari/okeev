<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiNewsController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => News::latest()->get()
        ]);
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->first();

        if (! $news) {
            return response()->json([
                'status' => false,
                'message' => 'Berita tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $news
        ]);
    }
}
