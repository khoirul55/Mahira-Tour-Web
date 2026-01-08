@extends('layouts.app')

@section('title', 'Dashboard Pendaftaran - Mahira Tour')

@push('styles')
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
}
</style>
@endpush

@section('content')
<section class="dashboard-section">
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
                                onclick="openEditJamaah({{ $jamaah->id }}, {{ $index + 1 }})">
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
                        <button class="btn-copy" onclick="copyAccount('123456789012')">
                            <i class="bi bi-clipboard"></i> Copy Nomor Rekening
                        </button>
                    </div>
                    
                    <form action="{{ route('register.payment.submit', $registration->id) }}" 
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
            
            <!-- Card 3: Upload Dokumen -->
            <div class="action-card">
                <div class="action-card-header">
                    <h3><i class="bi bi-file-earmark-check-fill"></i> Upload Dokumen</h3>
                    <span class="badge-status badge-pending">0 / {{ $registration->num_people }} Lengkap</span>
                </div>
                
                @if($registration->hasDPVerified())
                    <div class="status-message info">
                        <i class="bi bi-info-circle-fill"></i>
                        <small>Upload dokumen KTP, KK, Foto untuk setiap jamaah</small>
                    </div>
                    
                    <a href="{{ route('register.documents', $registration->id) }}" 
                       class="btn-upload" 
                       style="display: block; text-align: center; text-decoration: none;">
                        <i class="bi bi-cloud-upload-fill"></i> Upload Dokumen
                    </a>
                @else
                    <div class="status-message warning">
                        <i class="bi bi-lock-fill"></i>
                        <small>Upload dokumen dapat dilakukan setelah DP diverifikasi admin</small>
                    </div>
                @endif
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
<!-- Modal Edit Jamaah -->
<div class="modal fade" id="editJamaahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #001D5F 0%, #002B8F 100%); color: white; border-radius: 20px 20px 0 0;">
                <h5 class="modal-title">
                    <i class="bi bi-person-fill-gear"></i> 
                    Lengkapi Data Jamaah <span id="modalJamaahNumber"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body" style="padding: 2rem;">
                <form id="formEditJamaah" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="jamaah_id" name="jamaah_id">
                    
                    <!-- Identitas -->
                    <h6 style="color: #001D5F; font-weight: 700; margin-bottom: 1rem;">
                        <i class="bi bi-person-badge"></i> Identitas
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Gelar <span class="text-danger">*</span></label>
                            <select name="title" id="title" class="form-control-dash" required>
                                <option value="">Pilih</option>
                                <option value="Tn.">Tn.</option>
                                <option value="Ny.">Ny.</option>
                                <option value="Nn.">Nn.</option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <label class="form-label fw-bold">Nama Lengkap (Sesuai KTP) <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" id="full_name" class="form-control-dash" required>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">NIK <span class="text-danger">*</span></label>
                            <input type="text" name="nik" id="nik" class="form-control-dash" maxlength="16" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="gender" id="gender" class="form-control-dash" required>
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Gol. Darah</label>
                            <select name="blood_type" id="blood_type" class="form-control-dash">
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
                            <input type="text" name="birth_place" id="birth_place" class="form-control-dash" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control-dash" required>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status Pernikahan <span class="text-danger">*</span></label>
                            <select name="marital_status" id="marital_status" class="form-control-dash" required>
                                <option value="">Pilih</option>
                                <option value="single">Belum Menikah</option>
                                <option value="married">Menikah</option>
                                <option value="divorced">Cerai</option>
                                <option value="widowed">Duda/Janda</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Ayah Kandung <span class="text-danger">*</span></label>
                            <input type="text" name="father_name" id="father_name" class="form-control-dash" required>
                            <small class="text-muted">Untuk keperluan passport</small>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-12">
                            <label class="form-label fw-bold">Pekerjaan <span class="text-danger">*</span></label>
                            <input type="text" name="occupation" id="occupation" class="form-control-dash" required>
                        </div>
                    </div>
                    
                    <!-- Alamat -->
                    <h6 style="color: #001D5F; font-weight: 700; margin: 2rem 0 1rem;">
                        <i class="bi bi-geo-alt-fill"></i> Alamat
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" class="form-control-dash" rows="2" required></textarea>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Provinsi</label>
                            <input type="text" name="province" id="province" class="form-control-dash">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kota/Kabupaten</label>
                            <input type="text" name="city" id="city" class="form-control-dash">
                        </div>
                    </div>
                    
                    <!-- Kontak Darurat -->
                    <h6 style="color: #001D5F; font-weight: 700; margin: 2rem 0 1rem;">
                        <i class="bi bi-telephone-fill"></i> Kontak Darurat
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="emergency_name" id="emergency_name" class="form-control-dash" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Hubungan <span class="text-danger">*</span></label>
                            <select name="emergency_relation" id="emergency_relation" class="form-control-dash" required>
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
                            <input type="tel" name="emergency_phone" id="emergency_phone" class="form-control-dash" required>
                        </div>
                    </div>
                    
                </form>
            </div>
            
            <div class="modal-footer" style="border-top: 2px solid #E8EBF3; padding: 1.5rem;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 50px; padding: 10px 25px;">
                    Batal
                </button>
                <button type="button" class="btn btn-primary" onclick="submitJamaahForm()" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); border: none; border-radius: 50px; padding: 10px 30px; font-weight: 700;">
                    <i class="bi bi-save"></i> Simpan Data
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.modal-backdrop {
    background-color: rgba(0, 29, 95, 0.5);
}

