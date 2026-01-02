<?php

namespace App\Services;

class PackageService
{
    /**
     * Get all packages data
     * 
     * @return array
     */
    public static function getAll()
    {
        return [
            1 => [
                'id' => 1,
                'name' => 'Paket Umrah Januari 2026',
                'type' => 'umrah',
                'duration' => '12 Hari 10 Malam',
                'price' => 28900000,
                'price_before_discount' => 32000000,
                'discount' => 10,
                'image' => 'https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=800',
                'flyer' => 'umrah-januari-2026.jpg',
                'airline' => 'Garuda Indonesia',
                'available_seats' => 25,
                'departure_date' => '21 Januari 2026',
                'departure_route' => 'Jakarta',
                'description' => 'Paket umrah reguler dengan fasilitas lengkap dan hotel bintang 5 strategis dekat Masjidil Haram. Pengalaman ibadah yang nyaman dengan bimbingan muthawwif berpengalaman.',
                'includes' => [
                    'Tiket Pesawat PP Jakarta-Jeddah',
                    'Visa Umrah termasuk pengurusan',
                    'Asuransi Perjalanan',
                    'Hotel Bintang 5 (Makkah & Madinah)',
                    'Makan 3x Sehari (Prasmanan)',
                    'Manasik Umrah Lengkap',
                    'Handling & Airport Tax',
                    'Bus AC Exclusive',
                    'Muthawwif & Tour Leader Bersertifikat',
                    'Ziarah & Wisata Islami',
                    'Foto & Video Dokumentasi',
                    'Sertifikat Umrah',
                    'Air Zam-zam 5 Liter'
                ],
                'hotels' => [
                    'Elaf Al Mashaer Hotel - Makkah (200m dari Masjidil Haram)',
                    'Anwar Al Madinah Mövenpick - Madinah (150m dari Masjid Nabawi)'
                ],
                'itinerary' => [
                    ['day' => 'Hari 1-2', 'activity' => 'Keberangkatan dari Jakarta menuju Jeddah, dilanjutkan perjalanan ke Makkah. Check-in hotel dan istirahat.'],
                    ['day' => 'Hari 3-7', 'activity' => 'Pelaksanaan Umrah, thawaf, sa\'i, dan ibadah di Masjidil Haram. Ziarah ke Jabal Rahmah, Jabal Tsur, dan tempat bersejarah lainnya.'],
                    ['day' => 'Hari 8', 'activity' => 'Perjalanan Makkah ke Madinah via bus AC.'],
                    ['day' => 'Hari 9-11', 'activity' => 'Ibadah di Masjid Nabawi, ziarah Raudhah, makam Rasulullah SAW, dan situs bersejarah Madinah.'],
                    ['day' => 'Hari 12', 'activity' => 'Perjalanan kembali ke Jakarta dan tiba di tanah air.']
                ],
                'requirements' => [
                    'Paspor minimal berlaku 7 bulan dari tanggal keberangkatan',
                    'KTP yang masih berlaku',
                    'Kartu Keluarga',
                    'Foto 4x6 (latar putih) sebanyak 10 lembar',
                    'Surat keterangan Mahram (untuk wanita di bawah 45 tahun)',
                    'Buku vaksin Meningitis & Covid-19',
                    'Surat keterangan sehat dari dokter'
                ],
                'terms' => [
                    'DP minimal 30% dari total harga paket',
                    'Pelunasan paling lambat 30 hari sebelum keberangkatan',
                    'Pembatalan 30 hari sebelum keberangkatan: DP hangus',
                    'Pembatalan kurang dari 30 hari: dikenakan biaya 50% dari total',
                    'Harga sewaktu-waktu dapat berubah mengikuti kurs dan kebijakan Saudi',
                    'Peserta wajib mengikuti manasik minimal 2 kali pertemuan'
                ],
                'badge' => 'Terlaris'
            ],
            
            2 => [
                'id' => 2,
                'name' => 'Paket Umrah Awal Ramadhan',
                'type' => 'umrah-ramadhan',
                'duration' => '12 Hari 10 Malam',
                'price' => 38900000,
                'price_before_discount' => 45000000,
                'discount' => 13,
                'image' => 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=800',
                'flyer' => 'umrah-ramadhan-2026.jpg',
                'airline' => 'Saudi Airlines',
                'available_seats' => 15,
                'departure_date' => '17 Februari 2026',
                'departure_route' => 'Jakarta',
                'description' => 'Paket umrah spesial Ramadhan dengan pengalaman ibadah yang luar biasa di bulan penuh berkah. Hotel premium view Ka\'bah dan fasilitas eksklusif.',
                'includes' => [
                    'Semua fasilitas paket reguler',
                    'Hotel Premium View Ka\'bah',
                    'Sahur & Berbuka Premium Buffet',
                    'Kajian Ramadhan setiap hari',
                    'Tarawih di Masjidil Haram',
                    'Paket Kurma Premium',
                    'Free City Tour Thaif',
                    'Makan di restoran mewah',
                    'Welcome dinner & farewell dinner',
                    'Souvenir eksklusif'
                ],
                'hotels' => [
                    'Swissotel Makkah - View Ka\'bah (50m dari Masjidil Haram)',
                    'Pullman Zamzam Madinah - View Masjid (Direct access ke Masjid Nabawi)'
                ],
                'itinerary' => [
                    ['day' => 'Hari 1-2', 'activity' => 'Keberangkatan Jakarta-Jeddah, perjalanan ke Makkah. Check-in hotel premium.'],
                    ['day' => 'Hari 3-7', 'activity' => 'Pelaksanaan Umrah, ibadah Ramadhan, tarawih, dan ziarah. Sahur & berbuka di hotel.'],
                    ['day' => 'Hari 8', 'activity' => 'City Tour Thaif, perjalanan ke Madinah.'],
                    ['day' => 'Hari 9-11', 'activity' => 'Ibadah Ramadhan di Masjid Nabawi, ziarah, kajian malam.'],
                    ['day' => 'Hari 12', 'activity' => 'Kembali ke Jakarta dengan penuh berkah.']
                ],
                'requirements' => [
                    'Paspor minimal berlaku 7 bulan',
                    'KTP & Kartu Keluarga',
                    'Foto 4x6 (10 lembar)',
                    'Surat Mahram (wanita <45 tahun)',
                    'Vaksin Meningitis & Covid-19',
                    'Surat sehat dari dokter'
                ],
                'terms' => [
                    'DP minimal 40% karena high season',
                    'Pelunasan H-45 sebelum keberangkatan',
                    'Pembatalan dikenakan sesuai ketentuan',
                    'Harga final subject to change',
                    'Wajib manasik 2x pertemuan'
                ],
                'badge' => 'Premium'
            ],
            
            3 => [
                'id' => 3,
                'name' => 'Paket Umrah Keberangkatan Syawal',
                'type' => 'umrah',
                'duration' => '12 Hari 10 Malam',
                'price' => 29900000,
                'price_before_discount' => 33000000,
                'discount' => 9,
                'image' => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=800',
                'flyer' => 'umrah-syawal-2026.jpg',
                'airline' => 'Batik Air',
                'available_seats' => 30,
                'departure_date' => 'Mei 2026',
                'departure_route' => 'Padang',
                'description' => 'Umrah setelah Ramadhan dengan harga terjangkau dan fasilitas lengkap. Cocok untuk yang ingin beribadah dengan suasana lebih tenang.',
                'includes' => [
                    'Tiket Pesawat PP (Batik Air)',
                    'Visa Umrah',
                    'Asuransi Perjalanan',
                    'Hotel Bintang 5 Strategis',
                    'Makan 3x Sehari',
                    'Manasik Umrah',
                    'Handling & Airport Tax',
                    'Bus AC Exclusive',
                    'Muthawwif & Tour Leader',
                    'Ziarah Lengkap',
                    'Dokumentasi Profesional',
                    'Sertifikat Umrah',
                    'Air Zam-zam 5L'
                ],
                'hotels' => [
                    'Al Safwah Hotel - Makkah (300m dari Masjidil Haram)',
                    'Hotel Bintang 5 - Madinah (200m dari Masjid Nabawi)'
                ],
                'itinerary' => [
                    ['day' => 'Hari 1-2', 'activity' => 'Keberangkatan Jakarta-Jeddah-Makkah'],
                    ['day' => 'Hari 3-7', 'activity' => 'Pelaksanaan Umrah dan ziarah Makkah'],
                    ['day' => 'Hari 8', 'activity' => 'Perjalanan Makkah-Madinah'],
                    ['day' => 'Hari 9-11', 'activity' => 'Ibadah dan ziarah Madinah'],
                    ['day' => 'Hari 12', 'activity' => 'Kembali ke Indonesia']
                ],
                'requirements' => [
                    'Paspor berlaku minimal 7 bulan',
                    'KTP & KK',
                    'Foto 4x6 (10 lembar)',
                    'Surat Mahram (jika diperlukan)',
                    'Vaksin lengkap',
                    'Surat sehat'
                ],
                'terms' => [
                    'DP 30% dari total paket',
                    'Pelunasan H-30',
                    'Ketentuan pembatalan berlaku',
                    'Harga dapat berubah'
                ],
                'badge' => null
            ],
            
            4 => [
                'id' => 4,
                'name' => 'Paket Umrah Reguler 9 Hari',
                'type' => 'umrah',
                'duration' => '9 Hari',
                'price' => 28000000,
                'image' => 'https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=800',
                'flyer' => 'umrah-reguler-9hari.jpg',
                'airline' => 'Lion Air',
                'available_seats' => 20,
                'departure_date' => 'Tersedia Setiap Bulan',
                'departure_route' => 'Jambi',
                'departure_date' => 'Tersedia Setiap Bulan',
                'description' => 'Paket umrah ekonomis dengan durasi efisien 9 hari. Cocok untuk yang memiliki waktu terbatas namun tetap ingin menunaikan ibadah umrah dengan nyaman.',
                'includes' => [
                    'Tiket Pesawat PP',
                    'Visa Umrah',
                    'Asuransi',
                    'Hotel Bintang 5',
                    'Makan 3x',
                    'Manasik',
                    'Bus AC',
                    'Muthawwif & TL',
                    'Ziarah',
                    'Dokumentasi',
                    'Sertifikat',
                    'Zam-zam 5L'
                ],
                'hotels' => [
                    'Hotel Bintang 5 - Makkah',
                    'Hotel Bintang 5 - Madinah'
                ],
                'itinerary' => [
                    ['day' => 'Hari 1', 'activity' => 'Keberangkatan ke Jeddah'],
                    ['day' => 'Hari 2-5', 'activity' => 'Pelaksanaan Umrah di Makkah'],
                    ['day' => 'Hari 6-8', 'activity' => 'Ibadah dan ziarah Madinah'],
                    ['day' => 'Hari 9', 'activity' => 'Kembali ke Indonesia']
                ],
                'requirements' => [
                    'Paspor berlaku 7 bulan',
                    'KTP & KK',
                    'Foto 4x6',
                    'Vaksin',
                    'Surat sehat'
                ],
                'terms' => [
                    'DP 30%',
                    'Pelunasan H-30',
                    'S&K berlaku'
                ],
                'badge' => null
            ],
            
            5 => [
                'id' => 5,
                'name' => 'Paket Umrah VIP Premium',
                'type' => 'umrah-vip',
                'duration' => '12 Hari',
                'price' => 45000000,
                'price_before_discount' => 52000000,
                'discount' => 13,
                'image' => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=800',
                'flyer' => 'umrah-vip-premium.jpg',
                'airline' => 'Garuda Indonesia - Business Class',
                'available_seats' => 10,
                'departure_date' => 'Flexible Schedule',
                'departure_route' => 'Jakarta',
                'description' => 'Paket umrah VIP dengan layanan bintang 7. Business class flight, hotel super premium direct access Masjid, private handling, dan layanan personal butler.',
                'includes' => [
                    'Business Class Garuda Indonesia',
                    'Hotel 5* Premium Direct Access',
                    'Private Airport Handling',
                    'Personal Butler Service',
                    'Fine Dining Restaurant',
                    'VIP Lounge Access',
                    'Private Transport',
                    'Exclusive City Tour',
                    'Premium Gift Package',
                    'Professional Photography',
                    'Zam-zam 10 Liter',
                    'Luxury Amenities'
                ],
                'hotels' => [
                    'Raffles Makkah Palace - Direct Masjidil Haram',
                    'Oberoi Madinah - Direct Masjid Nabawi'
                ],
                'itinerary' => [
                    ['day' => 'Hari 1-2', 'activity' => 'Business class flight, VIP arrival, luxury hotel check-in'],
                    ['day' => 'Hari 3-7', 'activity' => 'VIP Umrah experience, exclusive ziarah, fine dining'],
                    ['day' => 'Hari 8-11', 'activity' => 'Premium Madinah experience, private tours'],
                    ['day' => 'Hari 12', 'activity' => 'VIP departure dengan kenang-kenangan istimewa']
                ],
                'requirements' => [
                    'Paspor berlaku minimal 7 bulan',
                    'Dokumen standar umrah',
                    'Medical clearance for VIP service'
                ],
                'terms' => [
                    'DP 50% untuk VIP package',
                    'Pelunasan H-60',
                    'Cancellation policy lebih ketat',
                    'Limited to 10 pax per group'
                ],
                'badge' => 'VIP'
            ]
        ];
    }

