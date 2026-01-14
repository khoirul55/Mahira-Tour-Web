{{-- resources/views/pages/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda - Mahira Tour | Travel Haji & Umrah Terpercaya')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

{{-- 
    STRATEGIC HERO SECTION
    Psychology: Aspiration → Spiritual Anchor → Trust → Dual CTAs
    Optimized for both conversion paths
--}}

<!-- Hero Video Section -->
<section class="hero-video-section">
    <!-- Background Video with Emotional Fallback -->
    <video 
        class="hero-video" 
        autoplay 
        muted 
        loop 
        playsinline
        poster="{{ asset('images/jamaah2.jpg') }}"
    >
        <source src="{{ asset('videos/kaabah-hero.mp4') }}" type="video/mp4">
        <source src="{{ asset('videos/kaabah-hero.webm') }}" type="video/webm">
        <!-- Fallback for browsers that don't support video -->
        <img src="{{ asset('images/jamaah2.jpg') }}" alt="Ka'bah" />
    </video>
    
    <!-- Strategic Gradient Overlay -->
    <div class="hero-overlay"></div>
    
    <!-- Content: Aspiration-First Structure -->
    <div class="hero-content-wrapper">
        <div class="container">
            <div class="hero-content">
                
                {{-- 1. HEADLINE: Lead with Aspiration --}}
                <h1 class="hero-title">
                    Wujudkan Ibadah <span class="highlight">Umrah & Haji</span><br>
                    Bersama Keluarga
                </h1>
                
                {{-- 2. SPIRITUAL ANCHOR: Quranic Reference (Subtle) --}}
                <p class="hero-spiritual">
                    "Dan sempurnakanlah ibadah haji dan umrah karena Allah"
                </p>
                
                {{-- 3. SUPPORTING COPY: Emotional Bridge --}}
                <p class="hero-subtitle">
                    Perjalanan spiritual yang aman, nyaman, dan penuh keberkahan<br>
                    bersama bimbingan profesional dan fasilitas terbaik
                </p>
                
                {{-- 4. TRUST SIGNAL: Now positioned after aspiration --}}
                <div class="hero-badge">
                    <i class="bi bi-shield-check"></i>
                    <span>Terpercaya Sejak 2023 • Resmi Kemenag RI</span>
                </div>
                
                {{-- 5. DUAL CTAs: Respecting Both Paths --}}
                <div class="hero-cta">
                    {{-- Path A: WhatsApp Consultation (Primary) --}}
                    <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" 
                       class="btn-primary"
                       target="_blank"
                       rel="noopener">
                        <i class="bi bi-whatsapp"></i>
                        Konsultasi Gratis
                    </a>
                    
                    {{-- Path B: Explore Packages (Secondary, softer language) --}}
                    <a href="#packages" class="btn-outline">
                        <i class="bi bi-compass"></i>
                        Jelajahi Paket Umrah
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>

{{-- 
    STRATEGIC NOTES:
    
    1. Trust Hierarchy Fixed:
       - Badge moved AFTER headline/spiritual anchor
       - Now: Dream → Feel → Trust → Act
       
    2. Spiritual Anchor Added:
       - Al-Baqarah 2:196 (partial)
       - Subtle, italic, low-key
       - Adds depth without being preachy
       
    3. Path B Language Softened:
       - Changed "Lihat Paket Umrah" → "Jelajahi Paket Umrah"
       - Icon: compass (exploration) instead of eye (viewing)
       - Feels inviting, not transactional
       
    4. Mobile Fallback Strategy:
       - Poster image specified
       - Multiple video formats (mp4 + webm)
       - <img> fallback for no-video-support browsers
       
    5. Performance Optimizations:
       - playsinline for iOS
       - Poster loads immediately while video buffers
       - Will-change CSS hint for smooth animations
--}}

<!-- ==================== STATS SECTION ==================== -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">99%</div>
                <div class="stat-label">Jamaah Puas</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">20+</div>
                <div class="stat-label">Tahun Pengalaman</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">3000+</div>
                <div class="stat-label">Jamaah Dilayani</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">6</div>
                <div class="stat-label">Kantor Cabang</div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== ABOUT SECTION ==================== -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content">
                    <span class="section-badge">Tentang Kami</span>
                    <h2 class="section-title">Mahira Tour<br>Travel Umrah & Haji Terpercaya</h2>
                    <p class="section-text">
                        Mahira Tour adalah perusahaan travel yang fokus pada penyelenggaraan perjalanan Umrah dan Haji. 
                        Berizin resmi dari Kementerian Agama RI, kami berkomitmen memberikan pelayanan terbaik 
                        dengan fasilitas premium dan bimbingan spiritual yang mendalam.
                    </p>
                    
                    <ul class="feature-list">
                        <li><i class="bi bi-check-circle-fill"></i> Izin Resmi Kemenag RI</li>
                        <li><i class="bi bi-check-circle-fill"></i> Pembimbing Berpengalaman</li>
                        <li><i class="bi bi-check-circle-fill"></i> Fasilitas Premium</li>
                        <li><i class="bi bi-check-circle-fill"></i> Harga Kompetitif</li>
                    </ul>
                    
                    <div class="about-buttons">
                        <a href="{{ route('about') }}" class="btn-primary">Tentang Kami</a>
                        <a href="#legalitas" class="btn-text">Lihat Legalitas</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="{{ asset('images/hero/jamaah2.jpeg') }}" alt="Kantor Mahira Tour">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== WHY CHOOSE US SECTION ==================== -->
<section class="why-section">
    <div class="container">
        <div class="section-header-center">
            <span class="section-badge">Mengapa Pilih Kami</span>
            <h2 class="section-title">Keunggulan Mahira Tour</h2>
            <p class="section-subtitle">
                Komitmen kami adalah memberikan pengalaman ibadah yang berkah dan tak terlupakan
            </p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                    <h3 class="why-title">Sesuai Syariat Islam</h3>
                    <p class="why-text">
                        Seluruh program kami mengikuti tuntunan Al-Qur'an dan Sunnah dengan bimbingan ustadz kompeten.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <h3 class="why-title">Izin Resmi</h3>
                    <p class="why-text">
                        Terdaftar dan diawasi langsung oleh Kementerian Agama RI PPIU No : 21062301498960002  
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                         <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <h3 class="why-title">Profesional & Berpengalaman</h3>
                    <p class="why-text">
                        Tim pembimbing dan tour leader yang berpengalaman melayani ribuan jamaah sejak 2016.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== PACKAGE SECTION ==================== -->
<section class="package-section" id="paket">
    <div class="container">
        <div class="section-header-center">
            <span class="section-badge">Paket Istimewa</span>
            <h2 class="section-title">Penawaran Paket Haji dan Umrah</h2>
            <p class="section-subtitle">
                Pilih paket yang sesuai dengan kebutuhan dan kenyamanan spiritual Anda
            </p>
        </div>
        
        <div class="row g-4">
            <!-- Package 1: Umrah Januari -->
            <div class="col-lg-4 col-md-6">
                <div class="package-card">
                    <div class="package-image">
                        <img src="{{ asset('images/hero/umrah-januari.jpeg') }}" alt="Umrah Reguler">
                        <div class="package-badge">Tersedia</div>
                    </div>
                    <div class="package-body">
                        <h3 class="package-title">Paket Umrah Januari</h3>
                        <div class="package-meta">
                            <span><i class="bi bi-calendar"></i>12 hari</span>
                            <span><i class="bi bi-geo-alt"></i> Makkah - Madinah</span>
                        </div>
                        
                        <ul class="package-features">
                            <li><i class="bi bi-check"></i> Hotel Bintang 5</li>
                            <li><i class="bi bi-check"></i> Tiket Pesawat PP</li>
                            <li><i class="bi bi-check"></i> Makan 3x Sehari</li>
                            <li><i class="bi bi-check"></i> Pembimbing Ibadah</li>
                        </ul>
                        
                        <div class="package-footer">
                            <div class="package-price">
                                <span class="price-label">Mulai dari</span>
                                <span class="price-value">Rp 28 Juta</span>
                            </div>
                            <a href="{{ route('schedule', 1) }}" class="btn-package">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Package 2: Umrah Ramadhan  -->
            <div class="col-lg-4 col-md-6">
                <div class="package-card featured">
                    <div class="package-image">
                        <img src="{{ asset('images/hero/umrah-ramadhan.jpeg') }}" alt="Umrah VIP">
                        <div class="package-badge featured">Best Seller</div>
                    </div>
                    <div class="package-body">
                        <h3 class="package-title">Paket Umrah Awal Ramadhan</h3>
                        <div class="package-meta">
                            <span><i class="bi bi-calendar"></i> 12 Hari 10 Malam</span>
                            <span><i class="bi bi-geo-alt"></i> Makkah - Madinah</span>
                        </div>
                        
                        <ul class="package-features">
                            <li><i class="bi bi-check"></i> Hotel View Ka'bah</li>
                            <li><i class="bi bi-check"></i> First Class Ticket</li>
                            <li><i class="bi bi-check"></i> Makan Premium</li>
                            <li><i class="bi bi-check"></i> City Tour</li>
                        </ul>
                        
                        <div class="package-footer">
                            <div class="package-price">
                                <span class="price-label">Mulai dari</span>
                                <span class="price-value">Rp 38 Juta</span>
                            </div>
                            <a href="{{ route('schedule', 2) }}" class="btn-package">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Package 3: Paket Syawal -->
            <div class="col-lg-4 col-md-6">
                <div class="package-card">
                    <div class="package-image">
                        <img src="{{ asset('images/hero/umrah-syawal.jpeg') }}" alt="Umrah Ramadhan">
                        <div class="package-badge">Tersedia</div>
                    </div>
                    <div class="package-body">
                        <h3 class="package-title">Paket Umrah Syawal</h3>
                        <div class="package-meta">
                            <span><i class="bi bi-calendar"></i> 12 Hari 10 Malam</span>
                            <span><i class="bi bi-geo-alt"></i> Makkah - Madinah</span>
                        </div>
                        
                        <ul class="package-features">
                            <li><i class="bi bi-check"></i> Special Ramadhan</li>
                            <li><i class="bi bi-check"></i> Hotel Bintang 5</li>
                            <li><i class="bi bi-check"></i> Sahur & Iftar Premium</li>
                            <li><i class="bi bi-check"></i> Tarawih di Haram</li>
                        </ul>
                        
                        <div class="package-footer">
                            <div class="package-price">
                                <span class="price-label">Mulai dari</span>
                                <span class="price-value">Rp 29 Juta</span>
                            </div>
                            <a href="{{ route('schedule', 3) }}" class="btn-package">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('schedule') }}" class="btn-primary-lg">
                Lihat Semua Paket
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- ==================== TESTIMONIAL SECTION ==================== -->
<section class="testimonial-section">
    <div class="container">
        <div class="section-header-center">
            <span class="section-badge">Testimoni</span>
            <h2 class="section-title">Video Testimoni Jamaah</h2>
            <p class="section-subtitle">
                Dengarkan pengalaman jamaah yang telah merasakan ibadah bersama Mahira Tour
            </p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-video">
                        <iframe 
                            src="https://www.youtube.com/embed/B-JQ7BGS5i8" 
                            title="Testimoni Jamaah Mahira Tour"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen
                            style="width: 100%; height: 100%; border-radius: 12px;">
                        </iframe>
                    </div>
                    <div class="testimonial-content">
                        <h4 class="testimonial-title">Pengalaman Umrah Luar Biasa</h4>
                        <p class="testimonial-name">Jamaah Mahira Tour</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-video">
                        <iframe 
                            src="https://www.youtube.com/embed/lSbViwp5fCA" 
                            title="Testimoni Jamaah Mahira Tour"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen
                            style="width: 100%; height: 100%; border-radius: 12px;">
                        </iframe>
                    </div>
                    <div class="testimonial-content">
                        <h4 class="testimonial-title">Pelayanan Sangat Memuaskan</h4>
                        <p class="testimonial-name">Jamaah Mahira Tour</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-video">
                        <iframe 
                            src="https://www.youtube.com/embed/JgQmegExd5A" 
                            title="Testimoni Jamaah Mahira Tour"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen
                            style="width: 100%; height: 100%; border-radius: 12px;">
                        </iframe>
                    </div>
                    <div class="testimonial-content">
                        <h4 class="testimonial-title">Pengalaman Umrah Luar Biasa</h4>
                        <p class="testimonial-name">Jamaah Mahira Tour</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('testimonials') }}" class="btn-outline-primary">
                Lihat Semua Testimoni
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
{{-- REPLACE GALLERY SECTION (line 389-470) dengan ini --}}

