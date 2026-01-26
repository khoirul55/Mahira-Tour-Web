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
{{-- ZIG-ZAG SECTIONS (Story to Vision) --}}
<section class="zigzag-section">
    <div class="container">
        
        {{-- BLOCK 1: STORY (Text Left, Image Right) --}}
        <div class="row align-items-center zigzag-row">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="zigzag-content">
                    <h2 class="zigzag-title">SEBUAH PERJALANAN <br>AMANAH & PELAYANAN</h2>
                    <p class="zigzag-desc">
                        Cerita ini tidak dimulai di kantor yang megah, pun tidak bermula dari rencana bisnis yang rumit. Semuanya berawal pada tahun 2016, di tengah lautan manusia yang memutih di Masjidil Haram.
                    </p>
                    <p class="zigzag-desc">
                        Di sana, sebuah niat terpatri: <strong>Setiap Muslim berhak merasakan kekhusyukan tanpa rasa was-was.</strong> Kini, setelah ribuan jamaah kami antarkan, Mahira Tour bukan sekadar biro perjalanan, melainkan wadah persaudaraan keluarga Allah.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="zigzag-image-wrapper">
                    <img src="{{ asset('images/hero/jamaah2.webp') }}" alt="Sejarah Mahira Tour" class="zigzag-img">
                </div>
            </div>
        </div>

        {{-- BLOCK 2: VALUES/EXPERTISE (Image Left, Text Right) --}}
        <div class="row align-items-center zigzag-row reversed">
            <div class="col-lg-6 order-1">
                <div class="zigzag-image-wrapper">
                    <img src="{{ asset('images/hero/video-poster.webp') }}" alt="Profesionalitas Mahira Tour" class="zigzag-img">
                </div>
            </div>
            <div class="col-lg-6 order-2">
                <div class="zigzag-content">
                    <h2 class="zigzag-title">LEBIH DARI SEKADAR <br>HAJI & UMRAH</h2>
                    <p class="zigzag-desc">
                        Kami tidak hanya mengurus tiket dan visa. Kami merancang pengalaman spiritual yang mendalam. Dengan izin resmi PPIU Kemenag RI, kami menjamin keamanan dan kenyamanan ibadah Anda.
                    </p>
                    <p class="zigzag-desc">
                        <ul>
                            <li><i class="bi bi-check-circle-fill text-gold"></i> Bimbingan Ibadah Sesuai Sunnah</li>
                            <li><i class="bi bi-check-circle-fill text-gold"></i> Fasilitas Nyaman & Terjamin</li>
                            <li><i class="bi bi-check-circle-fill text-gold"></i> Pendampingan Sepenuh Hati</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>

        {{-- BLOCK 3: VISION & MISSION (Text Left, Image Right) --}}
        <div class="row align-items-center zigzag-row">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="zigzag-content">
                    <h2 class="zigzag-title">PERJALANAN ANDA, <br>KOMITMEN KAMI</h2>
                    <p class="zigzag-desc">
                        <strong>Visi Kami:</strong> Menjadi jembatan terpercaya bagi jutaan hati yang merindu Baitullah.
                    </p>
                    <p class="zigzag-desc">
                        Kami berkomitmen untuk memberikan pelayanan yang jujur, amanah, dan profesional. Setiap senyum kepuasan jamaah adalah bukti dedikasi kami untuk Indonesia.
                    </p>
                    <a href="https://wa.me/6282184515310" class="btn-zigzag">
                        Konsultasi Sekarang <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="zigzag-image-wrapper">
                    <img src="{{ asset('images/hero/umrah-ramadhan.webp') }}" alt="Visi Misi Mahira Tour" class="zigzag-img">
                </div>
            </div>
        </div>

    </div>
</section>

{{-- OUR VALUES --}}


