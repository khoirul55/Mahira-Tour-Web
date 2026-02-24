@extends('layouts.app')

@section('title', $schedule->package_name . ' - Mahira Tour')
@section('meta_description', 'Paket Umrah ' . $schedule->package_name . ' keberangkatan ' . $schedule->departure_date->format('d M Y') . '. Harga Rp ' . number_format($schedule->price, 0, ',', '.') . '. Seat terbatas!')
@section('og_image', $schedule->flyer_image ? Storage::url($schedule->flyer_image) : asset('images/hero/hero-schedule.webp'))

@section('content')

<div x-data="{ showFlyer: false }">

    {{-- ==================== HERO SECTION: Split Layout ==================== --}}
    <section class="relative overflow-hidden h-[85vh] max-h-[700px] min-h-[500px]">
        <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] h-full">
            {{-- LEFT: Image & Title --}}
            <div class="relative h-[400px] lg:h-full">
                <div class="absolute inset-0">
                    <img src="{{ asset('images/hero/hero-schedule.webp') }}" alt="Background Umrah" class="w-full h-full object-cover">
                    <div class="absolute inset-0 z-[1] bg-black/40"></div>
                </div>
                <div class="relative z-[2] h-full flex flex-col justify-center px-[8%] text-white text-center lg:text-left shadow-black/50 text-shadow-md">
                    <h4 class="text-lg font-semibold uppercase tracking-[2px] mb-2.5">PAKET UMRAH PREMIUM</h4>
                    <h1 class="text-[3.5rem] lg:text-[3rem] md:text-[2.2rem] font-extrabold font-serif leading-[1.1] mb-5 uppercase">{{ $schedule->package_name }}</h1>
                    <div class="text-2xl md:text-xl font-semibold flex items-center gap-2 justify-center lg:justify-start flex-wrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        {{ $schedule->departure_date->format('d M') }} - {{ $schedule->return_date->format('d M Y') }}
                        <span class="text-base px-2.5 py-0.5 rounded ml-2.5 align-middle bg-[#C5A036] text-white">({{ $schedule->duration }})</span>
                    </div>
                    <div class="mt-2 text-white flex items-center gap-1.5 justify-center lg:justify-start">
                        <svg class="w-4 h-4 text-[#C5A036]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        start {{ $schedule->departure_route }}
                    </div>
                    <div class="mt-4">
                        <button @click="showFlyer = true"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-semibold text-sm text-white cursor-pointer transition-all duration-300 hover:-translate-y-0.5 border-2 border-white/60 bg-transparent hover:bg-white/15">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Lihat Brosur/Flyer
                        </button>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Gold Pricing Panel --}}
            <div class="flex flex-col justify-center items-center text-center p-10 bg-[#C5A036] text-[#001D5F]">
                <div class="w-full max-w-[350px]">
                    <div class="mb-6">
                        <span class="block font-bold text-sm uppercase tracking-[1px] mb-1">HARGA PAKET</span>
                        <h1 class="text-[2.8rem] md:text-[2rem] font-bold font-serif m-0 text-white shadow-black/10 text-shadow-sm">
                            Rp {{ number_format($schedule->price, 0, ',', '.') }}
                        </h1>
                        <p class="text-white/50 mt-2 mb-0">Per Orang / Pax</p>
                    </div>
                    <div class="mt-4 w-full">
                        @if($schedule->status !== 'full')
                        <a href="{{ route('register', ['schedule_id' => $schedule->id]) }}"
                           class="block w-full py-3.5 rounded-full font-bold uppercase text-center no-underline transition-all duration-300 hover:-translate-y-0.5 bg-white text-[#C5A036] hover:shadow-lg hover:shadow-black/20">
                            <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Daftar Sekarang
                        </a>
                        @else
                        <button disabled class="block w-full py-3.5 rounded-full font-bold uppercase cursor-not-allowed opacity-70 bg-gray-500 text-white border-0">
                            <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            Paket Penuh
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== CONTENT SECTION ==================== --}}
    <section class="container-main py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- LEFT COLUMN --}}
            <div>
                {{-- ACCOMMODATION --}}
                <div class="mb-12">
                    <h3 class="text-center text-2xl font-extrabold mb-6 text-[#001D5F]">Accomodation</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center group">
                            <div class="relative rounded-xl overflow-hidden h-[250px] bg-[#f0f0f0]">
                                <img src="{{ $schedule->hotel_makkah_image ? Storage::url($schedule->hotel_makkah_image) : 'https://placehold.co/400x300/f5f5f5/001D5F?text=Hotel+Makkah' }}"
                                     alt="Hotel Makkah" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <span class="absolute bottom-0 left-0 w-full text-center py-2 text-white text-sm font-bold tracking-[1px] bg-[#001D5F]/80 backdrop-blur-[4px]">MAKKAH</span>
                            </div>
                            <h5 class="font-bold text-base mt-2.5 text-center text-[#001D5F]">{{ $schedule->hotel_makkah ?? 'Anjum Hotel / Setaraf' }}</h5>
                        </div>
                        <div class="text-center group">
                            <div class="relative rounded-xl overflow-hidden h-[250px] bg-[#f0f0f0]">
                                <img src="{{ $schedule->hotel_madinah_image ? Storage::url($schedule->hotel_madinah_image) : 'https://placehold.co/400x300/f5f5f5/001D5F?text=Hotel+Madinah' }}"
                                     alt="Hotel Madinah" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <span class="absolute bottom-0 left-0 w-full text-center py-2 text-white text-sm font-bold tracking-[1px] bg-[#001D5F]/80 backdrop-blur-[4px]">MADINAH</span>
                            </div>
                            <h5 class="font-bold text-base mt-2.5 text-center text-[#001D5F]">{{ $schedule->hotel_madinah ?? 'Rove Hotel / Setaraf' }}</h5>
                        </div>
                    </div>
                    <p class="text-center text-sm italic mt-2 text-gray-500">*Accomodation as above or similar.</p>
                </div>

                {{-- PACKAGE INCLUDES --}}
                <div class="mb-12">
                    <h3 class="text-2xl font-extrabold mb-6 text-[#001D5F]">Package Includes</h3>
                    <ul class="space-y-3 list-none p-0">
                        @if($schedule->features)
                            @foreach(explode(',', $schedule->features) as $feature)
                            <li class="relative pl-5 text-base leading-relaxed text-[#333]">
                                <span class="absolute left-0 top-[-2px] font-bold text-lg text-[#333]">•</span>
                                {{ trim($feature) }}
                            </li>
                            @endforeach
                        @else
                            @foreach(['Visa Saudi', 'Ziarah kota Makkah & Madinah', '1x Ziarah Raudha/Maqam', 'Tiket Pesawat Ekonomi PP', 'Makan 3x Sehari (Asian/Indo Buffet)', 'Air Zamzam 5 Liter (Jika diizinkan)', 'Asuransi Perjalanan', 'Transportasi Bus AC Eksklusif', 'Muthawif Berpengalaman'] as $feature)
                            <li class="relative pl-5 text-base leading-relaxed text-[#333]">
                                <span class="absolute left-0 top-[-2px] font-bold text-lg text-[#333]">•</span>
                                {{ $feature }}
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                {{-- PACKAGE EXCLUDES --}}
                <div>
                    <h3 class="text-2xl font-extrabold mb-6 text-[#001D5F]">Package Excludes</h3>
                    <ul class="space-y-3 list-none p-0">
                        @if($schedule->excludes)
                            @foreach(explode(',', $schedule->excludes) as $exclude)
                            <li class="relative pl-5 text-base leading-relaxed text-[#333]">
                                <span class="absolute left-0 top-[-2px] font-bold text-lg text-[#333]">•</span>
                                {{ trim($exclude) }}
                            </li>
                            @endforeach
                        @else
                            @foreach(['Pembuatan Paspor', 'Vaksin Meningitis (Jika ada)', 'Kelebihan Bagasi (Excess Baggage)', 'Pengeluaran Pribadi (Laundry, Telp, dll)', 'Tour Tambahan di luar program'] as $exclude)
                            <li class="relative pl-5 text-base leading-relaxed text-[#333]">
                                <span class="absolute left-0 top-[-2px] font-bold text-lg text-[#333]">•</span>
                                {{ $exclude }}
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            {{-- RIGHT COLUMN --}}
            <div>
                {{-- FLIGHT --}}
                <div class="mb-12 text-center">
                    <h3 class="text-center text-2xl font-extrabold mb-6 text-[#001D5F]">Flight</h3>
                    <div>
                        <h2 class="font-bold font-serif text-[#001D5F]">{{ $schedule->airline }}</h2>
                        <div class="my-2.5">
                            <svg class="w-16 h-16 mx-auto text-[#C5A036]" fill="currentColor" viewBox="0 0 24 24"><path d="M22 16.21v-1.895l-1.5-1.5v-7.396c0-.854-.552-1.609-1.368-1.873L12.66 1.356c-.427-.139-.89-.139-1.317 0L4.868 3.546c-.816.264-1.368 1.02-1.368 1.873v7.396l-1.5 1.5v1.895h2v1.79h16v-1.79h2zm-10-14l5.664 1.837L12 5.892 6.336 4.047 12 2.21z"/></svg>
                        </div>
                        <p class="text-gray-500">Direct Flight / Transit sesuai program</p>
                    </div>
                </div>

                {{-- ITINERARY --}}
                <div class="mb-12 text-center">
                    <h3 class="text-center text-2xl font-extrabold mb-6 text-[#001D5F]">Itinerary</h3>
                    <div>
                        @if($schedule->itinerary_pdf)
                        <a href="{{ Storage::url($schedule->itinerary_pdf) }}" target="_blank"
                           class="inline-block px-8 py-4 font-bold text-sm tracking-[1px] text-white no-underline transition-all duration-300 hover:-translate-y-0.5 bg-[#001D5F] hover:bg-[#00154a] hover:shadow-[0_4px_15px_rgba(0,29,95,0.3)]">
                            DOWNLOAD ITINERARY PDF
                            <svg class="w-5 h-5 inline-block ml-1 -mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/></svg>
                        </a>
                        @else
                        <button disabled class="inline-block px-8 py-4 font-bold text-sm tracking-[1px] text-white opacity-60 cursor-not-allowed border-0 bg-[#001D5F]">
                            PDF BELUM TERSEDIA
                            <svg class="w-5 h-5 inline-block ml-1 -mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        </button>
                        @endif
                        <div class="mt-3 text-sm text-gray-500">*Program perjalanan dapat berubah sewaktu-waktu</div>
                        @if($schedule->itinerary)
                        <div class="mt-4 text-left p-4 rounded-lg text-sm bg-gray-50">
                            {!! nl2br(e(Str::limit($schedule->itinerary, 300))) !!}
                        </div>
                        @endif
                    </div>
                </div>

                {{-- UMRAH GIFTS --}}
                <div class="mb-12">
                    <h3 class="text-2xl font-extrabold mb-6 text-[#001D5F]">Umrah Gifts</h3>
                    <ul class="space-y-3 list-none p-0">
                        @if($schedule->gifts)
                            @foreach(explode(',', $schedule->gifts) as $gift)
                            <li class="relative pl-5 text-base leading-relaxed text-[#333]">
                                <span class="absolute left-0 top-[-2px] font-bold text-lg text-[#333]">•</span>
                                {{ trim($gift) }}
                            </li>
                            @endforeach
                        @else
                            @foreach(['Koper Besar (Cabin Bag)', 'Tas Selempang (Sling Bag)', 'Kain Ihram (Pria) / Mukena (Wanita)', 'Buku Panduan Doa', 'ID Card & Syal Mahira', 'Air Zamzam 5L'] as $gift)
                            <li class="relative pl-5 text-base leading-relaxed text-[#333]">
                                <span class="absolute left-0 top-[-2px] font-bold text-lg text-[#333]">•</span>
                                {{ $gift }}
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                {{-- ADDITIONAL INFO --}}
                <div>
                    <h3 class="text-2xl font-extrabold mb-6 text-[#001D5F]">Additional Information</h3>
                    <ul class="space-y-3 list-none p-0">
                        @if($schedule->additional_info)
                            @foreach(explode(',', $schedule->additional_info) as $info)
                            <li class="relative pl-5 text-base leading-relaxed text-[#333]">
                                <span class="absolute left-0 top-[-2px] font-bold text-lg text-[#333]">•</span>
                                {{ trim($info) }}
                            </li>
                            @endforeach
                        @else
                            @foreach(['Harga paket dapat berubah sewaktu-waktu mengikuti kebijakan maskapai dan hotel.', 'Jadwal keberangkatan bisa bergeser 1-2 hari.', 'Pendaftaran wajib menyertakan DP minimal Rp 5.000.000.', 'Pelunasan maksimal H-30 keberangkatan.'] as $info)
                            <li class="relative pl-5 text-base leading-relaxed text-[#333]">
                                <span class="absolute left-0 top-[-2px] font-bold text-lg text-[#333]">•</span>
                                {{ $info }}
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Sticky Register Button (Mobile) --}}
    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-[1000] shadow-[0_-4px_10px_rgba(0,0,0,0.1)]">
        <div class="grid grid-cols-2">
            <div class="flex items-center justify-center p-3 bg-white border-t border-gray-200">
                <span class="font-bold text-[#C5A036]">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
            </div>
            <a href="{{ route('register', ['schedule_id' => $schedule->id]) }}"
               class="flex items-center justify-center h-full no-underline text-white font-bold bg-[#001D5F]">
                Daftar Sekarang
            </a>
        </div>
    </div>

    {{-- FLYER MODAL / LIGHTBOX --}}
    <div x-show="showFlyer" x-cloak x-transition.opacity
         @click="showFlyer = false"
         class="fixed inset-0 z-[9999] flex items-center justify-center p-5 bg-black/90">
        <div class="relative max-w-[90%] max-h-[90vh]" @click.stop>
            <button @click="showFlyer = false"
                    class="absolute -top-10 right-0 bg-transparent border-0 text-white text-2xl cursor-pointer">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <img src="{{ Storage::url($schedule->flyer_image) }}" alt="Brosur Paket" class="max-w-full max-h-[80vh] rounded-lg shadow-[0_0_20px_rgba(0,0,0,0.5)]">
            <div class="text-center mt-3">
                <a href="{{ Storage::url($schedule->flyer_image) }}" download
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm text-white no-underline transition-all duration-300 hover:opacity-80 border border-white/50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Download Brosur
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