<section class="gallery-section" 
    x-data="{
        galleries: [
            { src: '{{ asset('images/gallery/gallery-1.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-2.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-3.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-4.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-5.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-6.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-7.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-8.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-9.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-10.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-11.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-12.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-13.webp') }}', alt: 'Jamaah Mahira Tour' },
            { src: '{{ asset('images/gallery/gallery-14.webp') }}', alt: 'Jamaah Mahira Tour' }
        ],
        currentIndex: 0,
        modalOpen: false,
        
        openModal(index) {
            this.currentIndex = index;
            this.modalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeModal() {
            this.modalOpen = false;
            document.body.style.overflow = '';
        },
        
        changeGallery(direction) {
            this.currentIndex = (this.currentIndex + direction + this.galleries.length) % this.galleries.length;
        }
    }" 
    @keydown.escape.window="if(modalOpen) closeModal()" 
    @keydown.arrow-left.window="if(modalOpen) changeGallery(-1)" 
    @keydown.arrow-right.window="if(modalOpen) changeGallery(1)">

    <div class="container">
        <div class="section-header-center">
            <span class="section-badge">Galeri</span>
            <h2 class="section-title">Dokumentasi Perjalanan Ibadah</h2>
        </div>
        
        <!-- Grid Gallery -->
        <div class="gallery-grid">
            <template x-for="(item, index) in galleries" :key="index">
                <div class="gallery-item" @click="openModal(index)">
                    <img :src="item.src" :alt="item.alt" loading="lazy">
                    <div class="gallery-overlay">
                        <i class="bi bi-zoom-in"></i>
                    </div>
                </div>
            </template>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('gallery') }}" class="btn-outline-primary">
                Lihat Galeri Lengkap <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    
    <!-- Alpine Modal - FIX: x-cloak + proper display control -->
    <div x-show="modalOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="closeModal()" 
         class="gallery-modal-alpine">
        
        <span class="gallery-close" @click="closeModal()">&times;</span>
        <div class="gallery-counter" x-text="`${currentIndex + 1} / ${galleries.length}`"></div>
        
        <button class="gallery-nav prev" @click="changeGallery(-1)" type="button">
            <i class="bi bi-chevron-left"></i>
        </button>
        
        <div class="gallery-modal-content" @click.stop>
            <img :src="galleries[currentIndex].src" 
                 :alt="galleries[currentIndex].alt"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">
        </div>
        
        <button class="gallery-nav next" @click="changeGallery(1)" type="button">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>
