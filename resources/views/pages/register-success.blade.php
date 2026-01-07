@extends('layouts.app')
@section('title', 'Pendaftaran Berhasil - Mahira Tour')
@push('styles')
<style>
.success-section{min-height:100vh;background:linear-gradient(180deg,#F8F9FF 0%,#fff 100%);padding:100px 0}
.success-card{max-width:700px;margin:0 auto;background:#fff;border-radius:24px;padding:3rem;box-shadow:0 20px 60px rgba(0,29,95,.15);text-align:center}
.success-icon{width:120px;height:120px;margin:0 auto 2rem;background:linear-gradient(135deg,#10B981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;animation:scaleIn .5s ease-out}
.success-icon i{font-size:4rem;color:#fff}
@keyframes scaleIn{0%{transform:scale(0)}50%{transform:scale(1.1)}100%{transform:scale(1)}}
.registration-number{font-size:2.5rem;font-weight:800;color:#001D5F;letter-spacing:2px;margin:1rem 0}
.info-box{background:#FEF3C7;border:2px solid #D4AF37;border-radius:16px;padding:1.5rem;margin:2rem 0;text-align:left}
.info-box ol{margin:0;padding-left:1.5rem}
.quick-actions{display:flex;gap:1rem;margin-top:2rem;justify-content:center;flex-wrap:wrap}
.btn-home,.btn-wa{padding:15px 30px;border-radius:50px;font-weight:700;text-decoration:none;transition:all .3s}
.btn-home{background:#001D5F;color:#fff}
.btn-wa{background:#25D366;color:#fff}
.btn-home:hover,.btn-wa:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,0,0,.2);color:#fff}
</style>
@endpush
@section('content')
<section class="success-section">
    <div class="container">
        <div class="success-card">
            <div class="success-icon"><i class="bi bi-check-circle-fill"></i></div>
            <h1>Pendaftaran Berhasil!</h1>
            <p class="text-muted">Terima kasih telah mendaftar di Mahira Tour</p>
            <div class="registration-info mt-4">
                <p class="mb-2">Nomor Registrasi Anda:</p>
                <h2 class="registration-number">{{ $registration->registration_number }}</h2>
                <small class="text-muted">Simpan nomor ini untuk tracking</small>
            </div>
            <div class="info-box">
                <strong><i class="bi bi-info-circle-fill"></i> Langkah Selanjutnya:</strong>
                <ol class="mt-2">
                    <li>Upload dokumen: KTP, KK, Pas Foto 4x6</li>
                    <li>Transfer DP 30%: <strong>Rp {{ number_format($registration->dp_amount, 0, ',', '.') }}</strong></li>
                    <li>Tim kami akan verifikasi dalam 1x24 jam</li>
                </ol>
            </div>
            <div class="quick-actions">
                <a href="{{ route('register.documents', $registration->id) }}" class="btn-home">
                    <i class="bi bi-cloud-upload"></i> Upload Dokumen
                </a>
                <a href="https://wa.me/6282184515310?text=Nomor%20Registrasi%3A%20{{ $registration->registration_number }}" 
                   class="btn-wa" target="_blank">
                    <i class="bi bi-whatsapp"></i> Hubungi CS
                </a>
            </div>
        </div>
    </div>
</section>
@endsection