<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/**
 * ========================================
 * MAHIRA TOUR - FRONTEND ROUTES
 * ========================================
 */

// ============================================
// HALAMAN UTAMA (PUBLIC)
// ============================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [AboutController::class, 'index'])->name('about');
Route::get('/jadwal', [ScheduleController::class, 'index'])->name('schedule');
Route::get('/jadwal/{id}/{slug?}', [ScheduleController::class, 'show'])->name('schedule.detail');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// Kontak Submit
Route::post('/kontak', function () {
    // Note: Idealnya dipindah ke ContactController@store, tapi untuk sekarang kita biarkan logic simple ini
    // atau jika user ingin, kita pindahkan nanti.
    // UPDATE: Memindahkan logic validasi ini ke Controller adalah langkah selanjutnya yang baik.
    request()->validate([
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'subject' => 'required',
        'message' => 'required|min:10'
    ]);
    
    return redirect()->route('contact')
        ->with('success', 'Terima kasih! Pesan Anda telah terkirim. Tim Mahira Tour akan segera menghubungi Anda.');
})->name('contact.submit'); // TODO: Move to ContactController



// DEBUG EMAIL ROUTE (Will be removed later)
Route::get('/test-email', function() {
    // Force Clear Cache for this request (optional hack)
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    
    try {
        $config = config('mail');
        \Illuminate\Support\Facades\Mail::raw('Tes kirim email dari Mahira Tour (Debug Mode). Jika ini masuk, berarti SMTP Sukses.', function($msg) {
            $msg->to('info@mahiratour.id')->subject('Test Email SMTP Mahira Tour');
        });
        dd("BERHASIL! Email Terkirim. Cek Inbox Zoho Anda.\n\nConfig: " . $config['host'] . ":" . $config['port']);
    } catch (\Exception $e) {
        dd("GAGAL! Pesan Error:\n" . $e->getMessage());
    }
});


// ============================================
// LAYANAN & HALAMAN STATIS LAINNYA
// ============================================

// Route::get('/layanan', [PublicController::class, 'services'])->name('services'); // Removed as per user request
Route::get('/visi-misi', function () { return redirect()->route('about'); })->name('vision-mission');
// Route::get('/cabang', [PublicController::class, 'branches'])->name('branches'); // Removed as per user request
// Route::get('/syarat-ketentuan', [PublicController::class, 'terms'])->name('terms'); // Removed as per user request


// ============================================
// GALERI & TESTIMONI
// ============================================

Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
Route::get('/testimoni', [TestimonialController::class, 'index'])->name('testimonials');


// ============================================
// PENDAFTARAN & DASHBOARD JAMAAH
// ============================================

// 1. Form Quick Booking
Route::get('/register', [RegistrationController::class, 'index'])->name('register');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.submit');

// 2. Cek Pendaftaran (Login Jamaah)
Route::get('/cek-pendaftaran', [PublicController::class, 'checkRegistrationForm'])->name('check.registration.form');
Route::post('/cek-pendaftaran', [PublicController::class, 'checkRegistrationSubmit'])->name('check.registration.submit');

// 3. Dashboard Jamaah (Protected by Token logic inside controller)
Route::prefix('dashboard/{reg}')->group(function() {
    Route::get('/', [RegistrationController::class, 'dashboard'])->name('registration.dashboard');
});

// 4. Upload & Payment Actions
Route::post('/register/{id}/payment', [RegistrationController::class, 'submitPayment'])->name('register.payment');
Route::post('/registration/{id}/submit-pelunasan', [RegistrationController::class, 'submitPelunasan'])->name('registration.submit-pelunasan');
Route::get('/register/{id}/documents', [RegistrationController::class, 'documents'])->name('register.documents');
Route::post('/register/{id}/documents', [RegistrationController::class, 'uploadDocuments'])->name('register.documents.upload');

// 5. API Internal untuk Dashboard Jamaah
Route::get('/api/jamaah/{id}', [RegistrationController::class, 'getJamaahData'])->name('api.jamaah.get');
Route::post('/api/jamaah/{id}', [RegistrationController::class, 'updateJamaahData'])->name('api.jamaah.update');
Route::post('/api/jamaah/{id}/passport-request', [RegistrationController::class, 'passportRequest'])->name('api.jamaah.passport-request');


// ============================================
// ADMIN PANEL AUTHENTICATION
// ============================================

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


// ============================================
// ADMIN PANEL DASHBOARD & FEATURES
// ============================================

Route::middleware(['admin.auth'])->prefix('admin')->group(function() {
    
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Payment Verification
    Route::post('/verify-payment/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'verify'])->name('admin.verify-payment');
    
    // Pelunasan Management
    Route::get('/pelunasan', [App\Http\Controllers\Admin\PaymentController::class, 'pelunasan'])->name('admin.pelunasan.index');
    Route::post('/pelunasan/{id}/send-tagihan', [App\Http\Controllers\Admin\PaymentController::class, 'sendTagihan'])->name('admin.pelunasan.send-tagihan');
    Route::post('/pelunasan/{id}/verify', [App\Http\Controllers\Admin\PaymentController::class, 'verifyPelunasan'])->name('admin.pelunasan.verify');

    // Registration Management
    Route::prefix('registrations')->name('admin.registrations.')->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\RegistrationController::class, 'index'])->name('index');
        Route::get('/export', [App\Http\Controllers\Admin\RegistrationController::class, 'export'])->name('export');
        Route::get('/{id}', [App\Http\Controllers\Admin\RegistrationController::class, 'show'])->name('show');
        Route::get('/{id}/export', [App\Http\Controllers\Admin\RegistrationController::class, 'exportSingle'])->name('export-single');
    });
    
    // Document Management
    Route::post('/documents/{id}/verify', [App\Http\Controllers\Admin\DocumentController::class, 'verify'])->name('admin.documents.verify');
    Route::get('/documents/download-all/{registrationId}', [App\Http\Controllers\Admin\DocumentController::class, 'downloadAll'])->name('admin.documents.download-all');
    
    // Passport Management
    Route::post('/passport/{jamaahId}/process', [App\Http\Controllers\Admin\DocumentController::class, 'processPassport'])->name('admin.passport.process');
    
    // Content Management: Galleries
    Route::prefix('galleries')->name('admin.galleries.')->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('index'); // Full namespace to avoid conflict if any
        Route::get('/create', [App\Http\Controllers\Admin\GalleryController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\GalleryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle', [App\Http\Controllers\Admin\GalleryController::class, 'toggleStatus'])->name('toggle');
    });
    
    // Content Management: Schedules
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
    
    // Secure File Access
    // Secure File Access (Via Query String untuk menghindari Nginx Static File 404)
    Route::get('/secure-file', [App\Http\Controllers\PrivateFileController::class, 'show'])
        ->name('admin.secure.file');

});

// ============================================
// FALLBACK
// ============================================

Route::fallback(function () {
    return view('errors.404');
});
