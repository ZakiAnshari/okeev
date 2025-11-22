<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticating(Request $request)
    {
        // Validasi input username dan password
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ], [
            'username.required' => 'Username harus diisi!',
            'password.required' => 'Password harus diisi!',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            toast('Username tidak ditemukan', 'error')
                ->position('top-end')->autoClose(3000)->width('fit-content');
            return back()->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            toast('Password salah', 'error')
                ->position('top-end')->autoClose(3000)->width('fit-content');
            return back()->withInput();
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();
        alert()->success('Berhasil Login', 'Selamat datang di Okeev');
        // Arahkan sesuai role_id
        if ($user->role_id == 3) {
            return redirect()->intended('dashboardpinjam');
        }

        return redirect()->intended('dashboard');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
