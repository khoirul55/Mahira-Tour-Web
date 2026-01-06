@extends('layouts.app')

@section('title', 'Tentang Kami - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')

{{-- HERO - STYLE SAMA DENGAN GALLERY --}}
<section class="hero">
    <!-- Background Image -->
    <div class="hero-background">
        <img src="{{ asset('storage/hero/hero-about.jpeg') }}" 
             alt="Tentang Mahira Tour" 
             loading="eager">
    </div>
    
    <!-- Overlay -->
    <div class="hero-overlay"></div>
    
    <!-- Content -->
    <div class="hero-content">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">
                <i class="bi bi-house-door-fill"></i> Beranda
            </a>
            <span>/</span>
            <span>Tentang Kami</span>
        </div>
        <h1>
            <span class="word">Tentang</span> 
            <span class="word">Mahira Tour</span>
        </h1>
        <p>{{ $companyInfo['tagline'] }} - Mitra terpercaya perjalanan ibadah Anda sejak 2016</p>
    </div>
</section>



<!-- LEGALITAS - UPDATED WITH IMAGES -->
<section class="legalitas">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">Berizin Resmi & Terpercaya</div>
            <h2 class="section-title">Legalitas & Keanggotaan</h2>
            <p class="section-subtitle">Terdaftar dan diawasi oleh lembaga resmi pemerintah dan organisasi internasional</p>
        </div>
        
        <div class="legal-grid">
            <!-- Kementerian Agama RI -->
            <div class="legal-card">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/kemenag.png') }}" 
                         alt="Kementerian Agama RI"
                         loading="lazy">
                </div>
                <h4 class="legal-title">Kementerian Agama RI</h4>
                <p class="legal-desc">Penyelenggara Perjalanan Ibadah Umrah (PPIU) Resmi</p>
                <span class="legal-number">21062301498960002</span>
            </div>
            
            <!-- Siskopatuh -->
            <div class="legal-card">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/siskopatuh.png') }}" 
                         alt="Siskopatuh"
                         loading="lazy">
                </div>
                <h4 class="legal-title">Siskopatuh</h4>
                <p class="legal-desc">Sistem Komputerisasi Haji Terpadu Kemenag RI</p>
            </div>
            
            <!-- HIMPUH -->
            <div class="legal-card">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/himpuh.png') }}" 
                         alt="HIMPUH"
                         loading="lazy">
                </div>
                <h4 class="legal-title">HIMPUH</h4>
                <p class="legal-desc">Himpunan Penyelenggara Umrah & Haji Indonesia</p>
            </div>
        </div>
    </div>
</section>
<!-- PROFILE - SINGLE HERO IMAGE (OPSI 1) -->
<section class="profile-section-hero">
    <div class="container">
        <!-- Hero Image -->
        <div class="profile-hero-image">
            <img src="{{ asset('storage/gallery/gallery-6.webp') }}" 
                 alt="Mahira Tour Office" 
                 loading="lazy">
            <div class="hero-overlay1"></div>
        </div>
        
        <!-- Profile Content -->
        <div class="profile-content-centered">
            <div class="section-badge">Profil Perusahaan</div>
            <h2 class="profile-title">{{ $companyInfo['name'] }}</h2>
            <p class="profile-description">{{ $companyInfo['description'] }}</p>
            
            <!-- Info Grid (4 Kolom) -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <div class="info-text">
                        <span class="info-label">Berdiri sejak</span>
                        <strong class="info-value">{{ $companyInfo['founded'] }}</strong>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-shield-fill-check"></i>
                    </div>
                    <div class="info-text">
                        <span class="info-label">Izin PPIU Resmi</span>
                        <strong class="info-value">{{ $companyInfo['ppiu_date'] }}</strong>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="info-text">
                        <span class="info-label">Cabang</span>
                        <strong class="info-value">7 Kota</strong>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="info-text">
                        <span class="info-label">Jamaah Terlayani</span>
                        <strong class="info-value">3000+</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- VISION & MISSION - FLAT LAYOUT -->
