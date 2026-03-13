{{-- navbar.blade.php - TailwindCSS v4 + Alpine.js --}}

{{-- Inline style to prevent FOUC (Flash of Unstyled Content) --}}
<style>
    .nav-link-zen {
        text-decoration: none !important;
        color: rgba(255,255,255,0.9);
        position: relative;
    }
    .nav-link-zen::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: #D4AF37;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    .nav-link-zen:hover::after {
        width: 60%;
    }
    .nav-link-zen:hover {
        text-decoration: none !important;
        color: #FFFFFF !important;
    }
    .nav-link-zen.scrolled-link {
        color: #001D5F !important;
    }
    .nav-link-zen.scrolled-link:hover {
        color: #D4AF37 !important;
    }
    .nav-link-zen.scrolled-link::after {
        background: #D4AF37;
    }
    /* Active state for current page */
    .nav-link-zen.active-link {
        color: #FFFFFF !important;
    }
    .nav-link-zen.active-link::after {
        width: 60%;
        background: #D4AF37;
    }
    .nav-link-zen.active-link.scrolled-link {
        color: #D4AF37 !important;
    }
    .nav-action-zen {
        text-decoration: none !important;
        color: rgba(255,255,255,0.8);
    }
    .nav-action-zen.scrolled-link {
        color: #001D5F !important;
    }
    .nav-action-zen:hover {
        text-decoration: none !important;
        color: #D4AF37 !important;
    }
    .nav-cta-zen {
        text-decoration: none !important;
        background: #D4AF37;
        color: #FFFFFF !important;
    }
    .nav-cta-zen:hover {
        background: #B89230;
        text-decoration: none !important;
        color: #FFFFFF !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.35);
    }
    .mobile-nav-link {
        text-decoration: none !important;
        color: #001D5F !important;
    }
    .mobile-nav-link:hover {
        text-decoration: none !important;
        background: #E8EBF3;
    }
    .mobile-nav-link.active-mobile {
        background: #E8EBF3;
        color: #D4AF37 !important;
        font-weight: 600;
    }
</style>

