@extends('layouts.app')

@section('title', 'Testimoni Jamaah - Mahira Tour')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/testimonials.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-zen">
        <div class="hero-content">
            <div class="breadcrumb-zen">
                <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> BERANDA</a>
                <span>/</span>
                <span>TESTIMONI</span>
            </div>
            
            <h1>Testimoni Jamaah</h1>
            <div class="zen-divider"></div>
            <p class="subtitle">Pengalaman spiritual dari para jamaah yang telah menunaikan ibadah bersama kami</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container-zen">
        
        <!-- Section Header -->
        <div class="section-header-zen">
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
@endsection