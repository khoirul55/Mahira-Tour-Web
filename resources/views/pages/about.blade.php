@extends('layouts.app')

@section('title', 'Tentang Kami - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
        <p class="hero-tagline">{{ $companyInfo['tagline'] }}</p>
        <p class="hero-desc">Mitra terpercaya perjalanan ibadah Anda sejak {{ $companyInfo['founded'] }}</p>
    </div>
</section>

{{-- QUICK STATS BAR --}}
<section class="quick-stats-bar">
    <div class="container">
        <div class="stats-bar-grid">
            @foreach($stats as $stat)
            <div class="stat-bar-item">
                <div class="stat-bar-icon">
                    <i class="bi {{ $stat['icon'] }}"></i>
                </div>
                <div class="stat-bar-content">
                    <span class="stat-bar-number">{{ $stat['number'] }}</span>
                    <span class="stat-bar-label">{{ $stat['label'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FOUNDER STORY --}}
<section class="founder-story-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Cerita Kami</div>
            <h2 class="section-title">Dari Mimpi Keluarga Kecil,<br>Kini Melayani Ribuan Jamaah</h2>
        </div>
        
        <div class="founder-story-layout">
            {{-- Founder Photos --}}
            <div class="founders-side">
                @foreach($leadership as $leader)
                <div class="founder-card-compact">
                    <div class="founder-photo-compact">
                        @if($leader['name'] == 'Khilal Hamdan')
                            <img src="{{ asset('storage/team/direktur.webp') }}" alt="{{ $leader['name'] }}">
                        @elseif($leader['name'] == 'Nadirman Hamdan')
                            <img src="{{ asset('storage/team/komisaris.webp') }}" alt="{{ $leader['name'] }}">
                        @else
                            <div class="placeholder-compact">
                                <i class="bi bi-person-circle"></i>
                            </div>
                        @endif
                    </div>
                    <h4>Ust. {{ $leader['name'] }}</h4>
                    <p>{{ $leader['position'] }}</p>
                </div>
                @endforeach
            </div>
            
            {{-- Story Content --}}
            <div class="story-side">
                <div class="story-quote">
                    <i class="bi bi-quote"></i>
                    <p>"Tahun 2016, kami berangkat umrah pertama kali. Pengalaman yang mengubah hidup. 
                    Dari situ lahir mimpi: <strong>membantu keluarga Indonesia merasakan momen spiritual yang sama.</strong> 
                    Kami tahu perjalanan ibadah bukan hanya soal tiket dan hotel, tapi tentang membangun kenangan 
                    yang akan diingat selamanya."</p>
                    <span class="quote-author">— Ust. Khilal Hamdan & Ust. Nadirman Hamdan</span>
                </div>
                
                {{-- Timeline --}}
                <div class="timeline-horizontal">
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-year">2016</div>
                        <div class="timeline-content">
                            <h5>Awal Mula</h5>
                            <p>Berangkat umrah pertama kali dan merasakan pengalaman spiritual yang mengubah hidup</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-year">2025</div>
                        <div class="timeline-content">
                            <h5>Resmi Berizin</h5>
                            <p>Mendapat izin resmi PPIU dari Kementerian Agama RI</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-year">2026</div>
                        <div class="timeline-content">
                            <h5>5000+ Jamaah</h5>
                            <p>Telah melayani ribuan keluarga Indonesia dengan penuh dedikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- VISI & MISI --}}
<section class="vision-mission-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Visi & Misi</div>
            <h2 class="section-title">Komitmen Kami Untuk Indonesia</h2>
        </div>
        
        <div class="vision-mission-grid">
            {{-- Vision --}}
            <div class="vision-card">
                <div class="vm-icon">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <h3>Visi</h3>
                <p>{{ $visionMission['vision'] }}</p>
            </div>
            
            {{-- Mission --}}
            <div class="mission-card">
                <div class="vm-icon">
                    <i class="bi bi-bullseye"></i>
                </div>
                <h3>Misi</h3>
                <ul class="mission-list">
                    @foreach($visionMission['missions'] as $mission)
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ $mission }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- OUR VALUES --}}
<section class="values-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Nilai-Nilai Kami</div>
            <h2 class="section-title">Prinsip yang Memandu Langkah Kami</h2>
            <p class="section-subtitle">Nilai-nilai yang kami pegang teguh dalam melayani setiap jamaah</p>
        </div>
        
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h4>Amanah</h4>
                <p>Menjaga kepercayaan jamaah sebagai tanggung jawab utama dalam setiap pelayanan</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-award"></i>
                </div>
                <h4>Profesional</h4>
                <p>Memberikan layanan terbaik dengan standar kualitas tertinggi dan tim berpengalaman</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-heart"></i>
                </div>
                <h4>Ikhlas</h4>
                <p>Melayani dengan hati yang tulus untuk membantu mewujudkan ibadah jamaah</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h4>Peduli</h4>
                <p>Memahami kebutuhan setiap jamaah dan memberikan perhatian penuh di setiap perjalanan</p>
            </div>
        </div>
    </div>
</section>

