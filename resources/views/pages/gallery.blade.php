@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
@endpush

@section('content')

<!-- HAPUS x-data wrapper luar, pindahkan ke section -->
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

<!-- SATU x-data untuk semua -->
<section class="py-5 bg-light" x-data="{
    activeFilter: 'all',
    galleries: @js($galleries),
    currentIndex: 0,
    modalOpen: false,
    
    get filteredGalleries() {
        return this.activeFilter === 'all' 
            ? this.galleries 
            : this.galleries.filter(g => g.category === this.activeFilter);
    },
    
    openModal(index) {
        this.currentIndex = index;
        this.modalOpen = true;
        document.body.style.overflow = 'hidden';
    },
    
    closeModal() {
        this.modalOpen = false;
        document.body.style.overflow = '';
    },
    
    changeGallery(direction) {
        this.currentIndex = (this.currentIndex + direction + this.galleries.length) % this.galleries.length;
    }
}" 
@keydown.escape.window="if(modalOpen) closeModal()" 
@keydown.arrow-left.window="if(modalOpen) changeGallery(-1)" 
@keydown.arrow-right.window="if(modalOpen) changeGallery(1)">

    <div class="container">
        
        <!-- Filter Section -->
        <div class="filter-container">
            <div class="container">
                <div class="filter-scroll">
                    <button 
                        @click="activeFilter = 'all'"
                        :class="{ 'active': activeFilter === 'all' }"
                        class="filter-btn">
                        <i class="bi bi-grid-fill"></i> Semua
                    </button>
                    
                    @foreach($categories as $key => $category)
                    @if($key !== 'all')
                    <button 
                        @click="activeFilter = '{{ $key }}'"
                        :class="{ 'active': activeFilter === '{{ $key }}' }"
                        class="filter-btn">
                        <i class="bi bi-{{ $key === 'Makkah' ? 'building' : 'camera' }}"></i>
                        {{ $category }}
                    </button>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid">
            <template x-for="(gallery, index) in filteredGalleries" :key="index">
                <div class="gallery-card" @click="openModal(index)">
                    <div class="gallery-image-wrapper">
                        <img :src="gallery.image" :alt="gallery.title" class="gallery-image">
                        <div class="zoom-icon"><i class="bi bi-zoom-in"></i></div>
                        <div class="gallery-overlay">
                            <div class="gallery-title" x-text="gallery.title"></div>
                            <span class="gallery-category" x-text="gallery.category"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- No Results -->
        <div x-show="filteredGalleries.length === 0" class="no-results">
            <i class="bi bi-images"></i>
            <h4>Tidak ada foto dalam kategori ini</h4>
            <p>Coba pilih kategori lain</p>
        </div>
    </div>
</section>

<!-- Modal - PINDAHKAN KE DALAM SECTION -->
<div x-show="modalOpen" 
     x-cloak
     x-transition
     @click.self="closeModal()"
     class="gallery-modal">
    
    <span class="gallery-close" @click="closeModal()">&times;</span>
    
    <div class="gallery-counter" x-text="`${currentIndex + 1} / ${galleries.length}`"></div>
    
    <button class="gallery-nav prev" @click="changeGallery(-1)">
        <i class="bi bi-chevron-left"></i>
    </button>
    
    <div class="gallery-modal-content">
        <img :src="galleries[currentIndex].image" 
             :alt="galleries[currentIndex].title">
        <div class="modal-info">
            <div class="modal-title" x-text="galleries[currentIndex].title"></div>
            <span class="modal-category" x-text="galleries[currentIndex].category"></span>
        </div>
    </div>
    
    <button class="gallery-nav next" @click="changeGallery(1)">
        <i class="bi bi-chevron-right"></i>
    </button>
</div>
</section>

@endsection

@push('scripts')
<script>
    // Galleries data for debugging
    console.log('Galleries loaded:', @json($galleries));
</script>
@endpush