<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerprocess(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'contact'       => 'required|string|max:20',
            'email'         => 'required|email|max:255|unique:users,email',
            'jenis_kelamin' => 'required',
            'password'      => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role_id'] = 2;

        User::create($validated);

        alert()->success('Registrasi Berhasil', 'Silakan login');
        return redirect()->route('login');
    }

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
        switch ($user->role_id) {
            case 2:
                // Role 2 → ke /home
                return redirect()->intended('/home');

            case 1:
            default:
                // Role 1 atau role tidak dikenal → ke /dashboard
                return redirect()->intended('/dashboard');
        }
    }


    // LOGOUT ADMIN
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
