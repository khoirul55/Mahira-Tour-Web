@extends('layouts.app')

@section('title', 'Dashboard Pendaftaran - Mahira Tour')

@push('styles')
<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
/* Dashboard Styles */
.dashboard-section {
    min-height: 100vh;
    background: linear-gradient(180deg, #F8F9FF 0%, #fff 100%);
    padding: 80px 0;
}

.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
}

/* Header */
.dashboard-header {
    background: linear-gradient(135deg, #001D5F 0%, #002B8F 100%);
    color: white;
    border-radius: 24px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 40px rgba(0, 29, 95, 0.2);
}

.dashboard-header h1 {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.dashboard-header .reg-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #D4AF37;
    margin-bottom: 1rem;
}

.dashboard-header .deadline {
    background: rgba(255, 255, 255, 0.15);
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
    display: inline-block;
    margin-top: 1rem;
}

/* Progress Bar */
.progress-section {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
}

.progress-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.progress-header h3 {
    font-weight: 700;
    color: #001D5F;
}

.progress-percentage {
    font-size: 2rem;
    font-weight: 800;
    color: #10B981;
}

.progress-bar-container {
    height: 12px;
    background: #E8EBF3;
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #10B981 0%, #059669 100%);
    border-radius: 10px;
    transition: width 0.5s ease;
}

/* Action Cards Grid */
.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.action-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.action-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #E8EBF3;
}

.action-card-header h3 {
    font-weight: 700;
    color: #001D5F;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.action-card-header i {
    font-size: 1.5rem;
    color: #D4AF37;
}

.badge-status {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 700;
}

.badge-pending {
    background: #FEF3C7;
    color: #F59E0B;
}

.badge-complete {
    background: #D1FAE5;
    color: #059669;
}

.badge-waiting {
    background: #DBEAFE;
    color: #2563EB;
}

