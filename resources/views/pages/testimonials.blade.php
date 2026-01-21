@extends('layouts.app')

@section('title', 'Testimoni Jamaah - Mahira Tour')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/testimonials.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-background">
            <img src="{{ asset('storage/hero/hero-testimonial.jpeg') }}" 
                 alt="Testimoni Jamaah Mahira Tour" 
                 loading="eager">
        </div>
        
        <div class="hero-overlay"></div>
        
        <div class="hero-content">
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">
                    <i class="bi bi-house-door-fill"></i> Beranda
                </a>
                <span>/</span>
                <span>Testimoni</span>
            </div>
            <h1>
                <span class="word">Testimoni</span> 
                <span class="word">Jamaah</span>
            </h1>
            <p>Pengalaman spiritual dari para jamaah yang telah menunaikan ibadah bersama kami</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container-zen">
        
        <!-- Video Testimonials Section -->
        <div class="section-header-zen">
            <div class="section-badge">Video Testimoni</div>
            <h2>Video Testimoni</h2>
            <p>Dengarkan langsung pengalaman jamaah kami</p>
        </div>

        <div class="video-grid-zen">
            <!-- Video 1 -->
            <div class="video-card-zen">
                <div class="video-wrapper-zen">
                    <div class="youtube-lite" data-id="B-JQ7BGS5i8">
                        <img src="https://img.youtube.com/vi/B-JQ7BGS5i8/hqdefault.jpg" alt="Thumnbail Testimoni">
                        <div class="play-btn"></div>
                    </div>
                </div>
                <div class="video-caption-zen">
                    <h4>Pengalaman Umrah Luar Biasa</h4>
                    <p>Jamaah Mahira Tour</p>
                </div>
            </div>

            <!-- Video 2 -->
            <div class="video-card-zen">
                <div class="video-wrapper-zen">
                    <div class="youtube-lite" data-id="lSbViwp5fCA">
                        <img src="https://img.youtube.com/vi/lSbViwp5fCA/hqdefault.jpg" alt="Thumnbail Testimoni">
                        <div class="play-btn"></div>
                    </div>
                </div>
                <div class="video-caption-zen">
                    <h4>Pelayanan Sangat Memuaskan</h4>
                    <p>Jamaah Mahira Tour</p>
                </div>
            </div>

            <!-- Video 3 -->
            <div class="video-card-zen">
                <div class="video-wrapper-zen">
                    <div class="youtube-lite" data-id="JgQmegExd5A">
                        <img src="https://img.youtube.com/vi/JgQmegExd5A/hqdefault.jpg" alt="Thumnbail Testimoni">
                        <div class="play-btn"></div>
                    </div>
                </div>
                <div class="video-caption-zen">
                    <h4>Bimbingan Spiritual Berkualitas</h4>
                    <p>Jamaah Mahira Tour</p>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="section-divider-zen"></div>

        <!-- Text Testimonials Section -->
        <div class="section-header-zen">
            <div class="section-badge">Cerita Jamaah</div>
            <h2>Apa Kata Mereka</h2>
            <p>Cerita inspiratif dari jamaah yang telah berangkat</p>
        </div>

        <!-- Testimonials Grid -->
        <div class="testimonial-grid-zen">
            @forelse($testimonials as $testimonial)
                <article class="testimonial-card-zen">
                    <div class="rating-zen">
                        <span class="stars-zen">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= $testimonial['rating'] ? '★' : '☆' }}
                            @endfor
                        </span>
                        <span class="rating-number">{{ $testimonial['rating'] }}.0</span>
                    </div>
                    
                    <blockquote class="quote-zen">
                        "{{ $testimonial['comment'] }}"
                    </blockquote>
                    
                    <div class="card-divider"></div>
                    
                    <div class="author-zen">
                        <div class="author-avatar-zen">
                            <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}">
                        </div>
                        <div class="author-info-zen">
                            <h4>{{ $testimonial['name'] }}</h4>
                            <p class="author-meta-zen">
                                <i class="bi bi-geo-alt"></i>{{ $testimonial['location'] }} · 
                                {{ \Carbon\Carbon::parse($testimonial['date'])->locale('id')->format('F Y') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="package-zen">{{ $testimonial['package'] }}</div>
                </article>
            @empty
                <div class="empty-state-zen">
                    <i class="bi bi-chat-dots"></i>
                    <h3>Belum Ada Testimoni</h3>
                    <p>Testimoni dari jamaah akan ditampilkan di sini</p>
                </div>
            @endforelse
        </div>

        <!-- CTA Section -->
        <section class="cta-zen">
            <h3>Siap Berangkat Umrah?</h3>
            <p>Bergabunglah dengan ratusan jamaah yang telah merasakan pelayanan terbaik kami</p>
            <a href="{{ route('register') }}" class="btn-zen">
                <i class="bi bi-calendar-check"></i>
                DAFTAR SEKARANG
            </a>
        </section>

    </main>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const youtubeLites = document.querySelectorAll('.youtube-lite');
        
        youtubeLites.forEach(lite => {
            lite.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const iframe = document.createElement('iframe');
                iframe.setAttribute('src', `https://www.youtube.com/embed/${id}?autoplay=1&rel=0&modestbranding=1&playsinline=1`);
                iframe.setAttribute('title', 'YouTube video player');
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                iframe.setAttribute('allowfullscreen', '1');
                
                this.parentNode.replaceChild(iframe, this);
            });
        });
    });
</script>
@endpush
@endsection