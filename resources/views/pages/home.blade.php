{{-- resources/views/pages/home.blade.php - TailwindCSS v4 --}}
@extends('layouts.app')

@section('title', 'Mahira Tour | Travel Umrah & Haji Resmi, Aman & Terpercaya')
@section('meta_description', 'Mahira Tour adalah travel Haji & Umrah berizin resmi Kemenag RI. Melayani 2000+ jamaah sejak 2016 dengan bimbingan ibadah profesional, hotel bintang 5, dan harga transparan. Daftar sekarang!')
@section('og_image', asset('images/hero/video-poster.webp'))

@section('preload')
    <link rel="preload" as="image" href="{{ asset('images/hero/video-poster.webp') }}" fetchpriority="high">
@endsection

@section('content')

{{-- ==================== HERO SECTION ==================== --}}
<section class="relative h-screen min-h-[550px] md:min-h-[650px] overflow-hidden bg-gradient-to-br from-[#001D5F] via-[#1a3a6e] to-[#2d5a8a]">
    
    {{-- Background Video --}}
    <video class="absolute top-1/2 left-1/2 min-w-full min-h-full -translate-x-1/2 -translate-y-1/2 object-cover opacity-85 brightness-[0.6] contrast-[1.1]"
           autoplay muted loop playsinline
           preload="metadata"
           poster="{{ asset('images/hero/video-poster.webp') }}">
        <source src="{{ asset('videos/kaabah-hero.mp4') }}" type="video/mp4">
        <source src="{{ asset('videos/kaabah-hero.webm') }}" type="video/webm">
    </video>
    
    {{-- Gradient Overlay (Lebih Elegan & Bersih) --}}
    {{-- Kita gunakan gradient dark-navy dari bawah ke atas, membiarkan tengah gambar lebih terang --}}
    <div class="absolute inset-0 z-[2] bg-gradient-to-t from-[#001233] via-[#001233]/60 to-transparent"></div>
    <div class="absolute inset-0 z-[2] bg-black/20"></div> {{-- Base darkening --}}
    
    {{-- Content --}}
    <div class="relative z-10 min-h-screen flex items-center justify-center pt-[72px] pb-12">
        <div class="container-main">
            <div class="text-center max-w-4xl mx-auto px-6 text-white flex flex-col items-center">
                
                <div class="inline-flex items-center gap-2.5 px-5 py-2 rounded-full bg-white/5 backdrop-blur-sm border border-white/10 mb-6 transition-all duration-500 hover:bg-white/10 hover:border-white/20">
                    <svg class="w-3.5 h-3.5 text-gold-light/90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span class="text-[10px] sm:text-xs font-medium tracking-[0.15em] uppercase text-white/80 text-left leading-tight sm:leading-normal">Terpercaya Sejak 2016 <span class="hidden sm:inline mx-1 text-white/30">|</span><br class="sm:hidden"> Resmi Kemenag RI</span>
                </div>

                {{-- 2. Headline --}}
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold font-serif leading-[1.15] mb-6 tracking-tight">
                    Wujudkan Ibadah <br class="hidden md:block">
                    <span class="text-gold lg:text-gold-light">Umrah & Haji</span> Bersama Keluarga
                </h1>
                
                {{-- 3. Quote/Sub-headline (Diubah ke font-sans agar kontras dengan judul & warnanya bersih) --}}
                <p class="text-base sm:text-lg md:text-xl text-white/80 font-sans leading-relaxed max-w-2xl mx-auto mb-10 font-light tracking-wide">
                    "Dan sempurnakanlah ibadah haji dan umrah karena Allah"<br>
                    <span class="text-sm opacity-60 mt-2 inline-block font-medium">(QS. Al-Baqarah: 196)</span>
                </p>

                {{-- 4. Action Buttons (Visual Hierarchy: 1 Solid, 1 Outlined/Glassmorphism) --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto px-4 sm:px-0">
                    
                    {{-- Primary Button (Solid Putih - Elegan dan Tenang) --}}
                    <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" 
                       target="_blank" rel="noopener"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-full bg-white text-primary font-semibold text-[15px] transition-all duration-500 hover:scale-[1.02] hover:bg-gray-50 hover:shadow-[0_8px_30px_rgba(255,255,255,0.15)] group">
                        <i class="bi bi-whatsapp text-lg text-[#25D366] group-hover:scale-110 transition-transform duration-500"></i>
                        Konsultasi Gratis
                    </a>

                    {{-- Secondary Button (Glassmorphism outline) --}}
                    <a href="#paket" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full bg-white/5 border border-white/30 text-white font-medium text-[15px] backdrop-blur-sm transition-all duration-300 hover:bg-white/10 hover:border-white/50 group">
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        Jelajahi Paket
                    </a>
                </div>
                
            </div>
        </div>
    </div>

    {{-- Scroll Indicator (Modern Style) --}}
    <a href="#cerita" 
       class="absolute bottom-6 sm:bottom-8 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center opacity-70 transition-all duration-500 hover:opacity-100 hover:-translate-y-1 group no-underline"
       aria-label="Scroll ke bawah">
        
        {{-- Desktop: Mouse Icon --}}
        <div class="hidden sm:flex w-[22px] h-[36px] rounded-full border-2 border-white/40 justify-center p-1 box-border">
            <div class="w-1 h-2 rounded-full bg-white opacity-80 animate-[mouseWheel_1.5s_ease-out_infinite]"></div>
        </div>
        
        {{-- Mobile: Bouncing Arrow --}}
        <div class="flex sm:hidden items-center justify-center p-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 animate-bounce mt-2">
            <svg class="w-4 h-4 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </div>
    </a>
</section>

{{-- ==================== ABOUT SECTION ==================== --}}
<section id="cerita" class="py-16 lg:py-24 bg-gray-50">
    <div class="container-main">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div>
                {{-- Badge --}}
                <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-gold-accessible border-b-2 border-gold tracking-[2px]">Cerita Kami</span>
                
                {{-- Title --}}
                <h2 class="text-2xl md:text-4xl font-semibold font-serif leading-snug mb-6 text-primary tracking-tighter">
                    Dari Mimpi Keluarga Kecil,<br>Kini Melayani Ribuan Jamaah
                </h2>
                
                {{-- Founder Quote --}}
                <div class="pl-5 mb-8 border-l-4 border-gold">
                    <p class="text-sm md:text-base italic leading-relaxed mb-2 text-gray-500">
                        "Tahun 2016, kami berangkat umrah pertama kali. 
                        Pengalaman yang mengubah hidup. Dari situ lahir mimpi: 
                        <strong class="text-gray-800">membantu keluarga Indonesia merasakan momen spiritual yang sama.</strong>"
                    </p>
                    <span class="text-xs font-semibold text-taupe">
                        — Ust.Khilal Hamdan & Ust. Nadirman Hamdan, Founder Mahira Tour
                    </span>
                </div>
                
                {{-- Trust Metrics --}}
                <div class="grid grid-cols-3 gap-2 sm:gap-4 mb-8">
                    @foreach([['2016', 'Tahun didirikan'], ['2000+', 'Jamaah terlayani'], ['4.9/5', 'Rating testimoni']] as $metric)
                    <div class="text-center p-3 sm:p-4 rounded-xl bg-white border border-gray-200">
                        <strong class="block text-lg sm:text-xl md:text-2xl font-bold text-gold-accessible">{{ $metric[0] }}</strong>
                        <span class="text-xs text-taupe">{{ $metric[1] }}</span>
                    </div>
                    @endforeach
                </div>
                
                {{-- CTA --}}
                <a href="{{ route('about') }}" 
                   class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 group bg-primary text-white border-2 border-primary hover:bg-gold hover:border-gold hover:shadow-lg hover:shadow-gold/30 no-underline">
                    Baca Cerita Lengkap
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <img src="{{ asset('images/hero/jamaah2.webp') }}" alt="Tim Mahira Tour bersama jamaah"
                     loading="lazy" width="600" height="400"
                     class="w-full h-auto object-cover">
            </div>
        </div>
    </div>
</section>

{{-- ==================== WHY CHOOSE US ==================== --}}
<section class="py-16 lg:py-24 bg-white" x-data="{ ppiuOpen: false }">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-gold-accessible border-b-2 border-gold">Mengapa Pilih Kami</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif mb-4 text-primary">
                Komitmen Kami untuk Ibadah Anda
            </h2>
            <p class="text-sm md:text-base text-taupe leading-relaxed">
                Perjalanan spiritual yang penuh makna dimulai dengan kepercayaan
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $features = [
                    ['icon' => 'M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z', 'title' => 'Sesuai Tuntunan Syariat', 'desc' => 'Seluruh ibadah dipandu sesuai Al-Qur\'an dan Sunnah dengan pembimbing bersertifikat Kemenag RI.', 'btn' => null],
                    ['icon' => 'M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z', 'title' => 'Berizin Resmi Kemenag', 'desc' => 'PPIU No: 21062301498960002', 'btn' => 'ppiu'],
                    ['icon' => 'M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z', 'title' => 'Berpengalaman Sejak 2016', 'desc' => 'Telah melayani 2000+ jamaah dengan testimoni yang nyata.', 'btn' => null],
                ];
            @endphp
            @foreach($features as $feature)
            <div class="p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-xl bg-gray-50 border border-gray-200">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 bg-gold/10 text-gold">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $feature['icon'] }}"/></svg>
                </div>
                <h3 class="text-lg font-bold mb-3 font-serif text-primary">{{ $feature['title'] }}</h3>
                <p class="text-sm leading-relaxed text-[#6B7280]">{{ $feature['desc'] }}</p>
                @if($feature['btn'] === 'ppiu')
                <button @click="ppiuOpen = true"
                        aria-label="Lihat Surat Izin PPIU Mahira Tour"
                        class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-xs font-semibold 
                               transition-all duration-300 cursor-pointer border-0 bg-primary/10 text-primary hover:bg-primary hover:text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Lihat Surat Izin PPIU
                </button>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    {{-- PPIU Modal (Alpine.js) --}}
    <div x-show="ppiuOpen" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="ppiuOpen = false;"
         @keydown.escape.window="ppiuOpen = false;"
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
         x-init="$watch('ppiuOpen', v => document.body.style.overflow = v ? 'hidden' : '')">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 relative shadow-2xl" @click.stop>
            <button @click="ppiuOpen = false" 
                    aria-label="Tutup modal surat izin"
                    class="absolute top-4 right-4 w-11 h-11 rounded-lg flex items-center justify-center border-0 cursor-pointer transition-colors bg-gray-100 text-gray-500 hover:bg-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h4 class="text-lg font-bold flex items-center gap-2 mb-4 text-primary">
                <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Surat Izin PPIU
            </h4>
            <div class="rounded-xl overflow-hidden mb-4 border border-gray-200">
                <img src="{{ Storage::url('surat/suratizin.jpg') }}" alt="Surat Izin PPIU Mahira Tour"
                     loading="lazy" width="500" height="700"
                     class="w-full h-auto">
            </div>
            <a href="{{ Storage::url('surat/suratizin.jpg') }}" download 
               class="w-full flex items-center justify-center gap-2 py-3 rounded-xl font-semibold text-sm transition-all duration-300 bg-primary text-white hover:bg-gold no-underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Download Surat Izin
            </a>
        </div>
    </div>
</section>

{{-- ==================== HADITH SECTION ==================== --}}
<section class="relative py-24 overflow-hidden bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('images/hero/hero-about.webp') }}');">
    <div class="absolute inset-0 bg-primary/90"></div>
    <div class="container-main relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <svg class="w-10 h-10 mx-auto mb-6 opacity-60 text-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/></svg>
            <h3 class="text-xl md:text-2xl font-serif italic leading-relaxed mb-6 text-white">
                "Laksanakanlah haji dan umrah secara berturut-turut, karena keduanya dapat menghilangkan kefakiran dan dosa, sebagaimana api menghilangkan karat pada besi."
            </h3>
            <div class="flex items-center justify-center gap-4">
                <span class="w-8 h-px bg-gold/50"></span>
                <span class="text-xs font-semibold uppercase tracking-widest text-gold-accessible">HR. Tirmidzi</span>
                <span class="w-8 h-px bg-gold/50"></span>
            </div>
        </div>
    </div>
</section>

{{-- ==================== STATS SECTION ==================== --}}
<section class="py-0 relative z-20 mt-0 bg-white">
    <div class="container-main">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 -mt-6 md:-mt-10 relative z-20">
            @foreach([['2000+', 'Jamaah Terlayani'], ['10+', 'Tahun Berpengalaman'], ['45+', 'Keberangkatan/Tahun'], ['100%', 'Izin Resmi Kemenag']] as $stat)
            <div class="text-center p-4 md:p-8 rounded-2xl shadow-lg transition-all duration-300 hover:-translate-y-1 bg-white border border-gray-200">
                <div class="text-xl md:text-3xl font-bold mb-2 text-gold-accessible">{{ $stat[0] }}</div>
                <div class="text-xs md:text-sm text-taupe">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==================== PACKAGE SECTION ==================== --}}
