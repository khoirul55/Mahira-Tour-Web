{{-- resources/views/partials/footer.blade.php - ZEN MINIMALIST VERSION --}}
<style>
    /* ========================================
       FOOTER ZEN MINIMALIST - OPTIMIZED
       File size: ~150 lines (dari 464)
       Konsisten dengan home page design
       ======================================== */
    
    :root {
        --footer-navy: #001D5F;
        --footer-gold: #D4AF37;
        --footer-text: rgba(255, 255, 255, 0.75);
    }
    
    /* Main Footer Container */
    .footer-mahira {
        background: var(--footer-navy);
        color: white;
        padding: 80px 0 0;
        margin-top: auto;
    }
    
    /* Footer Top Section */
    .footer-top {
        padding-bottom: 60px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    /* Brand Section */
    .footer-brand {
        margin-bottom: 2rem;
    }
    
    .footer-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1.25rem;
        font-family: 'Lora', serif;
    }
    
    .footer-logo img {
        height: 48px;
        width: auto;
    }
    
    .footer-description {
        color: var(--footer-text);
        line-height: 1.7;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
        max-width: 380px;
    }
    
    /* Badge - Simple Version */
    .footer-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(212, 175, 55, 0.15);
        border: 2px solid rgba(212, 175, 55, 0.3);
        color: var(--footer-gold);
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    /* Social Links - Clean Grid */
    .social-links {
        display: grid;
        grid-template-columns: repeat(5, 38px);
        gap: 10px;
    }
    
    .social-link {
        width: 38px;
        height: 38px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .social-link:hover {
        background: var(--footer-gold);
        border-color: var(--footer-gold);
        transform: translateY(-3px);
    }
    
    /* Footer Titles */
    .footer-title {
        font-size: 1rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1.5rem;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--footer-gold);
        display: inline-block;
        font-family: 'Lora', serif;
    }
    
    /* Footer Links */
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-links li {
        margin-bottom: 0.75rem;
    }
    
    .footer-links a {
        color: var(--footer-text);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-block;
    }
    
    .footer-links a:hover {
        color: white;
        padding-left: 8px;
    }
    
    /* Contact Items */
    .contact-item {
        display: flex;
        align-items: start;
        gap: 12px;
        margin-bottom: 1rem;
        color: var(--footer-text);
        font-size: 0.9rem;
    }
    
    .contact-icon {
        width: 36px;
        height: 36px;
        background: rgba(212, 175, 55, 0.15);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--footer-gold);
        flex-shrink: 0;
        font-size: 0.95rem;
    }
    
    .contact-item a {
        color: var(--footer-text);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .contact-item a:hover {
        color: white;
    }
    
    /* Newsletter - Simplified */
    .footer-newsletter {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 1.75rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 2rem;
    }
    
    .footer-newsletter h4 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        font-family: 'Lora', serif;
    }
    
    .footer-newsletter p {
        color: var(--footer-text);
        font-size: 0.85rem;
        margin-bottom: 1rem;
        line-height: 1.6;
    }
    
    .newsletter-form {
        display: flex;
        gap: 10px;
    }
    
    .newsletter-form input {
        flex: 1;
        padding: 12px 16px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .newsletter-form input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }
    
    .newsletter-form input:focus {
        outline: none;
        border-color: var(--footer-gold);
        background: rgba(255, 255, 255, 0.15);
    }
    
    .newsletter-form button {
        padding: 12px 24px;
        background: var(--footer-gold);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .newsletter-form button:hover {
        background: #B8941F;
        transform: translateY(-2px);
    }
    
    /* Footer Bottom */
    .footer-bottom {
        padding: 30px 0;
        background: rgba(0, 0, 0, 0.2);
    }
    
    .footer-bottom-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .footer-copyright {
        color: rgba(255, 255, 255, 0.65);
        font-size: 0.85rem;
    }
    
    .footer-copyright i.text-danger {
        animation: heartBeat 1.5s ease-in-out infinite;
    }
    
    /* Only 1 animation kept */
    @keyframes heartBeat {
        0%, 100% { transform: scale(1); }
        10%, 30% { transform: scale(1.1); }
    }
    
    .footer-license {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(212, 175, 55, 0.15);
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid rgba(212, 175, 55, 0.3);
    }
    
    .footer-license i {
        color: var(--footer-gold);
    }
    
    .footer-license span {
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    /* Floating WhatsApp - Simplified */
    .floating-whatsapp {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }
    
    .whatsapp-button {
        width: 60px;
        height: 60px;
        background: #25D366;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        box-shadow: 0 8px 24px rgba(37, 211, 102, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .whatsapp-button:hover {
        transform: scale(1.1);
        box-shadow: 0 12px 32px rgba(37, 211, 102, 0.5);
        color: white;
    }
    
    /* ========================================
       RESPONSIVE - MOBILE OPTIMIZED
       ======================================== */
    
    @media (max-width: 768px) {
        .footer-mahira {
            padding: 60px 0 0;
        }
        
        .footer-top {
            padding-bottom: 40px;
        }
        
        .footer-brand {
            margin-bottom: 2.5rem;
        }
        
        .footer-logo {
            font-size: 1.3rem;
        }
        
        .footer-logo img {
            height: 42px;
        }
        
        .footer-description {
            max-width: 100%;
        }
        
        .social-links {
            grid-template-columns: repeat(5, 36px);
            gap: 8px;
        }
        
        .social-link {
            width: 36px;
            height: 36px;
            font-size: 0.95rem;
        }
        
        .footer-newsletter {
            padding: 1.5rem;
        }
        
        .newsletter-form {
            flex-direction: column;
        }
        
        .newsletter-form button {
            width: 100%;
        }
        
        .footer-bottom-content {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        
        .floating-whatsapp {
            bottom: 20px;
            right: 20px;
        }
        
        .whatsapp-button {
            width: 56px;
            height: 56px;
            font-size: 1.6rem;
        }
    }
    
    @media (max-width: 576px) {
        .footer-mahira {
            padding: 50px 0 0;
        }
        
        .footer-title {
            font-size: 0.95rem;
            margin-bottom: 1.25rem;
        }
        
        .footer-links li {
            margin-bottom: 0.6rem;
        }
        
        .footer-links a {
            font-size: 0.85rem;
        }
        
        .contact-item {
            font-size: 0.85rem;
        }
        
        .contact-icon {
            width: 32px;
            height: 32px;
            font-size: 0.85rem;
        }
        
        .footer-newsletter h4 {
            font-size: 1rem;
        }
        
        .footer-newsletter p {
            font-size: 0.8rem;
        }
        
        .newsletter-form input,
        .newsletter-form button {
            font-size: 0.85rem;
            padding: 11px 14px;
        }
        
        .social-links {
            grid-template-columns: repeat(5, 34px);
            gap: 6px;
        }
        
        .social-link {
            width: 34px;
            height: 34px;
            font-size: 0.9rem;
        }
        
        .floating-whatsapp {
            bottom: 80px; /* Avoid conflict with mobile navbar */
        }
    }
    
    @media (max-width: 375px) {
        .footer-logo {
            font-size: 1.2rem;
        }
        
        .footer-logo img {
            height: 38px;
        }
        
        .social-links {
            grid-template-columns: repeat(5, 32px);
        }
        
        .social-link {
            width: 32px;
            height: 32px;
            font-size: 0.85rem;
        }
    }
</style>

<footer class="footer-mahira">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                <!-- Brand Column -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <img src="{{ asset('images/mahira-logo.png') }}" alt="Mahira Tour">
                            <span>Mahira Tour</span>
                        </div>

                        <div class="footer-badge">
                            <i class="fa-solid fa-shield-check"></i>
                            <span>Berizin Resmi Kemenag RI</span>
                        </div>
                        
                        <p class="footer-description">
                            Travel Haji & Umrah terpercaya sejak 2016 melayani ribuan jamaah 
                            ke Tanah Suci dengan pelayanan terbaik dan bimbingan spiritual 
                            yang sesuai syariat.
                        </p>
                        
                        <div class="social-links">
                            <a href="https://facebook.com/mahiratour" class="social-link" target="_blank" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="https://instagram.com/mahiratour" class="social-link" target="_blank" aria-label="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="https://youtube.com/@mahiratour" class="social-link" target="_blank" aria-label="YouTube">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                            <a href="https://twitter.com/mahiratour" class="social-link" target="_blank" aria-label="Twitter">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                            <a href="https://tiktok.com/@mahiratour" class="social-link" target="_blank" aria-label="TikTok">
                                <i class="fa-brands fa-tiktok"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Menu</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('schedule') }}">Paket & Jadwal</a></li>
                        <li><a href="{{ route('gallery') }}">Galeri</a></li>
                        <li><a href="{{ route('testimonials') }}">Testimoni</a></li>
                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Layanan</h5>
                    <ul class="footer-links">
                        <li><a href="#">Paket Umrah Reguler</a></li>
                        <li><a href="#">Paket Umrah VIP</a></li>
                        <li><a href="#">Paket Haji Furoda</a></li>
                        <li><a href="#">Umrah Plus Turki</a></li>
                        <li><a href="#">Umrah Ramadhan</a></li>
                        <li><a href="#">Manasik Haji/Umrah</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            Jl. Raya Makkah No. 123<br>
                            Jakarta Selatan 12345
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <a href="tel:+6282184515310">+62 821-8451-5310</a>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <a href="mailto:info@mahiratour.com">info@mahiratour.com</a>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            Senin - Sabtu<br>
                            08:00 - 17:00 WIB
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Newsletter -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="footer-newsletter">
                        <h4>Berlangganan Newsletter</h4>
                        <p>Dapatkan info promo, tips umrah, dan update jadwal terbaru</p>
                        <form class="newsletter-form" id="newsletterForm">
                            <input type="email" placeholder="Email Anda" required>
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p class="footer-copyright">
                    &copy; {{ date('Y') }} <strong>Mahira Tour</strong>. All Rights Reserved. 
                    Made with <i class="fa-solid fa-heart text-danger"></i> in Indonesia
                </p>
                <div class="footer-license">
                    <i class="fa-solid fa-certificate"></i>
                    <span>PPIU: 21062301498960002</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp -->
<div class="floating-whatsapp">
    <a href="https://wa.me/6282184515310?text=Assalamualaikum, saya ingin konsultasi paket umrah" 
       target="_blank" 
       class="whatsapp-button"
       aria-label="Chat WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</div>

<script>
    // Simple newsletter form handler
    document.getElementById('newsletterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const input = this.querySelector('input[type="email"]');
        const button = this.querySelector('button');
        const email = input.value;
        
        // Simple success feedback
        button.textContent = 'Berhasil!';
        button.style.background = '#10B981';
        
        // Reset after 2 seconds
        setTimeout(() => {
            this.reset();
            button.textContent = 'Subscribe';
            button.style.background = '#D4AF37';
        }, 2000);
        
        // You can add actual API call here
        console.log('Newsletter subscription:', email);
    });
    
    // Smooth scroll for footer links
    document.querySelectorAll('.footer-links a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>