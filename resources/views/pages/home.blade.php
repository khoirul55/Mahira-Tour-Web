{{-- resources/views/pages/home.blade.php - TailwindCSS v4 --}}
@extends('layouts.app')

@section('title', 'Mahira Tour | Travel Umrah & Haji Resmi, Aman & Terpercaya')

@section('content')

{{-- ==================== HERO SECTION ==================== --}}
<section class="relative h-screen min-h-[650px] overflow-hidden bg-gradient-to-br from-[#001D5F] via-[#1a3a6e] to-[#2d5a8a]">
    
    {{-- Background Video --}}
    <video class="absolute top-1/2 left-1/2 min-w-full min-h-full -translate-x-1/2 -translate-y-1/2 object-cover opacity-85 brightness-[0.45] contrast-[1.1]"
           autoplay muted loop playsinline
           poster="{{ asset('images/hero/video-poster.webp') }}">
        <source src="{{ asset('videos/kaabah-hero.mp4') }}" type="video/mp4">
        <source src="{{ asset('videos/kaabah-hero.webm') }}" type="video/webm">
        <img src="{{ asset('images/hero/video-poster.webp') }}" alt="Ka'bah" fetchpriority="high" />
    </video>
    
    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 z-[2] bg-gradient-to-br from-[#001D5F]/85 via-[#D4AF37]/20 to-[#001440]/90">
    </div>
    
    {{-- Content --}}
    <div class="relative z-10 min-h-screen flex items-center justify-center pt-[72px]">
        <div class="container-main">
            <div class="text-center max-w-3xl mx-auto px-6 text-white">
                
                {{-- Headline --}}
                <h1 class="text-4xl md:text-5xl lg:text-[52px] font-semibold leading-tight mb-5 font-serif drop-shadow-2xl tracking-tighter">
                    <span class="block" style="opacity: 0; animation: slideInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.3s forwards;">
                        Wujudkan Ibadah <span class="text-[#D4AF37] font-bold">Umrah & Haji</span>
                    </span>
                    <span class="block" style="opacity: 0; animation: slideInRight 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.5s forwards;">
                        Bersama Keluarga
                    </span>
                </h1>
                
                {{-- Spiritual Anchor --}}
                <p class="font-serif text-sm md:text-base italic mb-5 opacity-95 animate-[fadeInUp_1s_ease_0.3s_both] text-[#D4AF37] drop-shadow-lg">
                    "Dan sempurnakanlah ibadah haji dan umrah karena Allah"
                </p>
                
                {{-- Subtitle --}}
                <p class="text-base md:text-lg leading-relaxed mb-9 drop-shadow-md" style="opacity: 0; animation: fadeInUp 1s ease 0.6s forwards;">
                    Perjalanan spiritual yang aman, nyaman, dan penuh keberkahan<br>
                    bersama bimbingan profesional dan fasilitas terbaik
                </p>
                
                {{-- Trust Badge --}}
                <div class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full mb-8 text-xs md:text-sm font-semibold animate-[fadeInDown_1s_ease_both] bg-black/50 backdrop-blur-md border border-[#D4AF37]/50 shadow-lg">
                    <svg class="w-4 h-4 text-[#D4AF37]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                    <span>Terpercaya Sejak 2016 • Resmi Kemenag RI</span>
                </div>
                
                {{-- CTAs --}}
                <div class="flex gap-3.5 justify-center flex-wrap animate-[fadeInUp_1s_ease_0.5s_both]">
                    <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" 
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 bg-white text-[#001D5F] hover:bg-[#D4AF37] hover:text-white shadow-lg hover:shadow-xl hover:shadow-[#D4AF37]/40 no-underline">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Konsultasi Gratis
                    </a>
                    <a href="{{ route('schedule') }}" 
                       class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 bg-transparent text-white border-2 border-white/60 hover:bg-[#D4AF37] hover:border-[#D4AF37] hover:text-white shadow-lg hover:shadow-xl hover:shadow-[#D4AF37]/40 no-underline">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                        Jelajahi Paket
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================== ABOUT SECTION ==================== --}}
<section class="py-16 lg:py-24 bg-[#F8F9FA]">
    <div class="container-main">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div>
                {{-- Badge --}}
                <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-[#D4AF37] border-b-2 border-[#D4AF37] tracking-[2px]">Cerita Kami</span>
                
                {{-- Title --}}
                <h2 class="text-2xl md:text-4xl font-semibold font-serif leading-snug mb-6 text-[#001D5F] tracking-tighter">
                    Dari Mimpi Keluarga Kecil,<br>Kini Melayani Ribuan Jamaah
                </h2>
                
                {{-- Founder Quote --}}
                <div class="pl-5 mb-8 border-l-4 border-[#D4AF37]">
                    <p class="text-sm md:text-base italic leading-relaxed mb-2 text-gray-500">
                        "Tahun 2016, kami berangkat umrah pertama kali. 
                        Pengalaman yang mengubah hidup. Dari situ lahir mimpi: 
                        <strong class="text-gray-800">membantu keluarga Indonesia merasakan momen spiritual yang sama.</strong>"
                    </p>
                    <span class="text-xs font-semibold text-[#8B7F6E]">
                        — Ust.Khilal Hamdan & Ust. Nadirman Hamdan, Founder Mahira Tour
                    </span>
                </div>
                
                {{-- Trust Metrics --}}
                <div class="grid grid-cols-3 gap-4 mb-8">
                    @foreach([['2016', 'Tahun didirikan'], ['2000+', 'Jamaah terlayani'], ['4.9/5', 'Rating testimoni']] as $metric)
                    <div class="text-center p-4 rounded-xl bg-white border border-gray-200">
                        <strong class="block text-xl md:text-2xl font-bold text-[#D4AF37]">{{ $metric[0] }}</strong>
                        <span class="text-xs text-[#8B7F6E]">{{ $metric[1] }}</span>
                    </div>
                    @endforeach
                </div>
                
                {{-- CTA --}}
                <a href="{{ route('about') }}" 
                   class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 group bg-[#001D5F] text-white border-2 border-[#001D5F] hover:bg-[#D4AF37] hover:border-[#D4AF37] hover:shadow-lg hover:shadow-[#D4AF37]/30 no-underline">
                    Baca Cerita Lengkap
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <img src="{{ asset('images/hero/jamaah2.webp') }}" alt="Tim Mahira Tour bersama jamaah" 
                     class="w-full h-auto object-cover" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- ==================== WHY CHOOSE US ==================== --}}
<section class="py-16 lg:py-24 bg-white" x-data="{ ppiuOpen: false }">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-[#D4AF37] border-b-2 border-[#D4AF37]">Mengapa Pilih Kami</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif mb-4 text-[#001D5F]">
                Komitmen Kami untuk Ibadah Anda
            </h2>
            <p class="text-sm md:text-base text-[#8B7F6E] leading-relaxed">
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
            <div class="p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-xl bg-[#F8F9FA] border border-gray-200">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 bg-[#D4AF37]/10 text-[#D4AF37]">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $feature['icon'] }}"/></svg>
                </div>
                <h3 class="text-lg font-bold mb-3 font-serif text-[#001D5F]">{{ $feature['title'] }}</h3>
                <p class="text-sm leading-relaxed text-[#6B7280]">{{ $feature['desc'] }}</p>
                @if($feature['btn'] === 'ppiu')
                <button @click="ppiuOpen = true"
                        class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-semibold 
                               transition-all duration-300 cursor-pointer border-0 bg-[#001D5F]/10 text-[#001D5F] hover:bg-[#001D5F] hover:text-white">
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
                    class="absolute top-4 right-4 w-8 h-8 rounded-lg flex items-center justify-center border-0 cursor-pointer transition-colors bg-gray-100 text-gray-500 hover:bg-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h4 class="text-lg font-bold flex items-center gap-2 mb-4 text-[#001D5F]">
                <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Surat Izin PPIU
            </h4>
            <div class="rounded-xl overflow-hidden mb-4 border border-gray-200">
                <img src="{{ Storage::url('surat/suratizin.jpg') }}" alt="Surat Izin PPIU Mahira Tour" 
                     class="w-full h-auto" loading="lazy">
            </div>
            <a href="{{ Storage::url('surat/suratizin.jpg') }}" download 
               class="w-full flex items-center justify-center gap-2 py-3 rounded-xl font-semibold text-sm transition-all duration-300 bg-[#001D5F] text-white hover:bg-[#D4AF37] no-underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Download Surat Izin
            </a>
        </div>
    </div>
</section>

{{-- ==================== HADITH SECTION ==================== --}}
<section class="relative py-24 overflow-hidden bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('images/hero/hero-about.webp') }}');">
    <div class="absolute inset-0 bg-[#001D5F]/90"></div>
    <div class="container-main relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <svg class="w-10 h-10 mx-auto mb-6 opacity-60 text-[#D4AF37]" fill="currentColor" viewBox="0 0 24 24"><path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/></svg>
            <h3 class="text-xl md:text-2xl font-serif italic leading-relaxed mb-6 text-white">
                "Laksanakanlah haji dan umrah secara berturut-turut, karena keduanya dapat menghilangkan kefakiran dan dosa, sebagaimana api menghilangkan karat pada besi."
            </h3>
            <div class="flex items-center justify-center gap-4">
                <span class="w-8 h-px bg-[#D4AF37]/50"></span>
                <span class="text-xs font-semibold uppercase tracking-widest text-[#D4AF37]">HR. Tirmidzi</span>
                <span class="w-8 h-px bg-[#D4AF37]/50"></span>
            </div>
        </div>
    </div>
</section>

{{-- ==================== STATS SECTION ==================== --}}
<section class="py-0 relative z-20 mt-0 bg-white">
    <div class="container-main">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 -mt-10 relative z-20">
            @foreach([['2000+', 'Jamaah Terlayani'], ['10+', 'Tahun Berpengalaman'], ['45+', 'Paket Keberangkatan/Tahun'], ['100%', 'Izin Resmi Kemenag']] as $stat)
            <div class="text-center p-6 md:p-8 rounded-2xl shadow-lg transition-all duration-300 hover:-translate-y-1 bg-white border border-gray-200">
                <div class="text-2xl md:text-3xl font-bold mb-2 text-[#D4AF37]">{{ $stat[0] }}</div>
                <div class="text-xs md:text-sm text-[#8B7F6E]">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==================== PACKAGE SECTION ==================== --}}
<section class="py-16 lg:py-24 bg-[#F8F9FA]" id="paket">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-[#D4AF37] border-b-2 border-[#D4AF37]">Paket Istimewa</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif mb-4 text-[#001D5F]">
                Pilih Paket Sesuai Kebutuhan Anda di Tahun 2026
            </h2>
            <p class="text-sm md:text-base text-[#8B7F6E] leading-[1.8]">
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
            <div class="rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl {{ $pkg['featured'] ? 'ring-2 ring-[#D4AF37]' : '' }} bg-white">
                <div class="relative overflow-hidden aspect-[4/5] bg-gray-100">
                    <img src="{{ asset('images/packages/' . $pkg['img']) }}" alt="{{ $pkg['title'] }}" 
                         class="w-full h-full object-cover object-top" loading="lazy">
                    @if($pkg['featured'])
                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold bg-[#D4AF37] text-white">Terpopuler</span>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4 font-serif text-[#001D5F]">{{ $pkg['title'] }}</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            <svg class="w-4 h-4 shrink-0 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $pkg['date'] }} • <span class="font-semibold text-[#001D5F]">{{ $pkg['days'] }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            <svg class="w-4 h-4 shrink-0 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            {{ $pkg['airline'] }}
                        </div>
                        <div class="pt-3 mt-3 border-t border-gray-200">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 shrink-0 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <span class="text-sm font-semibold text-[#001D5F]">{{ $pkg['price'] }}</span>
                                <span class="text-xs text-[#8B7F6E]">({{ $pkg['note'] }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('schedule') }}" 
               class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 group bg-[#001D5F] text-white border-2 border-[#001D5F] hover:bg-[#D4AF37] hover:border-[#D4AF37] hover:shadow-lg hover:shadow-[#D4AF37]/30 no-underline">
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
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-[#D4AF37] border-b-2 border-[#D4AF37]">Testimoni</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif mb-4 text-[#001D5F]">
                Video Testimoni Jamaah
            </h2>
            <p class="text-sm md:text-base text-[#8B7F6E] leading-[1.8]">
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
                <div class="aspect-video">
                    <iframe src="https://www.youtube.com/embed/{{ $testi['id'] }}?rel=0&modestbranding=1&playsinline=1&origin={{ request()->getSchemeAndHttpHost() }}" 
                            title="Testimoni Jamaah Mahira Tour"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen loading="lazy"
                            referrerpolicy="strict-origin-when-cross-origin"
                            class="w-full h-full">
                    </iframe>
                </div>
                <div class="p-5">
                    <h4 class="text-sm font-bold mb-1 text-[#001D5F]">{{ $testi['title'] }}</h4>
                    <p class="text-xs text-[#8B7F6E]">Jamaah Mahira Tour</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('testimonials') }}" 
               class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 group bg-[#001D5F] text-white border-2 border-[#001D5F] hover:bg-[#D4AF37] hover:border-[#D4AF37] hover:shadow-lg hover:shadow-[#D4AF37]/30 no-underline">
                Lihat Semua Testimoni
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ==================== GALLERY SECTION ==================== --}}
<section class="py-16 lg:py-24 bg-[#F8F9FA]"
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
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-[#D4AF37] border-b-2 border-[#D4AF37]">Galeri</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif text-[#001D5F]">
                Dokumentasi Perjalanan Ibadah
            </h2>
        </div>
        
        {{-- Gallery Slider --}}
        <div class="relative group" x-data="{
            scrollLeft() { $refs.slider.scrollBy({ left: -320, behavior: 'smooth' }); },
            scrollRight() { $refs.slider.scrollBy({ left: 320, behavior: 'smooth' }); }
        }">
            {{-- Nav Buttons --}}
            <button @click="scrollLeft()" 
                    class="absolute left-2 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full flex items-center justify-center 
                           opacity-0 group-hover:opacity-100 transition-opacity duration-300 border-0 cursor-pointer shadow-lg bg-white text-[#001D5F]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="scrollRight()" 
                    class="absolute right-2 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full flex items-center justify-center 
                           opacity-0 group-hover:opacity-100 transition-opacity duration-300 border-0 cursor-pointer shadow-lg bg-white text-[#001D5F]">
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
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 bg-[#001D5F]/40">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('gallery') }}" 
               class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 group bg-[#001D5F] text-white border-2 border-[#001D5F] hover:bg-[#D4AF37] hover:border-[#D4AF37] hover:shadow-lg hover:shadow-[#D4AF37]/30 no-underline">
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
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/90">
        <button @click="closeModal()" class="absolute top-4 right-4 text-white text-3xl border-0 bg-transparent cursor-pointer z-10">&times;</button>
        <div class="absolute top-4 left-1/2 -translate-x-1/2 text-white text-sm opacity-70" x-text="`${currentIndex + 1} / ${galleries.length}`"></div>
        <button @click="changeGallery(-1)" class="absolute left-4 text-white border-0 bg-transparent cursor-pointer z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div class="max-w-4xl max-h-[80vh]" @click.stop>
            <img :src="galleries[currentIndex].src" :alt="galleries[currentIndex].alt" class="max-w-full max-h-[80vh] rounded-lg object-contain">
        </div>
        <button @click="changeGallery(1)" class="absolute right-4 text-white border-0 bg-transparent cursor-pointer z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</section>

{{-- ==================== LOCATION SECTION ==================== --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-[#D4AF37] border-b-2 border-[#D4AF37]">Lokasi Kami</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif mb-4 text-[#001D5F]">
                Kunjungi Kantor Pusat Mahira Tour
            </h2>
            <p class="text-sm md:text-base text-[#8B7F6E] leading-[1.8]">
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
               class="inline-flex items-center gap-2.5 px-8 py-4 rounded-lg font-semibold text-[15px] transition-all duration-300 hover:-translate-y-0.5 bg-[#001D5F] text-white border-2 border-[#001D5F] hover:bg-[#D4AF37] hover:border-[#D4AF37] hover:shadow-lg hover:shadow-[#D4AF37]/30 no-underline">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Buka di Google Maps
            </a>
        </div>
    </div>
</section>

{{-- ==================== PARTNERS SECTION ==================== --}}
<section class="py-16 lg:py-24 bg-[#F8F9FA]">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-4 pb-1 text-[#D4AF37] border-b-2 border-[#D4AF37]">Berizin Resmi & Terpercaya</span>
            <h2 class="text-2xl md:text-4xl font-semibold font-serif mb-4 text-[#001D5F]">
                Legalitas & Keanggotaan
            </h2>
            <p class="text-sm md:text-base text-[#8B7F6E] leading-[1.8]">
                Terdaftar dan diawasi oleh lembaga resmi pemerintah dan organisasi internasional
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-3xl mx-auto">
            @php
                $partners = [
                    ['img' => 'kemenag.webp', 'name' => 'Kementerian Agama RI', 'desc' => 'PPIU No: 21062301498960002'],
                    ['img' => 'siskopatuh.webp', 'name' => 'Siskopatuh', 'desc' => 'Sistem Komputerisasi Haji Terpadu'],
                    ['img' => 'himpuh.webp', 'name' => 'HIMPUH', 'desc' => 'Himpunan Penyelenggara Umrah Haji'],
                ];
            @endphp
            @foreach($partners as $partner)
            <div class="text-center p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1 bg-white border border-gray-200">
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 p-3 bg-[#F8F9FA]">
                    <img src="{{ asset('images/partners/' . $partner['img']) }}" alt="{{ $partner['name'] }}" 
                         class="max-w-full max-h-full object-contain" loading="lazy">
                </div>
                <h4 class="text-sm font-bold mb-1 text-[#001D5F]">{{ $partner['name'] }}</h4>
                <p class="text-xs text-[#8B7F6E]">{{ $partner['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==================== CTA SECTION ==================== --}}
@include('partials.cta-section')

@endsection