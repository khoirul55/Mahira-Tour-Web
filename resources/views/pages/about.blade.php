@extends('layouts.app')

@section('title', 'Tentang Kami - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    /* Leaflet map needs fixed height */
    #map { height: 100%; width: 100%; border-radius: 20px; }

    /* Ken Burns for hero */
    @keyframes heroKenBurns {
        0% { transform: scale(1); }
        100% { transform: scale(1.15); }
    }

    /* Executive arch frame */
    .executive-frame {
        border-radius: 200px 200px 20px 20px;
        overflow: hidden;
        aspect-ratio: 3/4;
        border: 2px solid #D4AF37;
        box-shadow: 20px 20px 0 rgba(0,29,95,0.1);
    }
    .executive-frame img {
        width: 100%; height: 100%; object-fit: cover;
        filter: grayscale(100%);
        transition: filter 0.5s;
    }
    .executive-frame:hover img { filter: grayscale(0%); }

    /* Branch card scrollbar */
    .branch-scroll::-webkit-scrollbar { height: 6px; }
    .branch-scroll::-webkit-scrollbar-track { background: #F8F9FA; border-radius: 10px; }
    .branch-scroll::-webkit-scrollbar-thumb { background: #D4AF37; border-radius: 10px; }

    /* Legal partner icons */
    .legal-icon {
        height: 50px; width: auto;
        filter: grayscale(100%) brightness(200%);
        transition: all 0.3s;
    }
    .legal-item:hover .legal-icon { filter: none; }

    /* PPIU Modal */
    .ppiu-modal {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.85); backdrop-filter: blur(5px);
        z-index: 9999; align-items: center; justify-content: center; padding: 20px;
    }
    .ppiu-modal.active { display: flex; }
</style>
@endpush

@section('content')

{{-- ==================== HERO SECTION ==================== --}}
<section class="relative h-[450px] md:h-[400px] sm:h-[350px] overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 z-[1]">
        <img src="{{ asset('images/hero/hero-about.webp') }}" alt="Tentang Mahira Tour" fetchpriority="high" loading="eager"
             class="w-full h-full object-cover object-center" style="animation: heroKenBurns 20s ease-in-out infinite alternate;">
    </div>
    <div class="absolute inset-0 z-[2]" style="background: rgba(0, 29, 95, 0.75);"></div>
    <div class="relative z-[3] text-center max-w-[900px] px-5 pt-10">
        <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full mb-6 text-[0.9rem]"
             style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
            <a href="{{ route('home') }}" class="text-white no-underline font-medium hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                Beranda
            </a>
            <span style="color: rgba(255,255,255,0.7);">/</span>
            <span style="color: rgba(255,255,255,0.7);">Tentang Kami</span>
        </div>
        <h1 class="text-[3.5rem] md:text-[2.5rem] sm:text-[2rem] font-bold font-serif text-white mb-4 leading-tight"
            style="text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
            <span class="inline-block mx-1 opacity-0" style="animation: slideInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.3s forwards;">Tentang</span>
            <span class="inline-block mx-1 opacity-0" style="animation: slideInRight 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.5s forwards;">Mahira Tour</span>
        </h1>
        <p class="font-semibold text-[0.9rem] uppercase tracking-wider mb-2" style="color: #D4AF37;">{{ $companyInfo['tagline'] }}</p>
        <p class="text-sm md:text-base max-w-[700px] mx-auto leading-relaxed" style="color: rgba(255,255,255,0.9);">
            Mitra terpercaya perjalanan ibadah Anda sejak {{ $companyInfo['founded'] }}
        </p>
    </div>
</section>

{{-- ==================== ZIGZAG STORY SECTIONS ==================== --}}
<section class="py-24 md:py-16 overflow-hidden" style="background: white;">
    <div class="container-main">

        {{-- BLOCK 1: STORY (Text Left, Image Right) — flex-col-reverse on mobile so image shows first --}}
        <div class="flex flex-col-reverse lg:grid lg:grid-cols-2 gap-10 lg:gap-16 items-center mb-32 lg:mb-40">
            {{-- Text (left on desktop, bottom on mobile) --}}
            <div class="p-5 lg:p-0 text-center lg:text-left">
                <h2 class="text-[2.5rem] md:text-[1.8rem] font-extrabold uppercase leading-tight mb-6 font-serif tracking-wide" style="color: #B89230;">
                    SEBUAH PERJALANAN <br>AMANAH & PELAYANAN
                </h2>
                <p class="text-lg md:text-base leading-relaxed mb-6" style="color: #6B7280;">
                    Cerita ini tidak dimulai di kantor yang megah, pun tidak bermula dari rencana bisnis yang rumit. Semuanya berawal pada tahun 2016, di tengah lautan manusia yang memutih di Masjidil Haram.
                </p>
                <p class="text-lg md:text-base leading-relaxed" style="color: #6B7280;">
                    Di sana, sebuah niat terpatri: <strong class="font-semibold" style="color: #1F2937;">Setiap Muslim berhak merasakan kekhusyukan tanpa rasa was-was.</strong> Kini, setelah ribuan jamaah kami antarkan, Mahira Tour bukan sekadar biro perjalanan, melainkan wadah persaudaraan keluarga Allah.
                </p>
            </div>
            {{-- Image (right on desktop, top on mobile) --}}
            <div>
                <div class="rounded overflow-hidden transition-transform duration-500 hover:scale-[1.01]"
                     style="box-shadow: 20px 20px 0px rgba(212,175,55,0.15);">
                    <img src="{{ asset('images/hero/story1.jpeg') }}" alt="Sejarah Mahira Tour" 
                         class="w-full h-auto block object-cover transition-transform duration-700 hover:scale-103" style="aspect-ratio: 4/3;">
                </div>
            </div>
        </div>

        {{-- BLOCK 2: VALUES/EXPERTISE (Image Left, Text Right) — natural order works for both mobile & desktop --}}
        <div class="flex flex-col lg:grid lg:grid-cols-2 gap-10 lg:gap-16 items-center mb-32 lg:mb-40">
            {{-- Image (left on desktop, top on mobile) --}}
            <div>
                <div class="rounded overflow-hidden transition-transform duration-500 hover:scale-[1.01]"
                     style="box-shadow: -20px 20px 0px rgba(212,175,55,0.15);">
                    <img src="{{ asset('images/hero/story2.jpeg') }}" alt="Profesionalitas Mahira Tour" 
                         class="w-full h-auto block object-cover transition-transform duration-700 hover:scale-103" style="aspect-ratio: 4/3;">
                </div>
            </div>
            {{-- Text (right on desktop, bottom on mobile) --}}
            <div class="p-5 lg:p-0 text-center lg:text-left">
                <h2 class="text-[2.5rem] md:text-[1.8rem] font-extrabold uppercase leading-tight mb-6 font-serif tracking-wide" style="color: #B89230;">
                    LEBIH DARI SEKADAR <br>HAJI & UMRAH
                </h2>
                <p class="text-lg md:text-base leading-relaxed mb-6" style="color: #6B7280;">
                    Kami tidak hanya mengurus tiket dan visa. Kami merancang pengalaman spiritual yang mendalam. Dengan izin resmi PPIU Kemenag RI, kami menjamin keamanan dan kenyamanan ibadah Anda.
                </p>
                <ul class="space-y-3 text-left inline-block lg:block">
                    <li class="flex items-center gap-3 text-lg md:text-base" style="color: #6B7280;">
                        <svg class="w-5 h-5 shrink-0" style="color: #D4AF37;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Bimbingan Ibadah Sesuai Sunnah
                    </li>
                    <li class="flex items-center gap-3 text-lg md:text-base" style="color: #6B7280;">
                        <svg class="w-5 h-5 shrink-0" style="color: #D4AF37;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Fasilitas Nyaman & Terjamin
                    </li>
                    <li class="flex items-center gap-3 text-lg md:text-base" style="color: #6B7280;">
                        <svg class="w-5 h-5 shrink-0" style="color: #D4AF37;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Pendampingan Sepenuh Hati
                    </li>
                </ul>
            </div>
        </div>

        {{-- BLOCK 3: VISION & MISSION (Text Left, Image Right) — flex-col-reverse on mobile --}}
        <div class="flex flex-col-reverse lg:grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            {{-- Text (left on desktop, bottom on mobile) --}}
            <div class="p-5 lg:p-0 text-center lg:text-left">
                <h2 class="text-[2.5rem] md:text-[1.8rem] font-extrabold uppercase leading-tight mb-6 font-serif tracking-wide" style="color: #B89230;">
                    PERJALANAN ANDA, <br>KOMITMEN KAMI
                </h2>
                <p class="text-lg md:text-base leading-relaxed mb-6" style="color: #6B7280;">
                    <strong class="font-semibold" style="color: #1F2937;">Visi Kami:</strong> Menjadi jembatan terpercaya bagi jutaan hati yang merindu Baitullah.
                </p>
                <p class="text-lg md:text-base leading-relaxed mb-6" style="color: #6B7280;">
                    Kami berkomitmen untuk memberikan pelayanan yang jujur, amanah, dan profesional. Setiap senyum kepuasan jamaah adalah bukti dedikasi kami untuk Indonesia.
                </p>
                <a href="https://wa.me/6282184515310" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2.5 font-bold no-underline pb-1 mt-2 transition-all duration-300 hover:gap-4"
                   style="color: #001D5F; border-bottom: 2px solid #D4AF37;"
                   onmouseover="this.style.color='#D4AF37';"
                   onmouseout="this.style.color='#001D5F';">
                    Konsultasi Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            {{-- Image (right on desktop, top on mobile) --}}
            <div>
                <div class="rounded overflow-hidden transition-transform duration-500 hover:scale-[1.01]"
                     style="box-shadow: 20px 20px 0px rgba(212,175,55,0.15);">
                    <img src="{{ asset('images/hero/story3.jpeg') }}" alt="Visi Misi Mahira Tour" 
                         class="w-full h-auto block object-cover transition-transform duration-700 hover:scale-103" style="aspect-ratio: 4/3;">
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ==================== LEADERSHIP ==================== --}}
<section class="py-24 md:py-14" style="background: #F8F9FA;">
    <div class="container-main">
        <div class="text-center mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4"
                  style="color: #D4AF37; background: rgba(212,175,55,0.1); letter-spacing: 2px;">Kepemimpinan</span>
            <h2 class="text-[2.5rem] md:text-[1.8rem] font-extrabold uppercase font-serif text-center mt-0 tracking-wide" style="color: #B89230;">
                TIM PIMPINAN MAHIRA TOUR
            </h2>
            <p class="text-base max-w-[600px] mx-auto mt-4 leading-relaxed" style="color: #6B7280;">DIPIMPIN OLEH PROFESIONAL BERPENGALAMAN</p>
        </div>

        {{-- Executive Profiles --}}
        <div class="flex flex-col gap-24 max-w-[900px] mx-auto">
            @foreach($leadership as $index => $leader)
            <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16 {{ $index % 2 !== 0 ? 'md:flex-row-reverse' : '' }} text-center md:text-left">
                <div class="flex-1">
                    <div class="executive-frame">
                        @if($leader['name'] == 'Khilal Hamdan')
                            <img src="{{ asset('storage/team/direktur.webp') }}" alt="{{ $leader['name'] }}" loading="lazy">
                        @elseif($leader['name'] == 'Nadirman Hamdan')
                            <img src="{{ asset('storage/team/komisaris.webp') }}" alt="{{ $leader['name'] }}" loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, #001D5F, #D4AF37);">
                                <svg class="w-20 h-20 text-white/70" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex-[1.5]">
                    <h3 class="text-[2rem] md:text-[1.6rem] font-extrabold mb-1 font-serif" style="color: #001D5F;">{{ $leader['name'] }}</h3>
                    <p class="text-sm font-bold uppercase tracking-widest mb-8" style="color: #D4AF37; letter-spacing: 2px;">{{ strtoupper($leader['position']) }}</p>
                    <div class="relative pl-8 md:pl-8 md:border-l-[3px] border-t-[2px] md:border-t-0 pt-5 md:pt-0" style="border-color: #E5E7EB;">
                        <svg class="absolute top-[-10px] left-2.5 w-8 h-8 opacity-20" style="color: #D4AF37;" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <p class="text-lg md:text-base italic leading-relaxed" style="color: #6B7280;">
                            Mengemban amanah untuk melayani tamu-tamu Allah adalah kehormatan tertinggi bagi kami. Kepuasan jamaah adalah prioritas utama.
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Team Members --}}
        @if(count($team) > 0)
        <div class="mt-20 pt-14" style="border-top: 1px solid #E5E7EB;">
            <h3 class="text-2xl font-bold text-center mb-10" style="color: #1F2937;">Tim Kami</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($team as $member)
                <div class="bg-white rounded-2xl p-5 text-center transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg"
                     style="box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                    <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4" style="border: 3px solid #D4AF37;">
                        <img src="{{ Storage::url($member['photo']) }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <h5 class="text-base font-bold mb-1" style="color: #1F2937;">{{ $member['name'] }}</h5>
                    <p class="text-sm" style="color: #6B7280;">{{ $member['position'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

{{-- ==================== TRUST & CERTIFIED ==================== --}}
<section class="py-24 md:py-14 text-white" style="background: linear-gradient(135deg, #001D5F 0%, #001440 100%);">
    <div class="container-main">
        <div class="text-center mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4"
                  style="color: #D4AF37; background: rgba(212,175,55,0.15); letter-spacing: 2px;">Berizin & Terpercaya</span>
            <h2 class="text-[2.5rem] md:text-[1.8rem] font-extrabold uppercase font-serif text-center text-white mt-0 tracking-wide">
                LEGALITAS RESMI
            </h2>
            <p class="text-base max-w-[600px] mx-auto mt-4 leading-relaxed" style="color: rgba(255,255,255,0.9);">TERDAFTAR DAN DIAWASI PEMERINTAH RI</p>
        </div>

        {{-- PPIU License Card --}}
        <div class="flex flex-col md:flex-row items-start gap-8 rounded-2xl p-10 md:p-10 mb-14 max-w-[900px] mx-auto"
             style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center shrink-0 mx-auto md:mx-0"
                 style="background: linear-gradient(135deg, #D4AF37, #C5A028);">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            </div>
            <div class="flex-1 text-center md:text-left">
                <h4 class="text-xl font-bold text-white mb-5">Surat Izin Penyelenggaraan Perjalanan Ibadah Umrah (PPIU)</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">
                    <div class="flex flex-col gap-1">
                        <span class="text-xs uppercase tracking-wide" style="color: rgba(255,255,255,0.7); letter-spacing: 1px;">Nomor Izin</span>
                        <span class="text-base font-semibold" style="color: #D4AF37;">{{ $ppiuInfo['number'] }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs uppercase tracking-wide" style="color: rgba(255,255,255,0.7); letter-spacing: 1px;">Tanggal Terbit</span>
                        <span class="text-base font-semibold" style="color: #D4AF37;">{{ $ppiuInfo['date'] }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs uppercase tracking-wide" style="color: rgba(255,255,255,0.7); letter-spacing: 1px;">Diterbitkan Oleh</span>
                        <span class="text-base font-semibold" style="color: #D4AF37;">{{ $ppiuInfo['issuer'] }}</span>
                    </div>
                </div>
                <button onclick="openPpiuModal()"
                        class="inline-flex items-center gap-2.5 px-6 py-3 rounded-xl text-sm font-semibold cursor-pointer transition-all duration-300 mt-2 hover:-translate-y-0.5"
                        style="background: rgba(255,255,255,0.2); color: white; border: 2px solid rgba(255,255,255,0.4);"
                        onmouseover="this.style.background='white'; this.style.color='#001D5F'; this.style.borderColor='white';"
                        onmouseout="this.style.background='rgba(255,255,255,0.2)'; this.style.color='white'; this.style.borderColor='rgba(255,255,255,0.4)';">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Lihat Surat Izin
                </button>
            </div>
        </div>

        {{-- Legal Partners --}}
        <div class="flex flex-col md:flex-row justify-center items-center gap-10 md:gap-10 flex-wrap pt-10 mt-5" style="border-top: 1px solid rgba(255,255,255,0.2);">
            <div class="legal-item flex flex-col items-center gap-4 opacity-80 hover:opacity-100 transition-all duration-300">
                <img src="{{ asset('images/partners/kemenag.webp') }}" alt="Kemenag" class="legal-icon">
                <span class="text-xs font-semibold tracking-widest" style="color: #D4AF37; letter-spacing: 1.5px;">RESMI KEMENAG RI</span>
            </div>
            <div class="hidden md:block w-px h-10" style="background: rgba(255,255,255,0.2);"></div>
            <div class="block md:hidden w-12 h-px" style="background: rgba(255,255,255,0.2);"></div>
            <div class="legal-item flex flex-col items-center gap-4 opacity-80 hover:opacity-100 transition-all duration-300">
                <img src="{{ asset('images/partners/himpuh.webp') }}" alt="HIMPUH" class="legal-icon">
                <span class="text-xs font-semibold tracking-widest" style="color: #D4AF37; letter-spacing: 1.5px;">ANGGOTA HIMPUH</span>
            </div>
            <div class="hidden md:block w-px h-10" style="background: rgba(255,255,255,0.2);"></div>
            <div class="block md:hidden w-12 h-px" style="background: rgba(255,255,255,0.2);"></div>
            <div class="legal-item flex flex-col items-center gap-4 opacity-80 hover:opacity-100 transition-all duration-300">
                <img src="{{ asset('images/partners/siskopatuh.webp') }}" alt="Siskopatuh" class="legal-icon">
                <span class="text-xs font-semibold tracking-widest" style="color: #D4AF37; letter-spacing: 1.5px;">TERDAFTAR SISKOPATUH</span>
            </div>
        </div>
    </div>
</section>

{{-- ==================== BRANCHES ==================== --}}
<section class="py-24 md:py-14" style="background: #F8F9FA;">
    <div class="container-main">
        <div class="text-center mb-16">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4"
                  style="color: #D4AF37; background: rgba(212,175,55,0.1); letter-spacing: 2px;">{{ count($branches) }} Cabang di Indonesia</span>
            <h2 class="text-[2.5rem] md:text-[1.8rem] font-extrabold uppercase font-serif text-center mt-0 tracking-wide" style="color: #B89230;">
                LOKASI CABANG KAMI
            </h2>
            <p class="text-base max-w-[600px] mx-auto mt-4 leading-relaxed" style="color: #6B7280;">KLIK KARTU CABANG UNTUK DETAIL LOKASI</p>
        </div>

        {{-- Branch Cards Slider --}}
        <div class="mb-10 overflow-hidden">
            <div id="branchCardsContainer" class="branch-scroll flex gap-5 overflow-x-auto pb-5 pt-2.5"
                 style="scroll-behavior: smooth; scrollbar-width: thin; scrollbar-color: #D4AF37 #F8F9FA;">
                {{-- Cards rendered by JS --}}
            </div>
        </div>

        {{-- Map --}}
        <div class="rounded-2xl overflow-hidden" style="background: white; box-shadow: 0 15px 50px rgba(0,29,95,0.1); height: 70vh; min-height: 500px;">
            <div id="map"></div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
@include('partials.cta-section')

{{-- ==================== PPIU MODAL ==================== --}}
<div id="ppiuModal" class="ppiu-modal" onclick="if(event.target===this)closePpiuModal()">
    <div class="bg-white rounded-2xl max-w-[600px] w-full max-h-[90vh] overflow-y-auto relative p-8 md:p-6"
         style="animation: fadeIn 0.3s ease;">
        <button onclick="closePpiuModal()"
                class="absolute top-4 right-4 w-10 h-10 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 border-0"
                style="background: #F3F4F6; color: #374151;"
                onmouseover="this.style.background='#001D5F'; this.style.color='white'; this.style.transform='rotate(90deg)';"
                onmouseout="this.style.background='#F3F4F6'; this.style.color='#374151'; this.style.transform='rotate(0deg)';">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h4 class="text-xl font-bold flex items-center gap-2.5 mb-5" style="color: #001D5F;">
            <svg class="w-6 h-6" style="color: #D4AF37;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
            Surat Izin PPIU
        </h4>
        <div class="rounded-xl p-4 mb-5" style="background: #F9FAFB;">
            <img src="{{ Storage::url('surat/suratizin.jpg') }}" alt="Surat Izin PPIU Mahira Tour" loading="lazy"
                 class="w-full h-auto rounded-lg" style="box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        </div>
        <a href="{{ Storage::url('surat/suratizin.jpg') }}" download
           class="flex items-center justify-center gap-2.5 w-full py-3.5 rounded-xl text-[15px] font-semibold text-white no-underline transition-all duration-300 hover:-translate-y-0.5"
           style="background: linear-gradient(135deg, #10B981, #0D9488);"
           onmouseover="this.style.boxShadow='0 8px 20px rgba(16,185,129,0.3)';"
           onmouseout="this.style.boxShadow='none';">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Download Surat Izin
        </a>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>const branchesData = JSON.parse('{!! addslashes(json_encode($branches)) !!}');</script>
<script src="{{ asset('js/about.js') }}"></script>
<script>
    function openPpiuModal() {
        document.getElementById('ppiuModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closePpiuModal() {
        document.getElementById('ppiuModal').classList.remove('active');
        document.body.style.overflow = '';
    }
</script>
@endpush
