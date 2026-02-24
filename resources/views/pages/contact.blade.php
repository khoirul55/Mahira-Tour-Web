@extends('layouts.app')

@section('title', 'Hubungi Kami - Mahira Tour')

@section('content')
{{-- ==================== HERO SECTION ==================== --}}
<section class="relative h-[300px] sm:h-[350px] md:h-[400px] overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 z-[1]">
        <img src="{{ asset('images/hero/hero-contact.webp') }}" alt="Hubungi Mahira Tour" fetchpriority="high" loading="eager"
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
            <span class="text-white/70">Hubungi Kami</span>
        </div>
        <h1 class="text-2xl sm:text-[2.5rem] md:text-[3.5rem] font-bold font-serif text-white mb-4 leading-tight shadow-black/30 text-shadow-lg">
            <span class="inline-block mx-1" style="opacity: 0; animation: slideInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.3s forwards;">Hubungi</span>
            <span class="inline-block mx-1" style="opacity: 0; animation: slideInRight 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.5s forwards;">Kami</span>
        </h1>
        <p class="font-semibold text-[0.9rem] uppercase tracking-wider mb-2 text-gold animate-[heroFadeIn_1s_ease_0.6s_backwards]">UMRAH BERSAMA, BERKAH BERSAMA</p>
        <p class="text-sm md:text-base max-w-[700px] mx-auto leading-relaxed text-white/90 animate-[heroFadeIn_1s_ease_0.6s_backwards]">
            Kami siap membantu Anda mewujudkan perjalanan spiritual yang berkesan
        </p>
    </div>
</section>

{{-- ==================== QUICK CONTACT ==================== --}}
<section class="py-12 lg:py-20 bg-white">
    <div class="container-main">
        <div class="text-center mb-10 lg:mb-16">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-6 py-2 rounded-full text-white mb-4 bg-primary">Kontak Cepat</span>
            <h2 class="text-2xl sm:text-3xl lg:text-[2.5rem] font-extrabold mb-4 text-gray-800">Cara Menghubungi Kami</h2>
            <p class="text-sm sm:text-base max-w-[600px] mx-auto text-gray-500">Pilih metode komunikasi yang paling nyaman untuk Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $contacts = [
                    [
                        'icon' => '<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>',
                        'title' => 'WhatsApp',
                        'desc' => 'Chat langsung dengan tim kami<br>' . $contactInfo['phone'],
                        'link' => 'https://wa.me/' . $contactInfo['whatsapp'],
                        'action' => 'Chat Sekarang',
                        'external' => true,
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
                        'title' => 'Telepon',
                        'desc' => 'Hubungi kami melalui telepon<br>' . $contactInfo['phone'],
                        'link' => 'tel:' . $contactInfo['phone'],
                        'action' => 'Telepon Kami',
                        'external' => false,
                        'stroke' => true,
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                        'title' => 'Email',
                        'desc' => 'Kirim email kepada kami<br>' . $contactInfo['email'],
                        'link' => 'mailto:' . $contactInfo['email'],
                        'action' => 'Kirim Email',
                        'external' => false,
                        'stroke' => true,
                    ],
                    [
                        'icon' => '<path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>',
                        'title' => 'Kantor Pusat',
                        'desc' => $contactInfo['main_office'],
                        'link' => 'https://maps.google.com/?q=' . urlencode($contactInfo['main_office']),
                        'action' => 'Lihat Peta',
                        'external' => true,
                    ],
                    [
                        'icon' => '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>',
                        'title' => 'Instagram',
                        'desc' => 'Follow untuk update terbaru<br>' . $contactInfo['instagram'],
                        'link' => 'https://instagram.com/' . str_replace('@', '', $contactInfo['instagram']),
                        'action' => 'Follow Kami',
                        'external' => true,
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                        'title' => 'Jam Operasional',
                        'desc' => '<strong>Senin - Jumat</strong><br>' . $contactInfo['hours']['weekday'] . '<br><strong>Sabtu</strong><br>' . ($contactInfo['hours']['saturday'] ?? '08:00 - 17:00 WIB'),
                        'link' => null,
                        'action' => null,
                        'stroke' => true,
                    ],
                ];
            @endphp

            @foreach($contacts as $c)
            <div class="rounded-2xl p-6 sm:p-8 lg:p-10 text-center h-full transition-all duration-400 hover:-translate-y-2.5 hover:shadow-xl group bg-white border-2 border-[#E8EBF3] shadow-[0_10px_40px_rgba(0,29,95,0.08)] hover:border-gold">
                <div class="w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-full flex items-center justify-center mx-auto mb-5 transition-all duration-400 group-hover:scale-110 group-hover:rotate-5 bg-gradient-to-br from-[#001D5F] to-[#002B8F] shadow-[0_10px_30px_rgba(0,29,95,0.3)]">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-white" @if(!empty($c['stroke'])) fill="none" stroke="currentColor" @else fill="currentColor" @endif viewBox="0 0 24 24">{!! $c['icon'] !!}</svg>
                </div>
                <h4 class="text-lg sm:text-xl font-bold mb-3 text-primary">{{ $c['title'] }}</h4>
                <div class="text-sm sm:text-base leading-relaxed mb-5 text-gray-500">{!! $c['desc'] !!}</div>
                @if($c['action'])
                <a href="{{ $c['link'] }}" @if(!empty($c['external'])) target="_blank" rel="noopener noreferrer" @endif
                   class="inline-flex items-center gap-2 px-7 py-3 rounded-full font-semibold text-[15px] no-underline transition-all duration-300 hover:translate-x-1 bg-[#E8EBF3] text-primary hover:bg-primary hover:text-white">
                    {{ $c['action'] }}
                </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==================== FORM & MAP ==================== --}}
