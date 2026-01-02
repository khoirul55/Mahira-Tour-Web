@extends('layouts.app')

@section('title', $package['name'] . ' - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
<style>
    :root {
        --primary-navy: #001D5F;
        --white: #FFFFFF;
        --light-navy: #002B8F;
        --lighter-navy: #E8EBF3;
        --gold: #D4AF37;
        --text-dark: #1A1A1A;
        --text-gray: #6B7280;
        --success: #10B981;
    }
    
    body {
        padding-top: 76px;
    }
    
    .page-header {
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--light-navy) 100%);
        color: var(--white);
        padding: 80px 0 60px;
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>') repeat;
    }
    
    .breadcrumb-custom {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        padding: 8px 20px;
        display: inline-block;
        margin-bottom: 15px;
    }
    
    .breadcrumb-custom a {
        color: var(--white);
        text-decoration: none;
        opacity: 0.8;
    }
    
    .hero-image {
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 25px 80px rgba(0, 29, 95, 0.3);
        position: relative;
    }
    
    .hero-image img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }
    
    .price-card {
        background: linear-gradient(135deg, var(--primary-navy), var(--light-navy));
        color: var(--white);
        border-radius: 30px;
        padding: 3rem;
        box-shadow: 0 25px 80px rgba(0, 29, 95, 0.3);
        position: sticky;
        top: 100px;
    }
    
    .price-original {
        text-decoration: line-through;
        opacity: 0.6;
        font-size: 1.5rem;
    }
    
    .price-current {
        font-size: 3rem;
        font-weight: 800;
        color: var(--gold);
        line-height: 1;
        margin: 15px 0;
    }
    
    .discount-badge {
        background: var(--gold);
        color: var(--primary-navy);
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .btn-book {
        width: 100%;
        padding: 18px;
        background: var(--gold);
        color: var(--primary-navy);
        border: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
        margin-top: 20px;
    }
    
    .btn-book:hover {
        background: #F4D03F;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
        color: var(--primary-navy);
    }
    
    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-navy);
        margin-bottom: 1.5rem;
        position: relative;
        padding-left: 20px;
    }
    
    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 80%;
        background: linear-gradient(180deg, var(--gold), var(--primary-navy));
        border-radius: 5px;
    }
    
    .feature-list {
        list-style: none;
        padding: 0;
    }
    
    .feature-list li {
        padding: 15px 0;
        border-bottom: 1px solid var(--lighter-navy);
        display: flex;
        align-items: start;
        gap: 15px;
        transition: all 0.3s;
    }
    
    .feature-list li:hover {
        padding-left: 15px;
        color: var(--primary-navy);
    }
    
    .feature-list li i {
        color: var(--success);
        font-size: 1.3rem;
        margin-top: 2px;
    }
    
    .itinerary-item {
        background: var(--white);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 40px rgba(0, 29, 95, 0.08);
        border-left: 5px solid var(--primary-navy);
        transition: all 0.3s;
        margin-bottom: 20px;
    }
    
    .itinerary-item:hover {
        transform: translateX(10px);
        border-left-color: var(--gold);
    }
    
    .itinerary-day {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-navy);
        margin-bottom: 10px;
    }
    
    .hotel-card {
        background: var(--lighter-navy);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .hotel-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary-navy), var(--light-navy));
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.5rem;
    }
    
    .terms-card {
        background: #FEF3C7;
        border-left: 5px solid var(--gold);
        border-radius: 15px;
        padding: 2rem;
    }
    
    .terms-card ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .terms-card li {
        margin-bottom: 10px;
        color: var(--text-dark);
    }
    
    @media (max-width: 768px) {
        .price-card {
            position: relative;
            top: 0;
            margin-top: 30px;
        }
        
        .hero-image img {
            height: 300px;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('packages') }}">Paket</a>
            <span class="mx-2">/</span>
            <span>{{ $package['name'] }}</span>
        </div>
        <h1 class="display-4 fw-bold">{{ $package['name'] }}</h1>
    </div>
</section>

