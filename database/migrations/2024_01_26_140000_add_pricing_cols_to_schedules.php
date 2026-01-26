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
            // Adding specific pricing columns. 
            // 'price' column will continue to serve as the Base/Quad price (Starting From)
            $table->decimal('price_triple', 15, 2)->nullable()->after('price');
            $table->decimal('price_double', 15, 2)->nullable()->after('price_triple');
            $table->decimal('price_child', 15, 2)->nullable()->after('price_double');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['price_triple', 'price_double', 'price_child']);
        });
    }
};
