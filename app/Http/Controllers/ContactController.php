<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function index()
    {
        // Ambil semua data kontak (urutan terbaru)
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        // Kirim ke view
        return view('admin.contact.index', compact('contacts'));
    }

    public function destroy($id)
    {
        $contacts = Contact::where('id', $id)->firstOrFail();
        $contacts->delete();

        Alert::success('Success', 'Data berhasil di Hapus');
        return redirect()->route('Contact.index');
    }

    public function show($id)
    {
        $contacts = Contact::findOrFail($id);
        return view('admin.contact.show', compact('contacts'));
    }
}
