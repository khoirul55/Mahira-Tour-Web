<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\HomeController;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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

// ✅ Quick Booking - FIXED: Tambahkan ->name('register')
Route::get('/register', [RegistrationController::class, 'index'])->name('register');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.submit');

// ✅ Dashboard (All-in-One)
Route::get('/dashboard/{reg}', [RegistrationController::class, 'dashboard'])->name('registration.dashboard');


// ✅ Upload DP (dari Dashboard)
Route::post('/register/{id}/payment', [RegistrationController::class, 'submitPayment'])
    ->name('register.payment');
// ============================================

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

// ✅ API Jamaah
Route::get('/api/jamaah/{id}', [RegistrationController::class, 'getJamaahData'])->name('api.jamaah.get');
Route::post('/api/jamaah/{id}', [RegistrationController::class, 'updateJamaahData'])->name('api.jamaah.update');

// Upload Documents
Route::get('/register/{id}/documents', [RegistrationController::class, 'documents'])
    ->name('register.documents');
    
Route::post('/register/{id}/documents', [RegistrationController::class, 'uploadDocuments'])
    ->name('register.documents.upload');


    // ============================================
// CHECK REGISTRATION STATUS
// ============================================

Route::get('/cek-pendaftaran', function() {
    return view('pages.check-registration');
})->name('check.registration.form');

Route::post('/cek-pendaftaran', function() {
    $validated = request()->validate([
        'registration_number' => 'required|string',
        'email' => 'required|email'
    ]);
    
    $registration = \App\Models\Registration::where('registration_number', $validated['registration_number'])
        ->where('email', $validated['email'])
        ->first();
    
    if (!$registration) {
        return back()
            ->withErrors(['error' => 'Nomor registrasi atau email tidak ditemukan. Pastikan data yang Anda masukkan benar.'])
            ->withInput();
    }
    
    // Generate/get token
    $token = $registration->generateAccessToken();
    
    // Redirect to dashboard
    return redirect()->route('registration.dashboard', [
        'reg' => $registration->registration_number,
        'token' => $token
    ]);
})->name('check.registration.submit');

// ============================================
// ADMIN PANEL
// ============================================

// Admin Login Form
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

// Admin Login Submit
Route::post('/admin/login', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    
    // Cari admin berdasarkan email
    $admin = Admin::where('email', $validated['email'])->first();
    
    // Validasi password
    if ($admin && Hash::check($validated['password'], $admin->password)) {
        session([
            'admin_logged_in' => true,
            'admin_id' => $admin->id,
            'admin_name' => $admin->name,        // ← PENTING!
            'admin_email' => $admin->email
        ]);
        
        return redirect()->route('admin.dashboard')
            ->with('success', 'Login berhasil! Selamat datang, ' . $admin->name);
    }
    
    return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
})->name('admin.login.submit');

// Admin Logout
Route::get('/admin/logout', function () {
    session()->flush();
    return redirect()->route('admin.login')->with('success', 'Logout berhasil');
})->name('admin.logout');


/**
 * ============================================
 * ROUTES ADMIN LENGKAP - COPY KE web.php
 * ============================================
 * 
 * Ganti semua admin routes yang ada dengan ini
 */

Route::middleware(['admin.auth'])->prefix('admin')->group(function() {
    
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    // Verify Payment
    Route::post('/verify-payment/{id}', [App\Http\Controllers\AdminController::class, 'verifyPayment'])
        ->name('admin.verify-payment');
    // Tab Perlu Pelunasan
    Route::get('/pelunasan', [App\Http\Controllers\AdminController::class, 'pelunasan'])
        ->name('admin.pelunasan.index');
    
    // Kirim Tagihan Manual
    Route::post('/pelunasan/{id}/send-tagihan', [App\Http\Controllers\AdminController::class, 'sendTagihan'])
        ->name('admin.pelunasan.send-tagihan');
    
    // Verifikasi Pelunasan
    Route::post('/pelunasan/{id}/verify', [App\Http\Controllers\AdminController::class, 'verifyPelunasan'])
        ->name('admin.pelunasan.verify');


// ========== USER ROUTES - PELUNASAN ==========
Route::post('/registration/{id}/submit-pelunasan', [RegistrationController::class, 'submitPelunasan'])
    ->name('registration.submit-pelunasan');
    // ============================================
    // REGISTRATIONS
    // ============================================
    Route::get('/registrations', [App\Http\Controllers\AdminController::class, 'registrations'])
        ->name('admin.registrations.index');
    
    Route::get('/registrations/export', [App\Http\Controllers\AdminController::class, 'exportRegistrations'])
        ->name('admin.registrations.export');
    
    Route::get('/registrations/{id}', [App\Http\Controllers\AdminController::class, 'showRegistration'])
        ->name('admin.registrations.show');
    
    Route::get('/registrations/{id}/export', [App\Http\Controllers\AdminController::class, 'exportSingleRegistration'])
        ->name('admin.registrations.export-single');
    
    // ============================================
    // DOCUMENTS
    // ============================================
    Route::post('/documents/{id}/verify', [App\Http\Controllers\AdminController::class, 'verifyDocument'])
        ->name('admin.documents.verify');
    
    Route::get('/documents/download-all/{registrationId}', [App\Http\Controllers\AdminController::class, 'downloadAllDocuments'])
        ->name('admin.documents.download-all');
    
    // ============================================
    // PASSPORT
    // ============================================
    Route::post('/passport/{jamaahId}/process', [App\Http\Controllers\AdminController::class, 'processPassport'])
        ->name('admin.passport.process');
    
    // ============================================
    // GALLERIES
    // ============================================
    Route::prefix('galleries')->name('admin.galleries.')->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\GalleryController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\GalleryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle', [App\Http\Controllers\Admin\GalleryController::class, 'toggleStatus'])->name('toggle');
    });
    
    // ============================================
    // SCHEDULES
    // ============================================
    Route::prefix('schedules')->name('admin.schedules.')->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\ScheduleController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\ScheduleController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\ScheduleController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\ScheduleController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\ScheduleController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\ScheduleController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle', [App\Http\Controllers\Admin\ScheduleController::class, 'toggleStatus'])->name('toggle');
        Route::post('/{id}/quota', [App\Http\Controllers\Admin\ScheduleController::class, 'updateQuota'])->name('quota');
    });
});

// ============================================
// API ROUTES (untuk user dashboard)
// ============================================
// Tambahkan di luar middleware admin

Route::post('/api/jamaah/{id}/passport-request', function(Request $request, $id) {
    $jamaah = \App\Models\Jamaah::findOrFail($id);
    
    $jamaah->update([
        'need_passport' => $request->need_passport ?? true,
        'passport_request_at' => now()
    ]);
    
    return response()->json([
        'success' => true,
        'message' => 'Request passport berhasil disimpan'
    ]);
})->name('api.jamaah.passport-request');
// ROUTE FALLBACK (404 Page)
// ============================================

Route::fallback(function () {
    return view('errors.404');
});