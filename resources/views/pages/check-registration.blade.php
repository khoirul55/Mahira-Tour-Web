@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/registration.css?v=2.0') }}">
@endpush

@section('content')
<section class="check-section">
    <div class="check-card" x-data="{ 
        loginMethod: 'phone',
        init() {
            // Optional: Check if error existed previously to persist state if needed
        }
    }">
        <h1><i class="bi bi-shield-lock"></i> Cek Pendaftaran</h1>
        <p class="mb-4">Masuk untuk melihat status dan melengkapi data</p>
        
        @if($errors->any())
        <div class="alert-check alert-danger">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif
        
        <form action="{{ route('check.registration.submit') }}" method="POST">
            @csrf
            
            <!-- Step 1: Email (Always Required) -->
            <div class="form-group-check">
                <label>Alamat Email <span style="color: #EF4444;">*</span></label>
                <input type="email" 
                       name="email" 
                       class="form-control-check" 
                       placeholder="email@contoh.com"
                       value="{{ old('email') }}"
                       required>
            </div>
            
            <div class="divider text-muted small my-4">VERIFIKASI LANJUTAN</div>
            <p class="small text-muted mb-2">Pilih salah satu metode verifikasi:</p>

            <!-- Selection Mode Tabs -->
            <div class="login-method-cards">
                <label class="method-label">
                    <input type="radio" name="login_method_dummy" class="method-input" 
                           value="phone" x-model="loginMethod">
                    <div class="method-card">
                        <i class="bi bi-whatsapp"></i>
                        <span class="method-title">Nomor WhatsApp</span>
                    </div>
                </label>
                
                <label class="method-label">
                    <input type="radio" name="login_method_dummy" class="method-input" 
                           value="reg" x-model="loginMethod">
                    <div class="method-card">
                        <i class="bi bi-card-text"></i>
                        <span class="method-title">No. Registrasi</span>
                    </div>
                </label>
            </div>
            
            <!-- Dynamic Input based on Selection -->
            <div class="form-group-check">
                <label x-text="loginMethod === 'phone' ? 'Nomor WhatsApp Terdaftar' : 'Nomor Registrasi'" class="mb-2 block font-bold text-primary">
                </label>
                
                <input type="text" 
                       name="keyword" 
                       class="form-control-check" 
                       :placeholder="loginMethod === 'phone' ? 'Contoh: 081234567890' : 'Contoh: MHR-2401-001'"
                       value="{{ old('keyword') }}"
                       required>
                       
                <small class="text-muted mt-2 d-block" x-show="loginMethod === 'phone'">
                    <i class="bi bi-info-circle"></i> Masukkan nomor WA yang digunakan saat mendaftar.
                </small>
                <small class="text-muted mt-2 d-block" x-show="loginMethod === 'reg'">
                    <i class="bi bi-info-circle"></i> Nomor registrasi ada di pesan WA konfirmasi pendaftaran.
                </small>
            </div>
            
            <button type="submit" class="btn-check mt-4 d-block w-100 shadow-lg">
                <i class="bi bi-search me-2"></i> Cari Data Pendaftaran
            </button>
        </form>
        
        <div class="link-register">
            Belum mendaftar umrah? 
            <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
</section>
@endsection