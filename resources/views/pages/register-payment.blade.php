@extends('layouts.app')
@section('title', 'Pembayaran DP - Mahira Tour')
@push('styles')
<style>
.payment-section{min-height:100vh;background:linear-gradient(180deg,#F8F9FF 0%,#fff 100%);padding:80px 0}
.payment-container{max-width:800px;margin:0 auto}
.payment-header{text-align:center;margin-bottom:3rem}
.payment-header h1{color:#001D5F;font-weight:800}
.info-card{background:#fff;border-radius:20px;padding:2rem;margin-bottom:2rem;box-shadow:0 10px 40px rgba(0,29,95,.1)}
.info-card h3{color:#001D5F;font-weight:700;margin-bottom:1.5rem}
.info-table{width:100%}
.info-table td{padding:1rem 0;border-bottom:1px solid #E8EBF3}
.info-table td:first-child{font-weight:600;color:#6B7280}
.info-table td:last-child{text-align:right;font-weight:700;color:#001D5F}
.dp-highlight{font-size:2rem;color:#D4AF37}
.bank-card{background:linear-gradient(135deg,#001D5F,#002B8F);color:#fff;border-radius:20px;padding:2rem;margin-bottom:2rem;position:relative;overflow:hidden}
.bank-card::before{content:'';position:absolute;top:-50%;right:-50%;width:200%;height:200%;background:radial-gradient(circle,rgba(255,255,255,.1),transparent);border-radius:50%}
.bank-logo{width:80px;margin-bottom:1rem}
.bank-account{font-size:2rem;font-weight:800;letter-spacing:3px;margin:1rem 0}
.btn-copy{background:rgba(255,255,255,.2);color:#fff;border:2px solid rgba(255,255,255,.4);padding:8px 20px;border-radius:50px;cursor:pointer;transition:all .3s}
.btn-copy:hover{background:rgba(255,255,255,.3)}
.upload-form{background:#fff;border-radius:20px;padding:2rem;box-shadow:0 10px 40px rgba(0,29,95,.1)}
.form-group{margin-bottom:1.5rem}
.form-group label{display:block;font-weight:700;color:#001D5F;margin-bottom:.5rem}
.form-select,.file-input{width:100%;padding:1rem;border:2px solid #E8EBF3;border-radius:12px;transition:all .3s}
.form-select:focus,.file-input:focus{outline:none;border-color:#001D5F}
.btn-submit{width:100%;background:linear-gradient(135deg,#10B981,#059669);color:#fff;padding:18px;border-radius:50px;border:none;font-weight:700;font-size:1.1rem;cursor:pointer;transition:all .3s}
.btn-submit:hover{transform:translateY(-3px);box-shadow:0 12px 35px rgba(16,185,129,.3)}
</style>
@endpush
@section('content')
<section class="payment-section">
    <div class="container payment-container">
        <div class="payment-header">
            <h1>Pembayaran DP 30%</h1>
            <p class="text-muted">Nomor Registrasi: <strong>{{ $registration->registration_number }}</strong></p>
        </div>
        
        <div class="info-card">
            <h3>Rincian Pembayaran</h3>
            <table class="info-table">
                <tr>
                    <td>Paket</td>
                    <td>{{ $registration->schedule->package_name }}</td>
                </tr>
                <tr>
                    <td>Jumlah Jamaah</td>
                    <td>{{ $registration->num_people }} orang</td>
</tr>
<tr>
<td>Total Harga</td>
<td>Rp {{ number_format($registration->total_price, 0, ',', '.') }}</td>
</tr>
<tr style="border-bottom:3px solid #D4AF37">
<td><strong>DP 30%</strong></td>
<td><span class="dp-highlight">Rp {{ number_format($registration->dp_amount, 0, ',', '.') }}</span></td>
</tr>
<tr>
<td>Sisa Pelunasan (H-30)</td>
<td>Rp {{ number_format($registration->total_price - $registration->dp_amount, 0, ',', '.') }}</td>
</tr>
</table>
</div>
    <div class="bank-card">
        <h4>Transfer ke Rekening:</h4>
        <p style="opacity:.9">Bank BNI</p>
        <div class="bank-account">1234 5678 9012</div>
        <p>a.n. <strong>PT Mahira Tour & Travel</strong></p>
        <button class="btn-copy" onclick="copyAccount('123456789012')">
            <i class="bi bi-clipboard"></i> Copy Nomor Rekening
        </button>
    </div>
    
    <div class="upload-form">
        <form action="{{ route('register.payment.submit', $registration->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Metode Pembayaran <span style="color:#EF4444">*</span></label>
                <select name="payment_method" class="form-select" required>
                    <option value="">Pilih Metode</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="cash">Cash di Kantor</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Upload Bukti Transfer <span style="color:#EF4444">*</span></label>
                <input type="file" name="payment_proof" class="file-input" accept="image/*,application/pdf" required>
                <small style="color:#6B7280">Format: JPG, PNG, PDF (Max 2MB)</small>
            </div>
            
            <button type="submit" class="btn-submit">
                <i class="bi bi-send"></i> Kirim Bukti Pembayaran
            </button>
        </form>
    </div>
</div>
</section>
@endsection
@push('scripts')
<script>
function copyAccount(text) {
    navigator.clipboard.writeText(text);
    alert('Nomor rekening berhasil dicopy!');
}
</script>
@endpush