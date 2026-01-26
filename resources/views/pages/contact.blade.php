@extends('layouts.app')

@section('title', 'Hubungi Kami - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link rel="stylesheet" href="{{ asset('css/cta.css') }}">
@endpush

@section('content')
<section class="page-hero">
    <div class="page-hero-background">
        <img src="{{ asset('images/hero/hero-contact.webp') }}" alt="Hubungi Mahira Tour" fetchpriority="high" loading="eager">
    </div>
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
        <div class="hero-breadcrumb">
            <a href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i> Beranda</a>
            <span>/</span>
            <span>Hubungi Kami</span>
        </div>
        <h1>
            <span class="hero-text-line slide-left">Hubungi</span> 
            <span class="hero-text-line slide-right">Kami</span>
        </h1>
        <p class="hero-tagline">UMRAH BERSAMA, BERKAH BERSAMA</p>
        <p class="hero-desc">Kami siap membantu Anda mewujudkan perjalanan spiritual yang berkesan</p>
    </div>
</section>

<section class="quick-contact-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">Kontak Cepat</div>
            <h2 class="section-title">Cara Menghubungi Kami</h2>
            <p class="section-subtitle">Pilih metode komunikasi yang paling nyaman untuk Anda</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h4 class="contact-title">WhatsApp</h4>
                    <div class="contact-info">
                        Chat langsung dengan tim kami<br>
                        <a href="https://wa.me/{{ $contactInfo['whatsapp'] }}" target="_blank">{{ $contactInfo['phone'] }}</a>
                    </div>
                    <a href="https://wa.me/{{ $contactInfo['whatsapp'] }}" target="_blank" class="contact-action">
                        <i class="bi bi-chat-dots-fill"></i> Chat Sekarang
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h4 class="contact-title">Telepon</h4>
                    <div class="contact-info">
                        Hubungi kami melalui telepon<br>
                        <a href="tel:{{ $contactInfo['phone'] }}">{{ $contactInfo['phone'] }}</a>
                    </div>
                    <a href="tel:{{ $contactInfo['phone'] }}" class="contact-action">
                        <i class="bi bi-telephone-fill"></i> Telepon Kami
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <h4 class="contact-title">Email</h4>
                    <div class="contact-info">
                        Kirim email kepada kami<br>
                        <a href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a>
                    </div>
                    <a href="mailto:{{ $contactInfo['email'] }}" class="contact-action">
                        <i class="bi bi-send-fill"></i> Kirim Email
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h4 class="contact-title">Kantor Pusat</h4>
                    <div class="contact-info">{{ $contactInfo['main_office'] }}</div>
                    <a href="https://maps.google.com/?q={{ urlencode($contactInfo['main_office']) }}" target="_blank" class="contact-action">
                        <i class="bi bi-map-fill"></i> Lihat Peta
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-instagram"></i>
                    </div>
                    <h4 class="contact-title">Instagram</h4>
                    <div class="contact-info">
                        Follow untuk update terbaru<br>
                        <a href="https://instagram.com/{{ str_replace('@', '', $contactInfo['instagram']) }}" target="_blank">{{ $contactInfo['instagram'] }}</a>
                    </div>
                    <a href="https://instagram.com/{{ str_replace('@', '', $contactInfo['instagram']) }}" target="_blank" class="contact-action">
                        <i class="bi bi-instagram"></i> Follow Kami
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <h4 class="contact-title">Jam Operasional</h4>
                    <div class="contact-info">
                        <strong>Senin - Jumat</strong><br>
                        {{ $contactInfo['hours']['weekday'] }}<br>
                        <strong>Sabtu</strong><br>
                        {{ $contactInfo['hours']['saturday'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="form-map-section">
    <div class="container">
        <div class="form-map-container">
            <div class="form-card" data-aos="fade-right">
                <h3>Kirim Pesan</h3>
                <p>Isi formulir di bawah dan tim kami akan segera menghubungi Anda</p>
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon *</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Subjek *</label>
                            <select name="subject" class="form-select" required>
                                <option value="">Pilih Subjek</option>
                                <option value="Informasi Paket">Informasi Paket</option>
                                <option value="Jadwal Keberangkatan">Jadwal Keberangkatan</option>
                                <option value="Konsultasi Umrah">Konsultasi Umrah</option>
                                <option value="Pembayaran">Pembayaran</option>
                                <option value="Keluhan">Keluhan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Pesan *</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send-fill"></i> Kirim Pesan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="map-card" data-aos="fade-left">
                <div class="map-header">
                    <h3>Lokasi Kantor Pusat</h3>
                    <p>Jl. Muradi No. 19, RT 000/RW 000, Kel. Koto Lolo, Kec. Pesisir Bukit, Kota Sungai Penuh, Jambi</p>
                </div>
                <iframe 
                    id="map"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7974.528410081892!2d101.3896565!3d-2.050239!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2da1004b62a7c9%3A0xdebd36e55d2e3189!2sTravel%20Umroh%20Mahira%20Tour!5e0!3m2!1sid!2sid!4v1766545347293!5m2!1sid!2sid" 
                    allowfullscreen="" 
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div class="map-action">
                    <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="btn-map">
                        <i class="bi bi-map-fill"></i>
                        Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">FAQ</div>
            <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
            <p class="section-subtitle">Temukan jawaban atas pertanyaan umum seputar layanan kami</p>
        </div>

        <!-- TAMBAHKAN x-data di sini -->
        <div class="faq-accordion" x-data="{ activeIndex: null }">
            
            <!-- FAQ 1 -->
            <div class="faq-item" :class="{ 'active': activeIndex === 0 }">
                <div class="faq-question" @click="activeIndex = activeIndex === 0 ? null : 0">
                    <span>Bagaimana cara mendaftar paket umrah?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer" x-show="activeIndex === 0" x-transition>
                    <div class="faq-answer-content">
                        Anda bisa mendaftar melalui kantor kami, WhatsApp, atau mengisi formulir di website. Tim kami akan membantu proses pendaftaran dari awal hingga keberangkatan.
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item" :class="{ 'active': activeIndex === 1 }">
                <div class="faq-question" @click="activeIndex = activeIndex === 1 ? null : 1">
                    <span>Apakah tersedia sistem cicilan?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer" x-show="activeIndex === 1" x-transition>
                    <div class="faq-answer-content">
                        Ya, kami menyediakan program cicilan dengan DP 30% dan pelunasan H-30 sebelum keberangkatan. Hubungi tim kami untuk informasi lebih detail.
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item" :class="{ 'active': activeIndex === 2 }">
                <div class="faq-question" @click="activeIndex = activeIndex === 2 ? null : 2">
                    <span>Dokumen apa saja yang diperlukan?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer" x-show="activeIndex === 2" x-transition>
                    <div class="faq-answer-content">
                        Dokumen yang diperlukan: KTP asli, Kartu Keluarga, Paspor (minimal berlaku 7 bulan), pas foto 4x6 berlatar putih, dan buku nikah (untuk yang sudah menikah).
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item" :class="{ 'active': activeIndex === 3 }">
                <div class="faq-question" @click="activeIndex = activeIndex === 3 ? null : 3">
                    <span>Berapa lama proses pengurusan visa umrah?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer" x-show="activeIndex === 3" x-transition>
                    <div class="faq-answer-content">
                        Proses pengurusan visa umrah membutuhkan waktu sekitar 14-21 hari kerja. Kami akan menginformasikan perkembangan proses visa Anda secara berkala.
                    </div>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-item" :class="{ 'active': activeIndex === 4 }">
                <div class="faq-question" @click="activeIndex = activeIndex === 4 ? null : 4">
                    <span>Apakah harga sudah termasuk manasik?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer" x-show="activeIndex === 4" x-transition>
                    <div class="faq-answer-content">
                        Ya, harga paket sudah termasuk bimbingan manasik, perlengkapan umrah, dan pendampingan oleh pembimbing berpengalaman selama di tanah suci.
                    </div>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="faq-item" :class="{ 'active': activeIndex === 5 }">
                <div class="faq-question" @click="activeIndex = activeIndex === 5 ? null : 5">
                    <span>Bagaimana jika ada perubahan jadwal keberangkatan?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer" x-show="activeIndex === 5" x-transition>
                    <div class="faq-answer-content">
                        Kami akan menginformasikan setiap perubahan jadwal kepada jamaah. Jika terjadi perubahan, kami akan membantu proses reschedule atau refund sesuai kebijakan yang berlaku.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@include('partials.cta-section')

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });
</script>
@endpush