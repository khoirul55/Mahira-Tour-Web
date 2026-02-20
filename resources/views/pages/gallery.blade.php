@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Mahira Tour')

@section('content')

{{-- ==================== HERO SECTION ==================== --}}
<section class="relative h-[450px] md:h-[400px] sm:h-[350px] overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 z-[1]">
        <img src="{{ asset('images/hero/hero-gallery.webp') }}" 
             alt="Galeri Kegiatan Mahira Tour" 
             fetchpriority="high"
             loading="eager"
             class="w-full h-full object-cover object-center"
             style="animation: heroKenBurns 20s ease-in-out infinite alternate;">
    </div>
    
    <div class="absolute inset-0 z-[2]" style="background: rgba(0, 29, 95, 0.75);"></div>
    
    <div class="relative z-[3] text-center max-w-[900px] px-5 pt-10">
        <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full mb-6 text-[0.9rem]"
             style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); animation: heroFadeIn 0.8s ease 0.2s backwards;">
            <a href="{{ route('home') }}" class="text-white no-underline font-medium hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                Beranda
            </a>
            <span style="color: rgba(255,255,255,0.7);">/</span>
            <span style="color: rgba(255,255,255,0.7);">Galeri</span>
        </div>
        <h1 class="text-[3.5rem] md:text-[2.5rem] sm:text-[2rem] font-bold font-serif text-white mb-4 leading-tight"
            style="text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
            <span class="inline-block mx-1 opacity-0" style="animation: slideInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.3s forwards;">Galeri</span>
            <span class="inline-block mx-1 opacity-0" style="animation: slideInRight 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.5s forwards;">Kegiatan</span>
        </h1>
        <p class="font-semibold text-[0.9rem] uppercase tracking-wider mb-2" style="color: #D4AF37; animation: heroFadeIn 1s ease 0.6s backwards;">
            UMRAH BERSAMA, BERKAH BERSAMA
        </p>
        <p class="text-sm md:text-base max-w-[700px] mx-auto leading-relaxed" 
           style="color: rgba(255,255,255,0.9); animation: heroFadeIn 1s ease 0.6s backwards;">
            Dokumentasi perjalanan ibadah Umrah bersama Mahira Tour
        </p>
    </div>
</section>