{{-- LEADERSHIP --}}
<section class="leadership-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Kepemimpinan</div>
            <h2 class="section-title">Tim Pimpinan Mahira Tour</h2>
            <p class="section-subtitle">Dipimpin oleh profesional berpengalaman di bidang travel dan layanan haji & umrah</p>
        </div>
        
        <div class="leader-grid">
            @foreach($leadership as $leader)
            <div class="leader-card">
                <div class="leader-photo">
                    @if($leader['name'] == 'Khilal Hamdan')
                        <img src="{{ asset('storage/team/direktur.webp') }}" alt="{{ $leader['name'] }}" loading="lazy">
                    @elseif($leader['name'] == 'Nadirman Hamdan')
                        <img src="{{ asset('storage/team/komisaris.webp') }}" alt="{{ $leader['name'] }}" loading="lazy">
                    @else
                        <div class="placeholder">
                            <i class="bi bi-person-circle"></i>
                        </div>
                    @endif
                </div>
                
                <div class="leader-info">
                    <h4 class="leader-name">Ust. {{ $leader['name'] }}</h4>
                    <p class="leader-position">
                        <i class="bi bi-award-fill"></i>
                        {{ $leader['position'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        
        {{-- Team Section Placeholder --}}
        @if(count($team) > 0)
        <div class="team-section-inner">
            <h3 class="team-title">Tim Kami</h3>
            <div class="team-grid">
                @foreach($team as $member)
                <div class="team-card">
                    <div class="team-photo">
                        <img src="{{ Storage::url($member['photo']) }}" alt="{{ $member['name'] }}" loading="lazy">
                    </div>
                    <h5>{{ $member['name'] }}</h5>
                    <p>{{ $member['position'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

{{-- TRUST & CERTIFIED --}}
<section class="trust-certified-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Berizin & Terpercaya</div>
            <h2 class="section-title">Legalitas Resmi Mahira Tour</h2>
            <p class="section-subtitle">Terdaftar dan diawasi oleh lembaga resmi pemerintah</p>
        </div>
        
        {{-- PPIU License Card --}}
        <div class="ppiu-license-card">
            <div class="ppiu-icon">
                <i class="bi bi-patch-check-fill"></i>
            </div>
            <div class="ppiu-content">
                <h4>Surat Izin Penyelenggaraan Perjalanan Ibadah Umrah (PPIU)</h4>
                <div class="ppiu-details">
                    <div class="ppiu-detail-item">
                        <span class="label">Nomor Izin</span>
                        <span class="value">{{ $ppiuInfo['number'] }}</span>
                    </div>
                    <div class="ppiu-detail-item">
                        <span class="label">Tanggal Terbit</span>
                        <span class="value">{{ $ppiuInfo['date'] }}</span>
                    </div>
                    <div class="ppiu-detail-item">
                        <span class="label">Diterbitkan Oleh</span>
                        <span class="value">{{ $ppiuInfo['issuer'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Legal Partners --}}
        <div class="legal-grid-compact">
            <div class="legal-card-compact">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/kemenag.png') }}" alt="Kementerian Agama RI" loading="lazy">
                </div>
                <h5>Kementerian Agama RI</h5>
                <p>Berizin Resmi</p>
            </div>
            
            <div class="legal-card-compact">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/siskopatuh.png') }}" alt="Siskopatuh" loading="lazy">
                </div>
                <h5>Siskopatuh</h5>
                <p>Terdaftar</p>
            </div>
            
            <div class="legal-card-compact">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/himpuh.png') }}" alt="HIMPUH" loading="lazy">
                </div>
                <h5>HIMPUH</h5>
                <p>Anggota Resmi</p>
            </div>
        </div>
    </div>
</section>

{{-- BRANCHES --}}
<section class="branches">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">{{ count($branches) }} Cabang di Indonesia</div>
            <h2 class="section-title">Lokasi Cabang Mahira Tour</h2>
            <p class="section-subtitle">Klik kartu cabang atau marker pada peta untuk melihat detail lokasi</p>
        </div>
        
        {{-- Branch Cards Slider --}}
        <div class="branch-cards-wrapper">
            <div class="branch-cards-container" id="branchCardsContainer">
                {{-- Cards will be rendered by JavaScript --}}
            </div>
        </div>
        
        {{-- Map --}}
        <div class="map-wrapper">
            <div id="map"></div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="cta-about">
    <div class="container">
        <div class="cta-content-about">
            <div class="cta-icon">
                <i class="bi bi-kaaba"></i>
            </div>
            <h2>Siap Memulai Perjalanan Spiritual Anda?</h2>
            <p>Hubungi kami untuk konsultasi gratis dan temukan paket yang sesuai kebutuhan Anda</p>
            <div class="cta-buttons-about">
                <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" 
                   class="btn-primary-cta" target="_blank">
                    <i class="bi bi-whatsapp"></i>
                    Konsultasi via WhatsApp
                </a>
                <a href="{{ route('schedule') }}" class="btn-outline-cta">
                    <i class="bi bi-calendar-check"></i>
                    Lihat Jadwal Keberangkatan
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>const branchesData = @json($branches);</script>
<script src="{{ asset('js/about.js') }}"></script>
@endpush