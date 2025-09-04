<?php

namespace Database\Seeders;

use App\Models\PromoCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PromoCode::create([
            'code' => 'WELCOME10',
            'name' => 'Welcome Discount 10%',
            'description' => 'Diskon 10% untuk pelanggan baru',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'minimum_amount' => 500000,
            'maximum_discount' => 100000,
            'usage_limit' => 50,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'is_active' => true,
        ]);

        PromoCode::create([
            'code' => 'FLAT50K',
            'name' => 'Flat Discount Rp50.000',
            'description' => 'Potongan langsung Rp50.000 untuk pembelian minimal Rp500.000',
            'discount_type' => 'fixed',
            'discount_value' => 50000,
            'minimum_amount' => 500000,
            'maximum_discount' => null,
            'usage_limit' => 30,
            'start_date' => now(),
            'end_date' => now()->addMonths(2),
            'is_active' => true,
        ]);

        PromoCode::create([
            'code' => 'SUMMER20',
            'name' => 'Summer Special 20%',
            'description' => 'Diskon musim panas 20% untuk semua paket wisata',
            'discount_type' => 'percentage',
            'discount_value' => 20,
            'minimum_amount' => 1000000,
            'maximum_discount' => 200000,
            'usage_limit' => 20,
            'start_date' => now(),
            'end_date' => now()->addMonths(1),
            'is_active' => true,
        ]);

        PromoCode::create([
            'code' => 'FIRST25',
            'name' => 'First Booking 25%',
            'description' => 'Diskon 25% untuk booking pertama',
            'discount_type' => 'percentage',
            'discount_value' => 25,
            'minimum_amount' => 300000,
            'maximum_discount' => 150000,
            'usage_limit' => 100,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'is_active' => true,
        ]);
    }
}
