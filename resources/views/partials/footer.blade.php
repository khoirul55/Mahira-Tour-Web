{{-- resources/views/partials/footer.blade.php --}}
<style>
    /* Footer Premium Design - Improved Version */
    .footer-mahira {
        background: linear-gradient(180deg, #001D5F 0%, #001440 100%);
        color: white;
        position: relative;
        overflow: hidden;
        margin-top: auto;
    }
    
    /* Animated Background Pattern */
    .footer-mahira::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(212, 175, 55, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(212, 175, 55, 0.04) 0%, transparent 50%);
        pointer-events: none;
    }
    
    /* Geometric Pattern Overlay */
    .footer-mahira::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 200px;
        background: url('data:image/svg+xml,<svg width="60" height="60" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="1.5" fill="white" opacity="0.05"/></svg>') repeat;
        pointer-events: none;
    }
    
    .footer-mahira .footer-top {
        padding: 5rem 0 2.5rem;
        position: relative;
        z-index: 2;
    }
    
    /* Brand Section - Enhanced */
    .footer-mahira .footer-brand {
        margin-bottom: 1.5rem;
    }
    
    .footer-mahira .footer-logo {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1.85rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .footer-mahira .footer-logo:hover {
        transform: translateX(5px);
    }
    
    .footer-mahira .footer-logo img {
        height: 55px;
        width: auto;
        filter: drop-shadow(0 4px 15px rgba(255, 255, 255, 0.15));
        transition: all 0.3s ease;
    }
    
    .footer-mahira .footer-logo:hover img {
        filter: drop-shadow(0 6px 20px rgba(212, 175, 55, 0.4));
        transform: scale(1.05);
    }
    
    .footer-mahira .footer-description {
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.8;
        margin-bottom: 1.75rem;
        font-size: 0.95rem;
        max-width: 400px;
    }
    
    /* Premium Badge with Animation */
    .footer-mahira .footer-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(184, 148, 31, 0.15) 100%);
        border: 2px solid rgba(212, 175, 55, 0.4);
        color: #D4AF37;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15);
    }
    
    .footer-mahira .footer-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.25);
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.3) 0%, rgba(184, 148, 31, 0.2) 100%);
    }
    
    .footer-mahira .footer-badge i {
        font-size: 1.1rem;
        animation: shieldPulse 2s ease-in-out infinite;
    }
    
    @keyframes shieldPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
    }
    
    /* Modern Social Links */
    .footer-mahira .social-links {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .footer-mahira .social-link {
        width: 46px;
        height: 46px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        border: 2px solid rgba(255, 255, 255, 0.12);
        position: relative;
        overflow: hidden;
    }
    
    .footer-mahira .social-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #D4AF37 0%, #B8941F 100%);
        transform: translateY(100%);
        transition: transform 0.4s ease;
        z-index: -1;
    }
    
    .footer-mahira .social-link:hover::before {
        transform: translateY(0);
    }
    
    .footer-mahira .social-link:hover {
        color: white;
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        border-color: #D4AF37;
    }
    
    .footer-mahira .social-link i {
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }
    
    .footer-mahira .social-link:hover i {
        transform: rotate(360deg) scale(1.1);
    }
    
    /* Footer Titles with Modern Design */
    .footer-mahira .footer-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1.75rem;
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
        padding-bottom: 12px;
    }
    
    .footer-mahira .footer-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #D4AF37 0%, transparent 100%);
        border-radius: 3px;
    }
    
    .footer-mahira .footer-title i {
        color: #D4AF37;
        font-size: 1.2rem;
    }
    
    /* Enhanced Footer Links */
    .footer-mahira .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-mahira .footer-links li {
        margin-bottom: 0.85rem;
        transform: translateX(0);
        transition: transform 0.3s ease;
    }
    
    .footer-mahira .footer-links li:hover {
        transform: translateX(5px);
    }
    
    .footer-mahira .footer-links a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 0.92rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        position: relative;
        padding-left: 0;
    }
    
    .footer-mahira .footer-links a i {
        color: #D4AF37;
        font-size: 0.75rem;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    
    .footer-mahira .footer-links a:hover {
        color: white;
        padding-left: 8px;
    }
    
    .footer-mahira .footer-links a:hover i {
        opacity: 1;
        transform: translateX(0);
    }
    
    /* Contact Items with Modern Icons */
    .footer-mahira .contact-item {
        display: flex;
        align-items: start;
        gap: 14px;
        margin-bottom: 1.25rem;
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.92rem;
        transition: all 0.3s ease;
        padding: 12px;
        border-radius: 12px;
    }
    
    .footer-mahira .contact-item:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: translateX(5px);
    }
    
    .footer-mahira .contact-icon {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(212, 175, 55, 0.1) 100%);
        border: 2px solid rgba(212, 175, 55, 0.3);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #D4AF37;
        flex-shrink: 0;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    .footer-mahira .contact-item:hover .contact-icon {
        background: linear-gradient(135deg, #D4AF37 0%, #B8941F 100%);
        color: white;
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
    }
    
    .footer-mahira .contact-item a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .footer-mahira .contact-item a:hover {
        color: white;
    }
    
    /* Premium Newsletter Section */
    .footer-newsletter {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(212, 175, 55, 0.05) 100%);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 2rem;
        border: 2px solid rgba(255, 255, 255, 0.12);
        margin-top: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .footer-newsletter:hover {
        border-color: rgba(212, 175, 55, 0.3);
        box-shadow: 0 12px 40px rgba(212, 175, 55, 0.15);
    }
    
    .footer-newsletter h4 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.85rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .footer-newsletter h4 i {
        color: #D4AF37;
        font-size: 1.3rem;
        animation: heartBeat 1.5s ease-in-out infinite;
    }
    
    @keyframes heartBeat {
        0%, 100% { transform: scale(1); }
        10%, 30% { transform: scale(1.15); }
        20%, 40% { transform: scale(1); }
    }
    
    .footer-newsletter p {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.9rem;
        margin-bottom: 1.25rem;
        line-height: 1.6;
    }
    
    .footer-newsletter .newsletter-form {
        display: flex;
        gap: 12px;
    }
    
    .footer-newsletter input {
        flex: 1;
        padding: 1rem 1.5rem;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        color: white;
        font-size: 0.92rem;
        transition: all 0.3s ease;
    }
    
    .footer-newsletter input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }
    
    .footer-newsletter input:focus {
        outline: none;
        border-color: #D4AF37;
        background: rgba(255, 255, 255, 0.18);
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
    }
    
    .footer-newsletter button {
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #D4AF37 0%, #B8941F 100%);
        color: white;
        border: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.92rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
    }
    
    .footer-newsletter button:hover {
        background: linear-gradient(135deg, #B8941F 0%, #9A7A1A 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
    }
    
    .footer-newsletter button i {
        transition: transform 0.3s ease;
    }
    
    .footer-newsletter button:hover i {
        transform: translateX(3px);
    }
    
    /* Footer Bottom - Enhanced */
    .footer-bottom {
        border-top: 2px solid rgba(255, 255, 255, 0.1);
        padding: 2rem 0;
        margin-top: 3rem;
        background: rgba(0, 0, 0, 0.1);
    }
    
    .footer-bottom-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }
    
    .footer-copyright {
        color: rgba(255, 255, 255, 0.65);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .footer-copyright i.text-danger {
        animation: heartBeat 1.5s ease-in-out infinite;
    }
    
    .footer-license {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(184, 148, 31, 0.15) 100%);
        padding: 10px 20px;
        border-radius: 50px;
        border: 2px solid rgba(212, 175, 55, 0.35);
        transition: all 0.3s ease;
    }
    
    .footer-license:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.25);
    }
    
    .footer-license i {
        color: #D4AF37;
        font-size: 1.1rem;
    }
    
    .footer-license span {
        color: rgba(255, 255, 255, 0.95);
        font-size: 0.88rem;
        font-weight: 600;
    }
    
    /* Premium Floating WhatsApp Button */
    .floating-whatsapp {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }
    
    .whatsapp-button {
        width: 65px;
        height: 65px;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        box-shadow: 0 10px 35px rgba(37, 211, 102, 0.5);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        animation: floatAnimation 3s ease-in-out infinite;
        border: 4px solid rgba(255, 255, 255, 0.3);
        position: relative;
    }
    
    .whatsapp-button::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: rgba(37, 211, 102, 0.3);
        animation: ripple 2s ease-out infinite;
    }
    
    @keyframes ripple {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }
    
    .whatsapp-button:hover {
        transform: scale(1.15) rotate(5deg);
        box-shadow: 0 15px 45px rgba(37, 211, 102, 0.7);
    }
    
    .whatsapp-button i {
        position: relative;
        z-index: 1;
    }
    
    .whatsapp-tooltip {
        position: absolute;
        right: 80px;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        color: #001D5F;
        padding: 14px 22px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.92rem;
        white-space: nowrap;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease;
    }
    
    .whatsapp-tooltip::after {
        content: '';
        position: absolute;
        right: -10px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 10px solid white;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
    }
    
    .floating-whatsapp:hover .whatsapp-tooltip {
        opacity: 1;
        right: 85px;
    }
    
    @keyframes floatAnimation {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-12px);
        }
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-mahira .footer-top {
            padding: 3.5rem 0 2rem;
        }
        
        .footer-newsletter {
            padding: 1.5rem;
        }
        
        .footer-newsletter .newsletter-form {
            flex-direction: column;
        }
        
        .footer-newsletter button {
            width: 100%;
            justify-content: center;
        }
        
        .footer-bottom-content {
            flex-direction: column;
            text-align: center;
        }
        
        .floating-whatsapp {
            bottom: 20px;
            right: 20px;
        }
        
        .whatsapp-button {
            width: 60px;
            height: 60px;
            font-size: 1.8rem;
        }
        
        .whatsapp-tooltip {
            display: none;
        }
    }
