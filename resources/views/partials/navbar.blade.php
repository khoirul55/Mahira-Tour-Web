{{-- resources/views/partials/navbar.blade.php --}}
{{-- OPTIMIZED FOR ELDERLY (40-65+ years) - Phase 1 Implementation --}}
<style>
    /* ============================================
       NAVBAR - ELDERLY FRIENDLY DESIGN
       Target: Orang Tua (40-65+) untuk Umrah/Haji
       Focus: Readability, Simplicity, Trust
    ============================================ */
    
    .navbar-mahira {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 2px 12px rgba(0, 29, 95, 0.1);
        transition: box-shadow 0.3s ease;
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(0, 29, 95, 0.08);
    }
    
    .navbar-mahira.scrolled {
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 4px 20px rgba(0, 29, 95, 0.15);
    }
    
    /* ============================================
       BRAND LOGO - Larger & More Prominent
    ============================================ */
    .navbar-mahira .navbar-brand {
        font-size: 1.5rem;
        font-weight: 800;
        color: #001D5F;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.5rem 0;
        transition: transform 0.3s ease;
    }
    
    .navbar-mahira .navbar-brand:hover {
        transform: scale(1.03);
    }
    
    .navbar-mahira .brand-logo {
        height: 55px;
        width: auto;
        filter: drop-shadow(0 2px 8px rgba(0, 29, 95, 0.15));
    }
    
    /* ============================================
       NAV LINKS - TEXT-ONLY Design
       CLEAN, PROFESSIONAL, ELDERLY-FRIENDLY
    ============================================ */
    .navbar-mahira .nav-link {
        color: #001D5F;
        font-weight: 600;
        font-size: 1.0625rem; /* 17px - Perfect for elderly */
        padding: 0.875rem 1.5rem !important;
        margin: 0 0.125rem;
        border-radius: 10px;
        transition: all 0.25s ease;
        position: relative;
        white-space: nowrap; /* Prevent text wrapping */
        letter-spacing: 0.3px; /* Better readability */
    }
    
    /* Simple Hover - Clean Highlight */
    .navbar-mahira .nav-link:hover {
        color: #001D5F;
        background: rgba(0, 29, 95, 0.08);
    }
    
    /* Active State - Clear Visual Feedback with Bottom Border */
    .navbar-mahira .nav-link.active {
        color: #001D5F;
        background: rgba(0, 29, 95, 0.06);
        border-bottom: 3px solid #B8941F;
    }
    
    /* Subtle hover underline effect */
    .navbar-mahira .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: 60%;
        height: 2px;
        background: #B8941F;
        border-radius: 2px;
        transition: transform 0.3s ease;
    }
    
    .navbar-mahira .nav-link:hover::after {
        transform: translateX(-50%) scaleX(1);
    }
    
    .navbar-mahira .nav-link.active::after {
        display: none; /* Hide on active (using border-bottom instead) */
    }
    
    /* ============================================
       PRIMARY CTA - "Daftar Sekarang"
       With Icon for Action Indication
    ============================================ */
    .navbar-mahira .btn-register {
        background: linear-gradient(135deg, #001D5F 0%, #001440 100%);
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.0625rem;
        border: none;
        box-shadow: 0 4px 16px rgba(0, 29, 95, 0.25);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        position: relative;
        min-height: 48px;
        white-space: nowrap;
        text-decoration: none !important; /* Remove underline */
    }
    
    /* Ensure no underline on hover/focus */
    .navbar-mahira .btn-register:hover,
    .navbar-mahira .btn-register:focus,
    .navbar-mahira .btn-register:active {
        text-decoration: none !important;
    }
    
    .navbar-mahira .btn-register i {
        font-size: 1.125rem;
        transition: transform 0.3s ease;
    }
    
    .navbar-mahira .btn-register:hover {
        background: linear-gradient(135deg, #B8941F 0%, #9A7A1A 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(184, 148, 31, 0.35);
    }
    
    .navbar-mahira .btn-register:hover i {
        transform: scale(1.1);
    }
    
    /* ============================================
       SECONDARY CTA - "Cek Status"
       Outline Style with Icon
    ============================================ */
    .navbar-mahira .btn-check-status {
        background: transparent;
        color: #001D5F;
        padding: 0.875rem 1.75rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.0625rem;
        border: 2px solid #001D5F;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-height: 48px;
        position: relative;
        white-space: nowrap;
        text-decoration: none !important; /* Remove underline */
    }
    
    /* Ensure no underline on hover/focus */
    .navbar-mahira .btn-check-status:hover,
    .navbar-mahira .btn-check-status:focus,
    .navbar-mahira .btn-check-status:active {
        text-decoration: none !important;
    }
    
    .navbar-mahira .btn-check-status i {
        font-size: 1.125rem;
        transition: transform 0.3s ease;
    }
    
    .navbar-mahira .btn-check-status:hover {
        background: #001D5F;
        color: white;
        border-color: #001D5F;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 29, 95, 0.2);
    }
    
    .navbar-mahira .btn-check-status:hover i {
        transform: scale(1.1);
    }
    
    /* ============================================
       MOBILE MENU TOGGLE
    ============================================ */
    .navbar-mahira .navbar-toggler {
        border: 2px solid #001D5F;
        border-radius: 12px;
        padding: 0.75rem 1rem; /* Larger touch target */
        transition: all 0.3s ease;
        min-width: 56px; /* Touch target minimum */
        min-height: 48px;
    }
    
    .navbar-mahira .navbar-toggler:hover {
        background: rgba(0, 29, 95, 0.05);
    }
    
    .navbar-mahira .navbar-toggler:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 29, 95, 0.25);
    }
    
    .navbar-mahira .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23001D5F' stroke-linecap='round' stroke-miterlimit='10' stroke-width='3' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        width: 28px;
        height: 28px;
    }
    
    /* ============================================
       MOBILE MENU - Simplified
    ============================================ */
    @media (max-width: 991px) {
        .navbar-mahira .navbar-collapse {
            background: rgba(255, 255, 255, 0.98);
            margin-top: 1rem;
            padding: 1.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 29, 95, 0.15);
            border: 1px solid rgba(0, 29, 95, 0.08);
        }
        
        /* Smooth collapse animation */
        .navbar-mahira .navbar-collapse.collapsing {
            transition: height 0.25s ease;
        }
        
        /* Larger touch targets on mobile */
        .navbar-mahira .nav-link {
            padding: 1.125rem 1rem !important; /* MIN 56px height */
            margin: 0.5rem 0;
            font-size: 1.125rem; /* 18px on mobile */
        }
        
        /* Remove hover effects on mobile */
        .navbar-mahira .nav-link:hover {
            transform: none;
        }
        
        /* Remove underline on mobile - unnecessary */
        .navbar-mahira .nav-link::after {
            display: none;
        }
        
        /* Add active/tap feedback */
        .navbar-mahira .nav-link:active {
            background: rgba(0, 29, 95, 0.12);
            transition: none;
        }
        
        /* CTA Buttons - Full Width on Mobile */
        .navbar-mahira .btn-register,
        .navbar-mahira .btn-check-status {
            width: 100%;
            justify-content: center;
            margin-top: 0.75rem;
            padding: 1.125rem 2rem;
            font-size: 1.125rem;
            min-height: 56px;
        }
        
        /* Visual separator between menu and CTAs */
        .navbar-mahira .nav-item:last-of-type {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(0, 29, 95, 0.1);
        }
    }
    
    /* ============================================
       FLOATING WHATSAPP BUTTON
       Always Visible - Critical for Elderly
    ============================================ */
    .floating-whatsapp {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9999;
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #25D366 0%, #20BA5A 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 24px rgba(37, 211, 102, 0.4);
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
    }
    
    .floating-whatsapp:hover {
        transform: scale(1.1) translateY(-4px);
        box-shadow: 0 10px 32px rgba(37, 211, 102, 0.5);
    }
    
    .floating-whatsapp i {
        font-size: 2rem;
        color: white;
    }
    
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 6px 24px rgba(37, 211, 102, 0.4);
        }
        50% {
            box-shadow: 0 6px 32px rgba(37, 211, 102, 0.6), 0 0 0 8px rgba(37, 211, 102, 0.2);
        }
    }
    
    /* Mobile - Larger floating button */
    @media (max-width: 768px) {
        .floating-whatsapp {
            width: 56px;
            height: 56px;
            bottom: 20px;
            right: 20px;
        }
        
        .floating-whatsapp i {
            font-size: 1.75rem;
        }
    }
    
    /* ============================================
       SMOOTH PAGE LOAD
    ============================================ */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .navbar-mahira {
        animation: fadeInDown 0.5s ease;
    }
    
    /* ============================================
       ACCESSIBILITY IMPROVEMENTS
    ============================================ */
    
    /* Focus visible for keyboard navigation */
    .navbar-mahira .nav-link:focus-visible,
    .navbar-mahira .btn-register:focus-visible,
    .navbar-mahira .btn-check-status:focus-visible {
        outline: 3px solid #B8941F;
        outline-offset: 2px;
    }
    
    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .navbar-mahira .nav-link {
            border: 1px solid transparent;
        }
        
        .navbar-mahira .nav-link:hover,
        .navbar-mahira .nav-link.active {
            border-color: #001D5F;
        }
    }
