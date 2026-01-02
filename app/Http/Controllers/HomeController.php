<?php
// File: app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data Jadwal Keberangkatan
        $schedules = [
            [
                'id' => 1,
                'package_name' => 'Paket Umrah Reguler',
                'duration' => '9 Hari 7 Malam',
                'departure_date' => '15 Mar 2025',
                'return_date' => '23 Mar 2025',
                'price' => 'Rp 28jt',
                'seats_available' => 27,
                'seats_total' => 45,
                'badge_text' => 'Tersedia',
                'badge_class' => 'available',
                'seats_class' => '',
                'features' => [
                    'Hotel Bintang 5 dekat Haram',
                    'Tiket Pesawat PP (Garuda/Saudia)',
                    'Makan 3x Sehari (Buffet)',
                    'Pembimbing Ibadah Berpengalaman',
                    'Visa & Asuransi Perjalanan'
                ]
            ],
            [
                'id' => 2,
                'package_name' => 'Paket Umrah VIP Premium',
                'duration' => '12 Hari 10 Malam',
                'departure_date' => '10 Apr 2025',
                'return_date' => '21 Apr 2025',
                'price' => 'Rp 45jt',
                'seats_available' => 5,
                'seats_total' => 30,
                'badge_text' => 'Hampir Penuh',
                'badge_class' => 'limited',
                'seats_class' => 'limited',
                'features' => [
                    'Hotel Bintang 5 View Ka\'bah',
                    'Tiket First Class (Garuda)',
                    'Makan Premium (Arab & Indo)',
                    'City Tour Madinah & Jeddah',
                    'Koper Premium + Perlengkapan'
                ]
            ],
            [
                'id' => 3,
                'package_name' => 'Paket Umrah Plus Turki',
                'duration' => '15 Hari 13 Malam',
                'departure_date' => '05 Mei 2025',
                'return_date' => '19 Mei 2025',
                'price' => 'Rp 38jt',
                'seats_available' => 35,
                'seats_total' => 45,
                'badge_text' => 'Tersedia',
                'badge_class' => 'available',
                'seats_class' => '',
                'features' => [
                    'Umrah + Wisata Istanbul',
                    'Hotel Bintang 5 (Saudi & Turki)',
                    'Visit Masjid Biru & Hagia Sophia',
                    'Shopping Grand Bazaar',
                    'Tour Leader Berpengalaman'
                ]
            ],
            [
                'id' => 4,
                'package_name' => 'Paket Umrah Ekonomis',
                'duration' => '9 Hari 7 Malam',
                'departure_date' => '20 Jun 2025',
                'return_date' => '28 Jun 2025',
                'price' => 'Rp 22jt',
                'seats_available' => 40,
                'seats_total' => 45,
                'badge_text' => 'Tersedia',
                'badge_class' => 'available',
                'seats_class' => '',
                'features' => [
                    'Hotel Bintang 3-4 Ajyad/Aziziyah',
                    'Tiket Pesawat PP (Lion/Citilink)',
                    'Makan 3x Sehari',
                    'Pembimbing Ibadah',
                    'Visa & Handling'
                ]
            ],
            [
                'id' => 5,
                'package_name' => 'Paket Umrah Ramadhan',
                'duration' => '12 Hari 10 Malam',
                'departure_date' => '01 Mar 2025',
                'return_date' => '12 Mar 2025',
                'price' => 'Rp 42jt',
                'seats_available' => 18,
                'seats_total' => 40,
                'badge_text' => 'Tersedia',
                'badge_class' => 'available',
                'seats_class' => '',
                'features' => [
                    'Special Ramadhan Package',
                    'Hotel Bintang 5 Walking Distance',
                    'Sahur & Iftar Premium',
                    'Tarawih di Masjidil Haram',
                    'Paket Berkah Ramadhan'
                ]
            ],
            [
                'id' => 6,
                'package_name' => 'Paket Haji Furoda',
                'duration' => '25 Hari 23 Malam',
                'departure_date' => '10 Jun 2025',
                'return_date' => '04 Jul 2025',
                'price' => 'Rp 85jt',
                'seats_available' => 8,
                'seats_total' => 35,
                'badge_text' => 'Hampir Penuh',
                'badge_class' => 'limited',
                'seats_class' => 'limited',
                'features' => [
                    'Program Haji Khusus (ONH Plus)',
                    'Hotel Bintang 5 Makkah & Madinah',
                    'Full AC Bus & Catering',
                    'Tenda Arafah Ber-AC',
                    'Handling Penuh 25 Hari'
                ]
            ]
        ];

        // Data Features
        $features = [
            [
                'icon' => 'bi-shield-check',
                'title' => 'Izin Resmi',
                'description' => 'Terdaftar dan berizin resmi dari Kementerian Agama RI'
            ],
            [
                'icon' => 'bi-building',
                'title' => 'Hotel Terbaik',
                'description' => 'Hotel bintang 5 dengan jarak dekat dari Masjidil Haram'
            ],
            [
                'icon' => 'bi-people',
                'title' => 'Tim Profesional',
                'description' => 'Pembimbing ibadah dan tour leader berpengalaman'
            ],
            [
                'icon' => 'bi-wallet2',
                'title' => 'Harga Terjangkau',
                'description' => 'Paket umrah dengan harga kompetitif dan fasilitas lengkap'
            ]
        ];

        return view('pages.home', compact('schedules', 'features'));
    }
}