{{-- ==================== GALLERY SECTION ==================== --}}
<section class="py-12" style="background: #F8F9FA;" x-data="{
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
        <div class="sticky top-[76px] z-30 py-6 mb-12" style="background: #F8F9FA; border-bottom: 1px solid rgba(184, 146, 48, 0.1); box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
            <div class="container-main">
                <div class="flex flex-wrap justify-center gap-3">
                    <button 
                        @click="activeFilter = 'all'"
                        :class="{ 'active-filter': activeFilter === 'all' }"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded font-semibold text-sm uppercase tracking-wider cursor-pointer transition-all duration-300 border whitespace-nowrap"
                        :style="activeFilter === 'all' ? 'background: #B89230; color: white; border-color: #B89230; box-shadow: 0 4px 15px rgba(184,146,48,0.25);' : 'background: white; color: #6B7280; border-color: #E5E7EB;'"
                        onmouseover="if(!this.classList.contains('active-filter')){this.style.borderColor='#B89230'; this.style.color='#B89230'; this.style.background='#FEFCE8';}"
                        onmouseout="if(!this.classList.contains('active-filter')){this.style.borderColor='#E5E7EB'; this.style.color='#6B7280'; this.style.background='white';}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Semua
                    </button>
                    
                    @foreach($categories as $key => $category)
                    @if($key !== 'all')
                    <button 
                        @click="activeFilter = '{{ $key }}'"
                        :style="activeFilter === '{{ $key }}' ? 'background: #B89230; color: white; border-color: #B89230; box-shadow: 0 4px 15px rgba(184,146,48,0.25);' : 'background: white; color: #6B7280; border-color: #E5E7EB;'"
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
                             class="w-full h-auto block transition-transform duration-600 group-hover:scale-105"
                             style="background-color: #f3f4f6;">
                        
                        {{-- Zoom Icon --}}
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60px] h-[60px] rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-300 scale-75 z-10"
                             style="background: rgba(184, 146, 48, 0.9); box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        </div>
                        
                        {{-- Overlay --}}
                        <div class="absolute inset-0 flex flex-col justify-end p-6 opacity-0 group-hover:opacity-100 transition-all duration-300 md:opacity-100"
                             style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent 40%);">
                            <div class="text-white font-bold text-lg font-serif translate-y-2.5 group-hover:translate-y-0 transition-transform duration-300" x-text="gallery.title"></div>
                            <span class="inline-block text-xs font-bold uppercase tracking-wider translate-y-2.5 group-hover:translate-y-0 transition-transform duration-300 delay-50"
                                  style="color: #D4AF37;" x-text="gallery.category"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- No Results --}}
        <div x-show="filteredGalleries.length === 0" x-cloak class="text-center py-20">
            <svg class="w-16 h-16 mx-auto mb-4" style="color: #E5E7EB;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h4 class="text-lg font-semibold mb-2" style="color: #001D5F;">Tidak ada foto dalam kategori ini</h4>
            <p class="text-sm" style="color: #78716c;">Coba pilih kategori lain</p>
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
         class="fixed inset-0 z-[99999] flex items-center justify-center"
         style="background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(5px);">
        
        {{-- Close Button --}}
        <button @click="closeModal()" 
                class="absolute top-8 right-10 z-[100000] w-[60px] h-[60px] rounded-full flex items-center justify-center text-white text-4xl cursor-pointer transition-all duration-300 border-0 hover:rotate-90"
                style="background: rgba(255,255,255,0.1); backdrop-filter: blur(5px);"
                onmouseover="this.style.background='rgba(184,146,48,0.9)';"
                onmouseout="this.style.background='rgba(255,255,255,0.1)';">
            &times;
        </button>
        
        {{-- Counter --}}
        <div class="absolute top-8 left-10 text-white text-base font-semibold z-[100000] px-6 py-2.5 rounded-full"
             style="background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.2);"
             x-text="`${currentIndex + 1} / ${galleries.length}`"></div>
        
        {{-- Prev Button --}}
        <button @click="changeGallery(-1)" type="button"
                class="absolute left-8 top-1/2 -translate-y-1/2 w-[60px] h-[60px] rounded-full flex items-center justify-center text-white text-2xl cursor-pointer z-[100000] transition-all duration-300"
                style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(5px);"
                onmouseover="this.style.background='white'; this.style.color='#B89230'; this.style.transform='translateY(-50%) scale(1.1)'; this.style.boxShadow='0 0 20px rgba(184,146,48,0.4)'; this.style.borderColor='white';"
                onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.color='white'; this.style.transform='translateY(-50%)'; this.style.boxShadow='none'; this.style.borderColor='rgba(255,255,255,0.2)';">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        
        {{-- Modal Content --}}
        <template x-if="galleries[currentIndex]">
            <div class="flex flex-col items-center justify-center max-w-[95vw] max-h-[95vh]" @click.stop
                 style="animation: zoomIn 0.3s ease;">
                <img :src="galleries[currentIndex].image" 
                     :alt="galleries[currentIndex].title"
                     class="max-w-full max-h-[85vh] w-auto h-auto object-contain rounded"
                     style="box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
                <div class="text-center mt-5 w-full">
                    <div class="text-white text-xl font-semibold font-serif mb-2.5" 
                         style="text-shadow: 0 2px 4px rgba(0,0,0,0.5);" 
                         x-text="galleries[currentIndex].title"></div>
                    <span class="inline-block px-4 py-1.5 rounded-full text-white text-sm font-semibold"
                          style="background: #B89230; box-shadow: 0 4px 10px rgba(0,0,0,0.3);"
                          x-text="galleries[currentIndex].category"></span>
                </div>
            </div>
        </template>
        
        {{-- Next Button --}}
        <button @click="changeGallery(1)" type="button"
                class="absolute right-8 top-1/2 -translate-y-1/2 w-[60px] h-[60px] rounded-full flex items-center justify-center text-white text-2xl cursor-pointer z-[100000] transition-all duration-300"
                style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(5px);"
                onmouseover="this.style.background='white'; this.style.color='#B89230'; this.style.transform='translateY(-50%) scale(1.1)'; this.style.boxShadow='0 0 20px rgba(184,146,48,0.4)'; this.style.borderColor='white';"
                onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.color='white'; this.style.transform='translateY(-50%)'; this.style.boxShadow='none'; this.style.borderColor='rgba(255,255,255,0.2)';">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</section>

@include('partials.cta-section')

@endsection

@push('scripts')
<style>
    @keyframes zoomIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>
<script>
    console.log('Galleries loaded:', @json($galleries));
</script>
@endpush