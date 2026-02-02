<?php

namespace App\Http\Controllers\Mobile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('mobile.register.index');
    }

    public function registerprocess(Request $request)
    {
        $validated = $request->validate([
            'first_name'          => 'required|string|max:255',
            'second_name'         => 'required|string|max:255|unique:users,second_name',
            'phone'               => 'required|string|max:20',
            'email'               => 'required|email|max:255|unique:users,email',
            'gender'              => 'required',
            'password'            => 'required|string|min:6|confirmed',
            'city'                => 'required|string|max:255',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role_id'] = 2;
        $validated['contact'] = $validated['phone'];
        unset($validated['phone']);
        $validated['jenis_kelamin'] = $validated['gender'];
        unset($validated['gender']);

        User::create($validated);

        toast('Registrasi Berhasil! Silakan login','success');
        return redirect()->route('login.index');
    }
}
