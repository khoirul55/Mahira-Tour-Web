{{-- resources/views/partials/footer.blade.php - TailwindCSS v4 --}}

<footer class="footer-main">
    {{-- Footer Top --}}
    <div class="footer-top">
        <div class="container-main">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-16">
                
                {{-- Brand Column --}}
                <div class="lg:col-span-5">
                    {{-- Logo --}}
                    <div class="flex items-center gap-3 mb-5">
                        <img src="{{ asset('images/mahira-logo.webp') }}" alt="Mahira Tour" 
                             class="h-12 w-auto" loading="lazy">
                        <span class="text-xl font-bold font-serif text-white">Mahira Tour</span>
                    </div>

                    {{-- Badge PPIU --}}
                    <div class="footer-badge inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-semibold mb-5">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                        <span>Berizin Resmi Kemenag RI</span>
                    </div>
                    
                    {{-- Description --}}
                    <p class="footer-text-muted text-sm leading-relaxed mb-6 max-w-sm">
                        Travel Haji & Umrah terpercaya sejak 2016 melayani ribuan jamaah 
                        ke Tanah Suci dengan pelayanan terbaik dan bimbingan spiritual 
                        yang sesuai syariat.
                    </p>
                    
                    {{-- Social Links --}}
                    <div class="flex gap-2.5">
                        @php
                            $socials = [
                                ['url' => 'https://www.instagram.com/mahiratourofficial/', 'label' => 'Instagram', 'icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z'],
                                ['url' => 'https://web.facebook.com/profile.php?id=100092693246095', 'label' => 'Facebook', 'icon' => 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'],
                                ['url' => 'https://www.youtube.com/@MahiraTourIndonesia', 'label' => 'YouTube', 'icon' => 'M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z'],
                                ['url' => 'https://www.tiktok.com/@mahiratour.id', 'label' => 'TikTok', 'icon' => 'M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z'],
                            ];
                        @endphp
                        @foreach($socials as $social)
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                           aria-label="{{ $social['label'] }}"
                           class="footer-social-icon w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-300
                                  hover:-translate-y-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $social['icon'] }}"/></svg>
                        </a>
                        @endforeach
                    </div>
                </div>
                
                {{-- Quick Links --}}
                <div class="lg:col-span-3">
                    <h5 class="footer-heading text-base font-bold font-serif mb-6 inline-block pb-2.5">Menu</h5>
                    <ul class="list-none m-0 p-0 space-y-3">
                        @php
                            $footerLinks = [
                                ['route' => 'home', 'label' => 'Beranda'],
                                ['route' => 'about', 'label' => 'Tentang Kami'],
                                ['route' => 'schedule', 'label' => 'Paket & Jadwal'],
                                ['route' => 'articles.index', 'label' => 'Informasi'],
                                ['route' => 'gallery', 'label' => 'Galeri'],
                                ['route' => 'testimonials', 'label' => 'Testimoni'],
                                ['route' => 'contact', 'label' => 'Kontak'],
                            ];
                        @endphp
                        @foreach($footerLinks as $link)
                        <li>
                            <a href="{{ route($link['route']) }}" 
                               class="footer-link text-sm inline-block transition-all duration-300 hover:pl-2">
                                {{ $link['label'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- Contact --}}
                <div class="lg:col-span-4">
                    <h5 class="footer-heading text-base font-bold font-serif mb-6 inline-block pb-2.5">Hubungi Kami</h5>
                    
                    <div class="space-y-4">
                        @php
                            $contacts = [
                                ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'content' => 'Jl. Muradi No. 19, RT 000/RW 000,<br>Kel. Koto Lolo, Kec. Pesisir Bukit,<br>Kota Sungai Penuh, Jambi', 'link' => null],
                                ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'content' => '+62 821-8451-5310', 'link' => 'tel:+6282184515310'],
                                ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'content' => 'info@mahiratour.id', 'link' => 'mailto:admin@mahiratour.id'],
                                ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'content' => 'Senin - Sabtu<br>08:00 - 17:00 WIB', 'link' => null],
                            ];
                        @endphp
                        @foreach($contacts as $contact)
                        <div class="footer-text-muted flex items-start gap-3 text-sm">
                            <div class="footer-contact-icon w-9 h-9 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $contact['icon'] }}"/>
                                </svg>
                            </div>
                            <div class="pt-1.5">
                                @if($contact['link'])
                                    <a href="{{ $contact['link'] }}" class="footer-link">
                                        {!! $contact['content'] !!}
                                    </a>
                                @else
                                    {!! $contact['content'] !!}
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Footer Bottom --}}
    <div class="footer-bottom">
        <div class="container-main">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="footer-copyright text-xs m-0">
                    &copy; {{ date('Y') }} <strong>Mahira Tour</strong>. All Rights Reserved.
                </p>
                <div class="footer-badge inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L3 7v2h18V7L12 2zm0 2.18L17.36 7H6.64L12 4.18zM5 21h14c1.1 0 2-.9 2-2v-8H3v8c0 1.1.9 2 2 2zm2-8h10v2H7v-2z"/></svg>
                    <span>PPIU: 21062301498960002</span>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- Floating WhatsApp --}}
<div class="fixed z-[9999] transition-all duration-300
            bottom-5 right-5 md:bottom-[30px] md:right-[30px]">
    <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" 
       target="_blank" 
       rel="noopener noreferrer"
       class="wa-float w-14 h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center 
              shadow-lg transition-all duration-300 animate-pulse
              hover:scale-110 hover:-translate-y-1"
       aria-label="Chat WhatsApp">
        <svg class="w-7 h-7 md:w-8 md:h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
</div>