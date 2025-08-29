<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'no_telp' => '+628123456789',
            'email' => 'osingguide@gmail.com',
            'address' => 'Banyuwangi',
        ]);
    }
}
