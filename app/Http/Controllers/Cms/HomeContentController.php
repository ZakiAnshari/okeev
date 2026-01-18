<?php

namespace App\Http\Controllers\Cms;

use App\Models\HomeContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    public function index()
    {
        $content = HomeContent::first();
        return view('admin.cms.home.content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'position' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'why_titles' => 'nullable|array',
            'why_descriptions' => 'nullable|array',
            'collaboration_customer' => 'nullable|string',
            'collaboration_happy' => 'nullable|string'
        ]);

        $content = HomeContent::first();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('home_contents', 'public');
            $data['image'] = $path;
            if ($content && $content->image) {
                Storage::disk('public')->delete($content->image);
            }
        }

        // Normalize is_active (checkbox may be absent)
        $data['is_active'] = $request->has('is_active') ? (bool)$request->input('is_active') : false;

        if (! $content) {
            // Map arrays to JSON fields
            $data['why_items'] = [];
            if (!empty($request->input('why_titles'))) {
                $titles = $request->input('why_titles');
                $descs = $request->input('why_descriptions', []);
                foreach ($titles as $i => $t) {
                    $data['why_items'][] = [
                        'title' => $t,
                        'description' => $descs[$i] ?? null,
                    ];
                }
            }

            $data['collaboration'] = [
                'customer' => $request->input('collaboration_customer'),
                'happy' => $request->input('collaboration_happy')
            ];

            HomeContent::create($data);
        } else {
            // Map arrays to JSON fields for update
            $data['why_items'] = $content->why_items ?? [];
            if (!empty($request->input('why_titles'))) {
                $titles = $request->input('why_titles');
                $descs = $request->input('why_descriptions', []);
                $items = [];
                foreach ($titles as $i => $t) {
                    $items[] = [
                        'title' => $t,
                        'description' => $descs[$i] ?? null,
                    ];
                }
                $data['why_items'] = $items;
            }

            $data['collaboration'] = [
                'customer' => $request->input('collaboration_customer', $content->collaboration['customer'] ?? null),
                'happy' => $request->input('collaboration_happy', $content->collaboration['happy'] ?? null)
            ];

            $content->fill($data);
            $content->save();
        }

        Alert::success('Success', 'Home content berhasil diupdate');
        return redirect()->back();
    }
}
