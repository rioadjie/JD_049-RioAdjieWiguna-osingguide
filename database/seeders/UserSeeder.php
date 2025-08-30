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
            'email' => 'admin@osingguide.com',
            'password' => Hash::make('admin123!@#'),
            'role' => 'admin',
            'phone' => '+6281234567890'
        ]);

        // Guide
        User::create([
            'name' => 'Rio',
            'email' => 'rio@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guide',
            'phone' => '+6281234567891'
        ]);

        // Customer
        User::create([
            'name' => 'Cutomer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '+6281234567892'
        ]);
    }
}
