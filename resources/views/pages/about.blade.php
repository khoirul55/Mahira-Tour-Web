@extends('layouts.app')

@section('title', 'Tentang Kami - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
<div x-data="{ ppiuModalOpen: false }">

{{-- ==================== HERO SECTION ==================== --}}
<section class="relative h-[300px] sm:h-[350px] md:h-[400px] overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 z-[1]">
        <img src="{{ asset('images/hero/hero-about.webp') }}" alt="Tentang Mahira Tour" fetchpriority="high" loading="eager"
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
            <span class="text-white/70">Tentang Kami</span>
        </div>
        <h1 class="text-2xl sm:text-[2.5rem] md:text-[3.5rem] font-bold font-serif text-white mb-4 leading-tight shadow-black/30 text-shadow-lg">
            <span class="inline-block mx-1" style="opacity: 0; animation: slideInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.3s forwards;">Tentang</span>
            <span class="inline-block mx-1" style="opacity: 0; animation: slideInRight 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.5s forwards;">Mahira Tour</span>
        </h1>
        <p class="font-semibold text-[0.9rem] uppercase tracking-wider mb-2 text-gold">{{ $companyInfo['tagline'] }}</p>
        <p class="text-sm md:text-base max-w-[700px] mx-auto leading-relaxed text-white/90">
            Mitra terpercaya perjalanan ibadah Anda sejak {{ $companyInfo['founded'] }}
        </p>
    </div>
</section>

{{-- ==================== ZIGZAG STORY SECTIONS ==================== --}}
<section class="py-16 lg:py-24 overflow-hidden bg-white">
    <div class="container-main">

        {{-- BLOCK 1: STORY (Text Left, Image Right) --}}
        <div class="flex flex-col-reverse lg:grid lg:grid-cols-2 gap-8 lg:gap-16 items-center mb-20 lg:mb-40">
            <div class="text-left lg:text-left">
                <h2 class="text-2xl sm:text-3xl lg:text-[2.5rem] font-extrabold uppercase leading-tight mb-5 font-serif tracking-wide text-primary">
                    SEBUAH PERJALANAN <br>AMANAH & PELAYANAN
                </h2>
                <p class="text-sm sm:text-base leading-relaxed mb-4 text-gray-500">
                    Cerita ini tidak dimulai di kantor yang megah, pun tidak bermula dari rencana bisnis yang rumit. Semuanya berawal pada tahun 2016, di tengah lautan manusia yang memutih di Masjidil Haram.
                </p>
                <p class="text-sm sm:text-base leading-relaxed text-gray-500">
                    Di sana, sebuah niat terpatri: <strong class="font-semibold text-gray-800">Setiap Muslim berhak merasakan kekhusyukan tanpa rasa was-was.</strong> Kini, setelah ribuan jamaah kami antarkan, Mahira Tour bukan sekadar biro perjalanan, melainkan wadah persaudaraan keluarga Allah.
                </p>
            </div>
            <div>
                <div class="rounded-xl overflow-hidden shadow-none lg:shadow-[20px_20px_0px_rgba(212,175,55,0.15)]">
                    <img src="{{ asset('images/hero/story1.jpeg') }}" alt="Sejarah Mahira Tour" 
                         class="w-full h-auto block object-cover aspect-[4/3]">
                </div>
            </div>
        </div>

        {{-- BLOCK 2: VALUES/EXPERTISE (Image Left, Text Right) — cream background --}}
        <div class="-mx-4 sm:-mx-6 lg:mx-0 px-4 sm:px-6 lg:px-0 py-12 lg:py-0 mb-20 lg:mb-40 bg-[#FDFBF7] lg:bg-transparent rounded-none lg:rounded-none">
        <div class="flex flex-col lg:grid lg:grid-cols-2 gap-8 lg:gap-16 items-center max-w-7xl mx-auto">
            <div>
                <div class="rounded-xl overflow-hidden shadow-none lg:shadow-[-20px_20px_0px_rgba(212,175,55,0.15)]">
                    <img src="{{ asset('images/hero/story2.jpeg') }}" alt="Profesionalitas Mahira Tour" 
                         class="w-full h-auto block object-cover aspect-[4/3]">
                </div>
            </div>
            <div class="text-left lg:text-left">
                <h2 class="text-2xl sm:text-3xl lg:text-[2.5rem] font-extrabold uppercase leading-tight mb-5 font-serif tracking-wide text-primary">
                    LEBIH DARI SEKADAR <br>HAJI & UMRAH
                </h2>
                <p class="text-sm sm:text-base leading-relaxed mb-5 text-gray-500">
                    Kami tidak hanya mengurus tiket dan visa. Kami merancang pengalaman spiritual yang mendalam. Dengan izin resmi PPIU Kemenag RI, kami menjamin keamanan dan kenyamanan ibadah Anda.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-sm sm:text-base text-gray-500">
                        <svg class="w-5 h-5 shrink-0 text-gold" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Bimbingan Ibadah Sesuai Sunnah
                    </li>
                    <li class="flex items-center gap-3 text-sm sm:text-base text-gray-500">
                        <svg class="w-5 h-5 shrink-0 text-gold" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Fasilitas Nyaman & Terjamin
                    </li>
                    <li class="flex items-center gap-3 text-sm sm:text-base text-gray-500">
                        <svg class="w-5 h-5 shrink-0 text-gold" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Pendampingan Sepenuh Hati
                    </li>
                </ul>
            </div>
        </div>
        </div>

        {{-- BLOCK 3: VISION & MISSION --}}
        <div class="flex flex-col-reverse lg:grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
            <div class="text-left lg:text-left">
                <h2 class="text-2xl sm:text-3xl lg:text-[2.5rem] font-extrabold uppercase leading-tight mb-5 font-serif tracking-wide text-primary">
                    PERJALANAN ANDA, <br>KOMITMEN KAMI
                </h2>
                <p class="text-sm sm:text-base leading-relaxed mb-4 text-gray-500">
                    <strong class="font-semibold text-gray-800">Visi Kami:</strong> Menjadi jembatan terpercaya bagi jutaan hati yang merindu Baitullah.
                </p>
                <p class="text-sm sm:text-base leading-relaxed mb-6 text-gray-500">
                    Kami berkomitmen untuk memberikan pelayanan yang jujur, amanah, dan profesional. Setiap senyum kepuasan jamaah adalah bukti dedikasi kami untuk Indonesia.
                </p>
                <a href="https://wa.me/6282184515310" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2.5 font-bold text-sm sm:text-base no-underline pb-1 mt-2 transition-all duration-300 hover:gap-4 text-primary border-b-2 border-gold hover:text-gold">
                    Konsultasi Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div>
                <div class="rounded-xl overflow-hidden shadow-none lg:shadow-[20px_20px_0px_rgba(212,175,55,0.15)]">
                    <img src="{{ asset('images/hero/story3.jpeg') }}" alt="Visi Misi Mahira Tour" 
                         class="w-full h-auto block object-cover aspect-[4/3]">
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ==================== LEADERSHIP ==================== --}}
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="container-main">
        <div class="text-center mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4 text-gold bg-gold/10 tracking-[2px]">Kepemimpinan</span>
            <h2 class="text-2xl sm:text-3xl lg:text-[2.5rem] font-extrabold uppercase font-serif text-center mt-0 tracking-wide text-primary">
                TIM PIMPINAN MAHIRA TOUR
            </h2>
            <p class="text-sm sm:text-base max-w-[600px] mx-auto mt-4 leading-relaxed text-gray-500">DIPIMPIN OLEH PROFESIONAL BERPENGALAMAN</p>
        </div>

        {{-- Executive Profiles --}}
        <div class="flex flex-col gap-16 lg:gap-24 max-w-[900px] mx-auto">
            @foreach($leadership as $index => $leader)
            <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16 {{ $index % 2 !== 0 ? 'md:flex-row-reverse' : '' }} text-center md:text-left">
                <div class="flex-1">
                    <div class="rounded-[200px_200px_20px_20px] overflow-hidden aspect-[3/4] border-2 border-gold shadow-none lg:shadow-[20px_20px_0_rgba(0,29,95,0.1)] group">
                        @if($leader['name'] == 'Khilal Hamdan')
                            <img src="{{ asset('storage/team/direktur.webp') }}" alt="{{ $leader['name'] }}" loading="lazy" class="w-full h-full object-cover grayscale transition-all duration-500 group-hover:grayscale-0">
                        @elseif($leader['name'] == 'Nadirman Hamdan')
                            <img src="{{ asset('storage/team/komisaris.webp') }}" alt="{{ $leader['name'] }}" loading="lazy" class="w-full h-full object-cover grayscale transition-all duration-500 group-hover:grayscale-0">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#001D5F] to-[#D4AF37]">
                                <svg class="w-20 h-20 text-white/70" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex-[1.5]">
                    <h3 class="text-xl sm:text-2xl lg:text-[2rem] font-extrabold mb-1 font-serif text-primary">{{ $leader['name'] }}</h3>
                    <p class="text-xs sm:text-sm font-bold uppercase tracking-widest mb-6 lg:mb-8 text-gold tracking-[2px]">{{ strtoupper($leader['position']) }}</p>
                    <div class="relative pl-8 md:pl-8 md:border-l-[3px] border-t-[2px] md:border-t-0 pt-5 md:pt-0 border-gray-200">
                        <svg class="absolute top-[-10px] left-2.5 w-8 h-8 opacity-20 text-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <p class="text-sm sm:text-base italic leading-relaxed text-gray-500">
                            Mengemban amanah untuk melayani tamu-tamu Allah adalah kehormatan tertinggi bagi kami. Kepuasan jamaah adalah prioritas utama.
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Team Members --}}
        @if(count($team) > 0)
        <div class="mt-20 pt-14 border-t border-gray-200">
            <h3 class="text-2xl font-bold text-center mb-10 text-gray-800">Tim Kami</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($team as $member)
                <div class="bg-white rounded-2xl p-5 text-center transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg shadow-[0_4px_15px_rgba(0,0,0,0.05)]">
                    <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4 border-3 border-gold">
                        <img src="{{ Storage::url($member['photo']) }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <h5 class="text-base font-bold mb-1 text-gray-800">{{ $member['name'] }}</h5>
                    <p class="text-sm text-gray-500">{{ $member['position'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

{{-- ==================== TRUST & CERTIFIED ==================== --}}
<section class="py-16 lg:py-24 text-white bg-gradient-to-br from-[#001D5F] to-[#001440]">
    <div class="container-main">
        <div class="text-center mb-10 lg:mb-14">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4 text-gold bg-gold/15 tracking-[2px]">Berizin & Terpercaya</span>
            <h2 class="text-2xl sm:text-3xl lg:text-[2.5rem] font-extrabold uppercase font-serif text-center text-white mt-0 tracking-wide">
                LEGALITAS RESMI
            </h2>
        </div>

        {{-- PPIU License Card --}}
        <div class="flex flex-col md:flex-row items-start gap-6 sm:gap-8 rounded-2xl p-6 sm:p-8 md:p-10 mb-14 max-w-[900px] mx-auto bg-white/10 backdrop-blur-[10px] border border-white/20">
            <div class="w-14 h-14 rounded-xl flex items-center justify-center shrink-0 mx-auto md:mx-0 bg-gradient-to-br from-[#D4AF37] to-[#C5A028]">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            </div>
            <div class="flex-1 text-center md:text-left">
                <h4 class="text-xl font-bold text-white mb-5">Surat Izin Penyelenggaraan Perjalanan Ibadah Umrah (PPIU)</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">
                    <div class="flex flex-col gap-1">
                        <span class="text-xs uppercase tracking-wide text-white/70 tracking-[1px]">Nomor Izin</span>
                        <span class="text-base font-semibold text-gold">{{ $ppiuInfo['number'] }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs uppercase tracking-wide text-white/70 tracking-[1px]">Tanggal Terbit</span>
                        <span class="text-base font-semibold text-gold">{{ $ppiuInfo['date'] }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs uppercase tracking-wide text-white/70 tracking-[1px]">Diterbitkan Oleh</span>
                        <span class="text-base font-semibold text-gold">{{ $ppiuInfo['issuer'] }}</span>
                    </div>
                </div>
                <button @click="ppiuModalOpen = true"
                        class="inline-flex items-center gap-2.5 px-6 py-3 rounded-xl text-sm font-semibold cursor-pointer transition-all duration-300 mt-2 hover:-translate-y-0.5 bg-white/20 text-white border-2 border-white/40 hover:bg-white hover:text-primary hover:border-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Lihat Surat Izin
                </button>
            </div>
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

{{-- ==================== BRANCHES ==================== --}}
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="container-main">
        <div class="text-center mb-12 lg:mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4 text-gold bg-gold/10 tracking-[2px]">{{ count($branches) }} Cabang di Indonesia</span>
            <h2 class="text-2xl sm:text-3xl lg:text-[2.5rem] font-extrabold uppercase font-serif text-center mt-0 tracking-wide text-primary">
                LOKASI CABANG KAMI
            </h2>
            <p class="text-sm sm:text-base max-w-[600px] mx-auto mt-4 leading-relaxed text-gray-500">KLIK KARTU CABANG UNTUK DETAIL LOKASI</p>
        </div>

        {{-- Branch Cards Slider --}}
        <div class="mb-10 overflow-hidden">
            <div id="branchCardsContainer" class="flex gap-5 overflow-x-auto pb-5 pt-2.5 snap-x scroll-smooth [scrollbar-width:thin] [scrollbar-color:#D4AF37_#F8F9FA]">
                {{-- Cards rendered by JS --}}
            </div>
        </div>

        {{-- Map --}}
        <div class="rounded-2xl overflow-hidden bg-white shadow-[0_15px_50px_rgba(0,29,95,0.1)] h-[350px] sm:h-[450px] lg:h-[70vh] lg:min-h-[500px]">
            <div id="map" class="w-full h-full rounded-[20px]"></div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
@include('partials.cta-section')

{{-- ==================== PPIU MODAL ==================== --}}
<div x-show="ppiuModalOpen" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-black/85 backdrop-blur-[5px] z-[9999] flex items-center justify-center p-5"
     @click.self="ppiuModalOpen = false"
     x-cloak>
    
    <div class="bg-white rounded-2xl max-w-[600px] w-full max-h-[90vh] overflow-y-auto relative p-8 md:p-6 animate-[fadeIn_0.3s_ease]">
        <button @click="ppiuModalOpen = false"
                class="absolute top-4 right-4 w-10 h-10 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 border-0 bg-gray-100 text-gray-700 hover:bg-primary hover:text-white hover:rotate-90">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h4 class="text-xl font-bold flex items-center gap-2.5 mb-5 text-primary">
            <svg class="w-6 h-6 text-gold" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
            Surat Izin PPIU
        </h4>
        <div class="rounded-xl p-4 mb-5 bg-gray-50">
            <img src="{{ Storage::url('surat/suratizin.jpg') }}" alt="Surat Izin PPIU Mahira Tour" loading="lazy"
                 class="w-full h-auto rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.1)]">
        </div>
        <a href="{{ Storage::url('surat/suratizin.jpg') }}" download
           class="flex items-center justify-center gap-2.5 w-full py-3.5 rounded-xl text-[15px] font-semibold text-white no-underline transition-all duration-300 hover:-translate-y-0.5 bg-gradient-to-br from-emerald-500 to-teal-600 hover:shadow-[0_8px_20px_rgba(16,185,129,0.3)]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Download Surat Izin
        </a>
    </div>
</div>

</div> {{-- End x-data --}}
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>const branchesData = JSON.parse('{!! addslashes(json_encode($branches)) !!}');</script>
<script src="{{ asset('js/about.js') }}"></script>
@endpush
