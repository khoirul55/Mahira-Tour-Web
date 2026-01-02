@extends('layouts.app')

@section('title', 'Jadwal Keberangkatan - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-background">
        <img src="{{ asset('storage/hero/hero-schedule.jpeg') }}" 
             alt="Jadwal Keberangkatan Mahira Tour" 
             loading="eager">
    </div>
    
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}">
                <i class="bi bi-house-door-fill"></i> Beranda
            </a>
            <span>/</span>
            <span>Jadwal Keberangkatan</span>
        </div>
        <h1>
            <span class="word">Jadwal</span> 
            <span class="word">Keberangkatan</span>
        </h1>
        <p>Pilih jadwal yang sesuai dengan rencana perjalanan spiritual Anda</p>
    </div>
</section>

<!-- Filter Section -->
<section class="filter-section">
    <div class="container">
        <div class="d-flex gap-2 justify-content-center flex-wrap">
            <button class="filter-btn active" data-filter="all">Semua Jadwal</button>
            @foreach($departure_routes as $route)
            <button class="filter-btn" data-filter="{{ $route }}">{{ $route }}</button>
            @endforeach
        </div>
    </div>
</section>

<!-- Schedule Grid with Flyers -->
<section class="py-5" style="padding: 80px 0; background: var(--white);">
    <div class="container">
        <div class="row g-4">
            @foreach($schedules as $schedule)
            @php
                $statusClass = match($schedule['status']) {
                    'available' => 'available',
                    'almost_full' => 'almost-full',
                    'full' => 'full',
                    default => 'available'
                };
                
                $statusText = match($schedule['status']) {
                    'available' => 'Tersedia',
                    'almost_full' => 'Hampir Penuh',
                    'full' => 'Penuh',
                    default => 'Tersedia'
                };
                
                $badgeClass = match($schedule['status']) {
                    'available' => 'badge-available',
                    'almost_full' => 'badge-almost-full',
                    'full' => 'badge-full',
                    default => 'badge-available'
                };
            @endphp
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index + 1) * 50 }}">
                <div class="flyer-card" 
                     data-route="{{ $schedule['departure_route'] }}"
                     data-airline="{{ $schedule['airline'] }}"
                     data-date="{{ date('d M Y', strtotime($schedule['departure_date'])) }}"
                     data-schedule-id="{{ $schedule['id'] }}">
                    
                    <!-- Flyer Image (Clickable) -->
                    <div class="flyer-image-container" 
                         onclick="openFlyerModal('{{ asset('storage/flyers/' . $schedule['flyer_image']) }}', '{{ $schedule['package_name'] }}', '{{ date('d M Y', strtotime($schedule['departure_date'])) }} • {{ $schedule['departure_route'] }} • {{ $schedule['airline'] }}')">
                        <img src="{{ asset('storage/flyers/' . $schedule['flyer_image']) }}" 
                             alt="{{ $schedule['package_name'] }}" 
                             class="flyer-image"
                             loading="lazy">
                        
                        <!-- Status Badge -->
                        <span class="flyer-badge {{ $badgeClass }}">
                            <i class="bi bi-{{ $schedule['status'] === 'full' ? 'x-circle-fill' : 'check-circle-fill' }}"></i>
                            {{ $statusText }}
                        </span>
                        
                        <!-- Zoom Hint -->
                        <div class="flyer-zoom-hint">
                            <i class="bi bi-zoom-in"></i>
                            Klik untuk perbesar
                        </div>
                    </div>
                    
                    <!-- Card Info -->
                    <div class="flyer-info">
                        <h3 class="flyer-title">{{ $schedule['package_name'] }}</h3>
                        
                        <div class="flyer-meta">
                            <div class="meta-item">
                                <i class="bi bi-calendar-event"></i>
                                <span>{{ date('d M Y', strtotime($schedule['departure_date'])) }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $schedule['departure_route'] }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-airplane-fill"></i>
                                <span>{{ $schedule['airline'] }}</span>
                            </div>
                            <div class="meta-item price">
                                <i class="bi bi-tag-fill"></i>
                                <span>Rp {{ number_format($schedule['price'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flyer-actions">
                            @if($schedule['status'] !== 'full')
                            <a href="{{ route('register', ['schedule_id' => $schedule['id']]) }}" 
                               class="btn-register-direct">
                                <i class="bi bi-pencil-square"></i>
                                Daftar Sekarang
                            </a>
                            @else
                            <button class="btn-register-direct" disabled style="opacity: 0.6; cursor: not-allowed;">
                                <i class="bi bi-x-circle"></i>
                                Kuota Penuh
                            </button>
                            @endif
                            
                            <button class="btn-view-flyer" 
                                    onclick="openFlyerModal('{{ asset('storage/flyers/' . $schedule['flyer_image']) }}', '{{ $schedule['package_name'] }}', '{{ date('d M Y', strtotime($schedule['departure_date'])) }} • {{ $schedule['departure_route'] }} • {{ $schedule['airline'] }}')">
                                <i class="bi bi-eye"></i>
                                Lihat Detail Flyer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @if(count($schedules) === 0)
        <div class="empty-state">
            <i class="bi bi-calendar-x empty-icon"></i>
            <h4 style="color: var(--primary-navy); font-weight: 700;">Belum Ada Jadwal Tersedia</h4>
            <p class="text-muted">Silakan hubungi kami untuk informasi jadwal terbaru</p>
        </div>
        @endif
    </div>
</section>

<!-- Flyer Modal -->
<div id="flyerModal" class="flyer-modal">
    <span class="modal-close" onclick="closeFlyerModal()">&times;</span>
    <div class="modal-content-wrapper">
        <img id="flyerModalImg" src="" alt="Flyer Detail" class="modal-flyer-image">
        <div class="modal-info">
            <h3 id="flyerModalTitle"></h3>
            <p id="flyerModalMeta"></p>
        </div>
    </div>
</div>

<!-- Info Section -->
<section class="info-card-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-subtitle" style="color: var(--gold); font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px; display: inline-block; padding: 8px 20px; background: rgba(212, 175, 55, 0.1); border-radius: 50px;">
                KEMUDAHAN PENDAFTARAN
            </div>
            <h2 class="fw-bold" style="font-size: 2.5rem; color: var(--primary-navy);">Kenapa Daftar di Mahira Tour?</h2>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="info-feature-card">
                    <div class="info-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h5 class="info-title">Booking Cepat</h5>
                    <p class="info-text">Proses pendaftaran mudah dan cepat, konfirmasi dalam 1x24 jam</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="info-feature-card">
                    <div class="info-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <h5 class="info-title">Cicilan Tersedia</h5>
                    <p class="info-text">Program cicilan dengan DP 30% dan pelunasan H-30 keberangkatan</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="info-feature-card">
                    <div class="info-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h5 class="info-title">Support 24/7</h5>
                    <p class="info-text">Tim kami siap membantu Anda kapan saja melalui WhatsApp</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content text-center">
            <div data-aos="fade-up">
                <h3 class="fw-bold mb-3" style="font-size: 2.5rem;">Tidak Menemukan Jadwal yang Cocok?</h3>
                <p class="mb-5" style="font-size: 1.25rem; opacity: 0.95; max-width: 600px; margin: 0 auto 2rem;">
                    Hubungi kami untuk informasi jadwal private atau keberangkatan khusus
                </p>
                <a href="{{ route('contact') }}" class="btn-cta">
                    <i class="bi bi-telephone"></i>
                    Hubungi Kami Sekarang
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{ asset('js/schedule.js') }}"></script>
@endpush