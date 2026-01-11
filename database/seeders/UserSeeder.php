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
        // Buat role Admin dan User
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'User']
        ];

        foreach ($roles as $role) {
            Roles::firstOrCreate(['name' => $role['name']]);
        }

        // Buat user Admin
        $admin = User::create([
            'first_name' => 'Admin Okeev',
            'second_name' => 'admin',
            'contact' => '082202020202',
            'role_id' => 1, // role Admin
            'email' => 'admin@gmail.com',
            'city' => 'Padang Panjang', // ⬅️ tambahan city
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        // Buat user biasa
        $user = User::create([
            'first_name' => 'Fikri Ganteng123',
            'second_name' => 'fikri',
            'contact' => '081234567890',
            'role_id' => 2, // role User
            'email' => 'fikri787@gmail.com',
            'city' => 'Bekasi', // ⬅️ tambahan city
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
