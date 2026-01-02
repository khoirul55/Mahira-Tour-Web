@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Mahira Tour')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
@endpush


<!-- Hero Section -->
<section class="hero">
    <div class="hero-background">
        <img src="{{ asset('storage/hero/hero-gallery.jpeg') }}" 
             alt="Galeri Kegiatan Mahira Tour" 
             loading="eager">
    </div>
    
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}">
                <i class="bi bi-house-door-fill"></i> Beranda
            </a>
            <span>/</span>
            <span>Galeri</span>
        </div>
        <h1>
            <span class="word">Galeri</span> 
            <span class="word">Kegiatan</span>
        </h1>
        <p>Dokumentasi perjalanan ibadah Umrah bersama Mahira Tour</p>
    </div>
</section>

<!-- Filter Section -->
<div class="filter-container">
    <div class="container">
        <div class="filter-scroll">
            @foreach($categories as $key => $category)
            <button 
                class="filter-btn {{ $key === 'all' ? 'active' : '' }}"
                onclick="filterGallery('{{ $key }}')"
                data-filter="{{ $key }}">
                <i class="bi bi-{{ $key === 'all' ? 'grid-fill' : ($key === 'Makkah' ? 'building' : ($key === 'Madinah' ? 'building-fill' : ($key === 'Wisata Islami' ? 'compass' : ($key === 'Akomodasi' ? 'house-door' : ($key === 'Dokumentasi' ? 'camera' : ($key === 'Fasilitas' ? 'gear' : 'airplane')))))) }}"></i>
                {{ $category }}
            </button>
            @endforeach
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="py-5 bg-light">
    <div class="container">
        <!-- Gallery Grid -->
        <div class="gallery-grid" id="galleryGrid">
            @foreach($galleries as $index => $gallery)
            <div class="gallery-card" data-category="{{ $gallery['category'] }}" onclick="openModal({{ $index }})">
                <div class="gallery-image-wrapper">
                    <img src="{{ $gallery['image'] }}" alt="{{ $gallery['title'] }}" class="gallery-image" loading="lazy">
                    <div class="zoom-icon">
                        <i class="bi bi-zoom-in"></i>
                    </div>
                    <div class="gallery-overlay">
                        <div class="gallery-title">{{ $gallery['title'] }}</div>
                        <span class="gallery-category">{{ $gallery['category'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- No Results -->
        <div class="no-results" id="noResults" style="display: none;">
            <i class="bi bi-images"></i>
            <h4>Tidak ada foto dalam kategori ini</h4>
            <p>Coba pilih kategori lain</p>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="gallery-modal" id="galleryModal">
    <span class="gallery-close" onclick="closeGalleryModal()">&times;</span>
    <div class="gallery-counter" id="galleryCounter">1 / 5</div>
    <div class="gallery-nav prev" onclick="changeGallery(-1)">
        <i class="bi bi-chevron-left"></i>
    </div>
    <div class="gallery-nav next" onclick="changeGallery(1)">
        <i class="bi bi-chevron-right"></i>
    </div>
    <div class="gallery-modal-content">
        <img id="galleryModalImg" src="" alt="">
        <div class="modal-info">
            <div class="modal-title" id="modalTitle"></div>
            <span class="modal-category" id="modalCategory"></span>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Pass data galleries dari PHP ke JavaScript
    const galleries = @json($galleries);
</script>
<script src="{{ asset('js/gallery.js') }}"></script>
@endpush

@endsection