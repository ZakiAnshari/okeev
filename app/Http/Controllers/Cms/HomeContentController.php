<?php

namespace App\Http\Controllers\Cms;

use App\Models\HomeContent;
use App\Models\HomeTestimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    public function index()
    {
        $content = HomeContent::first();
        $testimonials = HomeTestimonial::latest()->get();
        return view('admin.cms.home.content.index', compact('content', 'testimonials'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string',

            'why_title_1' => 'nullable|string|max:255',
            'why_description_1' => 'nullable|string',

            'why_title_2' => 'nullable|string|max:255',
            'why_description_2' => 'nullable|string',

            'why_title_3' => 'nullable|string|max:255',
            'why_description_3' => 'nullable|string',

            'collaboration_customer' => 'nullable|string|max:255',
            'collaboration_customer_happy' => 'nullable|string|max:255',

            'is_active' => 'nullable|boolean',
        ]);

        $content = HomeContent::first();

        // Normalize is_active (checkbox may be absent)
        $data['is_active'] = $request->has('is_active') ? (bool)$request->input('is_active') : true;

        if (! $content) {
            HomeContent::create($data);
        } else {
            $content->fill($data);
            $content->save();
        }

        Alert::success('Success', 'Home content berhasil diupdate');
        return redirect()->back();
    }
}
