@extends('layouts.app')

@section('title', 'Tentang Kami - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <style>
        .story-section-title { font-family: 'Lora', serif; margin-bottom: 2rem; line-height: 1.3; }
        
        /* Animation Classes */
        .story-block { 
            margin-bottom: 5rem; 
            opacity: 0; 
            transform: translateY(30px); 
            transition: all 0.8s ease-out; 
        }
        .story-block.visible { 
            opacity: 1; 
            transform: translateY(0); 
        }
        
        .story-block:last-child { margin-bottom: 0; }
        /* Literary Story Style */
        .story-narrative-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .story-narrative {
            font-family: 'Lora', serif; /* Font bergaya buku */
            font-size: 1.15rem;
            line-height: 1.9;
            color: var(--dark);
            text-align: justify; /* Rata kanan-kiri agar rapi seperti buku */
        }

        .story-narrative p {
            margin-bottom: 2rem;
        }

        /* Drop Cap untuk huruf pertama */
        .drop-cap {
            float: left;
            font-size: 5rem;
            line-height: 0.8;
            margin-top: 0.1em;
            margin-right: 0.1em; /* Reduced spacing */
            color: var(--accent);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        /* Float Image Wrapper for Caption */
        .story-img-wrapper {
            float: right;
            width: 40%;
            margin-left: 2rem;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .story-float-img {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .story-caption {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: var(--gray);
            font-style: italic;
            font-family: 'Lora', serif;
        }

        /* Ornament Separator */
        .story-separator {
            text-align: center;
            margin: 3rem 0;
            color: var(--accent);
            font-size: 1.5rem;
            opacity: 0.6;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }
        .story-separator::before, .story-separator::after {
            content: '';
            height: 1px;
            width: 50px;
            background: var(--accent);
            opacity: 0.3;
        }

        @media(max-width: 768px) {
            .story-img-wrapper {
                float: none;
                width: 100%;
                margin: 2rem 0;
            }
            .story-narrative {
                text-align: left; /* Mobile lebih enak rata kiri */
            }
        }
    </style>
@endpush

@section('content')

{{-- HERO --}}
{{-- HERO --}}
<section class="page-hero">
    <div class="page-hero-background">
        <img src="{{ asset('images/hero/hero-about.webp') }}" alt="Tentang Mahira Tour" fetchpriority="high" loading="eager">
    </div>
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
        <div class="hero-breadcrumb">
            <a href="{{ route('home') }}">
                <i class="bi bi-house-door-fill"></i> Beranda
            </a>
            <span>/</span>
            <span>Tentang Kami</span>
        </div>
        <h1>
            <span class="hero-text-line slide-left">Tentang</span> 
            <span class="hero-text-line slide-right">Mahira Tour</span>
        </h1>
        <p class="hero-tagline">{{ $companyInfo['tagline'] }}</p>
        <p class="hero-desc">Mitra terpercaya perjalanan ibadah Anda sejak {{ $companyInfo['founded'] }}</p>
    </div>
</section>

{{-- COMPANY STORY (Literary Style) --}}
<section class="founder-story-section">
    <div class="container">
        {{-- 1. TITLE --}}
        <div class="section-header-center">
            <div class="section-badge">Tentang Kami</div>
            <h2 class="section-title">Lebih Dari Sekadar Perjalanan</h2>
        </div>
        
        {{-- 2. NARRATIVE --}}
        <div class="story-narrative-container">
            <div class="story-narrative story-block visible">
                <p>
                    <span class="drop-cap">C</span>erita ini tidak dimulai di kantor yang megah, pun tidak bermula dari rencana bisnis yang rumit. Semuanya berawal pada tahun 2016, di tengah lautan manusia yang memutih di Masjidil Haram. Saat itu, untuk pertama kalinya kening kami bersujud di depan Ka'bah. Ada getaran hebat yang menjalar—sebuah rasa rindu yang akhirnya terobati, bercampur dengan kedamaian yang sulit dilukiskan kata-kata.
                </p>
                
                {{-- Float Image inserted naturally into text flow --}}
                <div class="story-img-wrapper">
                    <img src="{{ asset('images/hero/video-poster.webp') }}" alt="Suasana Jamaah Mahira Tour" class="story-float-img">
                    <span class="story-caption">Suasana kekhusyukan jamaah bersama Mahira Tour</span>
                </div>

                <p>
                    Di sela-sela doa yang rapuh itu, mata kami menangkap wajah-wajah jamaah lain. Ada yang kebingungan mencari arah, ada yang cemas menanti rombongan, namun tak sedikit pula yang tersenyum lega. Detik itu juga, sebuah niat terpatri dalam hati: <strong style="color:var(--primary)">Setiap Muslim berhak merasakan kekhusyukan ini tanpa harus terusik rasa was-was.</strong> Kami ingin menjadi jembatan bagi rindu-rindu itu.
                </p>

                <p>
                    Perjalanan merintis Mahira Tour bukanlah jalan yang lurus tanpa kerikil. Kami belajar, tertatih, dan berbenah. Dari sekadar membantu tetangga dan kerabat, amanah itu perlahan membesar. Kami sadar, melayani tamu Allah tidak bisa hanya bermodal semangat. Dibutuhkan profesionalitas, kejujuran, dan sistem yang kokoh.
                </p>

                <p>
                    Kini, setelah ribuan jamaah kami antarkan, semangat itu tidak berubah sediplin pun. Justru ia semakin menyala. Bagi kami, Mahira Tour bukan sekadar biro perjalanan; ia adalah wadah persaudaraan, tempat di mana kami melayani Anda bukan sebagai klien, melainkan sebagai keluarga sendiri di Tanah Suci.
                </p>
                
                {{-- Ornament Separator --}}
                <div class="story-separator">
                    <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                    <i class="bi bi-diamond-fill" style="font-size: 0.6rem;"></i>
                    <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                </div>
            </div>
            
            {{-- 3. IMPACT / TITIK BALIK --}}
            <div class="story-block">
                <div class="impact-box">
                    <h3 style="font-family: 'Lora', serif; margin-bottom: 2rem; font-size: 2rem;">Menjaga Amanah dengan Profesionalitas</h3>
                    <p style="max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; opacity: 0.9;">
                        Alhamdulillah, komitmen kami telah terwujud dengan izin resmi PPIU Kementerian Agama RI. Ribuan jamaah telah membuktikan bahwa ibadah yang tenang dimulai dari kepercayaan.
                    </p>
                    
                    <div style="display: flex; justify-content: center; gap: 4rem; flex-wrap: wrap;">
                        <div class="stat">
                            <div class="impact-number">2.000+</div>
                            <div class="impact-label">Hati yang Tertaut</div>
                        </div>
                        <div class="stat">
                            <div class="impact-number">100%</div>
                            <div class="impact-label">Resmi & Amanah</div>
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
                <p>Kami menempatkan kejujuran di atas segalanya. Apa yang kami sampaikan, itulah yang akan Anda dapatkan. Tidak ada janji manis yang tak ditepati.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-award"></i>
                </div>
                <h4>Profesional</h4>
                <p>Didukung sistem yang rapi dan tim yang berpengalaman, kami memastikan setiap detail perjalanan Anda terurus dengan baik.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-heart"></i>
                </div>
                <h4>Melayani dengan Hati</h4>
                <p>Kami melayani Anda bukan sebagai klien, tapi sebagai tamu Allah yang mulia. Empati dan kehangatan adalah bahasa utama kami.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h4>Peduli</h4>
                <p>Memahami kebutuhan setiap jamaah dan memberikan perhatian penuh, karena setiap cerita perjalanan Anda berharga bagi kami.</p>
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
                <button class="btn-view-ppiu" onclick="openPpiuModal()">
                    <i class="bi bi-file-earmark-text"></i> Lihat Surat Izin
                </button>
            </div>
        </div>
        
        {{-- Legal Partners --}}
        <div class="legal-grid-compact">
            <div class="legal-card-compact">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/kemenag.webp') }}" alt="Kementerian Agama RI" loading="lazy">
                </div>
                <h5>Kementerian Agama RI</h5>
                <p>Berizin Resmi</p>
            </div>
            
            <div class="legal-card-compact">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/siskopatuh.webp') }}" alt="Siskopatuh" loading="lazy">
                </div>
                <h5>Siskopatuh</h5>
                <p>Terdaftar</p>
            </div>
            
            <div class="legal-card-compact">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/himpuh.webp') }}" alt="HIMPUH" loading="lazy">
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
                <i class="bi bi-moon-stars-fill"></i>
            </div>
            <h2>Mari Jemput Rindu Itu</h2>
            <p>Panggilan itu mungkin sudah terdengar di hati Anda. Jika saatnya telah tiba, izinkan kami menemani langkah Anda menuju Rumah-Nya.</p>
            <div class="cta-buttons-about">
                <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" 
                   class="btn-primary-cta" target="_blank">
                    <i class="bi bi-whatsapp"></i>
                    Hubungi Kami untuk Konsultasi
                </a>
                <a href="{{ route('schedule') }}" class="btn-outline-cta">
                    <i class="bi bi-calendar-check"></i>
                    Lihat Jadwal
                </a>
            </div>
        </div>
    </div>
</section>

{{-- PPIU Modal --}}
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

@endsection


@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>const branchesData = JSON.parse('{!! addslashes(json_encode($branches)) !!}');</script>
<script src="{{ asset('js/about.js') }}"></script>
<script>
    function openPpiuModal() {
        document.getElementById('ppiuModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closePpiuModal() {
        document.getElementById('ppiuModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Scroll Animation Observer
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.2, // Trigger when 20% of the element is visible
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target); // Run once
                }
            });
        }, observerOptions);

        document.querySelectorAll('.story-block').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endpush
