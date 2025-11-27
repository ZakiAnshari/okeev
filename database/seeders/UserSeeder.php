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
        'name' => 'test',
        'username' => 'admin',
        'contact' => '082202020202',
        'role_id' => 1, // role Admin
        'email' => 'admin@gmail.com',
        'jenis_kelamin' => 'Laki-Laki',
        'email_verified_at' => now(),
        'password' => bcrypt('123'),
        'remember_token' => Str::random(10),
    ]);

    // Buat user biasa
    $user = User::create([
        'name' => 'User Satu',
        'username' => 'user1',
        'contact' => '081234567890',
        'role_id' => 2, // role User
        'email' => 'user@gmail.com',
        'jenis_kelamin' => 'Laki-Laki',
        'email_verified_at' => now(),
        'password' => bcrypt('123'),
        'remember_token' => Str::random(10),
    ]);
}

}