</style>

<footer class="footer-mahira">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                <!-- Brand Column - Enhanced -->
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
                            Travel Haji & Umrah terpercaya dengan pengalaman lebih dari 20 tahun 
                            melayani ribuan jamaah ke Tanah Suci. Komitmen kami adalah memberikan 
                            pelayanan terbaik untuk perjalanan ibadah Anda.
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
                    <h5 class="footer-title">
                        <i class="fa-solid fa-compass"></i>
                        Menu
                    </h5>
                    <ul class="footer-links">
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="fa-solid fa-angle-right"></i>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}">
                                <i class="fa-solid fa-angle-right"></i>
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('schedule') }}">
                                <i class="fa-solid fa-angle-right"></i>
                                Paket & Jadwal
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gallery') }}">
                                <i class="fa-solid fa-angle-right"></i>
                                Galeri
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}">
                                <i class="fa-solid fa-angle-right"></i>
                                FAQ
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">
                        <i class="fa-solid fa-briefcase"></i>
                        Layanan
                    </h5>
                    <ul class="footer-links">
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-angle-right"></i>
                                Paket Umrah Reguler
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-angle-right"></i>
                                Paket Umrah VIP
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-angle-right"></i>
                                Paket Haji Furoda
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-angle-right"></i>
                                Umrah Plus Turki
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-angle-right"></i>
                                Umrah Ramadhan
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-angle-right"></i>
                                Manasik Haji/Umrah
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">
                        <i class="fa-solid fa-headset"></i>
                        Hubungi Kami
                    </h5>
                    
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
                            <a href="tel:+628123456789">+62 812-3456-7890</a><br>
                            <a href="tel:+622187654321">+62 21 8765-4321</a>
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
            
            <!-- Premium Newsletter -->
            <div class="row mt-4">
                <div class="col-lg-6 col-xl-5">
                    <div class="footer-newsletter">
                        <h4>
                            <i class="fa-solid fa-envelope-open-text"></i>
                            Berlangganan Newsletter
                        </h4>
                        <p>Dapatkan info promo, tips umrah, dan update jadwal terbaru langsung ke email Anda</p>
                        <form class="newsletter-form" onsubmit="return false;">
                            <input type="email" placeholder="Masukkan email Anda" required>
                            <button type="submit">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Subscribe</span>
                            </button>
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
                    <span>Izin Kemenag: 123/PPIU/2024</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Premium Floating WhatsApp Button -->
