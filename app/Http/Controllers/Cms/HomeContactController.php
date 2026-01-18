<?php

namespace App\Http\Controllers\Cms;

use App\Models\HomeContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class HomeContactController extends Controller
{
    public function index()
    {
        $contact = HomeContact::first();
        return view('admin.cms.home.contact.index', compact('contact'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'description' => 'nullable|string',
            'instagram' => 'nullable|string',
            'tiktok' => 'nullable|string',
            'x' => 'nullable|string',
        ]);

        $contact = HomeContact::first();
        if (! $contact) {
            $contact = HomeContact::create($data);
        } else {
            $contact->fill($data);
            $contact->save();
        }

        Alert::success('Success', 'Contact berhasil diupdate');
        return redirect()->back();
    }
}
