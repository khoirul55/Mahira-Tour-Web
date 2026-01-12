<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Update payments table - tambah payment_type pelunasan
        Schema::table('payments', function (Blueprint $table) {
            // Ubah enum payment_type
            DB::statement("ALTER TABLE payments MODIFY COLUMN payment_type ENUM('dp', 'pelunasan') DEFAULT 'dp'");
            
            // Ubah enum status
            DB::statement("ALTER TABLE payments MODIFY COLUMN status ENUM('pending', 'verified', 'rejected', 'lunas') DEFAULT 'pending'");
        });
        
        // 2. Update registrations table
        Schema::table('registrations', function (Blueprint $table) {
            $table->decimal('pelunasan_amount', 12, 2)->nullable()->after('dp_amount');
            $table->date('pelunasan_deadline')->nullable()->after('document_deadline');
            $table->boolean('is_lunas')->default(false)->after('status');
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            DB::statement("ALTER TABLE payments MODIFY COLUMN payment_type ENUM('dp', 'full') DEFAULT 'dp'");
            DB::statement("ALTER TABLE payments MODIFY COLUMN status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending'");
        });
        
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['pelunasan_amount', 'pelunasan_deadline', 'is_lunas']);
        });
    }
};