@extends('layouts.app')

@section('title', $schedule->package_name . ' - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/schedule-detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/schedule-detail-additions.css') }}">
@endpush

@section('content')

<!-- Alpine x-data context -->
<div x-data="{ showFlyer: false }">

    <!-- HERO SECTION: Split Layout (Image Left, Gold Price Right) -->
    <section class="hagel-hero">
        <div class="row g-0 h-100">
            <!-- LEFT: Image & Title -->
            <div class="col-lg-8 position-relative hero-left">
                <div class="hero-bg-wrapper">
                    <!-- Gunakan gambar generic yang bersih agar teks terbaca -->
                    <img src="{{ asset('images/hero/hero-schedule.webp') }}" alt="Background Umrah" class="hero-bg-img">
                    <div class="hero-gradient-overlay"></div>
                </div>
                
                <div class="hero-text-content">
                    <h4 class="sub-title">PAKET UMRAH PREMIUM</h4>
                    <h1 class="main-title">{{ $schedule->package_name }}</h1>
                    <div class="hero-dates">
                        <i class="bi bi-calendar-check"></i>
                        {{ $schedule->departure_date->format('d M') }} - {{ $schedule->return_date->format('d M Y') }}
                        <span class="duration-badge">({{ $schedule->duration }})</span>
                    </div>
                    <!-- Route Info Added -->
                    <div class="hero-route mt-2 text-white">
                        <i class="bi bi-geo-alt-fill text-gold"></i> start {{ $schedule->departure_route }}
                    </div>
                    
                    <!-- View Flyer Button (Modal Trigger) -->
                    <div class="mt-4">
                        <button @click="showFlyer = true" class="btn btn-outline-light rounded-pill px-4">
                            <i class="bi bi-eye"></i> Lihat Brosur/Flyer
                        </button>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Gold Pricing Panel -->
            <div class="col-lg-4 hero-right-gold">
                <div class="pricing-content">
                    
                    <!-- Fixed Price Display -->
                    <div class="price-group text-center">
                        <span class="price-label mb-2 d-block">HARGA PAKET</span>
                        <h1 class="price-value display-4 fw-bold">Rp {{ number_format($schedule->price, 0, ',', '.') }}</h1>
                        <p class="text-white-50 mt-2 mb-0">Per Orang / Pax</p>
                    </div>

                    <div class="action-area mt-4 w-100">
                        @if($schedule->status !== 'full')
                        <a href="{{ route('register', ['schedule_id' => $schedule->id]) }}" 
                           class="btn btn-light w-100 py-3 rounded-pill fw-bold text-uppercase" 
                           style="color: var(--hagel-gold);">
                            <i class="bi bi-pencil-square"></i> Daftar Sekarang
                        </a>
                        @else
                        <button class="btn btn-secondary w-100 py-3 rounded-pill fw-bold text-uppercase" disabled>
                            <i class="bi bi-x-circle"></i> Paket Penuh
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT SECTION: White Background, 2 Columns -->
    <section class="hagel-content container py-5">
        <div class="row">
            <!-- LEFT COLUMN -->
            <div class="col-lg-6 mb-5">
                <!-- ACCOMMODATION -->
                <div class="content-block mb-5">
                    <h3 class="section-heading text-center mb-4">Accomodation</h3>
                    <div class="hotel-gallery row g-3">
                        <div class="col-6">
                             <div class="hotel-card">
                                <div class="hotel-img-wrapper">
                                    <img src="{{ $schedule->hotel_makkah_image ? Storage::url($schedule->hotel_makkah_image) : 'https://placehold.co/400x300/f5f5f5/001D5F?text=Hotel+Makkah' }}" 
                                         alt="Hotel Makkah" class="hotel-img">
                                    <span class="hotel-badge">MAKKAH</span>
                                </div>
                                <h5 class="hotel-title mt-2">{{ $schedule->hotel_makkah ?? 'Anjum Hotel / Setaraf' }}</h5>
                             </div>
                        </div>
                        <div class="col-6">
                            <div class="hotel-card">
                                <div class="hotel-img-wrapper">
                                    <img src="{{ $schedule->hotel_madinah_image ? Storage::url($schedule->hotel_madinah_image) : 'https://placehold.co/400x300/f5f5f5/001D5F?text=Hotel+Madinah' }}" 
                                         alt="Hotel Madinah" class="hotel-img">
                                    <span class="hotel-badge">MADINAH</span>
                                </div>
                                <h5 class="hotel-title mt-2">{{ $schedule->hotel_madinah ?? 'Rove Hotel / Setaraf' }}</h5>
                            </div>
                        </div>
                    </div>
                    <p class="text-center text-muted mt-2 fst-italic small">*Accomodation as above or similar.</p>
                </div>

                <!-- PACKAGE INCLUDES -->
                <div class="content-block mb-5">
                    <h3 class="section-heading-left">Package Includes</h3>
                    <ul class="hagel-list">
                        @if($schedule->features)
                            @foreach(explode(',', $schedule->features) as $feature)
                                 <li>{{ trim($feature) }}</li>
                            @endforeach
                        @else
                            <li>Visa Saudi</li>
                            <li>Ziarah kota Makkah & Madinah</li>
                            <li>1x Ziarah Raudha/Maqam</li>
                            <li>Tiket Pesawat Ekonomi PP</li>
                            <li>Makan 3x Sehari (Asian/Indo Buffet)</li>
                            <li>Air Zamzam 5 Liter (Jika diizinkan)</li>
                            <li>Asuransi Perjalanan</li>
                            <li>Transportasi Bus AC Eksklusif</li>
                            <li>Muthawif Berpengalaman</li>
                        @endif
                    </ul>
                </div>
                
                <!-- PACKAGE EXCLUDES -->
                <div class="content-block">
                    <h3 class="section-heading-left">Package Excludes</h3>
                    <ul class="hagel-list">
                        @if($schedule->excludes)
                            @foreach(explode(',', $schedule->excludes) as $exclude)
                                 <li>{{ trim($exclude) }}</li>
                            @endforeach
                        @else
                            <li>Pembuatan Paspor</li>
                            <li>Vaksin Meningitis (Jika ada)</li>
                            <li>Kelebihan Bagasi (Excess Baggage)</li>
                            <li>Pengeluaran Pribadi (Laundry, Telp, dll)</li>
                            <li>Tour Tambahan di luar program</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-lg-6">
                <!-- FLIGHT -->
                <div class="content-block mb-5 text-center">
                    <h3 class="section-heading text-center mb-4">Flight</h3>
                    <div class="airline-display">
                        <h2 class="airline-name">{{ $schedule->airline }}</h2>
                       <div class="flight-icon">
                           <i class="bi bi-airplane-engines"></i>
                       </div>
                       <p class="text-muted">Direct Flight / Transit sesuai program</p>
                    </div>
                </div>

                <!-- ITINERARY -->
                <div class="content-block mb-5 text-center">
                    <h3 class="section-heading text-center mb-4">Itinerary</h3>
                    <div class="itinerary-box">
                        @if($schedule->itinerary_pdf)
                        <a href="{{ Storage::url($schedule->itinerary_pdf) }}" target="_blank" class="btn-download-itinerary">
                            DOWNLOAD ITINERARY PDF <i class="bi bi-file-earmark-pdf"></i>
                        </a>
                        @else
                        <button class="btn-download-itinerary" disabled style="opacity:0.6; cursor:not-allowed">
                            PDF BELUM TERSEDIA <i class="bi bi-file-earmark-x"></i>
                        </button>
                        @endif
                        
                        <div class="mt-3 small text-muted">
                            *Program perjalanan dapat berubah sewaktu-waktu
                        </div>
                        
                        @if($schedule->itinerary)
                        <div class="itinerary-preview mt-4 text-start p-4 bg-light rounded">
                            {!! nl2br(e(Str::limit($schedule->itinerary, 300))) !!}
                        </div>
                        @endif
                    </div>
                </div>

                <!-- UMRAH GIFTS -->
                <div class="content-block mb-5">
                    <h3 class="section-heading-left">Umrah Gifts</h3>
                    <ul class="hagel-list">
                        @if($schedule->gifts)
                            @foreach(explode(',', $schedule->gifts) as $gift)
                                 <li>{{ trim($gift) }}</li>
                            @endforeach
                        @else
                            <li>Koper Besar (Cabin Bag)</li>
                            <li>Tas Selempang (Sling Bag)</li>
                            <li>Kain Ihram (Pria) / Mukena (Wanita)</li>
                            <li>Buku Panduan Doa</li>
                            <li>ID Card & Syal Mahira</li>
                            <li>Air Zamzam 5L</li>
                        @endif
                    </ul>
                </div>

                <!-- ADDITIONAL INFO -->
                 <div class="content-block">
                    <h3 class="section-heading-left">Additional Information</h3>
                    <ul class="hagel-list">
                        @if($schedule->additional_info)
                            @foreach(explode(',', $schedule->additional_info) as $info)
                                 <li>{{ trim($info) }}</li>
                            @endforeach
                        @else
                            <li>Harga paket dapat berubah sewaktu-waktu mengikuti kebijakan maskapai dan hotel.</li>
                            <li>Jadwal keberangkatan bisa bergeser 1-2 hari.</li>
                            <li>Pendaftaran wajib menyertakan DP minimal Rp 5.000.000.</li>
                            <li>Pelunasan maksimal H-30 keberangkatan.</li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- Sticky Register Button (Mobile) -->
    <div class="d-lg-none sticky-bottom-nav">
        <div class="row g-0">
            <div class="col-6 bg-white p-2 d-flex align-items-center justify-content-center border-top">
                <span class="text-gold fw-bold">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
            </div>
            <div class="col-6">
                <a href="{{ route('register', ['schedule_id' => $schedule->id]) }}" class="btn btn-primary w-100 h-100 rounded-0 d-flex align-items-center justify-content-center">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- FLYER MODAL / LIGHTBOX -->
    <div x-show="showFlyer" 
         x-cloak
         class="flyer-modal-overlay"
         @click="showFlyer = false"
         x-transition.opacity>
        
        <div class="flyer-modal-content" @click.stop>
            <button class="flyer-close-btn" @click="showFlyer = false">
                <i class="bi bi-x-lg"></i>
            </button>
            <img src="{{ Storage::url($schedule->flyer_image) }}" alt="Brosur Paket" class="flyer-img-full">
            <div class="text-center mt-3">
                <a href="{{ Storage::url($schedule->flyer_image) }}" download class="btn btn-sm btn-outline-light">
                    <i class="bi bi-download"></i> Download Brosur
                </a>
            </div>
        </div>
    </div>

</div>

<!-- Styles for Modal -->
<style>
    .flyer-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .flyer-modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90vh;
    }
    .flyer-img-full {
        max-width: 100%;
        max-height: 80vh;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }
    .flyer-close-btn {
        position: absolute;
        top: -40px;
        right: 0;
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
    }
</style>

@endsection
