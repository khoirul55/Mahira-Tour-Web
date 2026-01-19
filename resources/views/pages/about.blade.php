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
        <p>Mitra terpercaya perjalanan ibadah Anda sejak 2016</p>
    </div>
</section>

{{-- FOUNDER STORY --}}
<section class="founder-story-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Cerita Kami</div>
            <h2 class="section-title">Dari Mimpi Keluarga Kecil,<br>Kini Melayani Ribuan Jamaah</h2>
        </div>
        
        {{-- Founder Photos --}}
        <div class="founders-grid">
            <div class="founder-card">
                <div class="founder-photo">
                    <img src="{{ asset('storage/team/direktur.webp') }}" alt="Khilal Hamdan">
                </div>
                <h4>Ust. Khilal Hamdan</h4>
                <p>Co-Founder & Direktur</p>
            </div>
            <div class="founder-card">
                <div class="founder-photo">
                    <img src="{{ asset('storage/team/komisaris.webp') }}" alt="Nadirman Hamdan">
                </div>
                <h4>Ust. Nadirman Hamdan</h4>
                <p>Co-Founder & Komisaris</p>
            </div>
        </div>
        
        {{-- Story Content --}}
        <div class="story-content">
            <div class="story-quote">
                <i class="bi bi-quote"></i>
                <p>"Tahun 2016, kami berangkat umrah pertama kali. Pengalaman yang mengubah hidup. 
                Dari situ lahir mimpi: <strong>membantu keluarga Indonesia merasakan momen spiritual yang sama.</strong> 
                Kami tahu perjalanan ibadah bukan hanya soal tiket dan hotel, tapi tentang membangun kenangan 
                yang akan diingat selamanya."</p>
                <span class="quote-author">— Ust. Khilal Hamdan & Ust. Nadirman Hamdan</span>
            </div>
            
            {{-- Timeline --}}
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2016</div>
                    <div class="timeline-content">
                        <h5>Awal Mula</h5>
                        <p>Berangkat umrah pertama kali dan merasakan pengalaman spiritual yang mengubah hidup</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h5>Resmi Berizin</h5>
                        <p>Mendapat izin resmi PPIU dari Kementerian Agama RI</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2026</div>
                    <div class="timeline-content">
                        <h5>Lebih dari 5000 Jamaah</h5>
                        <p>Telah melayani ribuan keluarga Indonesia dengan penuh dedikasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- OUR VALUES --}}
<section class="values-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Nilai-Nilai Kami</div>
            <h2 class="section-title">Komitmen yang Kami Pegang</h2>
            <p class="section-subtitle">Prinsip yang memandu setiap langkah kami dalam melayani jamaah</p>
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
<section class="leadership">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Kepemimpinan</div>
            <h2 class="section-title">Tim Pimpinan Mahira Tour</h2>
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

{{-- TRUST & CERTIFIED (Stats + Legal gabung) --}}
<section class="trust-certified-section">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">Dipercaya & Bersertifikat</div>
            <h2 class="section-title">Terpercaya oleh Ribuan Jamaah</h2>
            <p class="section-subtitle">Dengan izin resmi dan pengawasan dari lembaga pemerintah</p>
        </div>
        
        {{-- Stats --}}
        <div class="stats-grid-compact">
            <div class="stat-item-compact">
                <div class="stat-number">5000+</div>
                <div class="stat-label">Jamaah Terlayani</div>
            </div>
            <div class="stat-item-compact">
                <div class="stat-number">10+</div>
                <div class="stat-label">Tahun Berpengalaman</div>
            </div>
            <div class="stat-item-compact">
                <div class="stat-number">45+</div>
                <div class="stat-label">Keberangkatan/Tahun</div>
            </div>
            <div class="stat-item-compact">
                <div class="stat-number">4.9/5</div>
                <div class="stat-label">Rating Testimoni</div>
            </div>
        </div>
        
        {{-- Legal Partners --}}
        <div class="legal-grid-compact">
            <div class="legal-card-compact">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/kemenag.png') }}" alt="Kementerian Agama RI" loading="lazy">
                </div>
                <h5>Kementerian Agama RI</h5>
                <p>PPIU No: 21062301498960002</p>
            </div>
            
            <div class="legal-card-compact">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/siskopatuh.png') }}" alt="Siskopatuh" loading="lazy">
                </div>
                <h5>Siskopatuh</h5>
                <p>Sistem Komputerisasi Haji</p>
            </div>
            
            <div class="legal-card-compact">
                <div class="legal-logo">
                    <img src="{{ asset('images/partners/himpuh.png') }}" alt="HIMPUH" loading="lazy">
                </div>
                <h5>HIMPUH</h5>
                <p>Himpunan Penyelenggara Umrah</p>
            </div>
        </div>
    </div>
</section>

{{-- BRANCHES --}}
<section class="branches">
    <div class="container">
        <div class="section-header-center">
            <div class="section-badge">7 Cabang di Indonesia & 2 Cabang Internasional</div>
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