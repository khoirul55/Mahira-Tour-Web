{{-- CTA SECTION --}}
{{-- CLOSING CTA (Vertical Split Style) --}}
<section class="closing-split-section">
    <div class="split-container">
        {{-- Left: Text Content --}}
        <div class="split-content-side">
            <span class="split-subtitle">PERJALANAN RUHANI</span>
            <h2 class="split-title">LANGKAH MENUJU <br>RUMAH-NYA</h2>
            <p class="split-desc">
                Panggilan itu mungkin sudah terdengar di hati Anda. Kami mengerti bahwa ini bukan sekadar perjalanan fisik, tapi perjalanan hati menuju Sang Pencipta. Izinkan Mahira Tour membersamai setiap langkah ibadah Anda dengan kenyamanan dan kepastian.
            </p>
            <div class="split-buttons">
                <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah"
                   class="btn-split-primary" target="_blank">
                    <i class="bi bi-whatsapp"></i> Konsultasi Gratis
                </a>
                <a href="{{ route('schedule') }}" class="btn-split-outline">
                    <i class="bi bi-calendar-check"></i> Lihat Jadwal
                </a>
            </div>
        </div>

        {{-- Right: Dual Vertical Images --}}
        <div class="split-image-side">
            <div class="split-img-wrapper img-tall">
                <img src="{{ asset('images/hero/kabah.webp') }}" alt="Ka'bah" class="split-img">
            </div>
            <div class="split-img-wrapper img-short">
                <img src="{{ asset('images/hero/masjid-nabawi.webp') }}" alt="Masjid Nabawi" class="split-img">
            </div>
        </div>
    </div>
</section>
