@extends('layouts.app')

@section('title', 'Jadwal Keberangkatan - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
@endpush

@section('content')
<!-- Hero Section -->
<!-- Hero Section -->
<section class="page-hero">
    <div class="page-hero-background">
        <img src="{{ asset('images/hero/hero-schedule.webp') }}" 
             alt="Jadwal Keberangkatan Mahira Tour" 
             fetchpriority="high"
             loading="eager">
    </div>
    
    <div class="page-hero-overlay"></div>
    
    <div class="page-hero-content">
        <div class="hero-breadcrumb">
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


<section class="filter-section">
    <div class="container">
        <div x-data="{ activeFilter: 'all' }" class="d-flex gap-2 justify-content-center flex-wrap">
            <button @click="activeFilter = 'all'; 
                    document.querySelectorAll('.col-lg-4').forEach(el => el.style.display = 'block')"
                    :class="{ 'active': activeFilter === 'all' }"
                    class="filter-btn">
                Semua Jadwal
            </button>
            
            @foreach($departure_routes as $route)
            <button @click="activeFilter = '{{ $route }}';
                    document.querySelectorAll('.col-lg-4').forEach(el => {
                        const card = el.querySelector('[data-route]');
                        el.style.display = card?.dataset.route === '{{ $route }}' ? 'block' : 'none';
                    })"
                    :class="{ 'active': activeFilter === '{{ $route }}' }"
                    class="filter-btn">
                {{ $route }}
            </button>
            @endforeach
        </div>
    </div>
</section>

<!-- Schedule Grid with Modal Trigger -->
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
     data-schedule-id="{{ $schedule['id'] }}"
     data-departure-date="{{ $schedule['departure_date'] }}"
     data-return-date="{{ $schedule['return_date'] }}"
     data-airline="{{ $schedule['airline'] }}"
     data-price="{{ $schedule['price'] }}"
     data-duration="{{ $schedule['duration'] }}"
     data-status="{{ $schedule['status'] }}"
     data-quota="{{ $schedule['quota'] }}"
     data-seats-taken="{{ $schedule['seats_taken'] }}">
    
    {{-- Flyer Image --}}
    <div class="flyer-image-container" 
         onclick="openDetailModal({{ $schedule['id'] }})">
        <img src="{{ Storage::url($schedule['flyer_image']) }}" 
             alt="{{ $schedule['package_name'] }}" 
             class="flyer-image"
             loading="lazy">
        
        <span class="flyer-badge {{ $badgeClass }}">
            <i class="bi bi-{{ $schedule['status'] === 'full' ? 'x-circle-fill' : 'check-circle-fill' }}"></i>
            {{ $statusText }}
        </span>
        
        <div class="flyer-click-hint">
            <i class="bi bi-eye"></i>
            Lihat Detail
        </div>
    </div>
    
    {{-- Card Info --}}
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
        
        {{-- 2 Button Actions --}}
        <div class="flyer-actions">
            @if($schedule['status'] !== 'full')
            <a href="{{ route('register', ['schedule_id' => $schedule['id']]) }}" 
               class="btn-register-direct">
                <i class="bi bi-pencil-square"></i> Daftar
            </a>
            @else
            <button class="btn-register-direct" disabled>
                <i class="bi bi-x-circle"></i> Penuh
            </button>
            @endif
            
            <button class="btn-view-detail" 
                    onclick="openDetailModal({{ $schedule['id'] }})">
                <i class="bi bi-info-circle"></i> Detail
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

<!-- Detail Modal (Simplified) -->
<div id="detailModal" class="detail-modal">
    <div class="modal-overlay" onclick="closeDetailModal()"></div>
    
    <div class="modal-drawer">
        <!-- Header -->
        <div class="modal-header-custom">
            <button class="modal-close-btn" onclick="closeDetailModal()">
                <i class="bi bi-x-lg"></i>
            </button>
            <h4 id="modalPackageName">Detail Paket</h4>
        </div>
        
        <!-- Body -->
        <div class="modal-body-custom">
            <!-- Flyer Small -->
            <div class="modal-flyer-section">
                <img id="modalFlyerImage" src="" alt="Flyer" class="modal-flyer-img">
            </div>
            
            <!-- Info List -->
            <div class="modal-details-section">
                <div class="detail-group">
                    <div class="detail-icon"><i class="bi bi-calendar-check"></i></div>
                    <div class="detail-content">
                        <small>Keberangkatan</small>
                        <strong id="modalDepartureDate">-</strong>
                    </div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-icon"><i class="bi bi-calendar-x"></i></div>
                    <div class="detail-content">
                        <small>Kepulangan</small>
                        <strong id="modalReturnDate">-</strong>
                    </div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-icon"><i class="bi bi-airplane-fill"></i></div>
                    <div class="detail-content">
                        <small>Maskapai</small>
                        <strong id="modalAirline">-</strong>
                    </div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-icon"><i class="bi bi-clock"></i></div>
                    <div class="detail-content">
                        <small>Durasi</small>
                        <strong id="modalDuration">-</strong>
                    </div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-icon"><i class="bi bi-people-fill"></i></div>
                    <div class="detail-content">
                        <small>Kuota Tersedia</small>
                        <strong id="modalAvailability">-</strong>
                    </div>
                </div>
                
                <div class="detail-group price-highlight">
                    <div class="detail-icon"><i class="bi bi-tag-fill"></i></div>
                    <div class="detail-content">
                        <small>Harga Paket</small>
                        <strong id="modalPrice" class="text-gold">-</strong>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="modal-footer-custom">
            <a href="{{ route('register') }}" id="modalRegisterBtnBottom" class="btn-modal-register-main">
                <i class="bi bi-pencil-square"></i> Daftar Sekarang
            </a>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{ asset('js/schedule.js') }}"></script>
@endpush