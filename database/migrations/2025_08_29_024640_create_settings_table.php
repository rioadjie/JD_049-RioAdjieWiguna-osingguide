<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // misal: platform_fee_type
            $table->string('value');        // misal: percentage
            $table->timestamps();
        });

        // Insert default komisi: 15% dari total
        DB::table('settings')->insert([
            ['key' => 'platform_fee_type', 'value' => 'percentage'],
            ['key' => 'platform_fee_value', 'value' => '15'],
            ['key' => 'currency', 'value' => 'IDR'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
