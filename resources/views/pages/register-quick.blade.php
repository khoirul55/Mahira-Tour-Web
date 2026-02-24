@extends('layouts.app')

@section('title', 'Booking Cepat - Mahira Tour')

@section('content')
<section class="min-h-screen flex items-center justify-center relative overflow-hidden py-16 md:py-8 bg-gradient-to-br from-[#001D5F] to-[#002B8F]">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-30 pointer-events-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%201440%20320%22%3E%3Cpath%20fill=%22%23ffffff%22%20fill-opacity=%220.05%22%20d=%22M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z%22/%3E%3C/svg%3E')] bg-bottom bg-no-repeat">
    </div>

    <div class="max-w-[600px] w-full mx-auto relative z-[1] px-4">
        {{-- Header --}}
        <div class="text-center text-white mb-12 md:mb-8 px-4">
            <h1 class="text-[2.5rem] md:text-[1.6rem] font-extrabold mb-4 [text-shadow:0_2px_10px_rgba(0,0,0,0.2)]">
                Formulir Pendaftaran Umrah
            </h1>
            <p class="text-lg md:text-base opacity-90">Amankan kursi keberangkatan Anda dengan mudah dan cepat</p>
        </div>

        {{-- Booking Card --}}
        <div class="bg-white rounded-3xl md:rounded-2xl p-12 md:p-6 relative z-[2] shadow-[0_20px_60px_rgba(0,0,0,0.3)]">

            {{-- Error Messages --}}
            @if($errors->any())
            <div class="flex items-start gap-3 p-4 rounded-xl mb-6 bg-red-50 border-2 border-red-500">
                <svg class="w-5 h-5 shrink-0 mt-0.5 text-red-900" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <div>
                    <strong class="text-sm font-bold text-red-900">Terjadi Kesalahan:</strong>
                    <ul class="mt-1 ml-4 text-sm list-disc text-red-900">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- Package Summary --}}
            @if($selectedSchedule)
            <div class="rounded-2xl p-5 mb-8 bg-gradient-to-br from-[#F8F9FF] to-[#E8EBF3] border-2 border-gold">
                <h3 class="text-xl font-bold mb-4 text-primary">{{ $selectedSchedule['package_name'] }}</h3>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-primary">
                        <svg class="w-5 h-5 shrink-0 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ date('d M Y', strtotime($selectedSchedule['departure_date'])) }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-primary">
                        <svg class="w-5 h-5 shrink-0 text-gold" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        <span>{{ $selectedSchedule['departure_route'] }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-primary">
                        <svg class="w-5 h-5 shrink-0 text-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M22 16.21v-1.895l-1.5-1.5v-7.396c0-.854-.552-1.609-1.368-1.873L12.66 1.356c-.427-.139-.89-.139-1.317 0L4.868 3.546c-.816.264-1.368 1.02-1.368 1.873v7.396l-1.5 1.5v1.895h2v1.79h16v-1.79h2z"/></svg>
                        <span>{{ $selectedSchedule['airline'] }}</span>
                    </div>
                </div>
                <div class="text-[1.8rem] md:text-[1.4rem] font-extrabold mt-4 text-gold">
                    Rp {{ number_format($selectedSchedule['price'], 0, ',', '.') }} <small class="text-sm opacity-70 font-normal">/ orang</small>
                </div>
            </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('register.submit') }}" method="POST" id="quickBookingForm" class="space-y-6">
                @csrf

                @if($selectedSchedule)
                    <input type="hidden" name="schedule_id" value="{{ $selectedSchedule['id'] }}">
                @else
                    <div>
                        <label class="block font-bold text-[15px] mb-2 text-primary">
                            Pilih Paket Keberangkatan <span class="text-red-500">*</span>
                        </label>
                        <select name="schedule_id" required
                                class="w-full px-5 py-3.5 rounded-xl text-base outline-none transition-all duration-300 cursor-pointer border-2 border-[#E8EBF3] font-[inherit] focus:border-primary focus:ring-3 focus:ring-[#001D5F]/10">
                            <option value="">-- Silakan Pilih Paket --</option>
                            @foreach($schedules as $schedule)
                            <option value="{{ $schedule->id }}" {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
                                {{ $schedule->package_name }} - Rp {{ number_format($schedule->price, 0, ',', '.') }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block font-bold text-[15px] mb-2 text-primary">
                        Nama Lengkap (Sesuai KTP) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="full_name" required minlength="3"
                           placeholder="Contoh: Siti Aminah"
                           value="{{ old('full_name') }}"
                           class="w-full px-5 py-3.5 rounded-xl text-base outline-none transition-all duration-300 border-2 border-[#E8EBF3] font-[inherit] focus:border-primary focus:ring-3 focus:ring-[#001D5F]/10">
                </div>

                {{-- No. WhatsApp --}}
                <div>
                    <label class="block font-bold text-[15px] mb-2 text-primary">
                        Nomor WhatsApp Aktif <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="phone" required pattern="08[0-9]{9,11}"
                           placeholder="Contoh: 081234567890"
                           value="{{ old('phone') }}"
                           class="w-full px-5 py-3.5 rounded-xl text-base outline-none transition-all duration-300 border-2 border-[#E8EBF3] font-[inherit] focus:border-primary focus:ring-3 focus:ring-[#001D5F]/10">
                    <small class="block mt-1 text-sm text-gray-500">Masuk tanpa tanda baca atau spasi. Nomor ini akan digunakan untuk login.</small>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block font-bold text-[15px] mb-2 text-primary">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" required
                           placeholder="Contoh: nama@email.com"
                           value="{{ old('email') }}"
                           class="w-full px-5 py-3.5 rounded-xl text-base outline-none transition-all duration-300 border-2 border-[#E8EBF3] font-[inherit] focus:border-primary focus:ring-3 focus:ring-[#001D5F]/10">
                </div>

                {{-- Jumlah Jamaah --}}
                <div>
                    <label class="block font-bold text-[15px] mb-2 text-primary">
                        Jumlah Jamaah yang Didaftarkan <span class="text-red-500">*</span>
                    </label>
                    <select name="num_people" required
                            class="w-full px-5 py-3.5 rounded-xl text-base outline-none transition-all duration-300 cursor-pointer border-2 border-[#E8EBF3] font-[inherit] focus:border-primary focus:ring-3 focus:ring-[#001D5F]/10">
                        @for($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('num_people', 1) == $i ? 'selected' : '' }}>{{ $i }} Orang</option>
                        @endfor
                    </select>
                </div>

                {{-- Catatan --}}
                <div>
                    <label class="block font-bold text-[15px] mb-2 text-primary">Catatan Tambahan (Opsional)</label>
                    <textarea name="notes" rows="3"
                              placeholder="Tuliskan permintaan khusus jika ada..."
                              class="w-full px-5 py-3.5 rounded-xl text-base outline-none transition-all duration-300 resize-y border-2 border-[#E8EBF3] font-[inherit] focus:border-primary focus:ring-3 focus:ring-[#001D5F]/10">{{ old('notes') }}</textarea>
                </div>

                {{-- Submit --}}
                <button type="submit" id="btnSubmit"
                        class="w-full py-4 rounded-full font-bold text-lg text-white border-0 cursor-pointer transition-all duration-300 hover:-translate-y-0.5 text-center block relative z-10 bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-[0_10px_30px_rgba(16,185,129,0.3)] hover:shadow-[0_15px_40px_rgba(16,185,129,0.4)]">
                    Daftar Sekarang
                    <svg class="w-5 h-5 inline-block ml-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </button>
            </form>

            {{-- Info Note --}}
            <div class="flex gap-4 p-4 rounded-xl mt-6 bg-amber-50 border-2 border-amber-500">
                <svg class="w-6 h-6 shrink-0 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                <div class="flex-1">
                    <strong class="block mb-1 text-sm text-primary">Langkah Selanjutnya:</strong>
                    <p class="m-0 text-sm text-gray-500">
                        Setelah pendaftaran berhasil, Anda akan diarahkan ke Dashboard Jamaah untuk melengkapi data paspor dan mengunggah bukti pembayaran DP.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('quickBookingForm').addEventListener('submit', function() {
    const btn = document.getElementById('btnSubmit');
    btn.disabled = true;
    btn.innerHTML = '<svg class="w-5 h-5 inline-block animate-spin mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';
});

document.querySelector('input[name="phone"]')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 13) value = value.substring(0, 13);
    e.target.value = value;
});
</script>
@endpush