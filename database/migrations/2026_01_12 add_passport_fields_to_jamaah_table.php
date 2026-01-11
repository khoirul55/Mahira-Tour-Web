<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Jalankan: php artisan migrate
     */
    public function up(): void
    {
        Schema::table('jamaah', function (Blueprint $table) {
            // Passport request fields
            $table->boolean('need_passport')->default(false)->after('completion_status');
            $table->timestamp('passport_request_at')->nullable()->after('need_passport');
            $table->boolean('passport_processed')->default(false)->after('passport_request_at');
            $table->timestamp('passport_processed_at')->nullable()->after('passport_processed');
            $table->unsignedBigInteger('passport_processed_by')->nullable()->after('passport_processed_at');
            $table->text('passport_notes')->nullable()->after('passport_processed_by');
            
            // Index for faster queries
            $table->index('need_passport');
            $table->index('passport_processed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jamaah', function (Blueprint $table) {
            $table->dropIndex(['need_passport']);
            $table->dropIndex(['passport_processed']);
            
            $table->dropColumn([
                'need_passport',
                'passport_request_at',
                'passport_processed',
                'passport_processed_at',
                'passport_processed_by',
                'passport_notes'
            ]);
        });
    }
};