<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PackageDetailController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;

/**
 * ========================================
 * MAHIRA TOUR - FRONTEND ROUTES
 * ========================================
 * Travel Umrah & Wisata Halal
 * Berdasarkan Company Profile Resmi
 * Menggunakan Closure Route
 * ========================================
 */

// ============================================
// HALAMAN UTAMA (PUBLIC)
// ============================================

/**
 * Halaman Beranda
 * URL: /
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('home');
/**
 * Halaman Tentang Kami
 * URL: /tentang-kami
 */
Route::get('/tentang-kami', [AboutController::class, 'index'])
    ->name('about');

Route::get('/paket/{id}', [PackageDetailController::class, 'show'])
    ->name('package.detail');

/**
 * Halaman Jadwal Keberangkatan
 * URL: /jadwal
 */
Route::get('/jadwal', [ScheduleController::class, 'index'])
    ->name('schedule');
/**
 * Halaman Kontak
 * URL: /kontak
 */
Route::get('/kontak', [ContactController::class, 'index'])
    ->name('contact');

/**
 * Handle Submit Form Kontak
 */
Route::post('/kontak', function () {
    $validated = request()->validate([
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'subject' => 'required',
        'message' => 'required|min:10'
    ]);
    
    // TODO: Kirim email atau simpan ke database
    
    return redirect()->route('contact')
        ->with('success', 'Terima kasih! Pesan Anda telah terkirim. Tim Mahira Tour akan segera menghubungi Anda.');
})->name('contact.submit');


// ============================================
// HALAMAN TAMBAHAN
// ============================================

/**
 * Halaman FAQ
 */
Route::get('/faq', function () {
    $faqs = [
        [
            'category' => 'Persyaratan',
            'question' => 'Apa saja persyaratan untuk mendaftar umrah?',
            'answer' => 'Persyaratan umrah: Mengisi Formulir Pendaftaran, Membayar DP, Pas Foto 4x6 (2 lembar), Paspor minimal berlaku 7 bulan, dan Materai 10.000 (4 lembar).'
        ],
        [
            'category' => 'Persyaratan',
            'question' => 'Bagaimana cara membuat paspor?',
            'answer' => 'Syarat pembuatan paspor: KTP Asli + Fotocopy 2 lembar, KK Asli + Fotocopy 2 lembar, Akte Kelahiran/Ijazah SD/SMP/SMA, dan Buku Nikah (Asli + Fotocopy) 2 lembar.'
        ],
        [
            'category' => 'Fasilitas',
            'question' => 'Apa saja fasilitas yang didapat?',
            'answer' => 'Fasilitas lengkap: Tiket Pesawat PP, Visa, Asuransi, Hotel Bintang 5, Makan 3x, Manasik, Bus Eksklusif, Muthawwif & TL, Wisata Islami, Foto Dokumentasi, Sertifikat, dan Air Zam-zam 5L.'
        ],
        [
            'category' => 'Hotel',
            'question' => 'Hotel apa yang digunakan?',
            'answer' => 'Kami menggunakan hotel bintang 5 seperti Al Safwah, Rayyana, atau Grand Al Massa di Makkah, serta hotel berkualitas di Madinah.'
        ],
        [
            'category' => 'Keberangkatan',
            'question' => 'Dari mana saja jalur keberangkatan?',
            'answer' => 'Mahira Tour melayani keberangkatan dari: Lampung, Padang, Jambi, Jakarta, dan Bengkulu. Kami memiliki 6 cabang di Indonesia untuk kemudahan Anda.'
        ],
        [
            'category' => 'Pembayaran',
            'question' => 'Bagaimana sistem pembayaran?',
            'answer' => 'Anda dapat membayar DP terlebih dahulu, kemudian melunasi sebelum keberangkatan. Detail pembayaran akan dijelaskan saat pendaftaran.'
        ],
        [
            'category' => 'Maskapai',
            'question' => 'Maskapai apa yang bekerja sama dengan Mahira Tour?',
            'answer' => 'Kami bekerja sama dengan 5 maskapai: Garuda Indonesia, Saudi Airlines, Batik Air, Lion Air, dan Super Air Jet.'
        ],
        [
            'category' => 'Bimbingan',
            'question' => 'Apakah ada bimbingan sebelum keberangkatan?',
            'answer' => 'Ya, kami menyediakan Manasik Umrah (bimbingan ibadah) sebelum keberangkatan agar jamaah siap secara fisik dan spiritual.'
        ]
    ];
    
    return view('pages.faq', compact('faqs'));
})->name('faq');


/**
 * Halaman Galeri
 * URL: /galeri
 */
Route::get('/galeri', [GalleryController::class, 'index'])
    ->name('gallery');

/**
 * Halaman Testimoni
 */
Route::get('/testimoni', [TestimonialController::class, 'index'])
    ->name('testimonials');

/**
 * Halaman Layanan
 */
