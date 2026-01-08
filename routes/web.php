<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\HomeController;

/**
 * ========================================
 * MAHIRA TOUR - FRONTEND ROUTES
 * ========================================
 */

// ============================================
// HALAMAN UTAMA (PUBLIC)
// ============================================

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

Route::get('/jadwal', [ScheduleController::class, 'index'])->name('schedule');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

Route::post('/kontak', function () {
    $validated = request()->validate([
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'subject' => 'required',
        'message' => 'required|min:10'
    ]);
    
    return redirect()->route('contact')
        ->with('success', 'Terima kasih! Pesan Anda telah terkirim. Tim Mahira Tour akan segera menghubungi Anda.');
})->name('contact.submit');



// ============================================
// QUICK BOOKING - DASHBOARD
// ============================================

Route::get('/dashboard/{reg}', [RegistrationController::class, 'dashboard'])
    ->name('registration.dashboard');

// ============================================
// PENDAFTARAN - MENGGUNAKAN CONTROLLER
// ============================================

Route::get('/pendaftaran', [RegistrationController::class, 'index'])->name('register');
Route::post('/pendaftaran', [RegistrationController::class, 'store'])->name('register.submit');

Route::get('/register', fn() => redirect()->route('register'));

Route::get('/register/documents/{registration}', [RegistrationController::class, 'documents'])->name('register.documents');
Route::post('/register/documents/{registration}', [RegistrationController::class, 'uploadDocuments'])->name('register.documents.upload');
Route::get('/register/payment/{registration}', [RegistrationController::class, 'payment'])->name('register.payment');
Route::post('/register/payment/{registration}', [RegistrationController::class, 'submitPayment'])->name('register.payment.submit');
Route::get('/register/success/{registration}', [RegistrationController::class, 'success'])->name('register.success');

// ✅ Lanjut ke halaman tambahan...

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

Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

Route::get('/testimoni', [TestimonialController::class, 'index'])->name('testimonials');

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

Route::get('/visi-misi', function () {
    return redirect()->route('about');
})->name('vision-mission');

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


// ============================================
// API ENDPOINTS FOR DASHBOARD
// ============================================

Route::get('/api/jamaah/{id}', [RegistrationController::class, 'getJamaahData'])->name('api.jamaah.get');
Route::put('/api/jamaah/{id}', [RegistrationController::class, 'updateJamaahData']);
// ============================================
// ROUTE FALLBACK (404 Page)
// ============================================

Route::fallback(function () {
    return view('errors.404');
});