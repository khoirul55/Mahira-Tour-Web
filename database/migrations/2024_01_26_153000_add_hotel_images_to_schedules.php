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
            if (!Schema::hasColumn('schedules', 'hotel_makkah_image')) {
                $table->string('hotel_makkah_image')->nullable()->after('hotel_makkah');
            }
            if (!Schema::hasColumn('schedules', 'hotel_madinah_image')) {
                $table->string('hotel_madinah_image')->nullable()->after('hotel_madinah');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['hotel_makkah_image', 'hotel_madinah_image']);
        });
    }
};
