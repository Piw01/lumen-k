<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Super Admin
        User::create([
            'name' => 'Lumen Super Admin',
            'email' => 'admin@lumen.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        // 2. Akun Staf (Kasir/Penjaga Toko)
        User::create([
            'name' => 'Staf Lumen',
            'email' => 'staf@lumen.com',
            'password' => Hash::make('password123'),
            'role' => 'staf',
        ]);

        // 3. Akun Customer (Pelanggan Pertama)
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'customer@mail.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);
    }
}