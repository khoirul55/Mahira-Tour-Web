<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan: php artisan migrate
     * 
     * Fix: Foreign key verified_by seharusnya ke tabel admins, bukan users
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop foreign key lama (ke users)
            $table->dropForeign(['verified_by']);
            
            // Buat foreign key baru ke admins (nullable)
            $table->foreign('verified_by')
                  ->references('id')
                  ->on('admins')
                  ->onDelete('set null');
        });
        
        // Sama untuk documents jika ada
        if (Schema::hasColumn('documents', 'verified_by')) {
            Schema::table('documents', function (Blueprint $table) {
                try {
                    $table->dropForeign(['verified_by']);
                } catch (\Exception $e) {
                    // Ignore if not exists
                }
                
                $table->foreign('verified_by')
                      ->references('id')
                      ->on('admins')
                      ->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->foreign('verified_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }
};