</section>

<!-- ==================== LOCATION SECTION ==================== -->
<section class="location-section">
    <div class="container">
        <div class="section-header-center">
            <span class="section-badge">Lokasi Kami</span>
            <h2 class="section-title">Kunjungi Kantor Pusat Mahira Tour</h2>
            <p class="section-subtitle">
                Jl. Raya Makkah No. 123, Jakarta Selatan 12345
            </p>
        </div>
        
        <div class="location-wrapper">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7974.528410081892!2d101.3896565!3d-2.050239!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2da1004b62a7c9%3A0xdebd36e55d2e3189!2sTravel%20Umroh%20Mahira%20Tour!5e0!3m2!1sid!2sid!4v1766545347293!5m2!1sid!2sid" 
                height="450" 
                style="border:0; border-radius: 16px;" 
                allowfullscreen="" 
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        
        <div class="text-center mt-4">
            <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="btn-primary-lg">
                <i class="bi bi-map"></i>
                Buka di Google Maps
            </a>
        </div>
    </div>
</section>

<section class="partners-section">
    <div class="container">
        <div class="section-header-center">
            <span class="section-badge">Berizin Resmi & Terpercaya</span>
            <h2 class="section-title">Legalitas & Keanggotaan</h2>
            <p class="section-subtitle">
                Terdaftar dan diawasi oleh lembaga resmi pemerintah dan organisasi internasional
            </p>
        </div>
        
        <div class="partners-grid">
            <!-- Kementerian Agama RI -->
            <div class="partner-item">
                <div class="partner-logo-wrapper">
                    <img src="{{ asset('images/partners/kemenag.png') }}" alt="Kementerian Agama RI">
                </div>
                <h4 class="partner-name">Kementerian Agama RI</h4>
                <p class="partner-desc">PPIU No: 21062301498960002</p>
            </div>
            
            <!-- Siskopatuh -->
            <div class="partner-item">
                <div class="partner-logo-wrapper">
                    <img src="{{ asset('images/partners/siskopatuh.png') }}" alt="Siskopatuh">
                </div>
                <h4 class="partner-name">Siskopatuh</h4>
                <p class="partner-desc">Sistem Komputerisasi Haji Terpadu</p>
            </div>
            
            <!-- HIMPUH -->
            <div class="partner-item">
                <div class="partner-logo-wrapper">
                    <img src="{{ asset('images/partners/himpuh.png') }}" alt="HIMPUH">
                </div>
                <h4 class="partner-name">HIMPUH</h4>
                <p class="partner-desc">Himpunan Penyelenggara Umrah Haji</p>
            </div>
        
    </div>
</section>

<!-- ==================== CTA SECTION ==================== -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Siap Berangkat ke Tanah Suci?</h2>
            <p class="cta-subtitle">
                Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik
            </p>
            <div class="cta-buttons">
                <a href="https://wa.me/6282184515310?text=Assalamualaikum%20Mahira%20Tour%2C%20saya%20ingin%20konsultasi%20paket%20umrah" class="btn-cta-primary" target="_blank">
                    <i class="bi bi-whatsapp"></i>
                    Konsultasi via WhatsApp
                </a>
                <a href="{{ route('register') }}" class="btn-cta-secondary">
                    <i class="bi bi-person-plus"></i>
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ==================== FLOATING WHATSAPP BUTTON ==================== -->
<div class="floating-whatsapp">
    <a href="https://wa.me/6282184515310?text=Assalamualaikum%20Mahira%20Tour%2C%20saya%20ingin%20konsultasi%20paket%20umrah" 
       class="whatsapp-button" 
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endpush