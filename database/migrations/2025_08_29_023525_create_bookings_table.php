<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Pihak yang terlibat
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('booking_code', 20)->unique();
            $table->foreignId('guide_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('guide_profile_id')->constrained('guide_profiles')->onDelete('cascade');

            // Detail perjalanan
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('total_days'); // dihitung otomatis: (end - start) + 1
            $table->integer('number_of_travelers'); // jumlah wisatawan
            $table->text('destination'); // lokasi wisata
            $table->text('notes')->nullable(); // permintaan khusus dari customer

            // Status pemesanan
            $table->string('status')->default('pending');
            // nilai: pending, confirmed, ongoing, completed, cancelled

            // Harga & komisi
            $table->decimal('guide_daily_rate', 10, 2); // tarif harian guide (saat booking)
            $table->decimal('sub_total', 10, 2); // daily_rate × total_days
            $table->decimal('platform_fee', 10, 2); // komisi platform
            $table->decimal('total_price', 10, 2); // sub_total + platform_fee

            // Info komisi (untuk tracking)
            $table->string('fee_type')->default('percentage'); // percentage / fixed
            $table->decimal('fee_value', 8, 2); // 15.00 (15%) atau 100000 (fixed)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
