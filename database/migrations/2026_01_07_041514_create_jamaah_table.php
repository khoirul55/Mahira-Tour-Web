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
            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->string('title', 10);
            $table->string('full_name');
            $table->string('nik', 16)->unique();
            $table->string('birth_place', 100);
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->string('father_name');
            $table->string('occupation', 100);
            $table->string('blood_type', 5)->nullable();
            $table->text('address');
            $table->string('province', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('emergency_name');
            $table->string('emergency_relation', 50);
            $table->string('emergency_phone', 20);
            $table->string('passport_number', 20)->nullable();
            $table->date('passport_issued_at')->nullable();
            $table->date('passport_expired_at')->nullable();
            $table->enum('document_status', ['incomplete', 'complete', 'verified'])->default('incomplete');
            $table->timestamps();

            $table->index('registration_id');
            $table->index('nik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jamaah');
    }
};
