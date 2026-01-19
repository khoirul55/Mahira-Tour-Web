{{-- resources/views/pages/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda - Mahira Tour | Travel Haji & Umrah Terpercaya')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css?v=2.0') }}">
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
                    <span>Terpercaya Sejak 2016 • Resmi Kemenag RI</span>
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
<!-- ==================== ABOUT SECTION - STORYTELLING APPROACH ==================== -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content">
                    <!-- Micro Badge -->
                    <div class="section-badge">Cerita Kami</div>
                    
                    <!-- Emotional Hook -->
                    <h2 class="section-title">
                        Dari Mimpi Keluarga Kecil,<br>
                        Kini Melayani Ribuan Jamaah
                    </h2>
                    
                    <!-- Founder Story (Personal) -->
                    <p class="founder-quote">
                        "Tahun 2016, kami berangkat umrah pertama kali. 
                        Pengalaman yang mengubah hidup. Dari situ lahir mimpi: 
                        <strong>membantu keluarga Indonesia merasakan momen spiritual yang sama.</strong>"
                        <span class="quote-author">— Ust.Khilal Hamdan & Ust. Nadirman Hamdan, Founder Mahira Tour</span>
                    </p>
                    
                    <!-- Proof Points (Data-driven) -->
                    <div class="trust-metrics">
                        <div class="metric">
                            <strong>2016</strong>
                            <span>Tahun didirikan</span>
                        </div>
                        <div class="metric">
                            <strong>1,234</strong>
                            <span>Jamaah terlayani</span>
                        </div>
                        <div class="metric">
                            <strong>4.9/5</strong>
                            <span>Rating testimoni</span>
                        </div>
                    </div>
                    
                    <!-- Single Strong CTA -->
                    <a href="{{ route('about') }}" class="btn-story">
                        Baca Cerita Lengkap 
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="{{ asset('images/hero/jamaah2.jpeg') }}" alt="Tim Mahira Tour bersama jamaah">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== WHY CHOOSE US SECTION ==================== -->
<section class="why-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Mengapa Pilih Kami</div>
            <h2 class="section-title">Komitmen Kami untuk Ibadah Anda</h2>
            <p class="section-subtitle">
                Perjalanan spiritual yang penuh makna dimulai dengan kepercayaan
            </p>
        </div>
        
        <div class="row g-4">
            <!-- Card 1: Syariat -->
            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                    <h3 class="why-title">Sesuai Tuntunan Syariat</h3>
                    <p class="why-text">
                        Seluruh ibadah dipandu sesuai Al-Qur'an dan Sunnah dengan pembimbing bersertifikat Kemenag RI.
                    </p>
                </div>
            </div>
            
            <!-- Card 2: Legal -->
            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <h3 class="why-title">Berizin Resmi Kemenag</h3>
                    <p class="why-text">
                        PPIU No: 21062301498960002 dengan audit rutin dan standar pelayanan tertinggi.
                    </p>
                </div>
            </div>
            
            <!-- Card 3: Experience -->
            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <h3 class="why-title">Berpengalaman Sejak 2023</h3>
                    <p class="why-text">
                        Telah melayani 5000+ jamaah dengan testimoni yang nyata.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- MOVE THIS SECTION AFTER "WHY CHOOSE US" --}}

<!-- ==================== STATS SECTION ==================== -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">5000+</div>
                <div class="stat-label">Jamaah Terlayani</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">15+</div>
                <div class="stat-label">Tahun Berpengalaman</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">45+</div>
                <div class="stat-label">Paket Keberangkatan/Tahun</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">100%</div>
                <div class="stat-label">Izin Resmi Kemenag</div>
            </div>
        </div>
    </div>
</section>

{{-- 
    PLACEMENT ORDER (correct flow):
    1. Hero
    2. About
    3. Why Us
    4. STATS (proof of claims) ← YOU ARE HERE
    5. Packages
--}}

