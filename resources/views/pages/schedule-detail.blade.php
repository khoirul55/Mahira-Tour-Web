@extends('layouts.app')

@section('title', $schedule->package_name . ' - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/schedule-detail.css') }}">
@endpush

@section('content')

<!-- HERO SECTION: Premium Full Width -->
<section class="detail-hero">
    <div class="hero-background">
        <img src="{{ Storage::url($schedule->flyer_image) }}" alt="{{ $schedule->package_name }}">
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content container">
        <div class="hero-badge">
            <i class="bi bi-star-fill"></i> Paket Premium
        </div>
        <h1 class="hero-title" data-aos="fade-up">{{ $schedule->package_name }}</h1>
        <div class="hero-meta" data-aos="fade-up" data-aos-delay="100">
            <div class="meta-pill">
                <i class="bi bi-calendar-check"></i> 
                {{ $schedule->departure_date->format('d M Y') }}
            </div>
            <div class="meta-pill">
                <i class="bi bi-geo-alt"></i> 
                {{ $schedule->departure_route }}
            </div>
            <div class="meta-pill">
                <i class="bi bi-airplane"></i> 
                {{ $schedule->airline }}
            </div>
            <div class="meta-pill">
                 <i class="bi bi-clock"></i>
                 {{ $schedule->duration }}
            </div>
        </div>
    </div>
</section>

<div class="container main-container">
    <div class="row">
        <!-- LEFT COLUMN: Content (Tabs) -->
        <div class="col-lg-8">
            
            <!-- OVERVIEW CARD -->
            <div class="content-card mb-4" data-aos="fade-up">
                <div class="card-header-premium">
                    <h3>Sekilas Paket</h3>
                </div>
                <div class="card-body-premium">
                    <p class="description-text">
                        {{ $schedule->description ?? 'Nikmati perjalanan ibadah Umrah yang khusyu dan nyaman bersama Mahira Tour. Paket ini dirancang khusus untuk memberikan pengalaman spiritual terbaik bagi Anda dan keluarga.' }}
                    </p>
                    
                    <div class="features-grid">
                        @if($schedule->features)
                            @foreach(explode(',', $schedule->features) as $feature)
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill text-gold"></i>
                                <span>{{ trim($feature) }}</span>
                            </div>
                            @endforeach
                        @else
                            <div class="feature-item"><i class="bi bi-check-circle-fill text-gold"></i> Tiket Pesawat PP</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill text-gold"></i> Visa Umrah</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill text-gold"></i> Hotel Berbintang</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill text-gold"></i> Makan 3x Sehari</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill text-gold"></i> Transportasi Bus AC</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill text-gold"></i> Muthawif Profesional</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- ACCOMMODATION (HOTEL) -->
            <div class="content-card mb-4" data-aos="fade-up">
                <div class="card-header-premium">
                    <h3>Akomodasi Hotel</h3>
                </div>
                <div class="card-body-premium">
                    <div class="hotel-pair">
                        <div class="hotel-item">
                            <div class="hotel-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="hotel-info">
                                <span class="city">Makkah</span>
                                <h4 class="hotel-name">{{ $schedule->hotel_makkah ?? 'Setaraf Bintang 5' }}</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="hotel-divider">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                        <div class="hotel-item">
                            <div class="hotel-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="hotel-info">
                                <span class="city">Madinah</span>
                                <h4 class="hotel-name">{{ $schedule->hotel_madinah ?? 'Setaraf Bintang 5' }}</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ITINERARY (Timeline) -->
            <div class="content-card mb-4" data-aos="fade-up">
                <div class="card-header-premium">
                    <h3>Rencana Perjalanan (Itinerary)</h3>
                </div>
                <div class="card-body-premium">
                    <div class="timeline">
                        @if($schedule->itinerary)
                             <!-- If JSON decoding logic existed, we would loop here. 
                                  For now, we'll try to display text gracefully or placeholder structure -->
                             @php 
                                $itinerary = json_decode($schedule->itinerary, true);
                             @endphp
                             
                             @if(is_array($itinerary))
                                @foreach($itinerary as $day)
                                <div class="timeline-item">
                                    <div class="timeline-marker">{{ $loop->iteration }}</div>
                                    <div class="timeline-content">
                                        <h5>Hari ke-{{ $day['day'] ?? $loop->iteration }}</h5>
                                        <p>{{ $day['activity'] ?? 'Kegiatan Ibadah' }}</p>
                                    </div>
                                </div>
                                @endforeach
                             @else
                                <div class="p-3 bg-light rounded">
                                    {!! nl2br(e($schedule->itinerary)) !!}
                                </div>
                             @endif
                        @else
                            <!-- Placeholder Itinerary -->
                            <div class="timeline-item">
                                <div class="timeline-marker">1</div>
                                <div class="timeline-content">
                                    <h5>Keberangkatan</h5>
                                    <p>Berkumpul di Bandara, proses check-in dan penerbangan menuju Jeddah/Madinah.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker">2</div>
                                <div class="timeline-content">
                                    <h5>Tiba di Madinah</h5>
                                    <p>Check-in hotel, istirahat, dan ziarah ke Makam Rasulullah SAW.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker">3</div>
                                <div class="timeline-content">
                                    <h5>Memperbanyak Ibadah</h5>
                                    <p>Fokus ibadah di Masjid Nabawi & Ziarah Raudhah.</p>
                                </div>
                            </div>
                            <!-- More days truncated -->
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: Sticky Sidebar (Price & Action) -->
        <div class="col-lg-4">
            <div class="sticky-sidebar">
                <div class="price-card" data-aos="fade-left">
                    <div class="price-header">
                        <span>Harga Mulai Dari</span>
                        <div class="price-amount">
                            Rp {{ number_format($schedule->price, 0, ',', '.') }}
                        </div>
                    </div>
                    
                    <div class="quota-info">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Sisa Kuota</span>
                            <strong>{{ $schedule->available_seats }} Kursi</strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ ($schedule->seats_taken / $schedule->quota) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    
                    <hr class="price-divider">
                    
                    @if($schedule->status === 'active' && $schedule->available_seats > 0)
                    <a href="{{ route('register', ['schedule_id' => $schedule->id]) }}" class="btn-book-now">
                        Daftar Sekarang <i class="bi bi-arrow-right"></i>
                    </a>
                    @else
                    <button class="btn-book-now disabled" disabled>
                        Paket Penuh / Tutup
                    </button>
                    @endif
                    
                    <a href="https://wa.me/6281234567890?text=Halo%20Mahira%20Tour,%20saya%20tertarik%20paket%20{{ urlencode($schedule->package_name) }}" 
                       class="btn-whatsapp" target="_blank">
                        <i class="bi bi-whatsapp"></i> Tanya via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- RELATED PACKAGES -->
    <div class="related-section mt-5">
        <h3 class="section-title text-center mb-4">Paket Lainnya</h3>
        <div class="row">
            @foreach($related_packages as $related)
            <div class="col-md-4 mb-4">
                <a href="{{ route('schedule.detail', ['id' => $related->id, 'slug' => \Illuminate\Support\Str::slug($related->package_name)]) }}" 
                   class="related-card">
                    <img src="{{ Storage::url($related->flyer_image) }}" alt="{{ $related->package_name }}">
                    <div class="related-info">
                        <h5>{{ $related->package_name }}</h5>
                        <p class="price">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Sticky Sidebar Logic (Optional Enhancement)
    window.addEventListener('scroll', function() {
        const sidebar = document.querySelector('.sticky-sidebar');
        // Logic handled by CSS sticky mostly, but can add shadow on scroll
    });
</script>
@endpush