Route::get('/layanan', function () {
    $services = [
        [
            'id' => 1,
            'icon' => 'bi-airplane-fill',
            'title' => 'Paket Umrah Reguler',
            'description' => 'Paket perjalanan Umrah dengan jadwal tetap, dilengkapi dengan akomodasi dan transportasi yang nyaman. Hotel bintang 5, makan 3x sehari, dan bimbingan ibadah lengkap.',
            'features' => [
                'Hotel Bintang 5 (Al Safwah, Rayyana, Grand Al Massa)',
                'Tiket Pesawat PP',
                'Visa & Asuransi',
                'Makan 3x Sehari',
                'Bus Exclusive',
                'Muthawwif & Tour Leader',
                'Perlengkapan Lengkap',
                'Air Zam-zam 5L'
            ],
            'starting_price' => 28000000
        ],
        [
            'id' => 2,
            'icon' => 'bi-star-fill',
            'title' => 'Paket Umrah VIP',
            'description' => 'Paket perjalanan Umrah eksklusif dengan fasilitas premium dan layanan personal. Hotel super dekat dengan Masjidil Haram untuk kemudahan ibadah Anda.',
            'features' => [
                'Hotel Premium dekat Masjidil Haram',
                'Layanan Personal',
                'Porter & Handling Premium',
                'Makan di Restoran',
                'City Tour',
                'Ziarah Lengkap',
                'Air Zam-zam 10L',
                'Dokumentasi Profesional'
            ],
            'starting_price' => 45000000
        ],
        [
            'id' => 3,
            'icon' => 'bi-moon-stars-fill',
            'title' => 'Paket Umrah Ramadhan',
            'description' => 'Paket perjalanan Umrah khusus di bulan suci Ramadhan dengan pengalaman ibadah yang lebih mendalam. Nikmati sahur dan berbuka bersama jamaah lainnya.',
            'features' => [
                'Semua Fasilitas Umrah Reguler',
                'Sahur & Berbuka Bersama',
                'Kajian Ramadhan',
                'Tarawih di Masjidil Haram',
                'Tadarus Al-Quran',
                'I\'tikaf di Masjidil Haram'
            ],
            'starting_price' => 38000000
        ],
        [
            'id' => 4,
            'icon' => 'bi-globe-asia-australia',
            'title' => 'Wisata Halal Internasional',
            'description' => 'Perjalanan wisata ke berbagai destinasi internasional yang menyediakan fasilitas dan makanan halal. Jelajahi keindahan dunia dengan tetap menjaga nilai-nilai Islam.',
            'features' => [
                'Berbagai Destinasi Islami',
                'Fasilitas 100% Halal',
                'Makanan Halal Terjamin',
                'Tour Guide Berpengalaman',
                'Transportasi Nyaman',
                'Waktu Sholat Teratur'
            ],
            'starting_price' => 35000000
        ],
        [
            'id' => 5,
            'icon' => 'bi-book-fill',
            'title' => 'Konsultasi & Bimbingan Umrah',
            'description' => 'Layanan konsultasi dan bimbingan ibadah Umrah sebelum keberangkatan untuk memastikan jamaah siap secara fisik dan spiritual.',
            'features' => [
                'Manasik Umrah Lengkap',
                'Bimbingan Tata Cara Ibadah',
                'Konsultasi Kesehatan',
                'Tips & Trik Umrah',
                'Persiapan Mental & Spiritual',
                'Buku Panduan Umrah'
            ],
            'starting_price' => 'Gratis untuk jamaah'
        ]
    ];
    
    return view('pages.services', compact('services'));
})->name('services');


/**
 * Halaman Visi Misi
 */
Route::get('/visi-misi', function () {
    return redirect()->route('about');
})->name('vision-mission');


/**
 * Halaman Cabang
 */
