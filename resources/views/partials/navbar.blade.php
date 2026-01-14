<nav x-data="{ open: false }" class="navbar-zen">

    <div class="navbar-container">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="navbar-logo">
            <img src="{{ asset('images/logo-mahira.png') }}" alt="Mahira Tour">
            <span>Mahira Tour</span>
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
    <a href="{{ route('check.registration.form') }}" class="nav-link-light">
        Cek Status
    </a>
    <a href="{{ route('register') }}" class="btn-zen-primary">
        Daftar Sekarang
    </a>
</div>



        <!-- Desktop CTA -->
        <div class="navbar-actions desktop-only">
            <a href="{{ route('check.registration.form') }}" class="nav-link-light">Cek Status</a>
            <a href="{{ route('register') }}" class="btn-zen-primary">Daftar Sekarang</a>
        </div>

        <!-- Mobile Toggle -->
        <button @click="open = true" class="mobile-toggle mobile-only">☰</button>
    </div>

    <!-- Mobile Menu -->
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-[-10px]"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-[-10px]"
        @click.outside="open = false"
        class="mobile-menu"
    >
        <button @click="open = false" class="mobile-close">✕</button>

        <ul class="mobile-nav">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('paket') }}">Paket & Jadwal</a></li>
            <li><a href="{{ route('testimoni') }}">Testimoni</a></li>
            <li><a href="{{ route('galeri') }}">Galeri</a></li>
            <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
            <li><a href="{{ route('kontak') }}">Hubungi Kami</a></li>
        </ul>

        <div class="mobile-actions">
            <a href="{{ route('register') }}" class="btn-zen-primary full">Daftar Sekarang</a>
            <a href="{{ route('cek-status') }}" class="nav-link-light">Cek Status</a>
        </div>
    </div>
</nav>
