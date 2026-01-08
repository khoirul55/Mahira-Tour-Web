<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CancelExpiredBookings extends Command
{
    /**
     * Signature command yang akan dipanggil
     * Contoh: php artisan bookings:cancel-expired
     */
    protected $signature = 'bookings:cancel-expired';

    /**
     * Deskripsi command
     */
    protected $description = 'Cancel expired draft bookings and release seats';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to check expired bookings...');
        
        $cancelled = 0;
        $released_seats = 0;
        
        try {
            // Cari semua booking yang expired
            Registration::where('status', 'draft')
                ->where('payment_deadline', '<', now())
                ->chunk(100, function($registrations) use (&$cancelled, &$released_seats) {
                    
                    foreach($registrations as $registration) {
                        DB::beginTransaction();
                        
                        try {
                            // Release seats di schedule
                            $registration->schedule->decrement('seats_taken', $registration->num_people);
                            
                            // Update status jadi cancelled
                            $registration->update([
                                'status' => 'cancelled',
                                'last_activity_at' => now()
                            ]);
                            
                            // Logging
                            Log::info('Booking cancelled automatically', [
                                'registration_number' => $registration->registration_number,
                                'seats_released' => $registration->num_people
                            ]);
                            
                            $cancelled++;
                            $released_seats += $registration->num_people;
                            
                            DB::commit();
                            
                        } catch (\Exception $e) {
                            DB::rollBack();
                            
                            Log::error('Failed to cancel booking', [
                                'registration_number' => $registration->registration_number,
                                'error' => $e->getMessage()
                            ]);
                        }
                    }
                });
            
            // Output hasil
            $this->info("✅ Successfully cancelled {$cancelled} bookings");
            $this->info("✅ Released {$released_seats} seats");
            
            return 0; // Success
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            Log::error('Cancel expired bookings failed', ['error' => $e->getMessage()]);
            
            return 1; // Error
        }
    }
}