    /**
     * Find package by ID
     * 
     * @param int $id
     * @return array|null
     */
    public static function find($id)
    {
        $packages = self::getAll();
        return $packages[$id] ?? null;
    }

    /**
     * Get packages by type
     * 
     * @param string $type
     * @return array
     */
    public static function getByType($type)
    {
        $packages = self::getAll();
        
        if ($type === 'all') {
            return $packages;
        }
        
        return array_filter($packages, function($package) use ($type) {
            return $package['type'] === $type;
        });
    }

    /**
     * Get available package types
     * 
     * @return array
     */
    public static function getTypes()
    {
        return [
            'all' => 'Semua Paket',
            'umrah' => 'Umrah Reguler',
            'umrah-vip' => 'Umrah VIP',
            'umrah-ramadhan' => 'Umrah Ramadhan',
            'wisata-halal' => 'Wisata Halal'
        ];
    }

    /**
     * Get formatted package list for dropdown
     * 
     * @return array
     */
    public static function getPackageList()
    {
        $packages = self::getAll();
        $list = [];
        
        foreach ($packages as $id => $package) {
            $list[$id] = $package['name'] . ' (' . $package['duration'] . ') - Rp ' . number_format($package['price'], 0, ',', '.');
        }
        
        return $list;
    }

    /**
     * Check if package has discount
     * 
     * @param int $id
     * @return bool
     */
    public static function hasDiscount($id)
    {
        $package = self::find($id);
        return $package && isset($package['discount']) && $package['discount'] > 0;
    }

    /**
     * Calculate discount amount
     * 
     * @param int $id
     * @return int
     */
    public static function getDiscountAmount($id)
    {
        $package = self::find($id);
        
        if (!$package || !self::hasDiscount($id)) {
            return 0;
        }
        
        return $package['price_before_discount'] - $package['price'];
    }
}