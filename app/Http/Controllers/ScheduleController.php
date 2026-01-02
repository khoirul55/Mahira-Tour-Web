<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = [
            // Flyer 1: Paket Umrah 24 Januari 2026 - Padang (Special Promo)
            [
                'id' => 1,
                'package_name' => 'Paket Berkah - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04', // 12 hari program
                'departure_route' => 'Start Padang',
                'quota' => 45,
                'seats_taken' => 12,
                'status' => 'available',
                'price' => 28900000,
                'airline' => 'Padang - Kull - Jeddah',
                'flyer_image' => 'flyer-umrah-januari-2026.jpg'
            ],
            [
                'id' => 2,
                'package_name' => 'Paket Mahabbah - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04',
                'departure_route' => 'Start Padang',
                'quota' => 40,
                'seats_taken' => 18,
                'status' => 'available',
                'price' => 31500000,
                'airline' => 'Padang - Kull - Jeddah',
                'flyer_image' => 'flyer-umrah-januari-2026.jpg'
            ],
            [
                'id' => 3,
                'package_name' => 'Paket Gold - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04',
                'departure_route' => 'Start Padang',
                'quota' => 35,
                'seats_taken' => 8,
                'status' => 'available',
                'price' => 35500000,
                'airline' => 'Padang - Kull - Jeddah',
                'flyer_image' => 'flyer-umrah-januari-2026.jpg'
            ],
            
            // Flyer 2: Umrah Awal Ramadhan - PDG to JED (Terbang Langsung)
            [
                'id' => 4,
                'package_name' => 'Umrah Awal Ramadhan',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-06', // 12 hari
                'departure_route' => 'Start Padang',
                'quota' => 45,
                'seats_taken' => 28,
                'status' => 'almost_full',
                'price' => 38900000,
                'airline' => 'PDG - JED (Terbang Langsung)',
                'flyer_image' => 'flyer-umrah-ramadhan-2026.jpg'
            ],
            
            // Flyer 3: Umrah Keberangkatan Syawal - Start Padang (Batik Air)
            [
                'id' => 5,
                'package_name' => 'Paket Reguler - Keberangkatan Syawal',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-04',
                'departure_route' => 'Start Padang',
                'quota' => 40,
                'seats_taken' => 8,
                'status' => 'available',
                'price' => 29900000,
                'airline' => 'Batik Air',
                'flyer_image' => 'flyer-umrah-syawal-2026.jpg'
            ],
            [
                'id' => 6,
                'package_name' => 'Paket Gold 5⭐ - Keberangkatan Syawal',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-04',
                'departure_route' => 'Start Padang',
                'quota' => 35,
                'seats_taken' => 15,
                'status' => 'available',
                'price' => 35900000,
                'airline' => 'Batik Air',
                'flyer_image' => 'flyer-umrah-syawal-2026.jpg'
            ],
        ];
        
        $departure_routes = [
            'Start Padang',
            'Start Jambi',
            'Start Jakarta',
            'Start Bengkulu',
            'Start Lampung'
        ];
        
        return view('pages.schedule', compact('schedules', 'departure_routes'));
    }
}