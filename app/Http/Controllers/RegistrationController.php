<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $packages = [
            1 => 'Paket Berkah - Special Promo',
            2 => 'Paket Mahabbah - Special Promo',
            3 => 'Paket Gold - Special Promo',
            4 => 'Umrah Awal Ramadhan',
            5 => 'Paket Reguler Syawal',
            6 => 'Paket Gold 5⭐ Syawal'
        ];
        
        $departure_routes = ['Start Lampung', 'Start Padang', 'Start Jambi', 'Start Jakarta', 'Start Bengkulu'];
        $provinces = ['Lampung', 'Sumatera Barat', 'Jambi', 'DKI Jakarta', 'Bengkulu', 'Sumatera Utara', 'Sumatera Selatan', 'Riau', 'Kepulauan Riau', 'Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'Banten', 'Yogyakarta'];
        $titles = ['Tn.', 'Ny.', 'Sdr.', 'Sdri.', 'H.', 'Hj.'];
        
        $selectedSchedule = null;
        if ($request->has('schedule_id')) {
            $selectedSchedule = $this->getScheduleById($request->schedule_id);
        }
        
        // 🔥 TAMBAHAN: Get ALL schedules untuk dropdown info
        $allSchedules = $this->getAllSchedules();
        
        // 🔥 PENTING: Assign ke variable dulu
        $allSchedules = $this->getAllSchedules();
        
        return view('pages.register', compact(
            'packages', 
            'departure_routes', 
            'provinces', 
            'titles',
            'selectedSchedule',
            'allSchedules'
        ));
    }
    
    // 🔥 NEW METHOD
    private function getAllSchedules()
    {
        return [
            1 => [
                'id' => 1,
                'package_name' => 'Paket Berkah - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04',
                'departure_route' => 'Start Padang',
                'price' => 28900000,
                'airline' => 'Padang - Kull - Jeddah',
                'flyer_image' => 'flyer-umrah-januari-2026.jpg',
                'duration' => '12 Hari',
                'facilities' => [
                    'Hotel Bintang 4 di Madinah',
                    'Hotel Bintang 5 di Makkah',
                    'Makan 3x Sehari',
                    'Tour Ziarah Lengkap',
                    'Perlengkapan Umrah',
                    'Manasik Persiapan'
                ],
                'quota' => 45,
                'seats_taken' => 12
            ],
            2 => [
                'id' => 2,
                'package_name' => 'Paket Mahabbah - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04',
                'departure_route' => 'Start Padang',
                'price' => 31500000,
                'airline' => 'Padang - Kull - Jeddah',
                'flyer_image' => 'flyer-umrah-januari-2026.jpg',
                'duration' => '12 Hari',
                'facilities' => [
                    'Hotel Bintang 5 di Madinah & Makkah',
                    'Makan 3x Sehari Premium',
                    'Tour Ziarah Lengkap + Extra',
                    'Perlengkapan Umrah Premium',
                    'Manasik + Konsultasi',
                    'City Tour Jeddah'
                ],
                'quota' => 40,
                'seats_taken' => 18
            ],
            3 => [
                'id' => 3,
                'package_name' => 'Paket Gold - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04',
                'departure_route' => 'Start Padang',
                'price' => 35500000,
                'airline' => 'Padang - Kull - Jeddah',
                'flyer_image' => 'flyer-umrah-januari-2026.jpg',
                'duration' => '12 Hari',
                'facilities' => [
                    'Hotel Bintang 5 Walking Distance',
                    'Makan 3x Premium Buffet',
                    'Tour Ziarah VIP',
                    'Perlengkapan Eksklusif',
                    'Manasik + Spiritual Guide',
                    'City Tour + Shopping'
                ],
                'quota' => 35,
                'seats_taken' => 8
            ],
            4 => [
                'id' => 4,
                'package_name' => 'Umrah Awal Ramadhan',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-06',
                'departure_route' => 'Start Padang',
                'price' => 38900000,
                'airline' => 'PDG - JED (Terbang Langsung)',
                'flyer_image' => 'flyer-umrah-ramadhan.jpg',
                'duration' => '12 Hari',
                'facilities' => [
                    'Penerbangan Direct Tanpa Transit',
                    'Hotel Bintang 5 Dekat Masjid',
                    'Iftar & Sahur Premium',
                    'Tarawih di Masjidil Haram',
                    'Ziarah Lengkap Ramadhan',
                    'Paket Kurma & Oleh-oleh'
                ],
                'quota' => 45,
                'seats_taken' => 28
            ],
            5 => [
                'id' => 5,
                'package_name' => 'Paket Reguler - Keberangkatan Syawal',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-04',
                'departure_route' => 'Start Padang',
                'price' => 29900000,
                'airline' => 'Batik Air',
                'flyer_image' => 'flyer-umrah-syawal.jpg',
                'duration' => '10 Hari',
                'facilities' => [
                    'Hotel Bintang 4',
                    'Makan 3x Sehari',
                    'Tour Ziarah Standar',
                    'Perlengkapan Umrah',
                    'Manasik Pra-Keberangkatan',
                    'Bus AC Pariwisata'
                ],
                'quota' => 40,
                'seats_taken' => 8
            ],
            6 => [
                'id' => 6,
                'package_name' => 'Paket Gold 5⭐ - Keberangkatan Syawal',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-04',
                'departure_route' => 'Start Padang',
                'price' => 35900000,
                'airline' => 'Batik Air',
                'flyer_image' => 'flyer-umrah-syawal.jpg',
                'duration' => '10 Hari',
                'facilities' => [
                    'Hotel Bintang 5 Walking Distance',
                    'Makan Premium Buffet',
                    'Tour Ziarah VIP',
                    'Perlengkapan Premium',
                    'Konsultasi Spiritual',
                    'City Tour + Shopping'
                ],
                'quota' => 35,
                'seats_taken' => 15
            ],
        ];
    }
    
    private function getScheduleById($scheduleId)
    {
        $allSchedules = $this->getAllSchedules();
        return $allSchedules[$scheduleId] ?? null;
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'full_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:20',
            'address' => 'nullable|string|max:500',
            'province' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'package_id' => 'required|integer',
            'departure_route' => 'required|string',
            'departure_date' => 'required|date|after_or_equal:today',
            'num_people' => 'required|integer|min:1|max:10',
            'message' => 'nullable|string|max:1000',
            'schedule_id' => 'nullable|integer'
        ]);
        
        session()->flash('registration_data', $validated);
        
        return redirect()->route('register')
            ->with('success', 
                'Pendaftaran Anda berhasil! Tim Mahira Tour akan segera menghubungi Anda di nomor ' . 
                $validated['phone'] . ' dalam 1x24 jam untuk konfirmasi lebih lanjut.'
            );
    }
}