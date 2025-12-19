<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiContactController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string',
        ]);

        // Simpan ke database menggunakan mass assignment
        $contact = Contact::create($validated);

        // Pastikan data tersimpan
        if (!$contact) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal menyimpan pesan'
            ], 500);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Pesan berhasil dikirim',
            'data'    => $contact
        ], 201);
    }
}
