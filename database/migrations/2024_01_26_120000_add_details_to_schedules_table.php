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
        Schema::table('schedules', function (Blueprint $table) {
            $table->longText('description')->nullable()->after('status');
            $table->text('hotel_makkah')->nullable()->after('description');
            $table->text('hotel_madinah')->nullable()->after('hotel_makkah');
            $table->longText('itinerary')->nullable()->after('hotel_madinah'); // JSON or Formatted Text
            $table->longText('features')->nullable()->after('itinerary'); // For Amenities/Facilities
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'hotel_makkah',
                'hotel_madinah',
                'itinerary',
                'features'
            ]);
        });
    }
};
