<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Mahira Tour - Travel Haji & Umrah Terpercaya')</title>
    <meta name="description" content="@yield('meta_description', 'Mahira Tour adalah travel Haji & Umrah terpercaya di Indonesia. Melayani ribuan jamaah sejak 2016 dengan layanan profesional dan bimbingan ibadah sesuai sunnah.')">
    <meta name="keywords" content="mahira tour, travel umrah, haji plus, umrah terpercaya, travel haji indonesia, paket umrah hemat, umrah 2026">
    <meta name="author" content="Mahira Tour">
    <meta name="robots" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Mahira Tour - Travel Haji & Umrah Terpercaya')">
    <meta property="og:description" content="@yield('meta_description', 'Mahira Tour adalah travel Haji & Umrah terpercaya di Indonesia. Melayani ribuan jamaah sejak 2016.')">
    <meta property="og:image" content="@yield('og_image', asset('images/hero/hero-video-poster.webp'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Mahira Tour - Travel Haji & Umrah Terpercaya')">
    <meta property="twitter:description" content="@yield('meta_description', 'Mahira Tour adalah travel Haji & Umrah terpercaya di Indonesia. Melayani ribuan jamaah sejak 2016.')">
    <meta property="twitter:image" content="@yield('og_image', asset('images/hero/hero-video-poster.webp'))">
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png?v=2') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest?v=2') }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico?v=2') }}">
    
    <!-- Preconnect to CDNs -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Preload LCP image (hero poster) -->
    @hasSection('preload')
        @yield('preload')
    @endif
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    
    <!-- Global CSS Variables -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    
    <!-- Page-specific shared CSS -->
    <link rel="stylesheet" href="{{ asset('css/page-hero.css') }}">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Page-specific CSS -->
    @stack('styles')
    
    <!-- Alpine.js x-cloak style handled in animations.css -->
</head>
<body>
    @include('partials.navbar')
    
    <main>
        @yield('content')
    </main>
    
    {{-- Floating WhatsApp is now inside footer.blade.php --}}

    @include('partials.footer')
    
    <!-- Bootstrap JS (deferred) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <!-- Page-specific scripts -->
    @stack('scripts')
</body>
</html>