<!-- Package Detail -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Hero Image -->
                <div class="hero-image mb-5" data-aos="fade-up">
                    <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}">
                </div>
                
                <!-- Description -->
                <div class="mb-5" data-aos="fade-up">
                    <h2 class="section-title">Deskripsi Paket</h2>
                    <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">
                        {{ $package['description'] }}
                    </p>
                </div>
                
                <!-- Includes -->
                <div class="mb-5" data-aos="fade-up">
                    <h2 class="section-title">Fasilitas yang Termasuk</h2>
                    <ul class="feature-list">
                        @foreach($package['includes'] as $item)
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Hotels -->
                @if(isset($package['hotels']))
                <div class="mb-5" data-aos="fade-up">
                    <h2 class="section-title">Akomodasi Hotel</h2>
                    @foreach($package['hotels'] as $hotel)
                    <div class="hotel-card">
                        <div class="hotel-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">{{ $hotel }}</h5>
                            <small class="text-muted">Hotel Bintang 5 dengan Fasilitas Lengkap</small>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Itinerary -->
                @if(isset($package['itinerary']))
                <div class="mb-5" data-aos="fade-up">
                    <h2 class="section-title">Jadwal Perjalanan</h2>
                    @foreach($package['itinerary'] as $day)
                    <div class="itinerary-item">
                        <div class="itinerary-day">{{ $day['day'] }}</div>
                        <p class="text-muted mb-0">{{ $day['activity'] }}</p>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Requirements -->
                @if(isset($package['requirements']))
                <div class="mb-5" data-aos="fade-up">
                    <h2 class="section-title">Persyaratan Pendaftaran</h2>
                    <div class="terms-card">
                        <ul>
                            @foreach($package['requirements'] as $req)
                            <li>{{ $req }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                
                <!-- Terms -->
                @if(isset($package['terms']))
                <div class="mb-5" data-aos="fade-up">
                    <h2 class="section-title">Syarat & Ketentuan</h2>
                    <div class="terms-card">
                        <ul>
                            @foreach($package['terms'] as $term)
                            <li>{{ $term }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="price-card" data-aos="fade-left">
                    @if(isset($package['discount']) && $package['discount'] > 0)
                    <div class="discount-badge">
                        <i class="bi bi-tag-fill"></i> Hemat {{ $package['discount'] }}%
                    </div>
                    @endif
                    
                    @if(isset($package['price_before_discount']))
                    <div class="price-original">
                        Rp {{ number_format($package['price_before_discount'], 0, ',', '.') }}
                    </div>
                    @endif
                    
                    <div class="price-current">
                        Rp {{ number_format($package['price'], 0, ',', '.') }}
                    </div>
                    <p class="mb-0 opacity-75">/orang</p>
                    
                    <hr style="border-color: rgba(255,255,255,0.2); margin: 25px 0;">
                    
                    <div class="mb-3">
                        <small class="d-block mb-2 opacity-75">Durasi</small>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock fs-5"></i>
                            <strong>{{ $package['duration'] }}</strong>
                        </div>
                    </div>
                    
                    @if(isset($package['available_seats']))
                    <div class="mb-3">
                        <small class="d-block mb-2 opacity-75">Sisa Kursi</small>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-people fs-5"></i>
                            <strong>{{ $package['available_seats'] }} Kursi</strong>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($package['airline']))
                    <div class="mb-3">
                        <small class="d-block mb-2 opacity-75">Maskapai</small>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-airplane fs-5"></i>
                            <strong>{{ $package['airline'] }}</strong>
                        </div>
                    </div>
                    @endif
                    
                    <a href="{{ route('register') }}" class="btn-book">
                        <i class="bi bi-calendar-check"></i>
                        Daftar Sekarang
                    </a>
                    
                    <a href="https://wa.me/6282184515310" class="btn-book" style="background: rgba(255,255,255,0.15); color: var(--white); border: 2px solid rgba(255,255,255,0.3);">
                        <i class="bi bi-whatsapp"></i>
                        Konsultasi via WA
                    </a>
                    
                    <div class="text-center mt-4">
                        <small class="opacity-75">
                            <i class="bi bi-shield-check"></i> Pembayaran Aman & Terpercaya
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>
@endpush