.form-control-dash {
    font-size: 0.95rem;
}

.form-label {
    font-size: 0.9rem;
    color: #001D5F;
}
</style>

<script>
// Open modal dengan data jamaah
function openEditJamaah(jamaahId, jamaahNumber) {
    // Set modal title
    document.getElementById('modalJamaahNumber').textContent = jamaahNumber;
    document.getElementById('jamaah_id').value = jamaahId;
    
    // Get jamaah data via AJAX
    fetch(`/api/jamaah/${jamaahId}`)
        .then(response => response.json())
        .then(data => {
            // Populate form
            document.getElementById('title').value = data.title || '';
            document.getElementById('full_name').value = data.full_name || '';
            document.getElementById('nik').value = data.nik !== 'PENDING' ? data.nik : '';
            document.getElementById('gender').value = data.gender || '';
            document.getElementById('blood_type').value = data.blood_type || '';
            document.getElementById('birth_place').value = data.birth_place !== '-' ? data.birth_place : '';
            document.getElementById('birth_date').value = data.birth_date || '';
            document.getElementById('marital_status').value = data.marital_status || '';
            document.getElementById('father_name').value = data.father_name !== '-' ? data.father_name : '';
            document.getElementById('occupation').value = data.occupation !== '-' ? data.occupation : '';
            document.getElementById('address').value = data.address !== '-' ? data.address : '';
            document.getElementById('province').value = data.province || '';
            document.getElementById('city').value = data.city || '';
            document.getElementById('emergency_name').value = data.emergency_name !== '-' ? data.emergency_name : '';
            document.getElementById('emergency_relation').value = data.emergency_relation !== '-' ? data.emergency_relation : '';
            document.getElementById('emergency_phone').value = data.emergency_phone !== '-' ? data.emergency_phone : '';
            
            // Show modal
            new bootstrap.Modal(document.getElementById('editJamaahModal')).show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memuat data jamaah');
        });
}

// Submit form
function submitJamaahForm() {
    const form = document.getElementById('formEditJamaah');
    const formData = new FormData(form);
    const jamaahId = document.getElementById('jamaah_id').value;
    
    // Show loading
    const btn = event.target;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menyimpan...';
    
    // ✅ FIX: Gunakan POST (bukan PUT)
    fetch(`/api/jamaah/${jamaahId}`, {
        method: 'POST',  // ← Ubah dari PUT ke POST
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ Data jamaah berhasil disimpan!');
            location.reload();
        } else {
            alert('❌ ' + (data.message || 'Gagal menyimpan data'));
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-save"></i> Simpan Data';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('❌ Terjadi kesalahan saat menyimpan data');
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-save"></i> Simpan Data';
    });
}
</script>
@endsection

@push('scripts')
<script>
// Copy account number
function copyAccount(text) {
    navigator.clipboard.writeText(text);
    alert('✅ Nomor rekening berhasil dicopy!');
}

// Auto-refresh completion every 30s (optional)
// setInterval(() => {
//     location.reload();
// }, 30000);
</script>
@endpush