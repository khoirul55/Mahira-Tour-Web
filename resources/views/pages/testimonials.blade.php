{{-- File: resources/views/pages/testimonial.blade.php --}}
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
            <span class="word">Cerita</span> 
            <span class="word">Inspiratif</span> 
            <span class="word">Jamaah</span>
        </h1>
        <p>Pengalaman spiritual berharga dari para jamaah yang telah menunaikan ibadah bersama Mahira Tour</p>
    </div>
</section>

<!-- Featured Video Testimonial Section -->
<section class="py-5" style="background: white;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="display-6 fw-bold mb-2" style="color: #1F2937;">Dengarkan Langsung dari Jamaah Kami</h2>
                <p class="text-muted">Pengalaman nyata dalam video testimoni</p>
            </div>
        </div>

        <!-- Featured Video Card -->
        <div class="featured-video-card">
            <div class="row g-0 align-items-center">
                <!-- Video Section -->
                <div class="col-lg-7">
                    <div class="video-wrapper">
                        <iframe 
                            width="100%" 
                            height="450" 
                            src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                            title="Testimoni Jamaah Mahira Tour"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            style="border-radius: 16px;">
                        </iframe>
                    </div>
                </div>
                
                <!-- Story Section -->
                <div class="col-lg-5">
                    <div class="video-story-content">
                        <div class="story-quote-icon">
                            <i class="bi bi-quote"></i>
                        </div>
                        
                        <h3 class="story-title">Pengalaman Umrah yang Tak Terlupakan</h3>
                        
                        <div class="story-author">
                            <img src="{{ asset('storage/testimonials/avatar-default.jpg') }}" alt="Ahmad Yani" class="author-avatar">
                            <div>
                                <h4 class="author-name">Bapak Ahmad Yani</h4>
                                <p class="author-location">
                                    <i class="bi bi-geo-alt-fill"></i> Lampung
                                    <span class="mx-2">•</span>
                                    <i class="bi bi-box-seam"></i> Paket Umrah Reguler
                                </p>
                            </div>
                        </div>
                        
                        <blockquote class="story-text">
                            "Alhamdulillah, pelayanan Mahira Tour sangat memuaskan. Hotel dekat dengan Masjidil Haram, pembimbing sangat ramah dan membantu. Perlengkapan lengkap, semuanya terorganisir dengan baik. Pengalaman spiritual yang luar biasa!"
                        </blockquote>
                        
                        <div class="story-meta">
                            <i class="bi bi-calendar3"></i>
                            <span>November 2024</span>
                            <span class="mx-2">•</span>
                            <i class="bi bi-clock"></i>
                            <span>9 Hari 7 Malam</span>
                        </div>
                        
                        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="btn-watch-full">
                            <i class="bi bi-youtube"></i>
                            Tonton Video Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Text Testimonials Grid Section -->
<section class="py-5" style="background: linear-gradient(180deg, #FFFFFF 0%, #F8F9FA 100%);">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-6 fw-bold mb-3" style="color: #1F2937;">Cerita Inspiratif dari Jamaah Kami</h2>
                <p class="text-muted">
                    Dengarkan pengalaman nyata dari para jamaah yang telah merasakan pelayanan terbaik kami
                </p>
            </div>
        </div>

        <!-- Testimonials Grid -->
        <div class="row g-4">
            @foreach($testimonials as $index => $testimonial)
                <div class="col-lg-4 col-md-6">
                    @include('components.testimonial-card', ['testimonial' => $testimonial])
                </div>
            @endforeach
        </div>

        <!-- Empty State (jika tidak ada testimoni) -->
        @if(count($testimonials) === 0)
            <div class="row">
                <div class="col-12 text-center py-5">
                    <i class="bi bi-chat-dots display-1 text-muted mb-3"></i>
                    <h3 class="text-muted">Belum Ada Testimoni</h3>
                    <p class="text-muted">Testimoni dari jamaah akan ditampilkan di sini</p>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection