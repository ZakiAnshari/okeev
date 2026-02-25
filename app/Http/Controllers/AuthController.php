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
        \Log::info('Register request received', [
            'all' => $request->all(),
            'method' => $request->method(),
        ]);
        
        try {
            // Validasi input
            $validated = $request->validate([
                'first_name'        => 'required|string|max:255',
                'second_name'       => 'required|string|max:255',
                'contact'           => 'required|string|max:20|unique:users,contact',
                'email'             => 'required|email|max:255|unique:users,email',
                'city'              => 'required|string|max:255',
                'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
                'password'          => 'required|string|min:6|confirmed',
            ], [
                'first_name.required' => 'Nama depan harus diisi.',
                'second_name.required' => 'Nama belakang harus diisi.',
                'contact.required' => 'Nomor telepon harus diisi.',
                'contact.unique' => 'Nomor telepon sudah terdaftar.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'city.required' => 'Kota harus diisi.',
                'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal 6 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
            ]);

            \Log::info('Validation passed', $validated);

            // Hash password
            $validated['password'] = Hash::make($validated['password']);
            $validated['role_id'] = 2;

            \Log::info('Creating user with data', $validated);

            // Create user
            $user = User::create($validated);

            \Log::info('User created successfully', ['id' => $user->id, 'email' => $user->email]);

            if (!$user || !$user->id) {
                throw new \Exception('Gagal menyimpan data user ke database');
            }

            // Success message dan redirect ke login
            return redirect()->route('login')->with('success', 'Registrasi Berhasil! Silakan login');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('Validation failed', $e->errors());
            return back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $e) {
            \Log::error('Register error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Error: ' . $e->getMessage()])->withInput();
        }
    }

    public function login()
    {
        return view('login');
    }

    public function authenticating(Request $request)
    {
        // Validasi input email & password
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password harus diisi!',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            toast('Email tidak ditemukan', 'error')
                ->position('top-end')
                ->autoClose(3000)
                ->width('fit-content');
            return back()->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            toast('Password salah', 'error')
                ->position('top-end')
                ->autoClose(3000)
                ->width('fit-content');
            return back()->withInput();
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        alert()->success('Berhasil Login', 'Selamat datang di Okeev');

        // Redirect ke intended URL jika ada
        $intendedUrl = redirect()->intended()->getTargetUrl();
        if ($intendedUrl && !str_contains($intendedUrl, '/login')) {
            return redirect()->to($intendedUrl);
        }

        // Redirect berdasarkan role
        switch ($user->role_id) {
            case 2:
                return redirect('/home');

            case 1:
            default:
                return redirect('/dashboard');
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
