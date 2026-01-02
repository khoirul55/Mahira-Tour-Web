@extends('layouts.app')

@section('title', 'Hubungi Kami - Mahira Tour')

@push('styles')
<style>
    :root {
        --primary-navy: #001D5F;
        --white: #FFFFFF;
        --light-navy: #002B8F;
        --lighter-navy: #E8EBF3;
        --gold: #D4AF37;
        --text-dark: #1A1A1A;
        --text-gray: #6B7280;
    }

    .hero {
        position: relative;
        height: 500px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-background {
        position: absolute;
        inset: 0;
        z-index: 1;
    }
    
    .hero-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        animation: kenBurns 20s ease-in-out infinite alternate;
    }
    
    @keyframes kenBurns {
        0% { transform: scale(1); }
        100% { transform: scale(1.08); }
    }
    
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 29, 95, 0.70);
        z-index: 2;
    }
    
    .hero-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 900px;
        padding: 0 20px;
    }
    
    .breadcrumb-custom {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        padding: 10px 24px;
        border-radius: 50px;
        margin-bottom: 30px;
        font-size: 0.9rem;
    }
    
    .breadcrumb-custom a {
        color: white;
        text-decoration: none;
    }
    
    .breadcrumb-custom span {
        color: rgba(255,255,255,0.8);
    }
    
    .hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        font-family: 'Lora', serif;
        color: white;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }
    
    .hero h1 .word {
        display: inline-block;
        animation: fadeInUp 0.8s ease backwards;
    }
    
    .hero h1 .word:nth-child(1) { animation-delay: 0.3s; }
    .hero h1 .word:nth-child(2) { animation-delay: 0.5s; }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .hero p {
        font-size: 1.25rem;
        color: white;
        opacity: 0.95;
        line-height: 1.8;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
    }

    .quick-contact-section {
        padding: 80px 0;
        background: var(--white);
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-badge {
        display: inline-block;
        background: var(--primary-navy);
        color: white;
        padding: 8px 24px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: var(--text-gray);
        max-width: 600px;
        margin: 0 auto;
    }

    .contact-card {
        background: var(--white);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 10px 40px rgba(0, 29, 95, 0.08);
        border: 2px solid var(--lighter-navy);
        transition: all 0.4s;
        height: 100%;
        text-align: center;
    }
    
    .contact-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 29, 95, 0.15);
        border-color: var(--gold);
    }
    
    .contact-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-navy), var(--light-navy));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        box-shadow: 0 10px 30px rgba(0, 29, 95, 0.3);
        transition: all 0.4s;
    }

    .contact-card:hover .contact-icon {
        transform: scale(1.1) rotate(5deg);
        background: linear-gradient(135deg, var(--gold), #C49B2F);
    }
    
    .contact-icon i {
        font-size: 2.2rem;
        color: var(--white);
    }
    
    .contact-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 12px;
    }
    
    .contact-info {
        color: var(--text-gray);
        line-height: 1.8;
        margin-bottom: 20px;
        font-size: 1rem;
    }
    
    .contact-info a {
        color: var(--text-gray);
        text-decoration: none;
        transition: color 0.3s;
        font-weight: 600;
    }
    
    .contact-info a:hover {
        color: var(--primary-navy);
    }

    .contact-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: var(--lighter-navy);
        color: var(--primary-navy);
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s;
    }

    .contact-action:hover {
        background: var(--primary-navy);
        color: var(--white);
        transform: translateX(5px);
    }

    .form-map-section {
        padding: 100px 0;
        background: var(--lighter-navy);
    }

    .form-map-container {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 40px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .form-card {
        background: var(--white);
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 0 15px 50px rgba(0, 29, 95, 0.1);
    }

    .form-card h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 15px;
    }

    .form-card p {
        color: var(--text-gray);
        margin-bottom: 30px;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--primary-navy);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    
    .form-control, .form-select {
        padding: 14px 20px;
        border: 2px solid var(--lighter-navy);
        border-radius: 12px;
        transition: all 0.3s;
        font-size: 0.95rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-navy);
        box-shadow: 0 0 0 0.2rem rgba(0, 29, 95, 0.15);
    }
    
    .btn-submit {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, var(--primary-navy), var(--light-navy));
        color: var(--white);
        border: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.05rem;
        transition: all 0.3s;
        box-shadow: 0 8px 25px rgba(0, 29, 95, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, var(--light-navy), var(--primary-navy));
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0, 29, 95, 0.35);
    }

    .map-card {
        background: var(--white);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0, 29, 95, 0.1);
        display: flex;
        flex-direction: column;
    }

    .map-header {
        padding: 30px 30px 25px;
        background: linear-gradient(135deg, var(--primary-navy), var(--light-navy));
        color: var(--white);
    }

    .map-header h3 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .map-header p {
        margin: 0;
        opacity: 0.95;
        font-size: 1rem;
        line-height: 1.6;
    }

    #map {
        width: 100%;
        height: 500px;
        border: 0;
        display: block;
    }

    .map-action {
        text-align: center;
        padding: 25px 30px;
        background: var(--white);
        border-top: 2px solid var(--lighter-navy);
    }

    .btn-map {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 40px;
        background: var(--gold);
        color: var(--white);
        text-decoration: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
    }

    .btn-map:hover {
        background: #C49B2F;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(212, 175, 55, 0.5);
        color: var(--white);
    }

    .btn-map i {
        font-size: 1.2rem;
    }

    .faq-section {
        padding: 100px 0;
        background: var(--white);
    }

    .faq-accordion {
        max-width: 900px;
        margin: 0 auto;
    }

    .faq-item {
        background: var(--white);
        border-radius: 16px;
        margin-bottom: 20px;
        overflow: hidden;
        border: 2px solid var(--lighter-navy);
        transition: all 0.3s;
    }

    .faq-item:hover {
        border-color: var(--gold);
    }

    .faq-question {
        padding: 25px 30px;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-navy);
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s;
        user-select: none;
    }

    .faq-question:hover {
        color: var(--gold);
    }

    .faq-question i {
        font-size: 1.2rem;
        transition: transform 0.3s;
    }

    .faq-item.active .faq-question i {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .faq-item.active .faq-answer {
        max-height: 500px;
    }

    .faq-answer-content {
        padding: 0 30px 25px;
        color: var(--text-gray);
        line-height: 1.8;
    }

    @media (max-width: 992px) {
        .form-map-container {
            grid-template-columns: 1fr;
        }
        #map { height: 450px; }
    }

    @media (max-width: 768px) {
        .hero { height: 400px; }
        .hero h1 { font-size: 2.2rem; }
        .section-title { font-size: 2rem; }
        .form-card { padding: 2rem; }
        #map { height: 400px; }
        .map-header { padding: 25px 20px; }
        .map-header h3 { font-size: 1.3rem; }
        .map-action { padding: 20px; }
    }

    @media (max-width: 480px) {
        .hero { height: 350px; }
        .hero h1 { font-size: 1.8rem; }
        #map { height: 350px; }
        .btn-map { padding: 14px 28px; font-size: 0.9rem; }
    }
</style>
@endpush

@section('content')
<section class="hero">
    <div class="hero-background">
        <img src="{{ asset('storage/gallery/kaabah.jpg') }}" alt="Hubungi Mahira Tour" loading="eager">
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i> Beranda</a>
            <span>/</span>
            <span>Hubungi Kami</span>
        </div>
        <h1>
            <span class="word">Hubungi</span> 
            <span class="word">Kami</span>
        </h1>
        <p>Kami siap membantu Anda mewujudkan perjalanan spiritual yang berkesan</p>
    </div>
</section>

<section class="quick-contact-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">Kontak Cepat</div>
            <h2 class="section-title">Cara Menghubungi Kami</h2>
            <p class="section-subtitle">Pilih metode komunikasi yang paling nyaman untuk Anda</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h4 class="contact-title">WhatsApp</h4>
                    <div class="contact-info">
                        Chat langsung dengan tim kami<br>
                        <a href="https://wa.me/{{ $contactInfo['whatsapp'] }}" target="_blank">{{ $contactInfo['phone'] }}</a>
                    </div>
                    <a href="https://wa.me/{{ $contactInfo['whatsapp'] }}" target="_blank" class="contact-action">
                        <i class="bi bi-chat-dots-fill"></i> Chat Sekarang
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h4 class="contact-title">Telepon</h4>
                    <div class="contact-info">
                        Hubungi kami melalui telepon<br>
                        <a href="tel:{{ $contactInfo['phone'] }}">{{ $contactInfo['phone'] }}</a>
                    </div>
                    <a href="tel:{{ $contactInfo['phone'] }}" class="contact-action">
                        <i class="bi bi-telephone-fill"></i> Telepon Kami
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <h4 class="contact-title">Email</h4>
                    <div class="contact-info">
                        Kirim email kepada kami<br>
                        <a href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a>
                    </div>
                    <a href="mailto:{{ $contactInfo['email'] }}" class="contact-action">
                        <i class="bi bi-send-fill"></i> Kirim Email
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h4 class="contact-title">Kantor Pusat</h4>
                    <div class="contact-info">{{ $contactInfo['main_office'] }}</div>
                    <a href="https://maps.google.com/?q={{ urlencode($contactInfo['main_office']) }}" target="_blank" class="contact-action">
                        <i class="bi bi-map-fill"></i> Lihat Peta
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-instagram"></i>
                    </div>
                    <h4 class="contact-title">Instagram</h4>
                    <div class="contact-info">
                        Follow untuk update terbaru<br>
                        <a href="https://instagram.com/{{ str_replace('@', '', $contactInfo['instagram']) }}" target="_blank">{{ $contactInfo['instagram'] }}</a>
                    </div>
                    <a href="https://instagram.com/{{ str_replace('@', '', $contactInfo['instagram']) }}" target="_blank" class="contact-action">
                        <i class="bi bi-instagram"></i> Follow Kami
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <h4 class="contact-title">Jam Operasional</h4>
                    <div class="contact-info">
                        <strong>Senin - Jumat</strong><br>
                        {{ $contactInfo['hours']['weekday'] }}<br>
                        <strong>Sabtu</strong><br>
                        {{ $contactInfo['hours']['saturday'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="form-map-section">
    <div class="container">
        <div class="form-map-container">
            <div class="form-card" data-aos="fade-right">
                <h3>Kirim Pesan</h3>
                <p>Isi formulir di bawah dan tim kami akan segera menghubungi Anda</p>
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon *</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Subjek *</label>
                            <select name="subject" class="form-select" required>
                                <option value="">Pilih Subjek</option>
                                <option value="Informasi Paket">Informasi Paket</option>
                                <option value="Jadwal Keberangkatan">Jadwal Keberangkatan</option>
                                <option value="Konsultasi Umrah">Konsultasi Umrah</option>
                                <option value="Pembayaran">Pembayaran</option>
                                <option value="Keluhan">Keluhan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Pesan *</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send-fill"></i> Kirim Pesan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="map-card" data-aos="fade-left">
                <div class="map-header">
                    <h3>Lokasi Kantor Pusat</h3>
                    <p>Jl. Muradi, Desa Koto Keras, Kec. Pesisir Bukit, Sungai Penuh, Jambi</p>
                </div>
                <iframe 
                    id="map"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7974.528410081892!2d101.3896565!3d-2.050239!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2da1004b62a7c9%3A0xdebd36e55d2e3189!2sTravel%20Umroh%20Mahira%20Tour!5e0!3m2!1sid!2sid!4v1766545347293!5m2!1sid!2sid" 
                    allowfullscreen="" 
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div class="map-action">
                    <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="btn-map">
                        <i class="bi bi-map-fill"></i>
                        Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">FAQ</div>
            <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
            <p class="section-subtitle">Temukan jawaban atas pertanyaan umum seputar layanan kami</p>
        </div>

        <div class="faq-accordion">
            <div class="faq-item" data-aos="fade-up">
                <div class="faq-question">
                    <span>Bagaimana cara mendaftar paket umrah?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Anda bisa mendaftar melalui kantor kami, WhatsApp, atau mengisi formulir di website. Tim kami akan membantu proses pendaftaran dari awal hingga keberangkatan.
                    </div>
                </div>
            </div>

            <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                <div class="faq-question">
                    <span>Apakah tersedia sistem cicilan?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Ya, kami menyediakan program cicilan dengan DP 30% dan pelunasan H-30 sebelum keberangkatan. Hubungi tim kami untuk informasi lebih detail.
                    </div>
                </div>
            </div>

            <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                <div class="faq-question">
                    <span>Dokumen apa saja yang diperlukan?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Dokumen yang diperlukan: KTP asli, Kartu Keluarga, Paspor (minimal berlaku 7 bulan), pas foto 4x6 berlatar putih, dan buku nikah (untuk yang sudah menikah).
                    </div>
                </div>
            </div>

            <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                <div class="faq-question">
                    <span>Berapa lama proses pengurusan visa umrah?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Proses pengurusan visa umrah membutuhkan waktu sekitar 14-21 hari kerja. Kami akan menginformasikan perkembangan proses visa Anda secara berkala.
                    </div>
                </div>
            </div>

            <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                <div class="faq-question">
                    <span>Apakah harga sudah termasuk manasik?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Ya, harga paket sudah termasuk bimbingan manasik, perlengkapan umrah, dan pendampingan oleh pembimbing berpengalaman selama di tanah suci.
                    </div>
                </div>
            </div>

            <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                <div class="faq-question">
                    <span>Bagaimana jika ada perubahan jadwal keberangkatan?</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Kami akan menginformasikan setiap perubahan jadwal kepada jamaah. Jika terjadi perubahan, kami akan membantu proses reschedule atau refund sesuai kebijakan yang berlaku.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 1000, once: true });

// FAQ Accordion
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const item = question.parentElement;
        const wasActive = item.classList.contains('active');
        
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));
        
        if (!wasActive) item.classList.add('active');
    });
});
</script>
@endpush