{{-- LEADERSHIP --}}
<section class="leadership-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Kepemimpinan</div>
            <h2 class="section-title zigzag-title" style="text-align:center; margin-top:0;">TIM PIMPINAN MAHIRA TOUR</h2>
            <p class="section-subtitle">DIPIMPIN OLEH PROFESIONAL BERPENGALAMAN</p>
        </div>
        
        {{-- EXECUTIVE PROFILE LAYOUT --}}
        <div class="executive-profile-wrapper">
            @foreach($leadership as $index => $leader)
            <div class="executive-card {{ $index % 2 == 0 ? '' : 'reversed' }}">
                <div class="executive-image-col">
                    <div class="executive-frame">
                        @if($leader['name'] == 'Khilal Hamdan')
                            <img src="{{ asset('storage/team/direktur.webp') }}" alt="{{ $leader['name'] }}" loading="lazy" class="executive-img">
                        @elseif($leader['name'] == 'Nadirman Hamdan')
                            <img src="{{ asset('storage/team/komisaris.webp') }}" alt="{{ $leader['name'] }}" loading="lazy" class="executive-img">
                        @else
                            <div class="placeholder"><i class="bi bi-person-circle"></i></div>
                        @endif
                    </div>
                </div>
                <div class="executive-info-col">
                    <h3 class="executive-name">{{ $leader['name'] }}</h3>
                    <p class="executive-role">{{ strtoupper($leader['position']) }}</p>
                    <div class="executive-quote">
                        <i class="bi bi-quote"></i>
                        <p>Mengemban amanah untuk melayani tamu-tamu Allah adalah kehormatan tertinggi bagi kami. Kepuasan jamaah adalah prioritas utama.</p>
                    </div>
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
            <h2 class="section-title zigzag-title" style="color:white; text-align:center; margin-top:0;">LEGALITAS RESMI</h2>
            <p class="section-subtitle">TERDAFTAR DAN DIAWASI PEMERINTAH RI</p>
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
        {{-- Legal Partners (Horizontal Banner) --}}
        <div class="legal-banner-wrapper">
            <div class="legal-item">
                <img src="{{ asset('images/partners/kemenag.webp') }}" alt="Kemenag" class="legal-icon hover-color">
                <span class="legal-label">RESMI KEMENAG RI</span>
            </div>
            <div class="legal-divider"></div>
            <div class="legal-item">
                <img src="{{ asset('images/partners/himpuh.webp') }}" alt="HIMPUH" class="legal-icon hover-color">
                <span class="legal-label">ANGGOTA HIMPUH</span>
            </div>
            <div class="legal-divider"></div>
            <div class="legal-item">
                <img src="{{ asset('images/partners/siskopatuh.webp') }}" alt="Siskopatuh" class="legal-icon hover-color">
                <span class="legal-label">TERDAFTAR SISKOPATUH</span>
            </div>
        </div>
    </div>
</section>
    </div>
</section>

{{-- BRANCHES --}}
<section class="branches">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">{{ count($branches) }} Cabang di Indonesia</div>
            <h2 class="section-title zigzag-title" style="text-align:center; margin-top:0;">LOKASI CABANG KAMI</h2>
            <p class="section-subtitle">KLIK KARTU CABANG UNTUK DETAIL LOKASI</p>
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
{{-- CLOSING CTA (Vertical Split Style) --}}
<section class="closing-split-section">
    <div class="split-container">
        {{-- Left: Text Content --}}
        <div class="split-content-side">
            <span class="split-subtitle">PERJALANAN RUHANI</span>
            <h2 class="split-title">LANGKAH MENUJU <br>RUMAH-NYA</h2>
            <p class="split-desc">
                Panggilan itu mungkin sudah terdengar di hati Anda. Kami mengerti bahwa ini bukan sekadar perjalanan fisik, tapi perjalanan hati menuju Sang Pencipta. Izinkan Mahira Tour membersamai setiap langkah ibadah Anda dengan kenyamanan dan kepastian.
            </p>
            <div class="split-buttons">
                <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" 
                   class="btn-split-primary" target="_blank">
                    <i class="bi bi-whatsapp"></i> Konsultasi Gratis
                </a>
                <a href="{{ route('schedule') }}" class="btn-split-outline">
                    <i class="bi bi-calendar-check"></i> Lihat Jadwal
                </a>
            </div>
        </div>

        {{-- Right: Dual Vertical Images --}}
        <div class="split-image-side">
            <div class="split-img-wrapper img-tall">
                <img src="{{ asset('images/hero/hero-about.webp') }}" alt="Ka'bah" class="split-img">
            </div>
            <div class="split-img-wrapper img-short">
                <img src="{{ asset('images/hero/masjid-nabawi.webp') }}" alt="Masjid Nabawi" class="split-img">
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