<nav x-data="{ 
        mobileOpen: false, 
        scrolled: false,
        init() {
            const forceSolid = document.body.classList.contains('navbar-solid');
            const update = () => this.scrolled = forceSolid || window.scrollY > 50;
            window.addEventListener('scroll', update, { passive: true });
            update();
        }
     }"
     @keydown.escape.window="mobileOpen = false"
     :class="scrolled ? 'bg-white shadow-nav' : 'bg-transparent'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
     style="z-index: 1040;">
    
    <div class="container-main flex items-center justify-between h-[76px] md:h-[80px]">
        {{-- Logo with fade transition --}}
        <a href="{{ url('/') }}" class="flex items-center gap-2 shrink-0" style="text-decoration: none;">
            <div class="relative h-10 md:h-12" style="min-width: 120px;">
                <img :style="scrolled ? 'opacity:0;' : 'opacity:1;'" 
                     src="{{ asset('images/mahira-logo-white.webp') }}" 
                     alt="Mahira Tour" 
                     class="absolute top-0 left-0 h-10 md:h-12 w-auto transition-opacity duration-300"
                     style="opacity:1;">
                <img :style="scrolled ? 'opacity:1;' : 'opacity:0;'" 
                     src="{{ asset('images/mahira-logo-transparent.webp') }}" 
                     alt="Mahira Tour" 
                     class="absolute top-0 left-0 h-10 md:h-12 w-auto transition-opacity duration-300"
                     style="opacity:0;">
            </div>
        </a>

        {{-- Desktop Menu --}}
        <ul class="hidden lg:flex items-center gap-1 list-none m-0 p-0">
            @php
                $navLinks = [
                    ['route' => 'home', 'label' => 'Beranda'],
                    ['route' => 'schedule', 'label' => 'Paket & Jadwal'],
                    ['route' => 'articles.index', 'label' => 'Artikel'],
                    ['route' => 'testimonials', 'label' => 'Testimoni'],
                    ['route' => 'gallery', 'label' => 'Galeri'],
                    ['route' => 'about', 'label' => 'Tentang Kami'],
                    ['route' => 'contact', 'label' => 'Hubungi Kami'],
                ];
            @endphp
            @foreach($navLinks as $link)
            <li>
                <a href="{{ route($link['route']) }}" 
                   :class="scrolled && 'scrolled-link'"
                   class="nav-link-zen {{ request()->routeIs($link['route']) ? 'active-link' : '' }} px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200">
                    {{ $link['label'] }}
                </a>
            </li>
            @endforeach
        </ul>

        {{-- Desktop Actions --}}
        <div class="hidden lg:flex items-center gap-3">
            <a href="{{ route('check.registration.form') }}" 
               :class="scrolled && 'scrolled-link'"
               class="nav-action-zen text-sm font-medium transition-all duration-200">
                Cek Status
            </a>
            <a href="{{ route('register') }}" 
               class="nav-cta-zen inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold 
                      shadow-md transition-all duration-300">
                Daftar Sekarang
            </a>
        </div>

        {{-- Mobile Toggle --}}
        <button @click="mobileOpen = !mobileOpen"
                :style="scrolled ? 'color: #001D5F' : 'color: #FFFFFF'"
                type="button"
                class="lg:hidden flex items-center justify-center w-11 h-11 rounded-xl 
                       transition-all duration-200 border-0 bg-transparent cursor-pointer
                       hover:scale-110 active:scale-95"
                style="color: #FFFFFF;"
                aria-label="Open menu"
                :aria-expanded="mobileOpen">
            <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Overlay --}}
    <div x-show="mobileOpen" 
         x-cloak
         @click="mobileOpen = false"
         x-transition:enter="transition-opacity ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 lg:hidden"
         style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
    </div>

    {{-- Mobile Menu Drawer --}}
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         @click.outside="mobileOpen = false"
         class="fixed top-0 right-0 h-full w-[300px] max-w-[85vw] shadow-2xl z-50 
                flex flex-col overflow-y-auto lg:hidden"
         style="background: #FFFFFF;">
        
        {{-- Mobile Menu Header --}}
        <div class="flex items-center justify-between px-6 pt-6 pb-4">
            <a href="{{ url('/') }}" class="shrink-0" style="text-decoration: none;">
                <img src="{{ asset('images/mahira-logo-transparent.webp') }}" 
                     alt="Mahira Tour" 
                     class="h-10 w-auto">
            </a>
            <button @click="mobileOpen = false" 
                    class="flex items-center justify-center w-10 h-10 rounded-xl border-0
                           transition-all duration-200 cursor-pointer hover:scale-105 active:scale-95"
                    style="background: #E8EBF3; color: #001D5F;"
                    aria-label="Tutup menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Divider --}}
        <div class="mx-6" style="border-top: 1px solid #f0f0f0;"></div>
        
        {{-- Mobile Nav Links --}}
        <ul class="flex flex-col px-4 py-4 gap-1 list-none m-0 p-0">
            @php
                $mobileIcons = [
                    'home' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                    'schedule' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                    'articles.index' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
                    'testimonials' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z',
                    'gallery' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                    'about' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                    'contact' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
                ];
            @endphp
            @foreach($navLinks as $link)
            <li>
                <a href="{{ route($link['route']) }}" @click="mobileOpen = false"
                   class="mobile-nav-link {{ request()->routeIs($link['route']) ? 'active-mobile' : '' }} flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200"
                   style="font-size: 15px; font-weight: 500;">
                    <svg class="w-5 h-5 shrink-0" style="color: #D4AF37;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $mobileIcons[$link['route']] }}"/>
                    </svg>
                    {{ $link['label'] }}
                </a>
            </li>
            @endforeach
        </ul>

        {{-- Mobile Actions --}}
        <div class="mt-auto px-6 pb-8 pt-4" style="border-top: 1px solid #f0f0f0;">
            <div class="flex flex-col gap-3">
                <a href="{{ route('register') }}" 
                   class="nav-cta-zen flex items-center justify-center gap-2 w-full py-3.5 rounded-xl font-semibold 
                          shadow-md transition-all duration-300"
                   style="font-size: 15px;">
                    Daftar Sekarang
                </a>
                <a href="{{ route('check.registration.form') }}" 
                   class="mobile-nav-link flex items-center justify-center gap-2 w-full py-3.5 rounded-xl font-medium 
                          transition-all duration-300"
                   style="background: #E8EBF3; font-size: 15px;">
                    Cek Status Pendaftaran
                </a>
            </div>
        </div>
    </div>
</nav>