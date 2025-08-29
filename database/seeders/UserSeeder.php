<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // ganti dengan password aman
            'role' => 'admin',
            'phone' => '+6281234567890'
        ]);

        // Guide
        User::create([
            'name' => 'Rovita Mei',
            'email' => 'rovita@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'guide',
            'phone' => '+6281234567891'
        ]);

        // Customer
        User::create([
            'name' => 'Rio Adjie',
            'email' => 'rio@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'customer',
            'phone' => '+6281234567892'
        ]);
    }
}
