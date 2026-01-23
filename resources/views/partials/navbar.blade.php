{{-- navbar.blade.php - FIXED VERSION --}}
<nav x-data="{ mobileOpen: false }" 
     @keydown.escape.window="mobileOpen = false"
     class="navbar-zen">
    <div class="navbar-container">
        <a href="{{ url('/') }}" class="navbar-logo">
            <!-- Logo for Transparent Header (White) -->
            <img src="{{ asset('images/mahira-logo-white.webp') }}" alt="Mahira Tour" class="logo-white">
            <!-- Logo for Scrolled Header (Original Color) -->
            <img src="{{ asset('images/mahira-logo-transparent.webp') }}" alt="Mahira Tour" class="logo-color">
        </a>

        {{-- Desktop Menu --}}
        <ul class="navbar-menu desktop-only">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('schedule') }}">Paket & Jadwal</a></li>
            <li><a href="{{ route('testimonials') }}">Testimoni</a></li>
            <li><a href="{{ route('gallery') }}">Galeri</a></li>
            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
            <li><a href="{{ route('contact') }}">Hubungi Kami</a></li>
        </ul>

        {{-- Desktop Actions --}}
        <div class="navbar-actions desktop-only">
            <a href="{{ route('check.registration.form') }}" class="nav-link-light">Cek Status</a>
            <a href="{{ route('register') }}" class="btn-zen-primary">Daftar Sekarang</a>
        </div>

        {{-- Mobile Toggle - FIXED: Proper event handler --}}
        <button @click="mobileOpen = true" 
                type="button"
                class="mobile-toggle mobile-only"
                aria-label="Open menu"
                :aria-expanded="mobileOpen">
            <i class="bi bi-list"></i>
        </button>
    </div>

    {{-- Mobile Overlay - FIXED: Proper closing --}}
    <div x-show="mobileOpen" 
         x-cloak
         @click="mobileOpen = false"
         x-transition:enter="transition-opacity ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="mobile-menu-overlay"></div>

    {{-- Mobile Menu Drawer - FIXED: Proper animations --}}
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         @click.outside="mobileOpen = false"
         class="mobile-menu">
        
        <div class="mobile-menu-header">
            <button @click="mobileOpen = false" 
                    type="button"
                    class="mobile-close"
                    aria-label="Close menu">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <ul class="mobile-nav">
            <li><a href="{{ route('home') }}" @click="mobileOpen = false">Beranda</a></li>
            <li><a href="{{ route('schedule') }}" @click="mobileOpen = false">Paket & Jadwal</a></li>
            <li><a href="{{ route('testimonials') }}" @click="mobileOpen = false">Testimoni</a></li>
            <li><a href="{{ route('gallery') }}" @click="mobileOpen = false">Galeri</a></li>
            <li><a href="{{ route('about') }}" @click="mobileOpen = false">Tentang Kami</a></li>
            <li><a href="{{ route('contact') }}" @click="mobileOpen = false">Hubungi Kami</a></li>
        </ul>

        <div class="mobile-actions">
            <a href="{{ route('register') }}" class="btn-zen-primary">Daftar Sekarang</a>
            <a href="{{ route('check.registration.form') }}" class="nav-link-light">Cek Status</a>
        </div>
    </div>
</nav>