<section class="py-14 lg:py-24 bg-[#E8EBF3]">
    <div class="container-main">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.2fr] gap-8 lg:gap-10 max-w-[1400px] mx-auto">
            {{-- Form --}}
            <div class="rounded-2xl sm:rounded-3xl p-5 sm:p-8 lg:p-12 bg-white shadow-[0_15px_50px_rgba(0,29,95,0.1)]">
                <h3 class="text-xl sm:text-2xl lg:text-[2rem] font-bold mb-3 text-primary">Kirim Pesan</h3>
                <p class="text-sm sm:text-base mb-6 lg:mb-8 text-gray-500">Isi formulir di bawah dan tim kami akan segera menghubungi Anda</p>
                
                @if(session('success'))
                <div class="flex items-center gap-3 p-4 rounded-xl mb-6 bg-emerald-50 border border-emerald-200">
                    <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span class="text-sm font-medium text-emerald-800">{{ session('success') }}</span>
                </div>
                @endif
                
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block font-semibold text-[15px] mb-2 text-primary">Nama Lengkap *</label>
                            <input type="text" name="name" required
                                   class="w-full px-5 py-3.5 rounded-xl text-[15px] outline-none transition-all duration-300 border-2 border-[#E8EBF3] focus:border-primary focus:shadow-[0_0_0_3px_rgba(0,29,95,0.15)]">
                        </div>
                        <div>
                            <label class="block font-semibold text-[15px] mb-2 text-primary">No. Telepon *</label>
                            <input type="tel" name="phone" required
                                   class="w-full px-5 py-3.5 rounded-xl text-[15px] outline-none transition-all duration-300 border-2 border-[#E8EBF3] focus:border-primary focus:shadow-[0_0_0_3px_rgba(0,29,95,0.15)]">
                        </div>
                    </div>
                    <div>
                        <label class="block font-semibold text-[15px] mb-2 text-primary">Email *</label>
                        <input type="email" name="email" required
                               class="w-full px-5 py-3.5 rounded-xl text-[15px] outline-none transition-all duration-300 border-2 border-[#E8EBF3] focus:border-primary focus:shadow-[0_0_0_3px_rgba(0,29,95,0.15)]">
                    </div>
                    <div>
                        <label class="block font-semibold text-[15px] mb-2 text-primary">Subjek *</label>
                        <select name="subject" required
                                class="w-full px-5 py-3.5 rounded-xl text-[15px] outline-none transition-all duration-300 cursor-pointer appearance-auto border-2 border-[#E8EBF3] focus:border-primary focus:shadow-[0_0_0_3px_rgba(0,29,95,0.15)]">
                            <option value="">Pilih Subjek</option>
                            <option value="Informasi Paket">Informasi Paket</option>
                            <option value="Jadwal Keberangkatan">Jadwal Keberangkatan</option>
                            <option value="Konsultasi Umrah">Konsultasi Umrah</option>
                            <option value="Pembayaran">Pembayaran</option>
                            <option value="Keluhan">Keluhan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-[15px] mb-2 text-primary">Pesan *</label>
                        <textarea name="message" rows="5" required
                                  class="w-full px-5 py-3.5 rounded-xl text-[15px] outline-none transition-all duration-300 resize-y border-2 border-[#E8EBF3] focus:border-primary focus:shadow-[0_0_0_3px_rgba(0,29,95,0.15)]"></textarea>
                    </div>
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2.5 py-4 rounded-full font-bold text-lg text-white border-0 cursor-pointer transition-all duration-300 hover:-translate-y-1 bg-gradient-to-br from-[#001D5F] to-[#002B8F] shadow-[0_8px_25px_rgba(0,29,95,0.25)] hover:shadow-[0_12px_35px_rgba(0,29,95,0.35)]">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                        Kirim Pesan
                    </button>
                </form>
            </div>

            {{-- Map --}}
            <div class="rounded-3xl overflow-hidden flex flex-col bg-white shadow-[0_15px_50px_rgba(0,29,95,0.1)]">
                <div class="px-5 sm:px-8 py-5 sm:py-7 bg-gradient-to-br from-[#001D5F] to-[#002B8F]">
                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-2">Lokasi Kantor Pusat</h3>
                    <p class="text-sm sm:text-base text-white/95 leading-relaxed m-0">Jl. Muradi No. 19, RT 000/RW 000, Kel. Koto Lolo, Kec. Pesisir Bukit, Kota Sungai Penuh, Jambi</p>
                </div>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7974.528410081892!2d101.3896565!3d-2.050239!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2da1004b62a7c9%3A0xdebd36e55d2e3189!2sTravel%20Umroh%20Mahira%20Tour!5e0!3m2!1sid!2sid!4v1766545347293!5m2!1sid!2sid" 
                    class="w-full h-[300px] sm:h-[400px] lg:h-[450px] border-0 block"
                    allowfullscreen="" 
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div class="text-center py-4 sm:py-6 px-5 sm:px-8 border-t-2 border-[#E8EBF3]">
                    <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 sm:gap-2.5 px-6 sm:px-10 py-3 sm:py-4 rounded-full font-bold text-sm sm:text-base text-white no-underline transition-all duration-300 hover:-translate-y-1 bg-gold shadow-[0_8px_25px_rgba(212,175,55,0.3)] hover:bg-[#C49B2F] hover:shadow-[0_12px_35px_rgba(212,175,55,0.5)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================== FAQ SECTION ==================== --}}
<section class="py-14 lg:py-24 bg-white">
    <div class="container-main">
        <div class="text-center mb-10 lg:mb-16">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-6 py-2 rounded-full text-white mb-4 bg-primary">FAQ</span>
            <h2 class="text-2xl sm:text-3xl lg:text-[2.5rem] font-extrabold mb-4 text-gray-800">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-sm sm:text-base max-w-[600px] mx-auto text-gray-500">Temukan jawaban atas pertanyaan umum seputar layanan kami</p>
        </div>

        <div class="max-w-[900px] mx-auto space-y-5" x-data="{ activeIndex: null }">
            @php
                $faqs = [
                    ['q' => 'Bagaimana cara mendaftar paket umrah?', 'a' => 'Anda bisa mendaftar melalui kantor kami, WhatsApp, atau mengisi formulir di website. Tim kami akan membantu proses pendaftaran dari awal hingga keberangkatan.'],
                    ['q' => 'Apakah tersedia sistem cicilan?', 'a' => 'Ya, kami menyediakan program cicilan dengan DP 30% dan pelunasan H-30 sebelum keberangkatan. Hubungi tim kami untuk informasi lebih detail.'],
                    ['q' => 'Dokumen apa saja yang diperlukan?', 'a' => 'Dokumen yang diperlukan: KTP asli, Kartu Keluarga, Paspor (minimal berlaku 7 bulan), pas foto 4x6 berlatar putih, dan buku nikah (untuk yang sudah menikah).'],
                    ['q' => 'Berapa lama proses pengurusan visa umrah?', 'a' => 'Proses pengurusan visa umrah membutuhkan waktu sekitar 14-21 hari kerja. Kami akan menginformasikan perkembangan proses visa Anda secara berkala.'],
                    ['q' => 'Apakah harga sudah termasuk manasik?', 'a' => 'Ya, harga paket sudah termasuk bimbingan manasik, perlengkapan umrah, dan pendampingan oleh pembimbing berpengalaman selama di tanah suci.'],
                    ['q' => 'Bagaimana jika ada perubahan jadwal keberangkatan?', 'a' => 'Kami akan menginformasikan setiap perubahan jadwal kepada jamaah. Jika terjadi perubahan, kami akan membantu proses reschedule atau refund sesuai kebijakan yang berlaku.'],
                ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div class="rounded-2xl overflow-hidden transition-all duration-300 border-2 border-[#E8EBF3] hover:border-gold"
                 :class="{ '!border-gold': activeIndex === {{ $i }} }">
                <div class="px-5 sm:px-8 py-4 sm:py-6 text-base sm:text-lg font-bold cursor-pointer flex justify-between items-center gap-3 select-none transition-colors duration-300 hover:text-gold text-primary"
                     :class="{ '!text-gold': activeIndex === {{ $i }} }"
                     @click="activeIndex = activeIndex === {{ $i }} ? null : {{ $i }}">
                    <span>{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-300" 
                         :class="{ 'rotate-180': activeIndex === {{ $i }} }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
                <div x-show="activeIndex === {{ $i }}" x-transition x-cloak>
                    <div class="px-5 sm:px-8 pb-5 sm:pb-6 text-sm sm:text-base leading-relaxed text-gray-500">
                        {{ $faq['a'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@include('partials.cta-section')

@endsection