@extends('layouts.app')

@section('title', 'Jadwal Keberangkatan - Mahira Tour')

@section('preload')
    <link rel="preload" as="image" href="{{ asset('images/hero/hero-schedule.webp') }}" fetchpriority="high">
@endsection

@section('content')
{{-- ==================== HERO SECTION ==================== --}}
<section class="relative h-[300px] sm:h-[350px] md:h-[400px] overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 z-[1]">
        <img src="{{ asset('images/hero/hero-schedule.webp') }}" alt="Jadwal Keberangkatan Mahira Tour" fetchpriority="high" loading="eager"
             class="w-full h-full object-cover object-center animate-[heroKenBurns_20s_ease-in-out_infinite_alternate]">
    </div>
    <div class="absolute inset-0 z-[2] bg-primary/75"></div>
    <div class="relative z-[3] text-center max-w-[900px] px-5 pt-10">
        <div class="inline-flex items-center gap-2 px-4 sm:px-6 py-2 rounded-full mb-4 sm:mb-6 text-xs sm:text-[0.9rem] bg-white/15 backdrop-blur-[10px]">
            <a href="{{ route('home') }}" class="text-white no-underline font-medium hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                Beranda
            </a>
            <span class="text-white/70">/</span>
            <span class="text-white/70">Jadwal Keberangkatan</span>
        </div>
        <h1 class="text-2xl sm:text-[2.5rem] md:text-[3.5rem] font-bold font-serif text-white mb-4 leading-tight [text-shadow:0_4px_20px_rgba(0,0,0,0.3)]">
            <span class="inline-block mx-1" style="opacity: 0; animation: slideInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.3s forwards;">Jadwal</span>
            <span class="inline-block mx-1" style="opacity: 0; animation: slideInRight 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.5s forwards;">Keberangkatan</span>
        </h1>
        <p class="font-semibold text-[0.9rem] uppercase tracking-wider mb-2 text-gold">UMRAH BERSAMA, BERKAH BERSAMA</p>
        <p class="text-sm md:text-base max-w-[700px] mx-auto leading-relaxed text-white/90">
            Pilih jadwal yang sesuai dengan rencana perjalanan spiritual Anda
        </p>
    </div>
</section>

{{-- ==================== FILTER SECTION ==================== --}}
<section class="sticky top-[76px] z-[999] py-5 bg-white shadow-[0_4px_20px_rgba(0,29,95,0.08)]"
         x-data="{ activeFilter: 'all' }">
    <div class="container-main">
        <div class="flex gap-2 justify-center flex-wrap">
            <button @click="activeFilter = 'all'; document.querySelectorAll('[data-schedule-card]').forEach(el => el.style.display = '')"
                    :class="{ 'active': activeFilter === 'all' }"
                    aria-label="Tampilkan semua jadwal"
                    class="px-8 py-3 rounded-full font-semibold text-[15px] cursor-pointer transition-all duration-300 border-2"
                    :class="activeFilter === 'all' ? 'border-primary bg-primary text-white shadow-[0_8px_25px_rgba(0,29,95,0.25)]' : 'border-[#E8EBF3] bg-white text-gray-500'">
                Semua Jadwal
            </button>

            @foreach($departure_routes as $route)
            <button @click="activeFilter = '{{ $route }}';
                    document.querySelectorAll('[data-schedule-card]').forEach(el => {
                        const card = el.querySelector('[data-route]');
                        el.style.display = card?.dataset.route === '{{ $route }}' ? '' : 'none';
                    })"
                    :class="{ 'active': activeFilter === '{{ $route }}' }"
                    class="px-8 py-3 rounded-full font-semibold text-[15px] cursor-pointer transition-all duration-300 border-2"
                    :class="activeFilter === '{{ $route }}' ? 'border-primary bg-primary text-white shadow-[0_8px_25px_rgba(0,29,95,0.25)]' : 'border-[#E8EBF3] bg-white text-gray-500'">
                {{ $route }}
            </button>
            @endforeach
        </div>
    </div>
</section>

