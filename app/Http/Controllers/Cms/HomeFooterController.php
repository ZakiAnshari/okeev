<?php

namespace App\Http\Controllers\Cms;

use App\Models\HomeFooter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class HomeFooterController extends Controller
{
    public function index()
    {
        $footer = HomeFooter::first();
        return view('admin.cms.home.footer.index', compact('footer'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'description' => 'nullable|string',
            'email' => 'nullable|email',
            'handphone' => 'nullable|string',
            'lokasi' => 'nullable|string',
        ]);

        $footer = HomeFooter::first();
        if (! $footer) {
            $footer = HomeFooter::create($data);
        } else {
            $footer->fill($data);
            $footer->save();
        }
        // Alert sukses
        Alert::success('Success', 'Footer berhasil diupdate');

        return redirect()->back()->with('success', 'Footer updated successfully.');
    }
}