Route::get('/cabang', function () {
    $branches = [
        [
            'name' => 'Kantor Pusat',
            'region' => 'Sungai Penuh',
            'address' => 'Jl. Muradi, Desa Koto Keras, Kecamatan Pesisir Bukit, Kota Sungai Penuh',
            'phone' => '0821 8451 5310',
            'email' => 'info@mahiratour.co.id',
            'maps_url' => '#',
            'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400',
            'is_main' => true
        ],
        [
            'name' => 'Regional Sumatera Barat',
            'region' => 'Padang',
            'address' => 'Jl. Raya Taruko 1 / Manunggal 3 No 66 A, RT 5 RW 8, Korong Gadang, Kec. Kuranji, Kota Padang',
            'phone' => '-',
            'email' => 'padang@mahiratour.co.id',
            'maps_url' => '#',
            'image' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=400',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Jambi',
            'region' => 'Jambi',
            'address' => 'Jl. Sunan Gunung Djati RT.28, Kenali Asam, Kota Baru, Jambi',
            'phone' => '-',
            'email' => 'jambi@mahiratour.co.id',
            'maps_url' => '#',
            'image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=400',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Jakarta Timur',
            'region' => 'Jakarta',
            'address' => 'Jl. Tegal Amba No 6, Desa Lorong Sawit, Kec. Lorong Sawit, Jakarta Timur',
            'phone' => '-',
            'email' => 'jakarta@mahiratour.co.id',
            'maps_url' => '#',
            'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=400',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Padang Utara',
            'region' => 'Padang',
            'address' => 'Jl. Pategangan, Gang L No. 4, RT. 004, RW. 003, Air Tawar Barat, Padang Utara',
            'phone' => '-',
            'email' => 'padangutara@mahiratour.co.id',
            'maps_url' => '#',
            'image' => 'https://images.unsplash.com/photo-1497366858526-0766cadbe8fa?w=400',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Bengkulu',
            'region' => 'Bengkulu',
            'address' => 'Jl. Sutoyo 6, Kelurahan Tanah Patah, Kec. Ratu Agung, Kota Bengkulu, RW. 02, RT. 19, No. 72',
            'phone' => '-',
            'email' => 'bengkulu@mahiratour.co.id',
            'maps_url' => '#',
            'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=400',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Merangin',
            'region' => 'Merangin',
            'address' => 'Muara Panco Barat, Kec. Renah Pembarap, Kabupaten Merangin',
            'phone' => '-',
            'email' => 'merangin@mahiratour.co.id',
            'maps_url' => '#',
            'image' => 'https://images.unsplash.com/photo-1497366412874-3415097a27e7?w=400',
            'is_main' => false
        ]
    ];
    
    return view('pages.branches', compact('branches'));
})->name('branches');


/**
 * Halaman Syarat & Ketentuan
 */
Route::get('/syarat-ketentuan', function () {
    $requirements = [
        'umrah' => [
            'Mengisi Formulir Pendaftaran',
            'Membayar Down Payment (DP)',
            'Pas Foto 4x6 sebanyak 2 Lembar',
            'Paspor (minimal berlaku 7 bulan)',
            'Materai 10.000 sebanyak 4 Lembar'
        ],
        'passport' => [
            'KTP Asli + Fotocopy 2 Lembar',
            'KK Asli + Fotocopy 2 Lembar',
            'Akte Kelahiran / Ijazah SD/SMP/SMA',
            'Buku Nikah (Asli + Fotocopy) 2 Lembar'
        ]
    ];
    
    $terms = [
        'Pembayaran DP minimal 30% dari total biaya paket',
        'Pelunasan dilakukan maksimal H-30 sebelum keberangkatan',
        'Pembatalan oleh jamaah dikenakan biaya sesuai ketentuan yang berlaku',
        'Dokumen yang sudah diserahkan tidak dapat dikembalikan',
        'Harga paket dapat berubah sewaktu-waktu mengikuti kebijakan pemerintah',
        'Jamaah wajib mengikuti manasik umrah yang diselenggarakan',
        'Mahira Tour berhak membatalkan keberangkatan jika kuota minimal tidak terpenuhi',
        'Force majeure (bencana alam, wabah, perang, dll) menjadi tanggung jawab bersama'
    ];
    
    return view('pages.terms', compact('requirements', 'terms'));
})->name('terms');

/**
 * Halaman Pendaftaran
 * URL: /pendaftaran
 */
Route::get('/pendaftaran', function () {
    $packages = [
        1 => 'Paket Umrah Reguler 9 Hari - Rp 28.000.000',
        2 => 'Paket Umrah VIP Premium - Rp 45.000.000',
        3 => 'Paket Umrah Ramadhan - Rp 38.000.000',
        4 => 'Wisata Halal Internasional - Mulai Rp 35.000.000'
    ];
    
    $departure_routes = [
        'Start Lampung',
        'Start Padang',
        'Start Jambi',
        'Start Jakarta',
        'Start Bengkulu'
    ];
    
    $provinces = [
        'Lampung', 'Sumatera Barat', 'Jambi', 'DKI Jakarta', 'Bengkulu',
        'Sumatera Utara', 'Sumatera Selatan', 'Riau', 'Kepulauan Riau',
        'Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'Banten', 'Yogyakarta'
    ];
    
    $titles = ['Tn.', 'Ny.', 'Sdr.', 'Sdri.', 'H.', 'Hj.'];
    
    return view('pages.register', compact('packages', 'departure_routes', 'provinces', 'titles'));
})->name('register');

Route::get('/register', fn() => redirect()->route('register'));


/**
 * Handle Submit Pendaftaran
 */
Route::post('/pendaftaran', function () {
    $validated = request()->validate([
        'title' => 'required',
        'full_name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'package_id' => 'required',
        'departure_route' => 'required',
        'departure_date' => 'required|date',
        'num_people' => 'required|integer|min:1',
        'message' => 'nullable|string'
    ]);
    
    // TODO: Simpan ke database atau kirim notifikasi
    
    return redirect()->route('register')
        ->with('success', 'Pendaftaran Anda berhasil! Tim Mahira Tour akan segera menghubungi Anda di nomor ' . $validated['phone']);
})->name('register.submit');


// ============================================
// ROUTE FALLBACK (404 Page)
// ============================================

Route::fallback(function () {
    return view('errors.404');
});