<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Models\HomeHeroSlider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class HomeHeroSliderController extends Controller
{
    public function index()
    {
        $sliders = HomeHeroSlider::orderBy('position')->get();
        return view('admin.cms.home.hero.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5 MB
            'position'  => 'required|integer|min:1',
            'is_active' => 'required|in:0,1',
        ]);

        DB::transaction(function () use ($request) {
            $count = HomeHeroSlider::count();
            $pos = (int) $request->input('position', $count + 1);
            $pos = max(1, min($pos, $count + 1));

            HomeHeroSlider::where('position', '>=', $pos)->increment('position');

            $path = $request->file('image')->store('hero', 'public');

            HomeHeroSlider::create([
                'image'     => $path,
                'position'  => $pos,
                'is_active' => $request->input('is_active', 1),
            ]);
        });

        Alert::success('Success', 'Hero berhasil ditambahkan');
        return redirect()->route('cms.home.hero.index');
    }


    public function update(Request $request, $id)
    {
        $slider = HomeHeroSlider::findOrFail($id);

        // Quick toggle for is_active
        if ($request->has('is_active') && !$request->has('position') && !$request->hasFile('image')) {
            $slider->is_active = $request->input('is_active');
            $slider->save();
            return redirect()->route('cms.home.hero.index')->with('success', 'Status diperbarui.');
        }

        $request->validate([
            'position' => 'sometimes|integer|min:1',
            'image' => 'sometimes|image|max:2048',
            'is_active' => 'sometimes|in:0,1',
        ]);

        DB::transaction(function () use ($request, $slider) {
            if ($request->filled('position')) {
                $newPos = (int) $request->input('position');
                $old = $slider->position;
                $max = HomeHeroSlider::count();
                $newPos = max(1, min($newPos, $max));

                if ($newPos < $old) {
                    HomeHeroSlider::whereBetween('position', [$newPos, $old - 1])->increment('position');
                } elseif ($newPos > $old) {
                    HomeHeroSlider::whereBetween('position', [$old + 1, $newPos])->decrement('position');
                }

                $slider->position = $newPos;
            }

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('hero', 'public');
                if ($slider->image) {
                    Storage::disk('public')->delete($slider->image);
                }
                $slider->image = $path;
            }

            if ($request->has('is_active')) {
                $slider->is_active = $request->input('is_active');
            }

            $slider->save();
        });

        return redirect()->route('cms.home.hero.index')->with('success', 'Hero diperbarui.');
    }

    public function destroy($id)
    {

        $slider = HomeHeroSlider::where('id', $id)->first();
        $slider->delete();

        Alert::success('Success', 'Data berhasil di Hapus');
        return redirect()->route('cms.home.hero.index');
    }
}
