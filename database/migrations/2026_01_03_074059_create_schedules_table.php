<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->date('departure_date');
            $table->date('return_date');
            $table->string('departure_route', 100);
            $table->string('airline', 100);
            $table->string('duration', 50);
            
            $table->decimal('price', 12, 2);
            $table->integer('quota');
            $table->integer('seats_taken')->default(0);
            
            $table->string('flyer_image', 500)->nullable();
            $table->enum('status', ['active', 'full', 'cancelled'])->default('active');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};