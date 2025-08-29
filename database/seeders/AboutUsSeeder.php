<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'logo' => 'osingguide-logo.svg',
            'description' => 'OsingGuide is for you to make your travel more easier with our guide.',
        ]);
    }
}
