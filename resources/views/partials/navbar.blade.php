{{-- resources/views/partials/navbar.blade.php --}}
{{-- OPTIMIZED VERSION - Menggunakan Font Awesome 6 yang sudah ter-install --}}
<style>
    /* Navbar Modern Glassmorphism - Optimized */
    .navbar-mahira {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        box-shadow: 0 4px 30px rgba(0, 29, 95, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0;
        border-bottom: 1px solid rgba(0, 29, 95, 0.1);
    }
    
    .navbar-mahira.scrolled {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(25px);
        box-shadow: 0 8px 40px rgba(0, 29, 95, 0.12);
        padding: 0;
    }
    
    .navbar-mahira .navbar-brand {
        font-size: 1.5rem;
        font-weight: 800;
        color: #001D5F;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 1rem 0;
        transition: all 0.3s ease;
    }
    
    .navbar-mahira .navbar-brand:hover {
        transform: scale(1.05);
    }
    
    .navbar-mahira .brand-logo {
        height: 50px;
        width: auto;
        transition: all 0.3s ease;
        filter: drop-shadow(0 4px 15px rgba(0, 29, 95, 0.2));
    }

    .navbar-mahira .brand-logo:hover {
        filter: drop-shadow(0 6px 20px rgba(0, 29, 95, 0.35));
        transform: rotate(-3deg);
    }
    
    .navbar-mahira .nav-link {
        color: #001D5F;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.75rem 1.25rem !important;
        margin: 0 0.25rem;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    /* Modern Icon Animation - Font Awesome Optimized */
    .navbar-mahira .nav-link i {
        font-size: 1.1rem;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
    }
    
    .navbar-mahira .nav-link:hover i {
        transform: scale(1.2) translateY(-2px);
        color: #D4AF37;
    }
    
    /* Animated underline */
    .navbar-mahira .nav-link::after {
        content: '';
        position: absolute;
        bottom: 8px;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: 40%;
        height: 3px;
        background: linear-gradient(90deg, #001D5F 0%, #D4AF37 100%);
        border-radius: 3px;
        transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    
    .navbar-mahira .nav-link:hover,
    .navbar-mahira .nav-link.active {
        color: #001D5F;
        background: linear-gradient(135deg, rgba(0, 29, 95, 0.06) 0%, rgba(212, 175, 55, 0.08) 100%);
        transform: translateY(-2px);
    }
    
    .navbar-mahira .nav-link:hover::after,
    .navbar-mahira .nav-link.active::after {
        transform: translateX(-50%) scaleX(1);
    }
    
    .navbar-mahira .nav-link.active i {
        color: #D4AF37;
        animation: iconPulse 0.6s ease;
    }
    
    @keyframes iconPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.3); }
    }
    
    /* Premium Button with Icon Animation */
    .navbar-mahira .btn-register {
        background: linear-gradient(135deg, #001D5F 0%, #001440 100%);
        color: white;
        padding: 0.65rem 1.75rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        border: none;
        box-shadow: 0 6px 20px rgba(0, 29, 95, 0.25);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }
    
    .navbar-mahira .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .navbar-mahira .btn-register:hover::before {
        left: 100%;
    }
    
    .navbar-mahira .btn-register i {
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    
    .navbar-mahira .btn-register:hover {
        background: linear-gradient(135deg, #D4AF37 0%, #B8941F 100%);
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(212, 175, 55, 0.4);
    }
    
    .navbar-mahira .btn-register:hover i {
        transform: rotate(360deg) scale(1.2);
    }
    
    /* Mobile Menu Styling */
    .navbar-mahira .navbar-toggler {
        border: 2px solid #001D5F;
        border-radius: 10px;
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }
    
    .navbar-mahira .navbar-toggler:hover {
        background: rgba(0, 29, 95, 0.05);
        transform: scale(1.05);
    }
    
    .navbar-mahira .navbar-toggler:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 29, 95, 0.25);
    }
    
    .navbar-mahira .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23001D5F' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.5' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        transition: all 0.3s ease;
    }
    
  @media (max-width: 991px) {
        .navbar-mahira .navbar-collapse {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.98) 100%);
            margin-top: 1rem;
            padding: 1.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 29, 95, 0.15);
            border: 1px solid rgba(0, 29, 95, 0.1);
            /* Hapus backdrop-filter di mobile untuk performa */
            will-change: transform, opacity;
        }
        
        /* Animasi yang lebih smooth - hanya opacity */
        .navbar-mahira .navbar-collapse.collapsing {
            transition: height 0.25s ease, opacity 0.25s ease;
            opacity: 0;
        }
        
        .navbar-mahira .navbar-collapse.show {
            opacity: 1;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .navbar-mahira .nav-link {
            padding: 0.875rem 1rem !important;
            margin: 0.35rem 0;
            border-radius: 12px;
        }
        
        .navbar-mahira .nav-link::after {
            display: none;
        }
        
        .navbar-mahira .btn-register {
            width: 100%;
            justify-content: center;
            margin-top: 1rem;
            padding: 0.875rem 1.75rem;
        }
    }
    
    /* Smooth page load animation */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .navbar-mahira {
        animation: fadeInDown 0.6s ease;
    }
</style>

<nav class="navbar navbar-mahira navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/mahira-logo.png') }}" alt="Mahira Tour" class="brand-logo">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home')}}">
                        <i class="fa-solid fa-house"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('schedule') ? 'active' : '' }}" href="{{ route('schedule') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Paket & Jadwal</span>
                    </a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link {{ request()->routeIs('testimonials') ? 'active' : '' }}" href="{{ route('testimonials') }}">
                        <i class="fa-solid fa-comments"></i>
                        <span>Testimoni</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">
                        <i class="fa-solid fa-images"></i>
                        <span>Galeri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>Tentang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Kontak</span>
                    </a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn-register" href="{{ route('register') }}">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Daftar Sekarang</span>
                    </a>
                </li>
                <li class="nav-item">
                     <a class="nav-link" href="{{ route('check.registration.form') }}">
                             <i class="bi bi-search"></i> Cek Status
                      </a>
                 </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Navbar scroll effect with throttle
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
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });
    
    // Active link indicator on scroll
    window.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('section[id]');
        const scrollY = window.pageYOffset;
        
        sections.forEach(current => {
            const sectionHeight = current.offsetHeight;
            const sectionTop = current.offsetTop - 100;
            const sectionId = current.getAttribute('id');
            
            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                document.querySelector(`.navbar-nav a[href*="${sectionId}"]`)?.classList.add('active');
            }
        });
    });
</script>