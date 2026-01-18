<?php

namespace App\Http\Controllers\Cms;

use App\Models\HomeAbout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class HomeAboutController extends Controller
{
    public function index()
    {
        $about = HomeAbout::first();
        return view('admin.cms.home.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'section_label' => 'nullable|string',
            'title_main' => 'nullable|string',
            'description_main' => 'nullable|string',
            'tagline' => 'nullable|string',
            'description_second' => 'nullable|string',
            'visi_description' => 'nullable|string',
            'visi_image' => 'nullable|image|max:2048',
            'misi_image' => 'nullable|image|max:2048',
            'title_1' => 'nullable|string',
            'title_2' => 'nullable|string',
            'title_3' => 'nullable|string',
            'title_4' => 'nullable|string',
            'fourth_title_1' => 'nullable|string',
            'fourth_title_2' => 'nullable|string',
            'fourth_title_3' => 'nullable|string',
            'support_service_1' => 'nullable|string',
            'support_service_2' => 'nullable|string',
            'support_service_3' => 'nullable|string',
            'support_service_4' => 'nullable|string',
        ]);

        $about = HomeAbout::first();

        // Handle visi image upload
        if ($request->hasFile('visi_image')) {
            $file = $request->file('visi_image');
            $path = $file->store('abouts', 'public');
            $data['visi_image'] = $path;
            if ($about && $about->visi_image) {
                Storage::disk('public')->delete($about->visi_image);
            }
        }

        // Handle misi image upload
        if ($request->hasFile('misi_image')) {
            $file = $request->file('misi_image');
            $path = $file->store('abouts', 'public');
            $data['misi_image'] = $path;
            if ($about && $about->misi_image) {
                Storage::disk('public')->delete($about->misi_image);
            }
        }

        if (! $about) {
            HomeAbout::create($data);
        } else {
            $about->fill($data);
            $about->save();
        }

        Alert::success('Success', 'About berhasil diupdate');
        return redirect()->back();
    }
}
