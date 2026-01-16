<nav x-data="{ open: false }" class="navbar-zen">
    <div class="navbar-container">
        <a href="{{ url('/') }}" class="navbar-logo">
            <img src="{{ asset('images/mahira-logo.png') }}" alt="Mahira Tour">
            <span class="logo-text">Mahira Tour</span>
        </a>

        <ul class="navbar-menu desktop-only">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('schedule') }}">Paket & Jadwal</a></li>
            <li><a href="{{ route('testimonials') }}">Testimoni</a></li>
            <li><a href="{{ route('gallery') }}">Galeri</a></li>
            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
            <li><a href="{{ route('contact') }}">Hubungi Kami</a></li>
        </ul>

        <div class="navbar-actions desktop-only">
            <a href="{{ route('check.registration.form') }}" class="nav-link-light">Cek Status</a>
            <a href="{{ route('register') }}" class="btn-zen-primary">Daftar Sekarang</a>
        </div>

        <button @click="open = true" class="mobile-toggle mobile-only">☰</button>
    </div>

    <!-- Mobile Overlay -->
    <div x-show="open" @click="open = false" x-cloak class="mobile-menu-overlay"></div>

    <!-- Mobile Menu -->
    <div x-show="open" x-cloak class="mobile-menu">
<div class="mobile-menu-header">
    <button @click="open = false" class="mobile-close">✕</button>
</div>
        <ul class="mobile-nav">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('schedule') }}">Paket & Jadwal</a></li>
            <li><a href="{{ route('testimonials') }}">Testimoni</a></li>
            <li><a href="{{ route('gallery') }}">Galeri</a></li>
            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
            <li><a href="{{ route('contact') }}">Hubungi Kami</a></li>
        </ul>

        <div class="mobile-actions">
            <a href="{{ route('register') }}" class="btn-zen-primary">Daftar Sekarang</a>
            <a href="{{ route('check.registration.form') }}" class="nav-link-light">Cek Status</a>
        </div>
    </div>
</nav>