@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Mahira Tour')

@section('preload')
    <link rel="preload" as="image" href="{{ asset('images/hero/hero-gallery.webp') }}" fetchpriority="high">
@endsection

@section('content')

{{-- ==================== HERO SECTION ==================== --}}
<section class="relative h-[300px] sm:h-[350px] md:h-[400px] overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 z-[1]">
        <img src="{{ asset('images/hero/hero-gallery.webp') }}" 
             alt="Galeri Kegiatan Mahira Tour" 
             fetchpriority="high"
             loading="eager"
             class="w-full h-full object-cover object-center animate-[heroKenBurns_20s_ease-in-out_infinite_alternate]">
    </div>
    
    <div class="absolute inset-0 z-[2] bg-primary/75"></div>
    
    <div class="relative z-[3] text-center max-w-[900px] px-5 pt-10">
        <div class="inline-flex items-center gap-2 px-4 sm:px-6 py-2 rounded-full mb-4 sm:mb-6 text-xs sm:text-[0.9rem] bg-white/15 backdrop-blur-[10px] animate-[heroFadeIn_0.8s_ease_0.2s_backwards]">
            <a href="{{ route('home') }}" class="text-white no-underline font-medium hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                Beranda
            </a>
            <span class="text-white/70">/</span>
            <span class="text-white/70">Galeri</span>
        </div>
        <h1 class="text-2xl sm:text-[2.5rem] md:text-[3.5rem] font-bold font-serif text-white mb-4 leading-tight shadow-black/30 text-shadow-lg">
            <span class="inline-block mx-1" style="opacity: 0; animation: slideInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.3s forwards;">Galeri</span>
            <span class="inline-block mx-1" style="opacity: 0; animation: slideInRight 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.5s forwards;">Kegiatan</span>
        </h1>
        <p class="font-semibold text-[0.9rem] uppercase tracking-wider mb-2 text-gold-accessible animate-[heroFadeIn_1s_ease_0.6s_backwards]">
            UMRAH BERSAMA, BERKAH BERSAMA
        </p>
        <p class="text-sm md:text-base max-w-[700px] mx-auto leading-relaxed text-white/90 animate-[heroFadeIn_1s_ease_0.6s_backwards]">
            Dokumentasi perjalanan ibadah Umrah bersama Mahira Tour
        </p>
    </div>
</section>

