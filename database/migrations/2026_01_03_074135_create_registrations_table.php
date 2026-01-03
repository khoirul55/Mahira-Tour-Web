<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            
            // Identifikasi
            $table->string('registration_number', 20)->unique();
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade');
            
            // PIC (Person in Charge / Pendaftar)
            $table->string('pic_title', 10);
            $table->string('pic_full_name');
            $table->string('pic_email');
            $table->string('pic_phone', 20);
            $table->text('pic_address')->nullable();
            $table->string('pic_province', 100)->nullable();
            $table->string('pic_city', 100)->nullable();
            
            // Booking Info
            $table->tinyInteger('num_people');
            $table->date('departure_date');
            $table->string('departure_route', 100);
            $table->text('notes')->nullable();
            
            // Payment
            $table->decimal('total_price', 12, 2);
            $table->decimal('dp_amount', 12, 2);
            $table->enum('dp_status', ['pending', 'paid', 'verified'])->default('pending');
            $table->timestamp('dp_paid_at')->nullable();
            $table->timestamp('dp_verified_at')->nullable();
            $table->unsignedBigInteger('dp_verified_by')->nullable();
            
            // Status
            $table->enum('status', ['pending', 'confirmed', 'document_incomplete', 'ready', 'cancelled'])->default('pending');
            
            $table->timestamps();
            
            // Indexes
            $table->index('registration_number');
            $table->index('status');
            $table->index('dp_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};