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
            // Tracking completion per jamaah
            $table->enum('completion_status', ['empty', 'partial', 'complete'])
                  ->default('empty')
                  ->after('document_status')
                  ->comment('Status kelengkapan data');
            
            $table->timestamp('profile_completed_at')
                  ->nullable()
                  ->after('completion_status')
                  ->comment('Kapan data profil lengkap');
            
            $table->timestamp('documents_completed_at')
                  ->nullable()
                  ->after('profile_completed_at')
                  ->comment('Kapan semua dokumen terupload');
            
            // Ubah beberapa field jadi nullable (karena akan diisi bertahap)
            $table->string('nik', 16)->nullable()->change();
            $table->string('birth_place', 100)->nullable()->change();
            $table->date('birth_date')->nullable()->change();
            $table->string('father_name', 255)->nullable()->change();
            $table->string('occupation', 100)->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->string('emergency_name', 255)->nullable()->change();
            $table->string('emergency_relation', 50)->nullable()->change();
            $table->string('emergency_phone', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jamaah', function (Blueprint $table) {
            $table->dropColumn([
                'completion_status',
                'profile_completed_at',
                'documents_completed_at'
            ]);
            
            // Rollback nullable (sesuaikan dengan migration asli Anda)
            // Contoh:
            // $table->string('nik', 16)->nullable(false)->change();
        });
    }
};