</style>

<nav class="navbar navbar-mahira navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" aria-label="Mahira Tour - Beranda">
            <img src="{{ asset('images/mahira-logo.png') }}" alt="Mahira Tour - Travel Umrah & Haji Terpercaya" class="brand-logo">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Buka menu navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                {{-- Main Navigation - TEXT-ONLY (6 Items) --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" 
                       href="{{ route('home') }}" 
                       aria-label="Halaman Beranda">
                        <span>Beranda</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('schedule') ? 'active' : '' }}" 
                       href="{{ route('schedule') }}"
                       aria-label="Lihat Paket dan Jadwal Umrah">
                        <span>Paket & Jadwal</span>
                    </a>
                </li>
                
                <li class="nav-item"> 
                    <a class="nav-link {{ request()->routeIs('testimonials') ? 'active' : '' }}" 
                       href="{{ route('testimonials') }}"
                       aria-label="Testimoni Jamaah">
                        <span>Testimoni</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" 
                       href="{{ route('gallery') }}"
                       aria-label="Galeri Foto Umrah">
                        <span>Galeri</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" 
                       href="{{ route('about') }}"
                       aria-label="Tentang Mahira Tour">
                        <span>Tentang Kami</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" 
                       href="{{ route('contact') }}"
                       aria-label="Hubungi Kami">
                        <span>Hubungi Kami</span>
                    </a>
                </li>
                
                {{-- CTA Section - Icons ONLY on Action Buttons --}}
                <li class="nav-item ms-lg-3">
                    <a class="btn-register" 
                       href="{{ route('register') }}"
                       aria-label="Daftar Umrah Sekarang">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Daftar Sekarang</span>
                    </a>
                </li>
                
                <li class="nav-item ms-lg-2">
                    <a class="btn-check-status" 
                       href="{{ route('check.registration.form') }}"
                       aria-label="Cek Status Pendaftaran">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Cek Status</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Floating WhatsApp Button - Always Visible --}}
<a href="https://wa.me/6282184515310?text=Assalamualaikum%2C%20saya%20ingin%20bertanya%20tentang%20paket%20umrah" 
   class="floating-whatsapp" 
   target="_blank" 
   rel="noopener noreferrer"
   aria-label="Hubungi kami via WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<script>
    // Optimized scroll effect with throttle
    let ticking = false;
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                const navbar = document.querySelector('.navbar-mahira');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
                ticking = false;
            });
            ticking = true;
        }
    });
    
    // Auto-close mobile menu on link click
    document.querySelectorAll('.navbar-nav .nav-link, .btn-register, .btn-check-status').forEach(link => {
        link.addEventListener('click', function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });
    
    // Announce page changes for screen readers
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            const pageName = this.querySelector('span').textContent;
            console.log('Navigasi ke: ' + pageName);
        });
    });
</script>