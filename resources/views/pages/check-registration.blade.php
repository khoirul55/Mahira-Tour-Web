@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran - Mahira Tour')

@push('styles')
<style>
.check-section {
    min-height: 100vh;
    background: linear-gradient(135deg, #001D5F 0%, #002B8F 100%);
    padding: 100px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.check-card {
    background: white;
    border-radius: 24px;
    padding: 3rem;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.check-card h1 {
    font-size: 2rem;
    font-weight: 800;
    color: #001D5F;
    margin-bottom: 0.5rem;
}

.check-card p {
    color: #6B7280;
    margin-bottom: 2rem;
}

.form-group-check {
    margin-bottom: 1.5rem;
}

.form-group-check label {
    display: block;
    font-weight: 700;
    color: #001D5F;
    margin-bottom: 0.5rem;
}

.form-control-check {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #E8EBF3;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s;
}

.form-control-check:focus {
    outline: none;
    border-color: #001D5F;
    box-shadow: 0 0 0 3px rgba(0, 29, 95, 0.1);
}

.btn-check {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-check:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
}

.alert-check {
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-danger {
    background: #FEE2E2;
    color: #991B1B;
    border: 2px solid #EF4444;
}

.divider {
    text-align: center;
    margin: 2rem 0;
    color: #6B7280;
    position: relative;
}

.divider::before,
.divider::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background: #E8EBF3;
}

.divider::before { left: 0; }
.divider::after { right: 0; }

.link-register {
    text-align: center;
    margin-top: 1.5rem;
    color: #6B7280;
}

.link-register a {
    color: #001D5F;
    font-weight: 700;
    text-decoration: none;
}

.link-register a:hover {
    text-decoration: underline;
}
</style>
@endpush

@section('content')
<section class="check-section">
    <div class="check-card">
        <h1><i class="bi bi-search"></i> Cek Status Pendaftaran</h1>
        <p>Masukkan nomor registrasi dan email untuk mengakses dashboard Anda</p>
        
        @if($errors->any())
        <div class="alert-check alert-danger">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif
        
        <form action="{{ route('check.registration.submit') }}" method="POST">
            @csrf
            
            <div class="form-group-check">
                <label>Nomor Registrasi <span style="font-weight: normal; color: #666;">atau</span> Nomor HP <span style="color: #EF4444;">*</span></label>
                <input type="text" 
                       name="keyword" 
                       class="form-control-check" 
                       placeholder="Contoh: MHR-xxx atau 0812xxx"
                       value="{{ old('keyword') }}"
                       required>
                <small style="color: #6B7280; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                    Masukkan nomor registrasi (jika tahu) atau nomor WhatsApp yang didaftarkan.
                </small>
            </div>
            
            <div class="form-group-check">
                <label>Email Terdaftar <span style="color: #EF4444;">*</span></label>
                <input type="email" 
                       name="email" 
                       class="form-control-check" 
                       placeholder="email@example.com"
                       value="{{ old('email') }}"
                       required>
            </div>
            
            <button type="submit" class="btn-check">
                <i class="bi bi-box-arrow-in-right"></i> Akses Dashboard
            </button>
        </form>
        
        <div class="divider">ATAU</div>
        
        <div class="link-register">
            Belum punya akun? 
            <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
</section>
@endsection