<div class="floating-whatsapp">
    <a href="https://wa.me/6282184515310?text=Assalamualaikum, saya ingin konsultasi tentang paket umrah" 
       target="_blank" 
       class="whatsapp-button"
       aria-label="Chat WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    <div class="whatsapp-tooltip">
        💬 Butuh Bantuan? Chat Kami!
    </div>
</div>

<script>
    // Newsletter Form Handler with Animation
    document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const input = this.querySelector('input[type="email"]');
        const button = this.querySelector('button');
        const email = input.value;
        
        // Button loading state
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Mengirim...</span>';
        button.disabled = true;
        
        // Simulate API call (replace with actual API call)
        setTimeout(() => {
            // Success state
            button.innerHTML = '<i class="fa-solid fa-check"></i> <span>Berhasil!</span>';
            button.style.background = 'linear-gradient(135deg, #10B981 0%, #059669 100%)';
            
            // Show success message
            const successMsg = document.createElement('div');
            successMsg.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, #10B981 0%, #059669 100%);
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
                z-index: 9999;
                font-weight: 600;
                animation: slideInRight 0.3s ease;
            `;
            successMsg.innerHTML = `
                <i class="fa-solid fa-circle-check"></i> 
                Terima kasih! Email <strong>${email}</strong> berhasil didaftarkan!
            `;
            document.body.appendChild(successMsg);
            
            // Remove success message after 4 seconds
            setTimeout(() => {
                successMsg.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => successMsg.remove(), 300);
            }, 4000);
            
            // Reset form
            this.reset();
            
            // Reset button after 2 seconds
            setTimeout(() => {
                button.innerHTML = originalText;
                button.style.background = 'linear-gradient(135deg, #D4AF37 0%, #B8941F 100%)';
                button.disabled = false;
            }, 2000);
        }, 1500);
    });
    
    // Add animations CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Smooth scroll for footer links
    document.querySelectorAll('.footer-links a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Intersection Observer for footer animation on scroll
    const footerObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
            }
        });
    }, {
        threshold: 0.1
    });
    
    // Observe footer sections
    document.querySelectorAll('.footer-mahira .col-lg-4, .footer-mahira .col-lg-2, .footer-mahira .col-lg-3').forEach(col => {
        col.style.opacity = '0';
        footerObserver.observe(col);
    });
    
    // Add fadeInUp animation
    const fadeUpStyle = document.createElement('style');
    fadeUpStyle.textContent = `
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(fadeUpStyle);
    
    // WhatsApp button click tracking
    document.querySelector('.whatsapp-button').addEventListener('click', function(e) {
        // Add click animation
        this.style.transform = 'scale(0.9)';
        setTimeout(() => {
            this.style.transform = '';
        }, 100);
        
        // You can add analytics tracking here
        console.log('WhatsApp button clicked');
    });
    
    // Email validation with real-time feedback
    const emailInput = document.querySelector('.newsletter-form input[type="email"]');
    emailInput.addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (this.value && !emailRegex.test(this.value)) {
            this.style.borderColor = '#EF4444';
            this.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.1)';
        } else if (this.value && emailRegex.test(this.value)) {
            this.style.borderColor = '#10B981';
            this.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.1)';
        } else {
            this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
            this.style.boxShadow = 'none';
        }
    });
    
    // Social media hover sound effect (optional - uncomment if you want)
    /*
    const socialLinks = document.querySelectorAll('.social-link');
    socialLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            // You can add a subtle sound effect here
            console.log('Social icon hovered:', this.getAttribute('aria-label'));
        });
    });
    */
    
    // Footer copyright year auto-update (already handled by Laravel but good to have)
    const currentYear = new Date().getFullYear();
    const copyrightYear = document.querySelector('.footer-copyright');
    if (copyrightYear && !copyrightYear.textContent.includes(currentYear)) {
        copyrightYear.innerHTML = copyrightYear.innerHTML.replace(/\d{4}/, currentYear);
    }
    
    // Lazy load footer background pattern for better performance
    if ('IntersectionObserver' in window) {
        const footerObserverBg = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('loaded');
                    footerObserverBg.unobserve(entry.target);
                }
            });
        });
        
        footerObserverBg.observe(document.querySelector('.footer-mahira'));
    }
</script>