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
        Schema::table('jamaah', function (Blueprint $table) {
            // Ubah NIK dari VARCHAR(16) menjadi VARCHAR(50)
            // Agar bisa menampung temporary NIK seperti "TEMP-3-1-6963df0bbb490"
            $table->string('nik', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jamaah', function (Blueprint $table) {
            // Kembalikan ke ukuran semula jika rollback
            $table->string('nik', 16)->nullable()->change();
        });
    }
};