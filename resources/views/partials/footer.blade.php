{{-- resources/views/partials/footer.blade.php - ZEN MINIMALIST VERSION --}}

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