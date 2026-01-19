<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Mahira Tour - Travel Haji & Umrah Terpercaya')</title>
    
    <!-- Preconnect to CDNs -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <!-- Global CSS Variables -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    
    <!-- Navbar CSS - Load before Vite -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Page-specific CSS -->
    @stack('styles')
    
    <!-- Alpine.js x-cloak style -->
    <style>
        [x-cloak] { 
            display: none !important; 
        }
        
        /* Smooth transitions for Alpine */
        .transition-opacity {
            transition-property: opacity;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .ease-out {
            transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
        }
        
        .ease-in {
            transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
        }
        
        .duration-200 {
            transition-duration: 200ms;
        }
        
        .duration-150 {
            transition-duration: 150ms;
        }
        
        .duration-300 {
            transition-duration: 300ms;
        }
        
        .opacity-0 {
            opacity: 0;
        }
        
        .opacity-100 {
            opacity: 1;
        }
        
        .-translate-x-full {
            transform: translateX(-100%);
        }
        
        .translate-x-0 {
            transform: translateX(0);
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Page-specific scripts -->
    @stack('scripts')
</body>
</html>