<!-- ==================== PACKAGE SECTION ==================== -->
<section class="package-section" id="paket">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">Paket Istimewa</div>
            <h2 class="section-title">Pilih Paket Sesuai Kebutuhan Anda</h2>
            <p class="section-subtitle">
                Setiap paket dirancang dengan perhatian penuh untuk kenyamanan dan kekhusyukan ibadah Anda
            </p>
        </div>
        
        <div class="package-grid">
            <!-- Package 1: Umrah Januari -->
            <div class="package-card">
                <div class="package-image">
                    <img src="{{ asset('images/hero/umrah-januari.jpeg') }}" alt="Paket Umrah Januari">
                </div>
                
                <div class="quick-info">
                    <h3 class="package-title">Umrah Januari 2026</h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <span class="info-text">24 Januari 2026 • <span class="info-highlight">12 Hari</span></span>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <span class="info-text">Padang - Kuala Lumpur - Jeddah</span>
                        </div>
                        
                        <div class="info-divider"></div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-tag"></i>
                            </div>
                            <span class="info-text">Mulai dari <span class="info-highlight">Rp 28,9 juta</span></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Package 2: Umrah Ramadhan (Featured) -->
            <div class="package-card featured">
                <div class="featured-badge">Paling Diminati</div>
                
                <div class="package-image">
                    <img src="{{ asset('images/hero/umrah-ramadhan.jpeg') }}" alt="Paket Umrah Ramadhan">
                </div>
                
                <div class="quick-info">
                    <h3 class="package-title">Umrah Awal Ramadhan</h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <span class="info-text">23 Februari 2026 • <span class="info-highlight">12 Hari</span></span>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <span class="info-text">Padang - Jeddah</span>
                        </div>
                        
                        <div class="info-divider"></div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-tag"></i>
                            </div>
                            <span class="info-text">Mulai dari <span class="info-highlight">Rp 38,9 juta</span></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Package 3: Umrah Syawal -->
            <div class="package-card">
                <div class="package-image">
                    <img src="{{ asset('images/hero/umrah-syawal.jpeg') }}" alt="Paket Umrah Syawal">
                </div>
                
                <div class="quick-info">
                    <h3 class="package-title">Umrah Keberangkatan Syawal</h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <span class="info-text">23 Februari 2026 • <span class="info-highlight">12 Hari</span></span>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <span class="info-text">Padang - Kuala Lumpur</span>
                        </div>
                        
                        <div class="info-divider"></div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-tag"></i>
                            </div>
                            <span class="info-text">Mulai dari <span class="info-highlight">Rp 29,9 juta</span></span>
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
            <div class="section-badge">Testimoni</div>
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
            <div class="section-badge">Lokasi Kami</div>
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
            <div class="section-badge">Berizin Resmi & Terpercaya</div>
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
        
        {{-- Button Lihat Surat Izin --}}
        <div class="text-center mt-4">
            <button class="btn-view-legalitas" onclick="openPpiuModal()">
                <i class="bi bi-file-earmark-text"></i> Lihat Surat Izin PPIU
            </button>
        </div>
    </div>
</section>

{{-- PPIU Modal Home --}}
<div id="ppiuModal" class="ppiu-modal" onclick="if(event.target===this)closePpiuModal()">
    <div class="ppiu-modal-content">
        <button class="ppiu-modal-close" onclick="closePpiuModal()">
            <i class="bi bi-x-lg"></i>
        </button>
        <h4><i class="bi bi-file-earmark-check"></i> Surat Izin PPIU</h4>
        <div class="ppiu-modal-image">
            <img src="{{ Storage::url('surat/suratizin.jpg') }}" alt="Surat Izin PPIU Mahira Tour" loading="lazy">
        </div>
        <a href="{{ Storage::url('surat/suratizin.jpg') }}" download class="btn-download-ppiu">
            <i class="bi bi-download"></i> Download Surat Izin
        </a>
    </div>
</div>


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
<script>
function openPpiuModal() {
    document.getElementById('ppiuModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closePpiuModal() {
    document.getElementById('ppiuModal').classList.remove('active');
    document.body.style.overflow = '';
}
</script>
@endpush