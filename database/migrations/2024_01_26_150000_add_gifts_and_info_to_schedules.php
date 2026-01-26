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
            if (!Schema::hasColumn('schedules', 'gifts')) {
                $table->text('gifts')->nullable()->after('excludes');
            }
            if (!Schema::hasColumn('schedules', 'additional_info')) {
                $table->text('additional_info')->nullable()->after('gifts');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['gifts', 'additional_info']);
        });
    }
};
