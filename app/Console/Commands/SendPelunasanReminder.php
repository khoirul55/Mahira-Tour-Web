<?php

namespace App\Console\Commands;

use App\Models\Registration;
use App\Mail\PelunasanTagihan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendPelunasanReminder extends Command
{
    protected $signature = 'pelunasan:remind';
    protected $description = 'Kirim reminder pelunasan otomatis';

    public function handle()
    {
        $this->info('🔍 Mencari registrasi yang perlu pelunasan...');
        
        // Query yang BENAR
        $registrations = Registration::with('schedule', 'payments')
            ->where('status', 'confirmed')
            ->where('is_lunas', false)
            ->whereHas('payments', function($q) {
                $q->where('payment_type', 'dp')
                  ->where('status', 'verified');
            })
            ->get()
            ->filter(function($reg) {
                // Filter manual: cek apakah pelunasan belum verified
                $pelunasan = $reg->pelunasanPayment();
                
                // Jika belum ada pelunasan ATAU pelunasan ditolak
                return !$pelunasan || $pelunasan->status !== 'verified';
            });

        $this->info("📋 Ditemukan: {$registrations->count()} registrasi");

        if ($registrations->isEmpty()) {
            $this->warn('⚠️ Tidak ada registrasi yang perlu reminder');
            return 0;
        }

        $sent = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($registrations as $reg) {
            // Skip jika sudah kirim dalam 7 hari terakhir
            if ($reg->last_pelunasan_reminder_at && 
                $reg->last_pelunasan_reminder_at->diffInDays(now()) < 7) {
                $skipped++;
                $this->warn("⏭️ Skip {$reg->email} (sudah kirim < 7 hari)");
                continue;
            }

            try {
                Mail::to($reg->email)->send(new PelunasanTagihan($reg));
                $reg->update(['last_pelunasan_reminder_at' => now()]);
                $sent++;
                $this->info("✅ Email terkirim ke: {$reg->email}");
            } catch (\Exception $e) {
                $failed++;
                Log::error("Email pelunasan gagal: {$reg->email}", [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                $this->error("❌ Gagal kirim ke: {$reg->email}");
                $this->error("   Error: " . $e->getMessage());
            }
        }

        $this->newLine();
        $this->info("📊 HASIL:");
        $this->info("✅ Berhasil: {$sent}");
        $this->warn("⏭️ Di-skip: {$skipped}");
        
        if ($failed > 0) {
            $this->error("❌ Gagal: {$failed}");
            $this->error("💡 Cek log/laravel.log untuk detail error");
        }

        return $failed > 0 ? 1 : 0;
    }
}