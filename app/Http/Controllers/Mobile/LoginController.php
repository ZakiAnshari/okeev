<?php

namespace App\Http\Controllers\Mobile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('mobile.login.index');
    }

    public function mobileauthenticating(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password harus diisi!',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            toast('Email tidak ditemukan', 'error')
                ->position('top-end')
                ->autoClose(3000)
                ->width('fit-content');
            return back()->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            toast('Password salah', 'error')
                ->position('top-end')
                ->autoClose(3000)
                ->width('fit-content');
            return back()->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        toast('Login Berhasil! Selamat datang ' . $user->first_name . ' di aplikasi Okeev!', 'success');

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