<section class="py-16 lg:py-24 bg-gray-50" id="paket">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-gold-accessible border-b-2 border-gold">Paket Istimewa</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif mb-4 text-primary">
                Pilih Paket Sesuai Kebutuhan Anda di Tahun 2026
            </h2>
            <p class="text-sm md:text-base text-taupe leading-[1.8]">
                Setiap paket dirancang dengan perhatian penuh untuk kenyamanan dan kekhusyukan ibadah Anda
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            @php
                $packages = [
                    ['img' => 'umrah-awal-musim-juli2026.jpg', 'title' => 'Paket Umrah Awal Musim', 'date' => '30 Juli 2026', 'days' => '12 Hari', 'airline' => 'Lion Air (Langsung PDG-JED)', 'price' => 'Rp 28,9 Juta', 'note' => 'Paket Reguler', 'featured' => true],
                    ['img' => 'umrah-super-hemat-agustus2026.jpg', 'title' => 'Paket Umrah Super Hemat', 'date' => '24 Agustus 2026', 'days' => '12 Hari', 'airline' => 'Lion Air (Langsung PDG-JED)', 'price' => 'Rp 25,9 Juta', 'note' => 'Terbatas', 'featured' => false],
                ];
            @endphp
            @foreach($packages as $pkg)
            <div class="rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl {{ $pkg['featured'] ? 'ring-2 ring-gold' : '' }} bg-white">
                <div class="relative overflow-hidden aspect-[3/4] sm:aspect-[4/5] bg-gray-100">
                    <img src="{{ asset('images/packages/' . $pkg['img']) }}" alt="{{ $pkg['title'] }}" 
                         class="w-full h-full object-cover object-top" loading="lazy">
                    @if($pkg['featured'])
                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold bg-gold text-white">Terpopuler</span>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4 font-serif text-primary">{{ $pkg['title'] }}</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            <svg class="w-4 h-4 shrink-0 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $pkg['date'] }} • <span class="font-semibold text-primary">{{ $pkg['days'] }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            <svg class="w-4 h-4 shrink-0 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            {{ $pkg['airline'] }}
                        </div>
                        <div class="pt-3 mt-3 border-t border-gray-200">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 shrink-0 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <span class="text-sm font-semibold text-primary">{{ $pkg['price'] }}</span>
                                <span class="text-xs text-taupe">({{ $pkg['note'] }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('schedule') }}" 
               class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 group bg-primary text-white border-2 border-primary hover:bg-gold hover:border-gold hover:shadow-lg hover:shadow-gold/30 no-underline">
                Lihat Semua Paket
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ==================== TESTIMONIAL SECTION ==================== --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-gold-accessible border-b-2 border-gold">Testimoni</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif mb-4 text-primary">
                Video Testimoni Jamaah
            </h2>
            <p class="text-sm md:text-base text-taupe leading-[1.8]">
                Dengarkan pengalaman jamaah yang telah merasakan ibadah bersama Mahira Tour
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $testimonials = [
                    ['id' => 'B-JQ7BGS5i8', 'title' => 'Pengalaman Umrah Luar Biasa'],
                    ['id' => 'lSbViwp5fCA', 'title' => 'Pelayanan Sangat Memuaskan'],
                    ['id' => 'JgQmegExd5A', 'title' => 'Pengalaman Umrah Luar Biasa'],
                ];
            @endphp
            @foreach($testimonials as $testi)
            <div class="rounded-2xl overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl bg-white border border-gray-200">
                {{-- YouTube Facade: Thumbnail + Play Button (loads iframe on click) --}}
                <div class="aspect-video relative cursor-pointer group" 
                     x-data="{ playing: false }"
                     @click="if(!playing) { playing = true; }">
                    {{-- Thumbnail (shown before click) --}}
                    <template x-if="!playing">
                        <div class="w-full h-full relative">
                            <img src="https://img.youtube.com/vi/{{ $testi['id'] }}/hqdefault.jpg" 
                                 alt="{{ $testi['title'] }}" 
                                 loading="lazy"
                                 class="w-full h-full object-cover">
                            {{-- Play Button Overlay --}}
                            <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/30 transition-colors duration-300">
                                <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                        </div>
                    </template>
                    {{-- Iframe (loaded only after click) --}}
                    <template x-if="playing">
                        <iframe :src="'https://www.youtube.com/embed/{{ $testi['id'] }}?rel=0&modestbranding=1&playsinline=1&autoplay=1&origin={{ request()->getSchemeAndHttpHost() }}'" 
                                title="Testimoni Jamaah Mahira Tour"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen
                                class="w-full h-full">
                        </iframe>
                    </template>
                </div>
                <div class="p-5">
                    <h4 class="text-sm font-bold mb-1 text-primary">{{ $testi['title'] }}</h4>
                    <p class="text-xs text-taupe">Jamaah Mahira Tour</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('testimonials') }}" 
               class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 group bg-primary text-white border-2 border-primary hover:bg-gold hover:border-gold hover:shadow-lg hover:shadow-gold/30 no-underline">
                Lihat Semua Testimoni
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ==================== GALLERY SECTION ==================== --}}
<section class="py-16 lg:py-24 bg-gray-50"
    x-data="{
        galleries: {{ json_encode($galleries) }},
        currentIndex: 0,
        modalOpen: false,
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

    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-gold-accessible border-b-2 border-gold">Galeri</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif text-primary">
                Dokumentasi Perjalanan Ibadah
            </h2>
        </div>
        
        {{-- Gallery Slider --}}
        <div class="relative group" x-data="{
            scrollLeft() { $refs.slider.scrollBy({ left: -320, behavior: 'smooth' }); },
            scrollRight() { $refs.slider.scrollBy({ left: 320, behavior: 'smooth' }); },
            hintVisible: true,
            initSwipeHint() {
                const slider = $refs.slider;
                const hideHint = () => { this.hintVisible = false; };
                slider.addEventListener('scroll', hideHint, { once: true });
                slider.addEventListener('touchstart', hideHint, { once: true });
                setTimeout(() => { this.hintVisible = false; }, 5000);
            }
        }" x-init="initSwipeHint()">
            {{-- Nav Buttons --}}
            <button @click="scrollLeft()" 
                    aria-label="Geser galeri ke kiri"
                    class="absolute left-2 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full flex items-center justify-center 
                           opacity-0 group-hover:opacity-100 transition-opacity duration-300 border-0 cursor-pointer shadow-lg bg-white text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="scrollRight()" 
                    aria-label="Geser galeri ke kanan"
                    class="absolute right-2 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full flex items-center justify-center 
                           opacity-0 group-hover:opacity-100 transition-opacity duration-300 border-0 cursor-pointer shadow-lg bg-white text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            {{-- Slider --}}
            <div class="flex gap-5 overflow-x-auto pb-4 snap-x snap-mandatory scrollbar-hide" 
                 x-ref="slider">
                <template x-for="(item, index) in galleries" :key="index">
                    <div @click="openModal(index)" 
                         class="flex-none w-72 h-52 rounded-xl overflow-hidden cursor-pointer snap-start relative group/item">
                        <img :src="item.src" :alt="item.alt" loading="lazy" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover/item:scale-110">
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 bg-primary/40">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Swipe Hint Animation --}}
            <div x-show="hintVisible && galleries.length > 3" 
                 x-transition:leave="transition ease-in duration-500" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0"
                 class="flex items-center justify-center gap-2 mt-2 text-taupe/70">
                
                {{-- Mobile: Swipe Hand Icon --}}
                <div class="flex md:hidden items-center gap-2 text-sm">
                    <svg class="w-5 h-5 animate-[swipeHand_1.5s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075-4.425a1.575 1.575 0 013.15 0v1.5m-3.15-1.5v4.65m3.15-3.15a1.575 1.575 0 013.15 0v5.1a6.3 6.3 0 01-6.3 6.3H9.75a4.5 4.5 0 01-3.6-1.8l-3.024-4.032A1.575 1.575 0 014.35 13.2l1.4 1.867"/>
                    </svg>
                    <span>Geser untuk lihat lebih banyak</span>
                    <svg class="w-4 h-4 animate-[bounceRight_1s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>

                {{-- Desktop: Scroll hint --}}
                <div class="hidden md:flex items-center gap-2 text-sm">
                    <span>Geser atau gunakan tombol navigasi</span>
                    <svg class="w-4 h-4 animate-[bounceRight_1s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('gallery') }}" 
               class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 group bg-primary text-white border-2 border-primary hover:bg-gold hover:border-gold hover:shadow-lg hover:shadow-gold/30 no-underline">
                Lihat Galeri Lengkap
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
    
    {{-- Lightbox Modal --}}
    <div x-show="modalOpen" x-cloak
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         @click.self="closeModal()" 
         role="dialog" aria-modal="true" aria-label="Galeri foto"
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/90">
        <button @click="closeModal()" aria-label="Tutup galeri" class="absolute top-4 right-4 w-11 h-11 flex items-center justify-center text-white text-3xl border-0 bg-white/10 rounded-full cursor-pointer z-10 hover:bg-white/20 transition-colors">&times;</button>
        <div class="absolute top-4 left-1/2 -translate-x-1/2 text-white text-sm opacity-70" x-text="`${currentIndex + 1} / ${galleries.length}`"></div>
        <button @click="changeGallery(-1)" aria-label="Foto sebelumnya" class="absolute left-4 w-12 h-12 flex items-center justify-center text-white border-0 bg-white/10 rounded-full cursor-pointer z-10 hover:bg-white/20 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div class="max-w-4xl max-h-[80vh]" @click.stop>
            <img :src="galleries[currentIndex].src" :alt="galleries[currentIndex].alt" class="max-w-full max-h-[80vh] rounded-lg object-contain">
        </div>
        <button @click="changeGallery(1)" aria-label="Foto berikutnya" class="absolute right-4 w-12 h-12 flex items-center justify-center text-white border-0 bg-white/10 rounded-full cursor-pointer z-10 hover:bg-white/20 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</section>

