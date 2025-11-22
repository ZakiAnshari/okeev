<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat role Admin dan simpan hasilnya
        $role = Roles::create(['name' => 'Admin']);

        // Buat user Admin
        User::create([
            'name' => 'test',
            'username' => 'admin', // 👈 WAJIB DITAMBAHKAN
            'contact' => '082202020202',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
