<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // ========== TAMBAHKAN DI SINI ==========
        $schedule->command('bookings:cancel-expired')
                 ->hourly()
                 ->withoutOverlapping()
                 ->runInBackground();

        // Reminder Pelunasan (Jalan setiap hari jam 09:00 pagi)
        $schedule->command('pelunasan:remind')
                 ->dailyAt('09:00')
                 ->withoutOverlapping()
                 ->runInBackground();

        // Cleanup Data Cancelled (Jalan setiap hari jam 02:00 pagi - saat trafik rendah)
        $schedule->command('bookings:cleanup')
                 ->dailyAt('02:00')
                 ->runInBackground();
        // =======================================
    }
    

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    protected $middlewareAliases = [
    // ... yang lain
    'admin.auth' => \App\Http\Middleware\AdminAuth::class,

    
];
}