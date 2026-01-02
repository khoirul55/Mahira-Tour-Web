<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageDetailController extends Controller
{
    public function show($id)
    {
        $packages = [
            1 => [
                'id' => 1,
                'name' => 'Paket Umrah Reguler 9 Hari',
                'type' => 'Umrah Reguler',
                'duration' => '9 Hari',
                'price' => 28000000,
                'image' => 'https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=800',
                'description' => 'Paket umrah reguler dengan fasilitas lengkap dan pelayanan terbaik. Didampingi oleh muthawwif dan tour leader berpengalaman.',
                
                'hotels' => [
                    'Al Safwah / Rayyana / Grand Al Massa Hotel (Makkah)',
                    'Hotel Bintang 5 (Madinah)',
                ],

                'includes' => [
                    'Tiket Pesawat Pulang Pergi',
                    'Visa Umrah',
                    'Asuransi Perjalanan',
                    'Hotel Bintang 5',
                    'Makan 3x Sehari (Prasmanan)',
                    'Manasik Umrah',
                    'Bus Exclusive',
                    'Muthawwif & Tour Leader',
                    'Wisata Islami',
                    'Foto Dokumentasi',
                    'Sertifikat Umrah',
                    'Air Zam-zam 5 Liter',
                ],

                'equipment' => [
                    'Dasar Batik',
                    'Kain Ihram / Mukena',
                    'Koper Besar & Kecil',
                    'Sabuk Umrah',
                    'Buku Panduan',
                    'Syal',
                    'ID Card',
                ],

                'requirements' => [
                    'Mengisi Formulir Pendaftaran',
                    'Membayar DP',
                    'Pas Foto 4x6 (2 lembar)',
                    'Paspor berlaku min. 7 bulan',
                    'Materai 10.000 (4 lembar)',
                ],

                'passport_requirements' => [
                    'KTP Asli + FC',
                    'KK Asli + FC',
                    'Akte / Ijazah',
                    'Buku Nikah + FC',
                ],

                'itinerary' => [
                    ['day' => 'Hari 1', 'activity' => 'Keberangkatan ke Jeddah'],
                    ['day' => 'Hari 2', 'activity' => 'Tiba di Makkah & Check-in'],
                    ['day' => 'Hari 3–5', 'activity' => 'Pelaksanaan Umrah'],
                    ['day' => 'Hari 6', 'activity' => 'Perjalanan ke Madinah'],
                    ['day' => 'Hari 7–8', 'activity' => 'Ziarah Madinah'],
                    ['day' => 'Hari 9', 'activity' => 'Kembali ke Indonesia'],
                ],

                'departure_routes' => [
                    'Padang',
                    'Jambi',
                    'Jakarta',
                    'Bengkulu',
                    'Lampung',
                ],

                'terms' => [
                    'DP sesuai ketentuan',
                    'Pelunasan sebelum berangkat',
                    'Harga dapat berubah',
                    'S&K berlaku',
                ],

                'available_seats' => 30,
            ],
        ];

        if (!array_key_exists($id, $packages)) {
            abort(404, 'Paket tidak ditemukan');
        }

        $package = $packages[$id];

        return view('pages.package-detail', compact('package'));
    }
}