/* Jamaah List */
.jamaah-item {
    background: #F8F9FF;
    border-radius: 12px;
    padding: 1.25rem;
    margin-bottom: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.jamaah-item.complete {
    background: #D1FAE5;
    border: 2px solid #10B981;
}

.jamaah-info {
    flex: 1;
}

.jamaah-info h4 {
    font-weight: 700;
    color: #001D5F;
    margin-bottom: 0.25rem;
}

.jamaah-info small {
    color: #6B7280;
}

.btn-jamaah {
    padding: 0.5rem 1.25rem;
    background: #001D5F;
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-jamaah:hover {
    background: #002B8F;
    transform: translateY(-2px);
}

.btn-jamaah.complete {
    background: #10B981;
}

/* Payment Section */
.payment-instructions {
    background: #FEF3C7;
    border: 2px solid #F59E0B;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.payment-instructions h4 {
    color: #001D5F;
    font-weight: 700;
    margin-bottom: 1rem;
}

.bank-info {
    background: linear-gradient(135deg, #001D5F 0%, #002B8F 100%);
    color: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
}

.bank-account {
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: 2px;
    margin: 1rem 0;
}

.btn-copy {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.4);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-copy:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Upload Form */
.upload-form {
    margin-top: 1.5rem;
}

.form-group-dash {
    margin-bottom: 1.25rem;
}

.form-group-dash label {
    display: block;
    font-weight: 700;
    color: #001D5F;
    margin-bottom: 0.5rem;
}

.form-control-dash {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #E8EBF3;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s;
}

.form-control-dash:focus {
    outline: none;
    border-color: #001D5F;
    box-shadow: 0 0 0 3px rgba(0, 29, 95, 0.1);
}

.btn-upload {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-upload:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
}

/* Status Messages */
.status-message {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.status-message i {
    font-size: 1.5rem;
}

.status-message.success {
    background: #D1FAE5;
    color: #059669;
    border: 2px solid #10B981;
}

.status-message.info {
    background: #DBEAFE;
    color: #2563EB;
    border: 2px solid #3B82F6;
}

.status-message.warning {
    background: #FEF3C7;
    color: #F59E0B;
    border: 2px solid #F59E0B;
}

/* Contact CS Sticky */
.contact-cs-sticky {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 999;
}

.btn-wa {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.5rem;
    background: #25D366;
    color: white;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    box-shadow: 0 10px 30px rgba(37, 211, 102, 0.4);
    transition: all 0.3s;
}

.btn-wa:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(37, 211, 102, 0.5);
    color: white;
}

.btn-wa i {
    font-size: 1.5rem;
}

/* Alpine.js Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 29, 95, 0.6);
    backdrop-filter: blur(5px);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.modal-container {
    background: white;
    border-radius: 24px;
    max-width: 800px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.modal-header-custom {
    background: linear-gradient(135deg, #001D5F 0%, #002B8F 100%);
    color: white;
    padding: 1.5rem 2rem;
    border-radius: 24px 24px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header-custom h3 {
    margin: 0;
    font-weight: 700;
    font-size: 1.25rem;
}

.modal-close {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
}

.modal-body-custom {
    padding: 2rem;
}

/* Document Upload Card */
.doc-upload-card {
    background: #F8F9FF;
    border: 2px dashed #E8EBF3;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s;
}

.doc-upload-card:hover {
    border-color: #001D5F;
}

.doc-upload-card.uploaded {
    background: #D1FAE5;
    border-color: #10B981;
    border-style: solid;
}

.doc-upload-card .doc-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.doc-upload-card .doc-title {
    font-weight: 700;
    color: #001D5F;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.doc-upload-card .doc-title i {
    color: #D4AF37;
}

.doc-upload-card .doc-status {
    font-size: 0.85rem;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
}

.doc-upload-card .doc-status.pending {
    background: #FEF3C7;
    color: #F59E0B;
}

.doc-upload-card .doc-status.uploaded {
    background: #D1FAE5;
    color: #059669;
}

.doc-upload-input {
    display: none;
}

.doc-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    cursor: pointer;
    border: 2px dashed #CBD5E1;
    border-radius: 12px;
    transition: all 0.3s;
    background: white;
}

.doc-upload-label:hover {
    border-color: #001D5F;
    background: #F8F9FF;
}

.doc-upload-label i {
    font-size: 2.5rem;
    color: #CBD5E1;
    margin-bottom: 0.5rem;
}

.doc-upload-label span {
    color: #6B7280;
    font-size: 0.9rem;
}

.doc-preview {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 12px;
}

.doc-preview img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

.doc-preview .doc-info {
    flex: 1;
}

.doc-preview .doc-name {
    font-weight: 600;
    color: #001D5F;
    font-size: 0.9rem;
}

.doc-preview .doc-size {
    color: #6B7280;
    font-size: 0.8rem;
}

.doc-preview .btn-remove {
    background: #FEE2E2;
    color: #EF4444;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s;
}

.doc-preview .btn-remove:hover {
    background: #EF4444;
    color: white;
}

/* Passport Option */
.passport-option {
    background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
    border: 2px solid #F59E0B;
    border-radius: 16px;
    padding: 1.5rem;
    margin-top: 1.5rem;
}

.passport-option h4 {
    color: #001D5F;
    font-weight: 700;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.passport-option p {
    color: #6B7280;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.passport-checkbox {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
}

.passport-checkbox input[type="checkbox"] {
    width: 24px;
    height: 24px;
    accent-color: #001D5F;
}

.passport-checkbox span {
    font-weight: 600;
    color: #001D5F;
}

/* Modal Footer */
.modal-footer-custom {
    padding: 1.5rem 2rem;
    border-top: 2px solid #E8EBF3;
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.btn-cancel {
    padding: 0.75rem 1.5rem;
    background: #E8EBF3;
    color: #6B7280;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-cancel:hover {
    background: #CBD5E1;
}

.btn-submit {
    padding: 0.75rem 2rem;
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
}

.btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Document List in Card */
.doc-list-mini {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-top: 1rem;
}

.doc-mini-item {
    background: #F8F9FF;
    padding: 0.75rem;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
}

.doc-mini-item i {
    color: #10B981;
}

.doc-mini-item.pending i {
    color: #F59E0B;
}

/* Responsive */
@media (max-width: 768px) {
    .action-grid {
        grid-template-columns: 1fr;
    }
    
    .dashboard-header {
        padding: 2rem 1.5rem;
    }
    
    .dashboard-header h1 {
        font-size: 1.5rem;
    }
    
    .dashboard-header .reg-number {
        font-size: 1.2rem;
    }
    
    .doc-list-mini {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')
<section class="dashboard-section" x-data="dashboardApp()">
    <div class="container dashboard-container">
        
        <!-- Success Message -->
        @if(session('success'))
        <div class="status-message success">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
        </div>
        @endif
        
        @if(session('error'))
        <div class="status-message warning">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>{{ session('error') }}</div>
        </div>
        @endif
        
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>Dashboard Pendaftaran</h1>
            <div class="reg-number">{{ $registration->registration_number }}</div>
            <div>
                <strong>Paket:</strong> {{ $registration->schedule->package_name }}<br>
                <strong>Jamaah:</strong> {{ $registration->num_people }} orang<br>
                <strong>Total:</strong> Rp {{ number_format($registration->total_price, 0, ',', '.') }}
            </div>
            @if($registration->payment_deadline)
            <div class="deadline">
                <i class="bi bi-clock-fill"></i>
                Deadline Upload DP: {{ $registration->payment_deadline->format('d M Y') }}
            </div>
            @endif
        </div>
        
        <!-- Progress Section -->
        <div class="progress-section">
            <div class="progress-header">
                <h3><i class="bi bi-graph-up"></i> Progress Pendaftaran</h3>
                <div class="progress-percentage">{{ $completion }}%</div>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: {{ $completion }}%"></div>
            </div>
            <small style="color: #6B7280; margin-top: 0.5rem; display: block;">
                {{ $completion < 100 ? 'Lengkapi data untuk melanjutkan proses pendaftaran' : 'Pendaftaran lengkap! Menunggu keberangkatan' }}
            </small>
        </div>
        
        <!-- Action Cards Grid -->
        <div class="action-grid">
            
            <!-- Card 1: Data Jamaah -->
            <div class="action-card">
                <div class="action-card-header">
                    <h3><i class="bi bi-people-fill"></i> Data Jamaah</h3>
                    <span class="badge-status {{ $registration->jamaah->every(fn($j) => $j->completion_status === 'complete') ? 'badge-complete' : 'badge-pending' }}">
                        {{ $registration->jamaah->where('completion_status', 'complete')->count() }} / {{ $registration->num_people }} Lengkap
                    </span>
                </div>
                
                @foreach($registration->jamaah as $index => $jamaah)
                <div class="jamaah-item {{ $jamaah->completion_status === 'complete' ? 'complete' : '' }}">
                    <div class="jamaah-info">
                        <h4>
                            @if($jamaah->isPlaceholder())
                                Jamaah {{ $index + 1 }} <small>(Belum Dilengkapi)</small>
                            @else
                                {{ $jamaah->display_name }}
                            @endif
                        </h4>
                        <small>
                            @if($jamaah->completion_status === 'complete')
                                <i class="bi bi-check-circle-fill text-success"></i> Data Lengkap
                            @elseif($jamaah->completion_status === 'partial')
                                <i class="bi bi-exclamation-circle-fill text-warning"></i> Sebagian Lengkap
                            @else
                                <i class="bi bi-circle"></i> Belum Dilengkapi
                            @endif
                        </small>
                    </div>
                    <button class="btn-jamaah {{ $jamaah->completion_status === 'complete' ? 'complete' : '' }}" 
                            @click="openEditJamaah({{ $jamaah->id }}, {{ $index + 1 }})">
                        {{ $jamaah->completion_status === 'complete' ? 'Edit' : 'Lengkapi' }}
                    </button>
                </div>
                @endforeach
                
                <div class="status-message info" style="margin-top: 1rem;">
                    <i class="bi bi-info-circle-fill"></i>
                    <small>Lengkapi data semua jamaah untuk melanjutkan ke tahap berikutnya</small>
                </div>
            </div>
            
            <!-- Card 2: Pembayaran DP -->
            <div class="action-card">
                <div class="action-card-header">
                    <h3><i class="bi bi-credit-card-fill"></i> Pembayaran DP</h3>
                    <span class="badge-status {{ $dpPayment && $dpPayment->status === 'verified' ? 'badge-complete' : ($dpPayment && $dpPayment->proof_path ? 'badge-waiting' : 'badge-pending') }}">
                        @if($dpPayment && $dpPayment->status === 'verified')
                            Verified
                        @elseif($dpPayment && $dpPayment->proof_path)
                            Menunggu Verifikasi
                        @else
                            Belum Upload
                        @endif
                    </span>
                </div>
                
                @if($dpPayment && $dpPayment->status === 'verified')
                    <!-- DP Verified -->
                    <div class="status-message success">
                        <i class="bi bi-check-circle-fill"></i>
                        <div>
                            <strong>DP Sudah Diverifikasi!</strong><br>
                            <small>Verified pada {{ $dpPayment->verified_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>
                    
                @elseif($dpPayment && $dpPayment->proof_path)
                    <!-- DP Uploaded, Waiting Verification -->
                    <div class="status-message info">
                        <i class="bi bi-clock-fill"></i>
                        <div>
                            <strong>Bukti DP Sudah Diupload</strong><br>
                            <small>Menunggu verifikasi admin (1x24 jam)</small>
                        </div>
                    </div>
                    
                @else
                    <!-- Need to Upload DP -->
                    <div class="payment-instructions">
                        <h4>Transfer DP 30%</h4>
                        <p style="margin: 0; color: #6B7280;">
                            <strong style="font-size: 1.5rem; color: #001D5F;">Rp {{ number_format($registration->dp_amount, 0, ',', '.') }}</strong>
                        </p>
                    </div>
                    
                    <div class="bank-info">
                        <p style="margin: 0; opacity: 0.9;">Bank BNI</p>
                        <div class="bank-account">1234 5678 9012</div>
                        <p style="margin: 0;">a.n. <strong>PT Mahira Tour & Travel</strong></p>
                        <button class="btn-copy" @click="copyAccount('123456789012')">
                            <i class="bi bi-clipboard"></i> Copy Nomor Rekening
                        </button>
                    </div>
                    
                    <form action="{{ route('register.payment', $registration->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data" 
                          class="upload-form">
                        @csrf
                        
                        <div class="form-group-dash">
                            <label>Metode Pembayaran</label>
                            <select name="payment_method" class="form-control-dash" required>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cash">Cash di Kantor</option>
                            </select>
                        </div>
                        
                        <div class="form-group-dash">
                            <label>Upload Bukti Transfer</label>
                            <input type="file" 
                                   name="payment_proof" 
                                   class="form-control-dash" 
                                   accept="image/*,application/pdf" 
                                   required>
                            <small style="color: #6B7280; font-size: 0.85rem;">JPG, PNG, PDF (Max 2MB)</small>
                        </div>
                        
                        <button type="submit" class="btn-upload">
                            <i class="bi bi-cloud-upload-fill"></i> Upload Bukti DP
                        </button>
                    </form>
                @endif
            </div>
            
            </div>
            
            <!-- ✅ TAMBAHKAN KODE PELUNASAN DI SINI -->
            @php
                $pelunasan = $registration->pelunasanPayment();
                $needsPelunasan = $registration->needsPelunasan();
            @endphp

            @if($registration->is_lunas)
                <!-- STATUS LUNAS -->
                <div class="action-card">
                    <div class="action-card-header">
                        <h3><i class="bi bi-check-circle-fill"></i> Status Pembayaran</h3>
                        <span class="badge-status badge-complete">LUNAS</span>
                    </div>
                    <div class="status-message success">
                        <i class="bi bi-check-circle-fill"></i>
                        <div>
                            <strong>Pembayaran Lengkap! ✅</strong><br>
                            <small>Semua pembayaran telah lunas.</small>
                        </div>
                    </div>
                </div>

            @elseif($needsPelunasan)
                <!-- CARD PELUNASAN -->
                <div class="action-card">
                    <div class="action-card-header">
                        <h3><i class="bi bi-wallet"></i> Pelunasan</h3>
                        <span class="badge-status {{ $pelunasan && $pelunasan->status === 'pending' ? 'badge-waiting' : 'badge-pending' }}">
                            @if($pelunasan && $pelunasan->status === 'pending')
                                Menunggu Verifikasi
                            @else
                                Belum Bayar
                            @endif
                        </span>
                    </div>
                    
                    <div class="payment-instructions">
                        <h4>Sisa Pelunasan</h4>
                        <p style="margin: 0; color: #6B7280;">
                            <strong style="font-size: 1.8rem; color: #DC2626;">Rp {{ number_format($registration->sisaPelunasan(), 0, ',', '.') }}</strong>
                        </p>
                        <small>Deadline: <strong class="text-danger">{{ $registration->pelunasan_deadline?->format('d M Y') }}</strong></small>
                    </div>
                    
                    @if($pelunasan && $pelunasan->status === 'pending')
                        <div class="status-message info">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <strong>Bukti pelunasan sudah diupload</strong><br>
                                <small>Menunggu verifikasi admin (1x24 jam)</small>
                            </div>
                        </div>
                    @elseif($pelunasan && $pelunasan->status === 'rejected')
                        <div class="status-message warning">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <div>
                                <strong>Bukti ditolak!</strong><br>
                                <small>{{ $pelunasan->rejection_notes }}</small>
                            </div>
                        </div>
                    @else
                        <div class="bank-info">
                            <p style="margin: 0; opacity: 0.9;">Bank BCA</p>
                            <div class="bank-account">1234 5678 9012</div>
                            <p style="margin: 0;">a.n. <strong>PT Mahira Tour</strong></p>
                        </div>
                    <!-- Tambahkan di section pelunasan sebelum form upload -->
                        @if($needsPelunasan && !$pelunasan)
                        <div style="margin-bottom: 1.5rem;">
                            <a href="https://wa.me/6282184515310?text=Halo%20Admin%20Mahira%20Tour,%0A%0ASaya%20ingin%20melakukan%20pelunasan:%0ANo.%20Registrasi:%20{{ $registration->registration_number }}%0ANama:%20{{ $registration->full_name }}%0ASisa%20Pelunasan:%20Rp%20{{ number_format($registration->sisaPelunasan(), 0, ',', '.') }}%0A%0AMohon%20info%20rekening.%20Terima%20kasih!" 
                            target="_blank"
                            class="btn-wa"
                            style="display: inline-flex; width: 100%; justify-content: center; align-items: center; gap: 0.5rem; padding: 1rem; background: #25D366; color: white; border-radius: 50px; text-decoration: none; font-weight: 600; margin-bottom: 1rem;">
                                <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
                                Bayar via WhatsApp Admin
                            </a>
                            <p style="text-align: center; font-size: 0.85rem; color: #6B7280;">Atau upload bukti transfer di bawah:</p>
                        </div>
                        @endif    
                        <form action="{{ route('registration.submit-pelunasan', $registration->id) }}" 
                              method="POST" 
                              enctype="multipart/form-data" 
                              class="upload-form">
                            @csrf
                            <div class="form-group-dash">
                                <label>Metode Pembayaran</label>
                                <select name="payment_method" class="form-control-dash" required>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <div class="form-group-dash">
                                <label>Upload Bukti Pelunasan</label>
                                <input type="file" name="payment_proof" class="form-control-dash" accept="image/*,.pdf" required>
                            </div>
                            <button type="submit" class="btn-upload">
                                <i class="bi bi-cloud-upload-fill"></i> Upload Bukti Pelunasan
                            </button>
                        </form>
                    @endif
                </div>
            @endif
            <!-- ✅ AKHIR KODE PELUNASAN -->
            
            <!-- Card 3: Upload Dokumen -->

            <!-- Card 3: Upload Dokumen -->
            <div class="action-card">
                <div class="action-card-header">
                    <h3><i class="bi bi-file-earmark-check-fill"></i> Upload Dokumen</h3>
                    @php
                        $totalDocs = $registration->jamaah->sum(fn($j) => $j->documents->count());
                        $requiredDocs = $registration->num_people * 3; // KTP, KK, Foto per jamaah
                    @endphp
                    <span class="badge-status {{ $totalDocs >= $requiredDocs ? 'badge-complete' : 'badge-pending' }}">
                        {{ $totalDocs }} / {{ $requiredDocs }} Dokumen
                    </span>
                </div>
                
                @if($registration->hasDPVerified())
                    <div class="status-message info" style="margin-bottom: 1rem;">
                        <i class="bi bi-info-circle-fill"></i>
                        <small>Upload dokumen KTP, KK, Foto, dan Buku Nikah (jika menikah) untuk setiap jamaah</small>
                    </div>
                    
                    @foreach($registration->jamaah as $index => $jamaah)
                    <div class="jamaah-item">
                        <div class="jamaah-info">
                            <h4>{{ $jamaah->isPlaceholder() ? 'Jamaah ' . ($index + 1) : $jamaah->display_name }}</h4>
                            <small>
                                <i class="bi bi-file-earmark"></i> {{ $jamaah->documents->count() }} dokumen diupload
                            </small>
                        </div>
                        <button class="btn-jamaah" @click="openDocumentModal({{ $jamaah->id }}, '{{ $jamaah->isPlaceholder() ? 'Jamaah ' . ($index + 1) : $jamaah->display_name }}', {{ $index + 1 }})">
                            <i class="bi bi-cloud-upload"></i> Upload
                        </button>
                    </div>
                    @endforeach
                @else
                    <div class="status-message warning">
                        <i class="bi bi-lock-fill"></i>
                        <small>Upload dokumen dapat dilakukan setelah DP diverifikasi admin</small>
                    </div>
                @endif
            </div>
            
        </div>
        
    </div>
    
    <!-- ========================================== -->
    <!-- MODAL: Edit Data Jamaah (Alpine.js) -->
    <!-- ========================================== -->
    <div x-show="showJamaahModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="modal-overlay"
         @click.self="showJamaahModal = false"
         style="display: none;">
        <div class="modal-container" @click.stop>
            <div class="modal-header-custom">
                <h3><i class="bi bi-person-fill-gear"></i> Lengkapi Data Jamaah <span x-text="jamaahNumber"></span></h3>
                <button class="modal-close" @click="showJamaahModal = false">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div class="modal-body-custom">
                <form id="formEditJamaah" @submit.prevent="submitJamaahForm">
                    <input type="hidden" x-model="jamaahId">
                    
                    <!-- Identitas -->
                    <h6 style="color: #001D5F; font-weight: 700; margin-bottom: 1rem;">
                        <i class="bi bi-person-badge"></i> Identitas
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Gelar <span class="text-danger">*</span></label>
                            <select x-model="jamaahData.title" class="form-control-dash" required>
                                <option value="">Pilih</option>
                                <option value="Tn.">Tn.</option>
                                <option value="Ny.">Ny.</option>
                                <option value="Nn.">Nn.</option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <label class="form-label fw-bold">Nama Lengkap (Sesuai KTP) <span class="text-danger">*</span></label>
                            <input type="text" x-model="jamaahData.full_name" class="form-control-dash" required>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">NIK <span class="text-danger">*</span></label>
                            <input type="text" x-model="jamaahData.nik" class="form-control-dash" maxlength="16" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select x-model="jamaahData.gender" class="form-control-dash" required>
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Gol. Darah</label>
                            <select x-model="jamaahData.blood_type" class="form-control-dash">
                                <option value="">-</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" x-model="jamaahData.birth_place" class="form-control-dash" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" x-model="jamaahData.birth_date" class="form-control-dash" required>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status Pernikahan <span class="text-danger">*</span></label>
                            <select x-model="jamaahData.marital_status" class="form-control-dash" required>
                                <option value="">Pilih</option>
                                <option value="single">Belum Menikah</option>
                                <option value="married">Menikah</option>
                                <option value="divorced">Cerai</option>
                                <option value="widowed">Duda/Janda</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Ayah Kandung <span class="text-danger">*</span></label>
                            <input type="text" x-model="jamaahData.father_name" class="form-control-dash" required>
                            <small class="text-muted">Untuk keperluan passport</small>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-12">
                            <label class="form-label fw-bold">Pekerjaan <span class="text-danger">*</span></label>
                            <input type="text" x-model="jamaahData.occupation" class="form-control-dash" required>
                        </div>
                    </div>
                    
                    <!-- Alamat -->
                    <h6 style="color: #001D5F; font-weight: 700; margin: 2rem 0 1rem;">
                        <i class="bi bi-geo-alt-fill"></i> Alamat
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea x-model="jamaahData.address" class="form-control-dash" rows="2" required></textarea>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Provinsi</label>
                            <input type="text" x-model="jamaahData.province" class="form-control-dash">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kota/Kabupaten</label>
                            <input type="text" x-model="jamaahData.city" class="form-control-dash">
                        </div>
                    </div>
                    
                    <!-- Kontak Darurat -->
                    <h6 style="color: #001D5F; font-weight: 700; margin: 2rem 0 1rem;">
                        <i class="bi bi-telephone-fill"></i> Kontak Darurat
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nama <span class="text-danger">*</span></label>
                            <input type="text" x-model="jamaahData.emergency_name" class="form-control-dash" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Hubungan <span class="text-danger">*</span></label>
                            <select x-model="jamaahData.emergency_relation" class="form-control-dash" required>
                                <option value="">Pilih</option>
                                <option value="ayah">Ayah</option>
                                <option value="ibu">Ibu</option>
                                <option value="suami">Suami</option>
                                <option value="istri">Istri</option>
                                <option value="anak">Anak</option>
                                <option value="saudara">Saudara</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">No. Telepon <span class="text-danger">*</span></label>
                            <input type="tel" x-model="jamaahData.emergency_phone" class="form-control-dash" required>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer-custom">
                <button type="button" class="btn-cancel" @click="showJamaahModal = false">Batal</button>
                <button type="button" class="btn-submit" @click="submitJamaahForm" :disabled="isSubmitting">
                    <span x-show="!isSubmitting"><i class="bi bi-save"></i> Simpan Data</span>
                    <span x-show="isSubmitting"><i class="bi bi-hourglass-split"></i> Menyimpan...</span>
                </button>
            </div>
        </div>
    </div>
    
    <!-- ========================================== -->
    <!-- MODAL: Upload Dokumen (Alpine.js) -->
    <!-- ========================================== -->
    <div x-show="showDocModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="modal-overlay"
         @click.self="showDocModal = false"
         style="display: none;">
        <div class="modal-container" @click.stop>
            <div class="modal-header-custom">
                <h3><i class="bi bi-file-earmark-arrow-up"></i> Upload Dokumen - <span x-text="docJamaahName"></span></h3>
                <button class="modal-close" @click="showDocModal = false">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div class="modal-body-custom">
                <form id="formUploadDoc" @submit.prevent="submitDocuments">
                    <input type="hidden" x-model="docJamaahId">
                    
                    <!-- KTP -->
                    <div class="doc-upload-card" :class="{ 'uploaded': documents.ktp.file }">
                        <div class="doc-header">
                            <div class="doc-title">
                                <i class="bi bi-card-heading"></i>
                                KTP <span class="text-danger">*</span>
                            </div>
                            <span class="doc-status" :class="documents.ktp.file ? 'uploaded' : 'pending'">
                                <span x-text="documents.ktp.file ? 'Siap Upload' : 'Belum Upload'"></span>
                            </span>
                        </div>
                        
                        <template x-if="!documents.ktp.file">
                            <label class="doc-upload-label">
                                <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'ktp')">
                                <i class="bi bi-cloud-upload"></i>
                                <span>Klik untuk upload KTP</span>
                                <small style="color: #9CA3AF; font-size: 0.8rem;">JPG, PNG, PDF (Max 2MB)</small>
                            </label>
                        </template>
                        
                        <template x-if="documents.ktp.file">
                            <div class="doc-preview">
                                <img :src="documents.ktp.preview || '/images/doc-icon.png'" alt="KTP Preview">
                                <div class="doc-info">
                                    <div class="doc-name" x-text="documents.ktp.file.name"></div>
                                    <div class="doc-size" x-text="formatFileSize(documents.ktp.file.size)"></div>
                                </div>
                                <button type="button" class="btn-remove" @click="removeFile('ktp')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <!-- Kartu Keluarga -->
                    <div class="doc-upload-card" :class="{ 'uploaded': documents.kk.file }">
                        <div class="doc-header">
                            <div class="doc-title">
                                <i class="bi bi-people"></i>
                                Kartu Keluarga (KK) <span class="text-danger">*</span>
                            </div>
                            <span class="doc-status" :class="documents.kk.file ? 'uploaded' : 'pending'">
                                <span x-text="documents.kk.file ? 'Siap Upload' : 'Belum Upload'"></span>
                            </span>
                        </div>
                        
                        <template x-if="!documents.kk.file">
                            <label class="doc-upload-label">
                                <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'kk')">
                                <i class="bi bi-cloud-upload"></i>
                                <span>Klik untuk upload Kartu Keluarga</span>
                                <small style="color: #9CA3AF; font-size: 0.8rem;">JPG, PNG, PDF (Max 2MB)</small>
                            </label>
                        </template>
                        
                        <template x-if="documents.kk.file">
                            <div class="doc-preview">
                                <img :src="documents.kk.preview || '/images/doc-icon.png'" alt="KK Preview">
                                <div class="doc-info">
                                    <div class="doc-name" x-text="documents.kk.file.name"></div>
                                    <div class="doc-size" x-text="formatFileSize(documents.kk.file.size)"></div>
                                </div>
                                <button type="button" class="btn-remove" @click="removeFile('kk')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <!-- Foto -->
                    <div class="doc-upload-card" :class="{ 'uploaded': documents.photo.file }">
                        <div class="doc-header">
                            <div class="doc-title">
                                <i class="bi bi-camera"></i>
                                Pas Foto 4x6 <span class="text-danger">*</span>
                            </div>
                            <span class="doc-status" :class="documents.photo.file ? 'uploaded' : 'pending'">
                                <span x-text="documents.photo.file ? 'Siap Upload' : 'Belum Upload'"></span>
                            </span>
                        </div>
                        
                        <template x-if="!documents.photo.file">
                            <label class="doc-upload-label">
                                <input type="file" class="doc-upload-input" accept="image/*" @change="handleFileSelect($event, 'photo')">
                                <i class="bi bi-cloud-upload"></i>
                                <span>Klik untuk upload Pas Foto</span>
                                <small style="color: #9CA3AF; font-size: 0.8rem;">JPG, PNG (Max 2MB) - Background putih</small>
                            </label>
                        </template>
                        
                        <template x-if="documents.photo.file">
                            <div class="doc-preview">
                                <img :src="documents.photo.preview || '/images/doc-icon.png'" alt="Photo Preview">
                                <div class="doc-info">
                                    <div class="doc-name" x-text="documents.photo.file.name"></div>
                                    <div class="doc-size" x-text="formatFileSize(documents.photo.file.size)"></div>
                                </div>
                                <button type="button" class="btn-remove" @click="removeFile('photo')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <!-- Buku Nikah (Opsional) -->
                    <div class="doc-upload-card" :class="{ 'uploaded': documents.buku_nikah.file }">
                        <div class="doc-header">
                            <div class="doc-title">
                                <i class="bi bi-heart"></i>
                                Buku Nikah <small class="text-muted">(Jika sudah menikah)</small>
                            </div>
                            <span class="doc-status" :class="documents.buku_nikah.file ? 'uploaded' : 'pending'">
                                <span x-text="documents.buku_nikah.file ? 'Siap Upload' : 'Opsional'"></span>
                            </span>
                        </div>
                        
                        <template x-if="!documents.buku_nikah.file">
                            <label class="doc-upload-label">
                                <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'buku_nikah')">
                                <i class="bi bi-cloud-upload"></i>
                                <span>Klik untuk upload Buku Nikah</span>
                                <small style="color: #9CA3AF; font-size: 0.8rem;">JPG, PNG, PDF (Max 2MB)</small>
                            </label>
                        </template>
                        
                        <template x-if="documents.buku_nikah.file">
                            <div class="doc-preview">
                                <img :src="documents.buku_nikah.preview || '/images/doc-icon.png'" alt="Buku Nikah Preview">
                                <div class="doc-info">
                                    <div class="doc-name" x-text="documents.buku_nikah.file.name"></div>
                                    <div class="doc-size" x-text="formatFileSize(documents.buku_nikah.file.size)"></div>
                                </div>
                                <button type="button" class="btn-remove" @click="removeFile('buku_nikah')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <!-- Passport Option -->
                    <div class="passport-option">
                        <h4><i class="bi bi-passport"></i> Passport</h4>
                        <p>Jika Anda belum memiliki passport, tim Mahira Tour dapat membantu pembuatan passport Anda.</p>
                        
                        <div class="doc-upload-card" :class="{ 'uploaded': documents.passport.file }" x-show="!noPassport" style="margin-bottom: 1rem;">
                            <div class="doc-header">
                                <div class="doc-title">
                                    <i class="bi bi-passport-fill"></i>
                                    Upload Passport
                                </div>
                                <span class="doc-status" :class="documents.passport.file ? 'uploaded' : 'pending'">
                                    <span x-text="documents.passport.file ? 'Siap Upload' : 'Belum Upload'"></span>
                                </span>
                            </div>
                            
                            <template x-if="!documents.passport.file">
                                <label class="doc-upload-label">
                                    <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'passport')">
                                    <i class="bi bi-cloud-upload"></i>
                                    <span>Klik untuk upload Passport</span>
                                    <small style="color: #9CA3AF; font-size: 0.8rem;">JPG, PNG, PDF (Max 2MB)</small>
                                </label>
                            </template>
                            
                            <template x-if="documents.passport.file">
                                <div class="doc-preview">
                                    <img :src="documents.passport.preview || '/images/doc-icon.png'" alt="Passport Preview">
                                    <div class="doc-info">
                                        <div class="doc-name" x-text="documents.passport.file.name"></div>
                                        <div class="doc-size" x-text="formatFileSize(documents.passport.file.size)"></div>
                                    </div>
                                    <button type="button" class="btn-remove" @click="removeFile('passport')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </template>
                        </div>
                        
                        <label class="passport-checkbox">
                            <input type="checkbox" x-model="noPassport" @change="if(noPassport) removeFile('passport')">
                            <span>Saya belum punya passport, mohon dibuatkan oleh tim Mahira Tour</span>
                        </label>
                        
                        <div x-show="noPassport" class="status-message info" style="margin-top: 1rem;">
                            <i class="bi bi-info-circle-fill"></i>
                            <small>Tim kami akan menghubungi Anda untuk proses pembuatan passport. Pastikan dokumen KTP & KK sudah di-upload.</small>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer-custom">
                <button type="button" class="btn-cancel" @click="showDocModal = false">Batal</button>
                <button type="button" class="btn-submit" @click="submitDocuments" :disabled="isUploading || !canSubmitDocs">
                    <span x-show="!isUploading"><i class="bi bi-cloud-upload"></i> Upload Dokumen</span>
                    <span x-show="isUploading"><i class="bi bi-hourglass-split"></i> Mengupload...</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Contact CS Sticky -->
<div class="contact-cs-sticky">
    <a href="https://wa.me/6282184515310?text=Halo%20Mahira%20Tour,%20saya%20butuh%20bantuan.%20Nomor%20Registrasi:%20{{ $registration->registration_number }}" 
       class="btn-wa" 
       target="_blank">
        <i class="bi bi-whatsapp"></i>
        <span>Butuh Bantuan?</span>
    </a>
</div>
@endsection

@push('scripts')
<script>
function dashboardApp() {
    return {
        // Modal States
        showJamaahModal: false,
        showDocModal: false,
        
        // Jamaah Data
        jamaahId: null,
        jamaahNumber: '',
        jamaahData: {
            title: '',
            full_name: '',
            nik: '',
            gender: '',
            blood_type: '',
            birth_place: '',
            birth_date: '',
            marital_status: '',
            father_name: '',
            occupation: '',
            address: '',
            province: '',
            city: '',
            emergency_name: '',
            emergency_relation: '',
            emergency_phone: ''
        },
        
        // Document Data
        docJamaahId: null,
        docJamaahName: '',
        documents: {
            ktp: { file: null, preview: null },
            kk: { file: null, preview: null },
            photo: { file: null, preview: null },
            buku_nikah: { file: null, preview: null },
            passport: { file: null, preview: null }
        },
        noPassport: false,
        
        // Loading States
        isSubmitting: false,
        isUploading: false,
        
        // Computed
        get canSubmitDocs() {
            return this.documents.ktp.file && this.documents.kk.file && this.documents.photo.file;
        },
        
        // Methods
        copyAccount(text) {
            navigator.clipboard.writeText(text);
            alert('✅ Nomor rekening berhasil dicopy!');
        },
        
        async openEditJamaah(id, number) {
            this.jamaahId = id;
            this.jamaahNumber = number;
            
            try {
                const response = await fetch(`/api/jamaah/${id}?token={{ request('token') }}`);
                const data = await response.json();
                
                this.jamaahData = {
                    title: data.title || '',
                    full_name: data.full_name && !data.full_name.includes('Belum Dilengkapi') ? data.full_name : '',
                    nik: data.nik !== 'PENDING' ? data.nik : '',
                    gender: data.gender || '',
                    blood_type: data.blood_type || '',
                    birth_place: data.birth_place !== '-' ? data.birth_place : '',
                    birth_date: data.birth_date || '',
                    marital_status: data.marital_status || '',
                    father_name: data.father_name !== '-' ? data.father_name : '',
                    occupation: data.occupation !== '-' ? data.occupation : '',
                    address: data.address !== '-' ? data.address : '',
                    province: data.province || '',
                    city: data.city || '',
                    emergency_name: data.emergency_name !== '-' ? data.emergency_name : '',
                    emergency_relation: data.emergency_relation !== '-' ? data.emergency_relation : '',
                    emergency_phone: data.emergency_phone !== '-' ? data.emergency_phone : ''
                };
                
                this.showJamaahModal = true;
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memuat data jamaah');
            }
        },
        
        async submitJamaahForm() {
            this.isSubmitting = true;
            
            try {
                const response = await fetch(`/api/jamaah/${this.jamaahId}?token={{ request('token') }}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.jamaahData)
                });
                
                const data = await response.json();
                
                if (data.success) {
                    alert('✅ Data jamaah berhasil disimpan!');
                    location.reload();
                } else {
                    alert('❌ ' + (data.message || 'Gagal menyimpan data'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan saat menyimpan data');
            } finally {
                this.isSubmitting = false;
            }
        },
        
        async openDocumentModal(jamaahId, jamaahName, index) {
            this.docJamaahId = jamaahId;
            this.docJamaahName = jamaahName;
            
            // Reset documents
            this.documents = {
                ktp: { file: null, preview: null, exists: false },
                kk: { file: null, preview: null, exists: false },
                photo: { file: null, preview: null, exists: false },
                buku_nikah: { file: null, preview: null, exists: false },
                passport: { file: null, preview: null, exists: false }
            };
            this.noPassport = false;
            
            // Fetch existing documents
            try {
                const response = await fetch(`/api/jamaah/${jamaahId}?token={{ request('token') }}`);
                const data = await response.json();
                
                if (data.documents) {
                    Object.keys(data.documents).forEach(type => {
                        if (this.documents[type]) {
                            this.documents[type].exists = true;
                            this.documents[type].preview = data.documents[type].url;
                            // Dummy file object for display logic
                            this.documents[type].file = { name: data.documents[type].file_name, size: 0 }; 
                        }
                    });
                }
                
                if (data.need_passport) {
                    this.noPassport = true;
                }
            } catch (error) {
                console.error('Error fetching docs:', error);
            }
            
            this.showDocModal = true;
        },
        
        handleFileSelect(event, docType) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('❌ Ukuran file maksimal 2MB');
                event.target.value = '';
                return;
            }
            
            this.documents[docType].file = file;
            this.documents[docType].exists = false; // Reset exists flag as this is new
            
            // Create preview for images
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.documents[docType].preview = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                this.documents[docType].preview = null;
            }
        },
        
        removeFile(docType) {
            this.documents[docType] = { file: null, preview: null, exists: false };
        },
        
        formatFileSize(bytes) {
            if (bytes === 0) return 'Existing File';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },
        
        async submitDocuments() {
            // Check if required docs are present (either existing or new file)
            // Note: KTP, KK, Photo are required
            const ktpOk = this.documents.ktp.file;
            const kkOk = this.documents.kk.file;
            const photoOk = this.documents.photo.file;
            
            if (!ktpOk || !kkOk || !photoOk) {
                alert('❌ Mohon upload/lengkapi dokumen wajib: KTP, KK, dan Pas Foto');
                return;
            }
            
            this.isUploading = true;
            
            try {
                const docTypes = ['ktp', 'kk', 'photo', 'buku_nikah', 'passport'];
                let uploadCount = 0;
                
                for (const docType of docTypes) {
                    // Only upload if it's a NEW file (instanceof File)
                    if (this.documents[docType].file && this.documents[docType].file instanceof File) {
                        const formData = new FormData();
                        formData.append('jamaah_id', this.docJamaahId);
                        formData.append('document_type', docType);
                        formData.append('document', this.documents[docType].file);
                        
                        const response = await fetch(`/register/{{ $registration->id }}/documents`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });
                        
                        if (!response.ok) {
                            throw new Error(`Gagal upload ${docType}`);
                        }
                        uploadCount++;
                    }
                }
                
                // Save no passport preference
                if (this.noPassport) {
                    await fetch(`/api/jamaah/${this.docJamaahId}/passport-request?token={{ request('token') }}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ need_passport: true })
                    });
                }
                
                if (uploadCount > 0 || this.noPassport) {
                    alert('✅ Dokumen berhasil diupdate!');
                    location.reload();
                } else {
                    alert('⚠️ Tidak ada dokumen baru yang diupload.');
                    this.showDocModal = false;
                }
                
            } catch (error) {
                console.error('Error:', error);
                alert('❌ ' + error.message);
            } finally {
                this.isUploading = false;
            }
        }
    }
}
</script>
@endpush