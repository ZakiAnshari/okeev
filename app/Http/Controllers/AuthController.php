<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerprocess(Request $request)
    {
        try {
            Log::info('Registration process started for email: ' . $request->input('email'));
            
            // Validasi input
            $validated = $request->validate([
                'first_name'    => 'required|string|max:255',
                'second_name'   => 'required|string|max:255',
                'contact'       => 'required|string|max:20|unique:users,contact',
                'email'         => 'required|email|max:255|unique:users,email',
                'city'          => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'password'      => 'required|string|min:6|confirmed',
            ], [
                'first_name.required'   => 'Nama depan harus diisi.',
                'second_name.required'  => 'Nama belakang harus diisi.',
                'contact.required'      => 'Nomor telepon harus diisi.',
                'contact.unique'        => 'Nomor telepon sudah terdaftar.',
                'email.required'        => 'Email harus diisi.',
                'email.email'           => 'Format email tidak valid.',
                'email.unique'          => 'Email sudah terdaftar.',
                'city.required'         => 'Kota harus diisi.',
                'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
                'jenis_kelamin.in'      => 'Nilai jenis kelamin tidak valid.',
                'password.required'     => 'Password harus diisi.',
                'password.min'          => 'Password minimal 6 karakter.',
                'password.confirmed'    => 'Konfirmasi password tidak cocok.',
            ]);

            Log::info('Validation passed', $validated);

            // Buat user baru
            $user = User::create([
                'first_name'    => $validated['first_name'],
                'second_name'   => $validated['second_name'],
                'contact'       => $validated['contact'],
                'email'         => $validated['email'],
                'city'          => $validated['city'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'password'      => Hash::make($validated['password']),
                'role_id'       => 2,
            ]);

            Log::info('User created successfully: ' . $user->id);

            toast('Registrasi Berhasil! Silakan login.', 'success')
                ->position('top-end');

            return redirect()->route('login');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation error:', $e->errors());
            
            toast('⚠️ Validasi gagal! Periksa kembali form Anda.', 'warning')
                ->position('top-end');
                
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            toast('❌ Terjadi kesalahan: ' . $e->getMessage(), 'error')
                ->position('top-end');
                
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
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
