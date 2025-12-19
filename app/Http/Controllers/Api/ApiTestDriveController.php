<?php

namespace App\Http\Controllers\Api;

use App\Models\Testdrive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiTestDriveController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'first_name' => 'required|string|max:100',
            'second_name' => 'required|string|max:100',
            'telp'       => 'required|string|max:20',
            'email'      => 'required|email|max:100',
            'city'       => 'nullable|string|max:50',
            'dealer'     => 'nullable|string|max:100',
            'status'     => 'nullable|string|max:50',
        ]);

        // Simpan ke database
        $testdrive = Testdrive::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Data test drive berhasil dikirim',
            'data'    => $testdrive
        ], 201);
    }
}