{{-- ==================== LOCATION SECTION ==================== --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-gold-accessible border-b-2 border-gold">Lokasi Kami</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif mb-4 text-primary">
                Kunjungi Kantor Pusat Mahira Tour
            </h2>
            <p class="text-sm md:text-base text-taupe leading-[1.8]">
                Jl. Muradi No. 19, RT 000/RW 000, Kel. Koto Lolo, Kec. Pesisir Bukit, Kota Sungai Penuh, Jambi
            </p>
        </div>
        
        <div class="rounded-2xl overflow-hidden shadow-lg">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7974.528410081892!2d101.3896565!3d-2.050239!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2da1004b62a7c9%3A0xdebd36e55d2e3189!2sTravel%20Umroh%20Mahira%20Tour!5e0!3m2!1sid!2sid!4v1766545347293!5m2!1sid!2sid" 
                    class="w-full h-[350px] md:h-[450px] border-0" 
                    allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        
        <div class="text-center mt-8">
            <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" 
               class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 bg-primary text-white border-2 border-primary hover:bg-gold hover:border-gold hover:shadow-lg hover:shadow-gold/30 no-underline">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Buka di Google Maps
            </a>
        </div>
    </div>
</section>

{{-- ==================== MITRA & MASKAPAI ==================== --}}
<section class="py-12 lg:py-16 bg-[#FDFBF7]">
    <div class="container-main">
        <p class="text-center text-xs uppercase tracking-[3px] text-gray-400 mb-8 font-semibold">Mitra Resmi & Maskapai Penerbangan</p>
        
        <div class="relative overflow-hidden" style="mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent); -webkit-mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent);">
            <div class="flex items-center gap-12 sm:gap-16 lg:gap-20 animate-[marqueeScroll_30s_linear_infinite] hover:[animation-play-state:paused] w-max">
                {{-- Set 1 --}}
                <img src="{{ asset('images/partners/kemenag.webp') }}" alt="Kemenag RI" class="h-[50px] sm:h-[60px] lg:h-[70px] w-auto shrink-0">
                <img src="{{ asset('images/partners/himpuh.webp') }}" alt="HIMPUH" class="h-[50px] sm:h-[60px] lg:h-[70px] w-auto shrink-0">
                <img src="{{ asset('images/partners/siskopatuh.png') }}" alt="Siskopatuh" class="h-[50px] sm:h-[60px] lg:h-[70px] w-auto shrink-0">
                <img src="{{ asset('images/partners/5pasti.png') }}" alt="5 Pasti" class="h-[50px] sm:h-[60px] lg:h-[70px] w-auto shrink-0">
                <img src="{{ asset('images/partners/garuda.png') }}" alt="Garuda Indonesia" class="h-[45px] sm:h-[55px] lg:h-[65px] w-auto shrink-0">
                <img src="{{ asset('images/partners/lionair.png') }}" alt="Lion Air" class="h-[45px] sm:h-[55px] lg:h-[65px] w-auto shrink-0">
                <img src="{{ asset('images/partners/batikair.png') }}" alt="Batik Air" class="h-[45px] sm:h-[55px] lg:h-[65px] w-auto shrink-0">
                <img src="{{ asset('images/partners/saudia.png') }}" alt="Saudia Airlines" class="h-[45px] sm:h-[55px] lg:h-[65px] w-auto shrink-0">
                
                {{-- Set 2 (duplicate for seamless loop) --}}
                <img src="{{ asset('images/partners/kemenag.webp') }}" alt="Kemenag RI" class="h-[50px] sm:h-[60px] lg:h-[70px] w-auto shrink-0">
                <img src="{{ asset('images/partners/himpuh.webp') }}" alt="HIMPUH" class="h-[50px] sm:h-[60px] lg:h-[70px] w-auto shrink-0">
                <img src="{{ asset('images/partners/siskopatuh.png') }}" alt="Siskopatuh" class="h-[50px] sm:h-[60px] lg:h-[70px] w-auto shrink-0">
                <img src="{{ asset('images/partners/5pasti.png') }}" alt="5 Pasti" class="h-[50px] sm:h-[60px] lg:h-[70px] w-auto shrink-0">
                <img src="{{ asset('images/partners/garuda.png') }}" alt="Garuda Indonesia" class="h-[45px] sm:h-[55px] lg:h-[65px] w-auto shrink-0">
                <img src="{{ asset('images/partners/lionair.png') }}" alt="Lion Air" class="h-[45px] sm:h-[55px] lg:h-[65px] w-auto shrink-0">
                <img src="{{ asset('images/partners/batikair.png') }}" alt="Batik Air" class="h-[45px] sm:h-[55px] lg:h-[65px] w-auto shrink-0">
                <img src="{{ asset('images/partners/saudia.png') }}" alt="Saudia Airlines" class="h-[45px] sm:h-[55px] lg:h-[65px] w-auto shrink-0">
            </div>
        </div>
    </div>
</section>

{{-- ==================== CTA SECTION ==================== --}}
@include('partials.cta-section')

@endsection