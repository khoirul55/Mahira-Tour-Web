<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = [
            [
                'package_name' => 'Paket Berkah - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04',
                'departure_route' => 'Start Padang',
                'airline' => 'Padang - Kull - Jeddah',
                'duration' => '12 Hari',
                'price' => 28900000,
                'quota' => 45,
                'seats_taken' => 12,
                'flyer_image' => 'flyers/flyer-umrah-januari.jpg',
                'status' => 'active'
            ],
            [
                'package_name' => 'Paket Mahabbah - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04',
                'departure_route' => 'Start Padang',
                'airline' => 'Padang - Kull - Jeddah',
                'duration' => '12 Hari',
                'price' => 31500000,
                'quota' => 40,
                'seats_taken' => 18,
                'flyer_image' => 'flyers/flyer-umrah-januari.jpg',
                'status' => 'active'
            ],
            [
                'package_name' => 'Paket Gold - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04',
                'departure_route' => 'Start Padang',
                'airline' => 'Padang - Kull - Jeddah',
                'duration' => '12 Hari',
                'price' => 35500000,
                'quota' => 35,
                'seats_taken' => 8,
                'flyer_image' => 'flyers/flyer-umrah-januari.jpg',
                'status' => 'active'
            ],
            [
                'package_name' => 'Umrah Awal Ramadhan',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-06',
                'departure_route' => 'Start Padang',
                'airline' => 'PDG - JED (Terbang Langsung)',
                'duration' => '12 Hari',
                'price' => 38900000,
                'quota' => 45,
                'seats_taken' => 28,
                'flyer_image' => 'flyers/flyer-umrah-ramadhan.jpg',
                'status' => 'active'
            ],
            [
                'package_name' => 'Paket Reguler - Keberangkatan Syawal',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-04',
                'departure_route' => 'Start Padang',
                'airline' => 'Batik Air',
                'duration' => '10 Hari',
                'price' => 29900000,
                'quota' => 40,
                'seats_taken' => 8,
                'flyer_image' => 'flyers/flyer-umrah-syawal.jpg',
                'status' => 'active'
            ],
            [
                'package_name' => 'Paket Gold 5⭐ - Keberangkatan Syawal',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-04',
                'departure_route' => 'Start Padang',
                'airline' => 'Batik Air',
                'duration' => '10 Hari',
                'price' => 35900000,
                'quota' => 35,
                'seats_taken' => 15,
                'flyer_image' => 'flyers/flyer-umrah-syawal.jpg',
                'status' => 'active'
            ]
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}