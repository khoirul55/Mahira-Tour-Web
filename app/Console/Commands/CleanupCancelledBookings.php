<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CleanupCancelledBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete cancelled or expired bookings older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting cleanup of old cancelled bookings...');

        // Cari booking cancelled/expired yg last_activity_at-nya > 30 hari lalu
        $cutoffDate = now()->subDays(30);

        $registrations = Registration::whereIn('status', ['cancelled', 'expired'])
            ->where('last_activity_at', '<', $cutoffDate)
            ->get();

        if ($registrations->isEmpty()) {
            $this->info('No old cancelled bookings found to clean up.');
            return 0;
        }

        $count = $registrations->count();
        $this->info("Found {$count} bookings to delete.");

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        $deletedCount = 0;
        $failedCount = 0;

        foreach ($registrations as $registration) {
            DB::beginTransaction();
            try {
                // 1. Hapus Dokumen & File Fisik
                // Ambil semua dokumen terkait booking ini (via jamaah)
                $jamaahIds = $registration->jamaah->pluck('id');
                $documents = Document::whereIn('jamaah_id', $jamaahIds)->get();

                foreach ($documents as $doc) {
                    // Hapus file fisik jika ada
                    if ($doc->file_path && Storage::exists($doc->file_path)) {
                        Storage::delete($doc->file_path);
                    }
                    $doc->delete();
                }

                // 2. Hapus Data Jamaah
                $registration->jamaah()->delete();

                // 3. Hapus Data Payment (Opsional: jika ingin keep history payment mungkin perlu SoftDelete, 
                // tapi request ini adalah clean up data cancelled, biasanya payment gagal/refund manual)
                // Asumsi: hapus bersih
                $registration->payments()->delete();

                // 4. Hapus Registration
                $registration->delete();

                DB::commit();
                $deletedCount++;
                
                Log::info("Cleanup: Deleted registration {$registration->registration_number}");

            } catch (\Exception $e) {
                DB::rollBack();
                $failedCount++;
                Log::error("Cleanup Failed: {$registration->registration_number}. Error: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info("Cleanup completed.");
        $this->info("Deleted: {$deletedCount}");
        if ($failedCount > 0) {
            $this->error("Failed: {$failedCount}");
        }

        return 0;
    }
}
