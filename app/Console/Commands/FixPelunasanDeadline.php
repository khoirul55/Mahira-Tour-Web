<?php

namespace App\Console\Commands;

use App\Models\Registration;
use Illuminate\Console\Command;

class FixPelunasanDeadline extends Command
{
    protected $signature = 'fix:pelunasan-deadline';
    protected $description = 'Fix missing pelunasan_deadline for existing registrations';

    public function handle()
    {
        $this->info('🔍 Mencari registrasi dengan pelunasan_deadline NULL...');
        
        $registrations = Registration::whereNull('pelunasan_deadline')
            ->whereHas('schedule')
            ->get();
        
        if ($registrations->isEmpty()) {
            $this->info('✅ Semua registrasi sudah memiliki pelunasan_deadline');
            return 0;
        }
        
        $this->info("📋 Ditemukan: {$registrations->count()} registrasi");
        
        $updated = 0;
        
        foreach ($registrations as $reg) {
            try {
                $deadline = $reg->schedule->departure_date->copy()->subDays(30);
                
                $reg->update(['pelunasan_deadline' => $deadline]);
                
                $this->info("✅ {$reg->registration_number}: Deadline set to {$deadline->format('d M Y')}");
                $updated++;
                
            } catch (\Exception $e) {
                $this->error("❌ {$reg->registration_number}: {$e->getMessage()}");
            }
        }
        
        $this->newLine();
        $this->info("📊 Total updated: {$updated} registrasi");
        
        return 0;
    }
}