<section class="vision-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title-main">Visi dan Misi</h2>
            <h3 class="section-subtitle-main">Komitmen Kami Dalam Membimbing Jamaah</h3>
        </div>
        
        <div class="vision-content-flat">
            <!-- VISI -->
            <div class="vision-box-flat">
                <div class="vision-icon-flat">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <h3>Visi</h3>
                <p>{{ $visionMission['vision'] }}</p>
            </div>
            
            <!-- MISI -->
            <div class="mission-box-flat">
                <div class="mission-icon-flat">
                    <i class="bi bi-bullseye"></i>
                </div>
                <h3>Misi</h3>
                <ul class="mission-list-flat">
                    <li>Menyediakan Produk Layanan yang Variatif dan kompetitif sesuai kebutuhan pelanggan</li>
                    <li>Menjaga & Memproteksi kepercayaan perusahaan kami</li>
                    <li>Memberikan Generasi Baru yang Profesional</li>
                    <li>Melayani dengan dedikasi, keikhlasan, dan nilai-nilai keislaman</li>
                    <li>Bimbingan lengkap untuk pemahaman dan penghayatan ibadah</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- LEADERSHIP - SQUARE CARD (OPSI 1) -->
<section class="leadership">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">Kepemimpinan</div>
            <h2 class="section-title">Pimpinan Mahira Tour</h2>
            <p class="section-subtitle">Dipimpin oleh profesional berpengalaman di bidang travel dan layanan haji & umrah</p>
        </div>
        
        <div class="leader-grid-square">
            @foreach($leadership as $leader)
            <div class="leader-card-square">
                <div class="leader-photo-square">
                    @if($leader['name'] == 'Khilal Hamdan')
                        <img src="{{ asset('storage/team/direktur.webp') }}" 
                             alt="Khilal Hamdan" 
                             loading="lazy">
                    @elseif($leader['name'] == 'Nadirman Hamdan')
                        <img src="{{ asset('storage/team/komisaris.webp') }}" 
                             alt="Nadirman Hamdan" 
                             loading="lazy">
                    @else
                        <div class="placeholder">
                            <i class="bi bi-person-circle"></i>
                        </div>
                    @endif
                </div>
                
                <div class="leader-info-square">
                    <h4 class="leader-name-square">{{ $leader['name'] }}</h4>
                    <p class="leader-position-square">
                        <i class="bi bi-award-fill"></i>
                        {{ $leader['position'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- BRANCHES - SIMPLE LIST -->
<section class="branches" style="padding: 100px 0; background: var(--light-bg);">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">7 Cabang di Indonesia</div>
            <h2 class="section-title">Lokasi Cabang Mahira Tour</h2>
            <p class="section-subtitle">Klik marker atau pilih cabang untuk melihat detail lokasi</p>
        </div>
        
        <div class="map-wrapper">
            <!-- SIDEBAR -->
            <div class="branch-sidebar">
                <div class="sidebar-header">
                    <h3>Pilih Cabang</h3>
                    <p>Klik untuk melihat di peta</p>
                </div>
                
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari kota...">
                    <i class="bi bi-search"></i>
                </div>
                
                <div id="branchList"></div>
            </div>
            
            <!-- MAP -->
            <div id="map"></div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <div class="container">
        <h3>Siap Memulai Perjalanan Spiritual Anda?</h3>
        <p>Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik</p>
        <div class="cta-buttons">
            <a href="{{ route('schedule') }}" class="btn btn-white">
                <i class="bi bi-box-seam"></i>
                Lihat Paket Kami
            </a>
            <a href="https://wa.me/6282184515310" class="btn btn-gold" target="_blank">
                <i class="bi bi-whatsapp"></i>
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>// ===== LEAFLET MAP =====
const branchesData = @json($branches);</script>
<script src="{{ asset('js/about.js') }}"></script>
@endpush
