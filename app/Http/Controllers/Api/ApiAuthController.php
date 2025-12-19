<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'user_token' => 'required|string'
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        // HAPUS SEMUA TOKEN LAMA
        $user->tokens()->delete();

        // BUAT TOKEN BARU
        $token = $user->createToken($request->user_token)->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user(); // user yang sedang login

        // hapus token yang sedang dipakai
        $user->currentAccessToken()->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Logout berhasil',
            'name'    => $user->name
        ]);
    }
}