{{-- ==================== SCHEDULE GRID ==================== --}}
<section class="py-20 bg-white">
    <div class="container-main">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($schedules as $schedule)
            @php
                $statusClass = match($schedule['status']) {
                    'available' => 'available',
                    'almost_full' => 'almost-full',
                    'full' => 'full',
                    default => 'available'
                };

                $statusText = match($schedule['status']) {
                    'available' => 'Tersedia',
                    'almost_full' => 'Hampir Penuh',
                    'full' => 'Penuh',
                    default => 'Tersedia'
                };
            @endphp

            <div data-schedule-card>
                <div class="rounded-2xl overflow-hidden h-full flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl group bg-white shadow-[0_4px_15px_rgba(0,29,95,0.08)]"
                     data-route="{{ $schedule['departure_route'] }}"
                     data-schedule-id="{{ $schedule['id'] }}">
                    
                    {{-- Flyer Image --}}
                    <a href="{{ route('schedule.detail', ['id' => $schedule['id'], 'slug' => \Illuminate\Support\Str::slug($schedule['package_name'])]) }}" 
                       class="block relative h-[350px] overflow-hidden cursor-pointer no-underline bg-gray-100">
                        <img src="{{ Storage::url($schedule['flyer_image']) }}" 
                             alt="{{ $schedule['package_name'] }}" 
                             class="w-full h-full object-contain object-center transition-transform duration-400 group-hover:scale-105 bg-white"
                             loading="lazy">
                        
                        {{-- Status Badge --}}
                        <span class="absolute top-3 right-3 z-10 flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-bold text-xs bg-gradient-to-br from-[#D4AF37] to-[#F4D03F] text-primary shadow-[0_4px_12px_rgba(212,175,55,0.4)]">
                            @if($schedule['status'] === 'full')
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            @else
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            @endif
                            {{ $statusText }}
                        </span>
                        
                        {{-- Hover Hint --}}
                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 px-4 py-2 rounded-full text-white text-xs font-semibold flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none z-[2] bg-black/75 backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Lihat Detail
                        </div>
                    </a>
                    
                    {{-- Card Info --}}
                    <div class="p-5 flex-1 flex flex-col gap-3.5 relative z-[5]">
                        <h3 class="text-xl font-bold leading-snug m-0 text-primary">{{ $schedule['package_name'] }}</h3>
                        
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-[#E8EBF3] text-primary">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ date('d M Y', strtotime($schedule['departure_date'])) }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-[#E8EBF3] text-primary">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                {{ $schedule['departure_route'] }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-[#E8EBF3] text-primary">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 16.21v-1.895l-1.5-1.5v-7.396c0-.854-.552-1.609-1.368-1.873L12.66 1.356c-.427-.139-.89-.139-1.317 0L4.868 3.546c-.816.264-1.368 1.02-1.368 1.873v7.396l-1.5 1.5v1.895h2v1.79h16v-1.79h2zm-10-14l5.664 1.837L12 5.892 6.336 4.047 12 2.21z"/></svg>
                                {{ $schedule['airline'] }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold text-white bg-gold">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                                Rp {{ number_format($schedule['price'], 0, ',', '.') }}
                            </span>
                        </div>
                        
                        {{-- Action Buttons --}}
                        <div class="flex gap-2 mt-auto">
                            @if($schedule['status'] !== 'full')
                            <a href="{{ route('register', ['schedule_id' => $schedule['id']]) }}" 
                               class="flex-1 inline-flex items-center justify-center gap-2.5 py-4 rounded-lg text-[15px] font-semibold no-underline transition-all duration-300 hover:-translate-y-0.5 bg-primary text-white border-2 border-primary hover:bg-gold hover:border-gold hover:shadow-lg hover:shadow-gold/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Daftar
                            </a>
                            @else
                            <button disabled class="flex-1 inline-flex items-center justify-center gap-2.5 py-4 rounded-lg text-[15px] font-semibold transition-all duration-300 cursor-not-allowed opacity-70 bg-gray-400 text-white border-2 border-gray-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                Penuh
                            </button>
                            @endif

                            <a href="{{ route('schedule.detail', ['id' => $schedule['id'], 'slug' => \Illuminate\Support\Str::slug($schedule['package_name'])]) }}" 
                               class="flex-1 inline-flex items-center justify-center gap-2.5 py-4 rounded-lg text-[15px] font-semibold no-underline transition-all duration-300 hover:-translate-y-0.5 bg-white text-primary border-2 border-primary hover:bg-gold hover:border-gold hover:text-white hover:shadow-lg hover:shadow-gold/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(count($schedules) === 0)
        <div class="text-center py-20">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h4 class="text-xl font-bold mb-2 text-primary">Belum Ada Jadwal Tersedia</h4>
            <p class="text-base text-gray-500">Silakan hubungi kami untuk informasi jadwal terbaru</p>
        </div>
        @endif
    </div>
</section>

@include('partials.cta-section')

@endsection