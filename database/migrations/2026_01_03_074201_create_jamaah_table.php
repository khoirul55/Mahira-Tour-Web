<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jamaah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');
            
            // Biodata
            $table->string('title', 10);
            $table->string('full_name');
            $table->string('nik', 16)->nullable();
            $table->string('birth_place', 100);
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->string('father_name');
            $table->string('occupation', 100);
            $table->string('blood_type', 5)->nullable();
            
            // Alamat
            $table->text('address');
            $table->string('province', 100)->nullable();
            $table->string('city', 100)->nullable();
            
            // Kontak Darurat
            $table->string('emergency_name')->nullable();
            $table->string('emergency_relation', 50)->nullable();
            $table->string('emergency_phone', 20)->nullable();
            
            // Passport (Diisi admin setelah dibuat)
            $table->string('passport_number', 20)->nullable();
            $table->date('passport_issued_at')->nullable();
            $table->date('passport_expired_at')->nullable();
            
            // Status
            $table->enum('document_status', ['incomplete', 'complete', 'verified'])->default('incomplete');
            
            $table->timestamps();
            
            // Indexes
            $table->index('registration_id');
            $table->index('nik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jamaah');
    }
};