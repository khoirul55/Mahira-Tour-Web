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
        Schema::table('registrations', function (Blueprint $table) {
            // Tambah kolom untuk Quick Booking flow
            $table->decimal('dp_amount', 12, 2)->after('total_price')->comment('30% dari total_price');
            $table->date('payment_deadline')->nullable()->after('dp_amount')->comment('Deadline upload DP (3 hari)');
            $table->date('document_deadline')->nullable()->after('payment_deadline')->comment('Deadline upload dokumen');
            
            // Progress tracking
            $table->tinyInteger('completion_percentage')->default(0)->after('status')->comment('0-100%');
            $table->timestamp('last_activity_at')->nullable()->after('updated_at')->comment('Terakhir user/admin aktif');
            
            // CS Assignment (opsional untuk nanti)
            $table->unsignedBigInteger('assigned_to')->nullable()->after('last_activity_at')->comment('Admin/CS yang handle');
            
            // Update status enum - tambah 'draft'
            $table->enum('status', ['draft', 'pending', 'confirmed', 'cancelled'])->default('draft')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'dp_amount',
                'payment_deadline', 
                'document_deadline',
                'completion_percentage',
                'last_activity_at',
                'assigned_to'
            ]);
            
            // Rollback status enum
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending')->change();
        });
    }
};