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
            // Check and add price_triple if missing
            if (!Schema::hasColumn('schedules', 'price_triple')) {
                $table->decimal('price_triple', 15, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('schedules', 'price_double')) {
                $table->decimal('price_double', 15, 2)->nullable()->after('price_triple');
            }
            if (!Schema::hasColumn('schedules', 'price_child')) {
                $table->decimal('price_child', 15, 2)->nullable()->after('price_double');
            }
            
            // Check features/excludes just in case
            if (!Schema::hasColumn('schedules', 'excludes')) {
                $table->text('excludes')->nullable()->after('features');
            }
            if (!Schema::hasColumn('schedules', 'itinerary_pdf')) {
                $table->string('itinerary_pdf')->nullable()->after('itinerary');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No down needed as this is a fix
    }
};
