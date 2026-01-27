{{-- resources/views/partials/footer.blade.php - ZEN MINIMALIST VERSION --}}

<footer class="footer-mahira">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                <!-- Brand Column -->
                <div class="col-lg-5 col-md-6">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <img src="{{ asset('images/mahira-logo.webp') }}" alt="Mahira Tour" loading="lazy">
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
                <div class="col-lg-3 col-md-6">
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
                
                <!-- Contact -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            Jl. Muradi No. 19, RT 000/RW 000,<br>
                            Kel. Koto Lolo, Kec. Pesisir Bukit,<br>
                            Kota Sungai Penuh, Jambi
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
                            <a href="mailto:admin@mahiratour.id">admin@mahiratour.id</a>
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