<?php

namespace App\Http\Controllers\Mobile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('mobile.login.index');
    }

    public function mobileauthenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username harus diisi!',
            'password.required' => 'Password harus diisi!',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            alert()->error('Login Gagal', 'Username tidak ditemukan');
            return back()->withInput();
        }

        if (!Auth::attempt($credentials)) {
            alert()->error('Login Gagal', 'Password salah');
            return back()->withInput();
        }

        $request->session()->regenerate();


        // ✅ SATU KALI SAJA
        alert()->success(
            'Login Berhasil',
            'Selamat datang ' . auth()->user()->username . ' di aplikasi Okeev!'
        );

        if ($user->role_id == 2) {
            return redirect()->intended('/m');
        }

        return redirect()->intended('/dashboard');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/m');
    }
}
