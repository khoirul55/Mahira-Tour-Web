@extends('layouts.app')

@section('title', 'Tentang Kami - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="hero-background">
        <img src="{{ asset('storage/hero/hero-about.jpeg') }}" alt="Tentang Mahira Tour" loading="eager">
    </div>
    <div class="hero-overlay"></div>
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

{{-- PROFILE --}}
<section class="profile-section-hero">
    <div class="container">
        <div class="profile-hero-image">
            <img src="{{ asset('storage/gallery/gallery-6.webp') }}" alt="Mahira Tour Office" loading="lazy">
        </div>
        
        <div class="profile-content-centered">
            <div class="section-badge">Profil Perusahaan</div>
            <h2 class="profile-title">{{ $companyInfo['name'] }}</h2>
            <p class="profile-description">{{ $companyInfo['description'] }}</p>
            
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
            
            </div>
        </div>
    </div>
</section>

{{-- VISION & MISSION --}}
<section class="vision-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title-main">Visi dan Misi</h2>
        </div>
        
        <div class="vision-content-flat">
            <div class="vision-box-flat">
                <div class="vision-icon-flat">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <h3>Visi</h3>
                <p>{{ $visionMission['vision'] }}</p>
            </div>
            
            <div class="mission-box-flat">
                <div class="mission-icon-flat">
                    <i class="bi bi-bullseye"></i>
                </div>
                <h3>Misi</h3>
                <ul class="mission-list-flat">
                    <li>Menyediakan Produk Layanan yang Variatif dan kompetitif</li>
                    <li>Menjaga & Memproteksi kepercayaan perusahaan</li>
                    <li>Memberikan Generasi Baru yang Profesional</li>
                    <li>Melayani dengan dedikasi dan keikhlasan</li>
                    <li>Bimbingan lengkap untuk pemahaman ibadah</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- LEADERSHIP --}}
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
                        <img src="{{ asset('storage/team/direktur.webp') }}" alt="Khilal Hamdan" loading="lazy">
                    @elseif($leader['name'] == 'Nadirman Hamdan')
                        <img src="{{ asset('storage/team/komisaris.webp') }}" alt="Nadirman Hamdan" loading="lazy">
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

{{-- LEGALITAS --}}
<section class="legalitas">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">Berizin Resmi & Terpercaya</div>
            <h2 class="section-title">Legalitas & Keanggotaan</h2>
            <p class="section-subtitle">Terdaftar dan diawasi oleh lembaga resmi pemerintah</p>
        </div>
        
        <div class="legal-grid">
            <div class="legal-card">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/kemenag.png') }}" alt="Kementerian Agama RI" loading="lazy">
                </div>
                <h4 class="legal-title">Kementerian Agama RI</h4>
                <p class="legal-desc">Penyelenggara Perjalanan Ibadah Umrah Resmi</p>
                <span class="legal-number">21062301498960002</span>
            </div>
            
            <div class="legal-card">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/siskopatuh.png') }}" alt="Siskopatuh" loading="lazy">
                </div>
                <h4 class="legal-title">Siskopatuh</h4>
                <p class="legal-desc">Sistem Komputerisasi Haji Terpadu</p>
            </div>
            
            <div class="legal-card">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/himpuh.png') }}" alt="HIMPUH" loading="lazy">
                </div>
                <h4 class="legal-title">HIMPUH</h4>
                <p class="legal-desc">Himpunan Penyelenggara Umrah Haji</p>
            </div>
        </div>
    </div>
</section>

{{-- BRANCHES --}}
<section class="branches">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">7 Cabang di Indonesia</div>
            <h2 class="section-title">Lokasi Cabang Mahira Tour</h2>
            <p class="section-subtitle">Klik marker atau pilih cabang untuk melihat detail lokasi</p>
        </div>
        
        <div class="map-wrapper">
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
            
            <div id="map"></div>
        </div>
    </div>
</section>



@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>const branchesData = @json($branches);</script>
<script src="{{ asset('js/about.js') }}"></script>
@endpush