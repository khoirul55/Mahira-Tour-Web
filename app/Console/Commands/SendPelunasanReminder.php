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
        $registrations = Registration::where('status', 'confirmed')
            ->where('is_lunas', false)
            ->whereHas('payments', function($q) {
                $q->where('payment_type', 'dp')->where('status', 'verified');
            })
            ->whereDoesntHave('payments', function($q) {
                $q->where('payment_type', 'pelunasan')->where('status', 'verified');
            })
            ->get();

        $sent = 0;
        foreach ($registrations as $reg) {
            // Skip jika sudah kirim dalam 7 hari terakhir
            if ($reg->last_pelunasan_reminder_at && 
                $reg->last_pelunasan_reminder_at->diffInDays(now()) < 7) {
                continue;
            }

            try {
                Mail::to($reg->email)->send(new PelunasanTagihan($reg));
                $reg->update(['last_pelunasan_reminder_at' => now()]);
                $sent++;
            } catch (\Exception $e) {
                Log::error("Email pelunasan gagal: {$reg->email}", ['error' => $e->getMessage()]);
            }
        }

        $this->info("✅ Terkirim: $sent email");
        return 0;
    }
}