{{-- ==================== GALLERY SECTION ==================== --}}
<section class="py-12 bg-gray-50" x-data="{
    activeFilter: 'all',
    galleries: {{ json_encode($galleries) }},
    currentIndex: 0,
    modalOpen: false,
    
    get filteredGalleries() {
        return this.activeFilter === 'all' 
            ? this.galleries 
            : this.galleries.filter(g => g.category === this.activeFilter);
    },
    
    openModal(index) {
        const gallery = this.filteredGalleries[index];
        this.currentIndex = this.galleries.findIndex(g => g === gallery);
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

    <div class="container-main">
        
        {{-- Filter Buttons --}}
        <div class="sticky top-[76px] z-30 py-6 mb-12 bg-gray-50 border-b border-[#B89230]/10 shadow-[0_4px_20px_rgba(0,0,0,0.05)]">
            <div class="container-main">
                <div class="flex flex-wrap justify-center gap-3">
                    <button 
                        @click="activeFilter = 'all'"
                        :class="activeFilter === 'all' ? 'bg-[#B89230] text-white border-[#B89230] shadow-[0_4px_15px_rgba(184,146,48,0.25)]' : 'bg-white text-gray-500 border-gray-200 hover:border-[#B89230] hover:text-[#B89230] hover:bg-[#FEFCE8]'"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded font-semibold text-sm uppercase tracking-wider cursor-pointer transition-all duration-300 border whitespace-nowrap">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Semua
                    </button>
                    
                    @foreach($categories as $key => $category)
                    @if($key !== 'all')
                    <button 
                        @click="activeFilter = '{{ $key }}'"
                        :class="activeFilter === '{{ $key }}' ? 'bg-[#B89230] text-white border-[#B89230] shadow-[0_4px_15px_rgba(184,146,48,0.25)]' : 'bg-white text-gray-500 border-gray-200 hover:border-[#B89230] hover:text-[#B89230] hover:bg-[#FEFCE8]'"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded font-semibold text-sm uppercase tracking-wider cursor-pointer transition-all duration-300 border whitespace-nowrap">
                        {{ $category }}
                    </button>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Masonry Gallery Grid --}}
        <div class="columns-1 md:columns-2 lg:columns-3 gap-6 mb-12">
            <template x-for="(gallery, index) in filteredGalleries" :key="index">
                <div class="break-inside-avoid mb-6 rounded-xl overflow-hidden cursor-pointer relative group transition-all duration-400 hover:-translate-y-1 hover:shadow-xl"
                     @click="openModal(index)">
                    <div class="relative overflow-hidden">
                        <img :src="gallery.image" :alt="gallery.title" 
                             class="w-full h-auto block transition-transform duration-600 group-hover:scale-105 bg-gray-100">
                        
                        {{-- Zoom Icon --}}
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60px] h-[60px] rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-300 scale-75 z-10 bg-[#B89230]/90 shadow-[0_4px_15px_rgba(0,0,0,0.2)]">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        </div>
                        
                        {{-- Overlay --}}
                        <div class="absolute inset-0 flex flex-col justify-end p-6 opacity-0 group-hover:opacity-100 transition-all duration-300 md:opacity-100 bg-gradient-to-t from-black/80 to-transparent">
                            <div class="text-white font-bold text-lg font-serif translate-y-2.5 group-hover:translate-y-0 transition-transform duration-300" x-text="gallery.title"></div>
                            <span class="inline-block text-xs font-bold uppercase tracking-wider translate-y-2.5 group-hover:translate-y-0 transition-transform duration-300 delay-50 text-gold-accessible" x-text="gallery.category"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- No Results --}}
        <div x-show="filteredGalleries.length === 0" x-cloak class="text-center py-20">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h4 class="text-lg font-semibold mb-2 text-primary">Tidak ada foto dalam kategori ini</h4>
            <p class="text-sm text-stone-500">Coba pilih kategori lain</p>
        </div>
    </div>

    {{-- ==================== LIGHTBOX MODAL ==================== --}}
    <div x-show="modalOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="closeModal()" 
         role="dialog" aria-modal="true" aria-label="Galeri foto"
         class="fixed inset-0 z-[99999] flex items-center justify-center bg-black/85 backdrop-blur-[5px]">
        
        {{-- Close Button --}}
        <button @click="closeModal()" 
                aria-label="Tutup galeri"
                class="absolute top-8 right-10 z-[100000] w-[60px] h-[60px] rounded-full flex items-center justify-center text-white text-4xl cursor-pointer transition-all duration-300 border-0 hover:rotate-90 bg-white/10 backdrop-blur-[5px] hover:bg-[#B89230]/90">
            &times;
        </button>
        
        {{-- Counter --}}
        <div class="absolute top-8 left-10 text-white text-base font-semibold z-[100000] px-6 py-2.5 rounded-full bg-black/50 backdrop-blur-[5px] border border-white/20"
             x-text="`${currentIndex + 1} / ${galleries.length}`"></div>
        
        {{-- Prev Button --}}
        <button @click="changeGallery(-1)" type="button"
                aria-label="Foto sebelumnya"
                class="absolute left-8 top-1/2 -translate-y-1/2 w-[60px] h-[60px] rounded-full flex items-center justify-center text-white text-2xl cursor-pointer z-[100000] transition-all duration-300 bg-white/10 border border-white/20 backdrop-blur-[5px] hover:bg-white hover:text-[#B89230] hover:scale-110 hover:shadow-[0_0_20px_rgba(184,146,48,0.4)] hover:border-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        
        {{-- Modal Content --}}
        <template x-if="galleries[currentIndex]">
            <div class="flex flex-col items-center justify-center max-w-[95vw] max-h-[95vh] animate-[zoomIn_0.3s_ease]" @click.stop>
                <img :src="galleries[currentIndex].image" 
                     :alt="galleries[currentIndex].title"
                     class="max-w-full max-h-[85vh] w-auto h-auto object-contain rounded shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                <div class="text-center mt-5 w-full">
                    <div class="text-white text-xl font-semibold font-serif mb-2.5 shadow-black/50 text-shadow-md" 
                         x-text="galleries[currentIndex].title"></div>
                    <span class="inline-block px-4 py-1.5 rounded-full text-white text-sm font-semibold bg-[#B89230] shadow-[0_4px_10px_rgba(0,0,0,0.3)]"
                          x-text="galleries[currentIndex].category"></span>
                </div>
            </div>
        </template>
        
        {{-- Next Button --}}
        <button @click="changeGallery(1)" type="button"
                aria-label="Foto berikutnya"
                class="absolute right-8 top-1/2 -translate-y-1/2 w-[60px] h-[60px] rounded-full flex items-center justify-center text-white text-2xl cursor-pointer z-[100000] transition-all duration-300 bg-white/10 border border-white/20 backdrop-blur-[5px] hover:bg-white hover:text-[#B89230] hover:scale-110 hover:shadow-[0_0_20px_rgba(184,146,48,0.4)] hover:border-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</section>

@include('partials.cta-section')

@endsection

@push('scripts')
{{-- Removed inline style since animation is now handled via Tailwind arbitrary class --}}
<script>
    console.log('Galleries loaded:', {!! json_encode($galleries) !!});
</script>
@endpush