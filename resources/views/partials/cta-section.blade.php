{{-- CTA SECTION - TailwindCSS v4 --}}
<section class="py-16 lg:py-24 overflow-hidden" style="background: white;">
    <div class="container-main">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            
            {{-- Left: Text Content --}}
            <div class="flex-1 w-full lg:order-1">
                <span class="block text-sm font-bold uppercase tracking-[3px] pl-5 mb-5 text-[#9A7B2C] border-l-[3px] border-gold">
                    PERJALANAN RUHANI
                </span>
                
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-bold uppercase leading-tight mb-7 font-serif text-primary tracking-wide">
                    LANGKAH MENUJU <br>RUMAH-NYA
                </h2>
                
                <p class="text-sm sm:text-base lg:text-lg leading-relaxed mb-8 sm:mb-10 max-w-lg text-gray-500" style="line-height: 1.8;">
                    Panggilan itu mungkin sudah terdengar di hati Anda. Kami mengerti bahwa ini bukan sekadar perjalanan fisik, tapi perjalanan hati menuju Sang Pencipta. Izinkan Mahira Tour membersamai setiap langkah ibadah Anda dengan kenyamanan dan kepastian.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-5">
                    <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah"
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3.5 sm:py-4 rounded font-bold uppercase 
                              tracking-wider text-sm transition-all duration-300 hover:-translate-y-1
                              bg-primary text-white hover:bg-gold hover:shadow-lg hover:shadow-gold/30">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Konsultasi Gratis
                    </a>
                    <a href="{{ route('schedule') }}" 
                       class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3.5 sm:py-4 rounded font-bold uppercase 
                              tracking-wider text-sm transition-all duration-300 hover:-translate-y-1
                              bg-primary text-white border-2 border-primary hover:bg-gold hover:border-gold hover:shadow-lg hover:shadow-gold/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Lihat Jadwal
                    </a>
                </div>
            </div>

            {{-- Right: Dual Vertical Images --}}
            <div class="flex-[1.2] flex gap-3 sm:gap-5 h-[200px] sm:h-[300px] lg:h-[600px] w-full lg:order-2">
                <div class="flex-1 overflow-hidden rounded-xl lg:-mt-12 group">
                    <img src="{{ asset('images/hero/kabah.webp') }}" alt="Ka'bah" 
                         class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                         loading="lazy">
                </div>
                <div class="flex-1 overflow-hidden rounded-xl lg:mt-12 lg:h-[90%] group">
                    <img src="{{ asset('images/hero/masjid-nabawi.webp') }}" alt="Masjid Nabawi" 
                         class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                         loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
