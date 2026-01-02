<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display registration form
     * Bisa menerima parameter schedule_id dari halaman jadwal
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Data paket umrah
        $packages = [
            1 => 'Paket Berkah - Special Promo - Rp 28.900.000',
            2 => 'Paket Mahabbah - Special Promo - Rp 31.500.000',
            3 => 'Paket Gold - Special Promo - Rp 35.500.000',
            4 => 'Umrah Awal Ramadhan - Rp 38.900.000',
            5 => 'Paket Reguler Syawal - Rp 29.900.000',
            6 => 'Paket Gold 5⭐ Syawal - Rp 35.900.000'
        ];
        
        // Jalur keberangkatan
        $departure_routes = [
            'Start Lampung',
            'Start Padang',
            'Start Jambi',
            'Start Jakarta',
            'Start Bengkulu'
        ];
        
        // Provinsi
        $provinces = [
            'Lampung', 'Sumatera Barat', 'Jambi', 'DKI Jakarta', 'Bengkulu',
            'Sumatera Utara', 'Sumatera Selatan', 'Riau', 'Kepulauan Riau',
            'Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'Banten', 'Yogyakarta'
        ];
        
        // Gelar
        $titles = ['Tn.', 'Ny.', 'Sdr.', 'Sdri.', 'H.', 'Hj.'];
        
        // Ambil data schedule jika ada parameter schedule_id
        $selectedSchedule = null;
        if ($request->has('schedule_id')) {
            $selectedSchedule = $this->getScheduleById($request->schedule_id);
        }
        
        return view('pages.register', compact(
            'packages', 
            'departure_routes', 
            'provinces', 
            'titles',
            'selectedSchedule'
        ));
    }
    
    /**
     * Handle registration form submission
     * TODO: Simpan ke database setelah migrasi dibuat
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
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
        ], [
            // Custom error messages
            'title.required' => 'Gelar harus dipilih',
            'full_name.required' => 'Nama lengkap harus diisi',
            'full_name.min' => 'Nama lengkap minimal 3 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'phone.required' => 'Nomor WhatsApp harus diisi',
            'phone.min' => 'Nomor WhatsApp minimal 10 digit',
            'package_id.required' => 'Paket harus dipilih',
            'departure_route.required' => 'Jalur keberangkatan harus dipilih',
            'departure_date.required' => 'Tanggal keberangkatan harus dipilih',
            'departure_date.after_or_equal' => 'Tanggal keberangkatan tidak boleh sebelum hari ini',
            'num_people.required' => 'Jumlah jamaah harus diisi',
            'num_people.min' => 'Jumlah jamaah minimal 1 orang',
            'num_people.max' => 'Jumlah jamaah maksimal 10 orang per pendaftaran'
        ]);
        
        // TODO: Simpan ke database
        // Contoh struktur untuk save nanti:
        /*
        $registration = Registration::create([
            'title' => $validated['title'],
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'province' => $validated['province'],
            'city' => $validated['city'],
            'package_id' => $validated['package_id'],
            'departure_route' => $validated['departure_route'],
            'departure_date' => $validated['departure_date'],
            'num_people' => $validated['num_people'],
            'message' => $validated['message'],
            'schedule_id' => $validated['schedule_id'] ?? null,
            'status' => 'pending', // pending, confirmed, paid, cancelled
            'registration_date' => now(),
            'registration_number' => $this->generateRegistrationNumber()
        ]);
        */
        
        // TODO: Kirim email notifikasi ke admin
        // TODO: Kirim WhatsApp notification (optional)
        
        // Sementara simpan ke session untuk development
        session()->flash('registration_data', $validated);
        
        // Redirect dengan pesan sukses
        return redirect()->route('register')
            ->with('success', 
                'Pendaftaran Anda berhasil! Tim Mahira Tour akan segera menghubungi Anda di nomor ' . 
                $validated['phone'] . ' dalam 1x24 jam untuk konfirmasi lebih lanjut.'
            );
    }
    
    /**
     * Get schedule data by ID
     * Helper method untuk mengambil data schedule
     *
     * @param  int  $scheduleId
     * @return array|null
     */
    private function getScheduleById($scheduleId)
    {
        // Data schedule (sama seperti di ScheduleController)
        $schedules = [
            1 => [
                'id' => 1,
                'package_name' => 'Paket Berkah - Special Promo',
                'departure_date' => '2026-01-24',
                'return_date' => '2026-02-04',
                'departure_route' => 'Start Padang',
                'price' => 28900000,
                'airline' => 'Padang - Kull - Jeddah',
                'flyer_image' => 'flyer-umrah-januari-2026.jpg',
                'duration' => '12 Hari'
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
                'duration' => '12 Hari'
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
                'duration' => '12 Hari'
            ],
            4 => [
                'id' => 4,
                'package_name' => 'Umrah Awal Ramadhan',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-06',
                'departure_route' => 'Start Padang',
                'price' => 38900000,
                'airline' => 'PDG - JED (Terbang Langsung)',
                'flyer_image' => 'flyer-umrah-ramadhan-2026.jpg',
                'duration' => '12 Hari'
            ],
            5 => [
                'id' => 5,
                'package_name' => 'Paket Reguler - Keberangkatan Syawal',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-04',
                'departure_route' => 'Start Padang',
                'price' => 29900000,
                'airline' => 'Batik Air',
                'flyer_image' => 'flyer-umrah-syawal-2026.jpg',
                'duration' => '10 Hari'
            ],
            6 => [
                'id' => 6,
                'package_name' => 'Paket Gold 5⭐ - Keberangkatan Syawal',
                'departure_date' => '2026-02-23',
                'return_date' => '2026-03-04',
                'departure_route' => 'Start Padang',
                'price' => 35900000,
                'airline' => 'Batik Air',
                'flyer_image' => 'flyer-umrah-syawal-2026.jpg',
                'duration' => '10 Hari'
            ],
        ];
        
        return $schedules[$scheduleId] ?? null;
    }
    
    /**
     * Generate unique registration number
     * Format: MHR-YYYYMMDD-XXXX
     *
     * @return string
     */
    private function generateRegistrationNumber()
    {
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        
        return "MHR-{$date}-{$random}";
    }
}