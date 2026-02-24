@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran - Mahira Tour')

@section('content')
<section class="min-h-screen flex items-center justify-center relative overflow-hidden py-16 md:py-8 bg-gradient-to-br from-[#001D5F] to-[#002B8F]">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-30 pointer-events-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%201440%20320%22%3E%3Cpath%20fill=%22%23ffffff%22%20fill-opacity=%220.05%22%20d=%22M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z%22/%3E%3C/svg%3E')] bg-bottom bg-no-repeat">
    </div>

    <div class="max-w-[500px] w-full mx-auto relative z-[2] px-4"
         x-data="{ loginMethod: 'phone' }">

        {{-- Card --}}
        <div class="bg-white rounded-3xl md:rounded-2xl p-12 md:p-6 mb-8 md:mb-6 shadow-[0_20px_60px_rgba(0,0,0,0.3)]">

            <h1 class="text-[2rem] md:text-[1.5rem] font-extrabold mb-2 flex items-center gap-3 text-primary">
                <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Cek Pendaftaran
            </h1>
            <p class="mb-8 md:mb-6 text-base md:text-sm text-gray-500">Masuk untuk melihat status dan melengkapi data</p>

            {{-- Error Alert --}}
            @if($errors->any())
            <div class="flex items-center gap-3 p-4 rounded-xl mb-6 bg-red-50 border-2 border-red-500">
                <svg class="w-5 h-5 shrink-0 text-red-900" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <span class="text-sm font-medium text-red-900">{{ $errors->first() }}</span>
            </div>
            @endif

            <form action="{{ route('check.registration.submit') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-6">
                    <label class="block font-bold text-[15px] mb-2 text-primary">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" required
                           placeholder="email@contoh.com"
                           value="{{ old('email') }}"
                           class="w-full px-5 py-3.5 rounded-xl text-base outline-none transition-all duration-300 border-2 border-[#E8EBF3] font-[inherit] focus:border-primary focus:ring-3 focus:ring-[#001D5F]/10">
                </div>

                {{-- Divider --}}
                <div class="relative text-center my-8 text-sm uppercase tracking-wide text-gray-500">
                    <span class="relative z-[1] px-3 bg-white">VERIFIKASI LANJUTAN</span>
                    <div class="absolute top-1/2 left-0 right-0 h-px -translate-y-1/2 bg-[#E8EBF3]"></div>
                </div>

                <p class="text-sm mb-3 text-gray-500">Pilih salah satu metode verifikasi:</p>

                {{-- Method Selection Cards --}}
                <div class="grid grid-cols-2 md:grid-cols-1 gap-3 mb-6">
                    <label class="cursor-pointer">
                        <input type="radio" name="login_method_dummy" value="phone" x-model="loginMethod" class="hidden peer">
                        <div class="flex flex-col md:flex-row items-center justify-center md:justify-start gap-2 p-4 md:p-3 rounded-xl text-center md:text-left transition-all duration-300
                                    peer-checked:bg-[rgba(0,29,95,0.05)]"
                             :class="loginMethod === 'phone' ? 'border-2 border-primary' : 'border-2 border-[#E8EBF3] hover:bg-gray-50'">
                            <svg class="w-6 h-6 md:w-5 md:h-5" :class="loginMethod === 'phone' ? 'text-primary' : 'text-gray-400'" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.832-1.438A9.955 9.955 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18a8 8 0 01-4.257-1.222l-.293-.175-3.045.799.813-2.971-.192-.304A7.963 7.963 0 014 12a8 8 0 1116 0 8 8 0 01-8 8z"/></svg>
                            <span class="font-semibold text-sm" :class="loginMethod === 'phone' ? 'text-primary' : 'text-gray-500'">Nomor WhatsApp</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="login_method_dummy" value="reg" x-model="loginMethod" class="hidden peer">
                        <div class="flex flex-col md:flex-row items-center justify-center md:justify-start gap-2 p-4 md:p-3 rounded-xl text-center md:text-left transition-all duration-300
                                    peer-checked:bg-[rgba(0,29,95,0.05)]"
                             :class="loginMethod === 'reg' ? 'border-2 border-primary' : 'border-2 border-[#E8EBF3] hover:bg-gray-50'">
                            <svg class="w-6 h-6 md:w-5 md:h-5" :class="loginMethod === 'reg' ? 'text-primary' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span class="font-semibold text-sm" :class="loginMethod === 'reg' ? 'text-primary' : 'text-gray-500'">No. Registrasi</span>
                        </div>
                    </label>
                </div>

                {{-- Dynamic Input --}}
                <div class="mb-6">
                    <label class="block font-bold text-[15px] mb-2 text-primary"
                           x-text="loginMethod === 'phone' ? 'Nomor WhatsApp Terdaftar' : 'Nomor Registrasi'"></label>
                    <input type="text" name="keyword" required
                           :placeholder="loginMethod === 'phone' ? 'Contoh: 081234567890' : 'Contoh: MHR-2401-001'"
                           value="{{ old('keyword') }}"
                           class="w-full px-5 py-3.5 rounded-xl text-base outline-none transition-all duration-300 border-2 border-[#E8EBF3] font-[inherit] focus:border-primary focus:ring-3 focus:ring-[#001D5F]/10">
                    <small x-show="loginMethod === 'phone'" class="flex items-center gap-1.5 mt-2 text-sm text-gray-500">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        Masukkan nomor WA yang digunakan saat mendaftar.
                    </small>
                    <small x-show="loginMethod === 'reg'" class="flex items-center gap-1.5 mt-2 text-sm text-gray-500">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        Nomor registrasi ada di pesan WA konfirmasi pendaftaran.
                    </small>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full py-4 rounded-full font-bold text-lg text-white border-0 cursor-pointer transition-all duration-300 hover:-translate-y-0.5 mt-2 flex items-center justify-center gap-2 bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-[0_10px_30px_rgba(16,185,129,0.3)] hover:shadow-[0_15px_40px_rgba(16,185,129,0.4)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Cari Data Pendaftaran
                </button>
            </form>

            {{-- Link Register --}}
            <div class="text-center mt-6 text-sm text-gray-500">
                Belum mendaftar umrah?
                <a href="{{ route('register') }}" class="font-bold no-underline hover:underline text-primary">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</section>
@endsection