@extends('layouts.app')

@section('title', 'Testimoni Jamaah - Mahira Tour')

@section('preload')
    <link rel="preload" as="image" href="{{ asset('images/hero/hero-testimonial.webp') }}" fetchpriority="high">
@endsection

@section('content')
    {{-- ==================== HERO SECTION ==================== --}}
    <section class="relative h-[300px] sm:h-[350px] md:h-[400px] overflow-hidden flex items-center justify-center">
        <div class="absolute inset-0 z-[1]">
            <img src="{{ asset('images/hero/hero-testimonial.webp') }}" 
                 alt="Testimoni Jamaah Mahira Tour" 
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
                <span class="text-white/70">Testimoni</span>
            </div>
            <h1 class="text-2xl sm:text-[2.5rem] md:text-[3.5rem] font-bold font-serif text-white mb-4 leading-tight shadow-black/30 text-shadow-lg">
                <span class="inline-block mx-1" style="opacity: 0; animation: slideInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.3s forwards;">Testimoni</span>
                <span class="inline-block mx-1" style="opacity: 0; animation: slideInRight 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.5s forwards;">Jamaah</span>
            </h1>
            <p class="font-semibold text-[0.9rem] uppercase tracking-wider mb-2 text-gold animate-[heroFadeIn_1s_ease_0.6s_backwards]">
                UMRAH BERSAMA, BERKAH BERSAMA
            </p>
            <p class="text-sm md:text-base max-w-[700px] mx-auto leading-relaxed text-white/90 animate-[heroFadeIn_1s_ease_0.6s_backwards]">
                Pengalaman spiritual dari para jamaah yang telah menunaikan ibadah bersama kami
            </p>
        </div>
    </section>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <main class="container-main pb-16">
        
        {{-- Video Testimonials Section --}}
        <div class="text-center mt-16 mb-12">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-gold-accessible border-b-2 border-gold">Video Testimoni</span>
            <h2 class="text-2xl md:text-3xl font-normal mb-3 text-gray-800">Video Testimoni</h2>
            <p class="text-base text-stone-500 font-light">Dengarkan langsung pengalaman jamaah kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @php
                $videos = [
                    ['id' => 'B-JQ7BGS5i8', 'title' => 'Pengalaman Umrah Luar Biasa', 'author' => 'Jamaah Mahira Tour'],
                    ['id' => 'lSbViwp5fCA', 'title' => 'Pelayanan Sangat Memuaskan', 'author' => 'Jamaah Mahira Tour'],
                    ['id' => 'JgQmegExd5A', 'title' => 'Bimbingan Spiritual Berkualitas', 'author' => 'Jamaah Mahira Tour'],
                ];
            @endphp
            @foreach($videos as $video)
            <div class="rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-xl group bg-white border border-gray-200">
                <div class="relative w-full pb-[56.25%]">
                    <div class="youtube-lite absolute inset-0 bg-black cursor-pointer flex items-center justify-center" data-id="{{ $video['id'] }}">
                        <img src="https://img.youtube.com/vi/{{ $video['id'] }}/hqdefault.jpg" alt="Thumbnail Testimoni"
                             class="w-full h-full object-cover opacity-70 group-hover:opacity-90 transition-opacity duration-300">
                        <div class="absolute w-[68px] h-[48px] rounded-xl flex items-center justify-center z-[2] transition-all duration-300 group-hover:scale-110 bg-red-600/90">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="p-5 text-center">
                    <h4 class="text-sm font-semibold mb-1 text-gray-800">{{ $video['title'] }}</h4>
                    <p class="text-xs text-stone-500">{{ $video['author'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Divider --}}
        <div class="w-full h-px my-16 bg-gray-200"></div>

        {{-- Text Testimonials Section --}}
        <div class="text-center mb-12">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-gold-accessible border-b-2 border-gold">Cerita Jamaah</span>
            <h2 class="text-2xl md:text-3xl font-normal mb-3 text-gray-800">Apa Kata Mereka</h2>
            <p class="text-base text-stone-500 font-light">Cerita inspiratif dari jamaah yang telah berangkat</p>
        </div>

        {{-- Testimonials Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($testimonials as $testimonial)
                <article class="relative p-8 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-lg group bg-white border border-gray-200">
                    {{-- Left accent line on hover --}}
                    <div class="absolute top-0 left-0 w-0.5 h-0 transition-all duration-300 group-hover:h-full bg-primary"></div>
                    
                    {{-- Rating --}}
                    <div class="flex items-center gap-2 mb-6 text-xs tracking-widest">
                        <span class="text-gold-accessible tracking-[2px]">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= $testimonial['rating'] ? '★' : '☆' }}
                            @endfor
                        </span>
                        <span class="font-medium text-stone-700">{{ $testimonial['rating'] }}.0</span>
                    </div>
                    
                    {{-- Quote --}}
                    <blockquote class="leading-relaxed mb-7 text-[15px] font-serif text-stone-700 leading-[1.8]">
                        "{{ $testimonial['comment'] }}"
                    </blockquote>
                    
                    {{-- Divider --}}
                    <div class="w-10 h-px my-7 bg-primary"></div>
                    
                    {{-- Author --}}
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 bg-stone-50 border border-gray-200">
                            <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-[15px] font-medium mb-1 text-stone-900">{{ $testimonial['name'] }}</h4>
                            <p class="text-[13px] m-0 text-stone-500">
                                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                {{ $testimonial['location'] }} · 
                                {{ \Carbon\Carbon::parse($testimonial['date'])->locale('id')->format('F Y') }}
                            </p>
                        </div>
                    </div>
                    
                    {{-- Package Badge --}}
                    <div class="text-[11px] uppercase tracking-wider font-medium py-2 text-stone-700">
                        {{ $testimonial['package'] }}
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-20">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <h3 class="text-xl font-normal mb-2 text-stone-500">Belum Ada Testimoni</h3>
                    <p class="text-[15px] text-stone-500 font-light">Testimoni dari jamaah akan ditampilkan di sini</p>
                </div>
            @endforelse
        </div>

    </main>

    @include('partials.cta-section')

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const youtubeLites = document.querySelectorAll('.youtube-lite');
        
        youtubeLites.forEach(lite => {
            lite.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const iframe = document.createElement('iframe');
                const origin = window.location.origin;
                iframe.setAttribute('src', `https://www.youtube.com/embed/${id}?autoplay=1&rel=0&modestbranding=1&playsinline=1&origin=${origin}`);
                iframe.setAttribute('title', 'YouTube video player');
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
                iframe.setAttribute('allowfullscreen', '1');
                iframe.classList.add('absolute', 'inset-0', 'w-full', 'h-full', 'border-0');
                
                this.parentNode.replaceChild(iframe, this);
            });
        });
    });
</script>
@endpush
@endsection