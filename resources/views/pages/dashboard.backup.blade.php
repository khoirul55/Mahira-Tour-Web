@extends('layouts.app')

@section('title', 'Dashboard Pendaftaran - Mahira Tour')

@push('styles')
<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>

    /* Dashboard Styles - Consistent with Mahira Theme */
    [x-cloak] { display: none !important; }
    
    /* Reuse global variables but ensure dashboard scope */
    .dashboard-section {
        --dash-primary: var(--primary);
        --dash-accent: var(--accent);
        --dash-bg: var(--bg-main);
        
        background-color: var(--dash-bg);
        min-height: 100vh;
        padding: 120px 0 80px 0;
    }

    .dashboard-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--light-navy) 100%);
        color: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 29, 95, 0.15);
    }
    
    .dashboard-header h1 {
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.8rem;
    }
    
    .dashboard-header .reg-number {
        background: rgba(255, 255, 255, 0.1);
        display: inline-block;
        padding: 8px 16px;
        border-radius: 8px;
        font-family: monospace;
        font-size: 1.1rem;
        margin-bottom: 8px;
        border: 1px solid rgba(255,255,255,0.2);
    }

    /* Cards */
    .action-card, .progress-section {
        background: white;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05); /* Softer shadow */
        border: 1px solid var(--border);
    }

    .action-card h3, .progress-header h3 {
        color: var(--primary);
        font-weight: 700;
        font-size: 1.2rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .action-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border);
    }
    
    /* Buttons */
    .btn-jamaah, .btn-upload, .btn-submit {
        background: var(--primary);
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
        border: none;
        transition: all 0.3s;
    }
    
    .btn-jamaah:hover, .btn-upload:hover, .btn-submit:hover {
        background: var(--primary-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 29, 95, 0.2);
    }

    /* Badges */
    .badge-status {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
    }
    .badge-pending { background: #fee2e2; color: #dc2626; }
    .badge-waiting { background: #e0f2fe; color: #0284c7; }
    .badge-complete { background: #dcfce7; color: #16a34a; }

    /* Hide Global WA */
    .floating-whatsapp { display: none !important; }

    .deadline {
        background: #FEF2F2;
        color: #991B1B;
        border: 1px solid #FCA5A5;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* Typography & Headers */
    .action-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color);
    }

    .action-card-header h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .action-card-header i {
        color: var(--accent);
        font-size: 1.25rem;
    }

    /* Modern Badges */
    .badge-status {
        padding: 6px 12px;
        border-radius: 6px; /* Pill -> Rounded Rect */
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .badge-pending { background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; }
    .badge-complete { background: #ecfdf5; color: #047857; border: 1px solid #d1fae5; }
    .badge-waiting { background: #eff6ff; color: #1d4ed8; border: 1px solid #dbeafe; }

    /* Jamaah List - Clean Row */
    .jamaah-item {
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 12px; /* Smooth corners */
        padding: 16px;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: border-color 0.2s;
    }

    .jamaah-item:hover {
        border-color: var(--accent);
    }

    .jamaah-item h4 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
        margin: 0 0 4px 0;
    }

    .jamaah-item small {
        color: var(--text-muted);
        font-size: 0.875rem;
    }

    /* Modern Buttons */
    .btn-jamaah, .btn-upload, .btn-submit {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px; /* Consistent rounded corners */
        font-weight: 500;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 4px rgba(15, 23, 42, 0.1);
    }

    .btn-jamaah:hover, .btn-upload:hover, .btn-submit:hover {
        background: var(--primary-light);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(15, 23, 42, 0.15);
    }

    .btn-jamaah.complete {
        background: #fff;
        color: var(--text-main);
        border: 1px solid var(--border-color);
        box-shadow: none;
    }
    .btn-jamaah.complete:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    /* Bank Info - Clean Card */
    .bank-info {
        background: #f8fafc; /* Very light slate */
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin: 20px 0;
    }
    
    .bank-info p {
        color: var(--text-muted);
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.1em;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .bank-account {
        font-family: 'Monaco', monospace;
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-main); /* Dark text for readability */
        letter-spacing: -0.5px;
    }

    .btn-copy {
        background: #fff;
        color: var(--text-muted);
        border: 1px solid var(--border-color);
        padding: 8px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    
    .btn-copy:hover {
        color: var(--accent);
        border-color: var(--accent);
        background: #eff6ff;
    }

    /* Form Inputs */
    .form-control-dash, .doc-upload-label, select.form-control-dash {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 14px; /* Slightly tighter padding */
        font-size: 0.95rem;
        color: var(--text-main);
        background: #fff;
        transition: all 0.2s;
        width: 100%;
        display: block; /* Ensure block level */
        box-sizing: border-box; /* Fix padding issues */
    }

    .form-control-dash:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }
    
    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: var(--primary);
    }
    
    /* Modal Footer */
    .modal-footer-custom {
        padding: 24px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end; /* Align right */
        gap: 12px;
        background: #f8fafc;
        border-radius: 0 0 24px 24px;
    }
    
    .modal-close {
        background: transparent;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.2s;
    }
    .modal-close:hover { opacity: 1; }

    /* Alpine.js Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(15, 23, 42, 0.85); /* Darker overlay */
        backdrop-filter: blur(4px);
        z-index: 3000;
        display: flex;
        align-items: flex-start; /* Start from top on mobile */
        justify-content: center;
        padding: 20px;
        overflow-y: auto; /* Allow scrolling overlay */
    }

    .modal-container {
        background: #ffffff !important;
        border-radius: 16px; /* Slightly smaller radius */
        width: 100%;
        max-width: 700px; /* Constrain width */
        margin: auto; /* Center vertically if flex aligns center */
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
        border: 1px solid var(--border-color);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .modal-header-custom {
        background: var(--primary); /* Solid color, no gradient */
        color: white;
        padding: 20px 24px;
        border-radius: 16px 16px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-shrink: 0;
    }

    .modal-body-custom {
        padding: 24px;
        background: #ffffff;
        color: var(--text-main);
        overflow-y: visible; /* Let content flow */
    }

    .doc-upload-label {
        border: 2px dashed var(--border-color);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 24px;
        cursor: pointer;
        background: #f8fafc;
        text-align: center;
    }


    /* Status Messages */
    .status-message {
        padding: 16px;
        border-radius: 8px;
        display: flex;
        gap: 12px;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 16px;
    }
    .status-message.info {
        background: #eff6ff;
        color: #1e40af;
        border: 1px solid #dbeafe;
    }
    .status-message.warning {
        background: #fffbeb;
        color: #92400e;
        border: 1px solid #fde68a;
    }
    
    /* Sticky Button */
    .contact-cs-sticky {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 50;
    }
    .btn-wa {
        background: #25D366;
        color: white;
        padding: 12px 20px;
        border-radius: 50px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        transition: transform 0.2s;
        text-decoration: none;
    }
    .btn-wa:hover {
        transform: translateY(-2px);
        color: white;
    }

    /* PROGRESS BAR */
    .progress-bar-container {
        height: 8px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }
    .progress-bar-fill {
        background: var(--success);
        height: 100%;
        border-radius: 10px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-section { padding-top: 20px; padding-bottom: 100px; }
        .dashboard-header { padding: 20px; border-left-width: 4px; }
        .dashboard-header h1 { font-size: 1.25rem; }
        .action-card { padding: 20px; border-radius: 12px; }
        .bank-info { padding: 16px; }
        
        .jamaah-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .btn-jamaah { width: 100%; text-align: center; }
        
        /* Bank Mobile */
        .bank-account { font-size: 1.25rem; }
        .bank-info .d-flex { display: flex; flex-direction: column; align-items: flex-start; gap: 8px; }
        .bank-info img { height: 24px !important; margin-bottom: 4px; }
        .bank-info .btn-copy { width: 100%; margin: 8px 0 0 0 !important; text-align: center; }
        
        .action-grid { grid-template-columns: 1fr; gap: 20px; }
    }


    /* Toast Notification */
    .toast-container {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 1100;
        display: flex;
        flex-direction: column;
        gap: 12px;
        pointer-events: none;
    }

    .toast-modern {
        background: white;
        color: var(--text-main);
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 500;
        font-size: 0.95rem;
        transform: translateX(100%);
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        pointer-events: auto;
        border-left: 4px solid var(--success);
        min-width: 300px;
    }

    .toast-modern.show {
        transform: translateX(0);
        opacity: 1;
    }

    .toast-icon {
        color: var(--success);
        font-size: 1.25rem;
    }

    /* Adjusted Padding for Navbar */
    .dashboard-section {
        min-height: 100vh;
        padding: 120px 0 80px 0; /* Increased top padding */
    }

    @media (max-width: 768px) {
        .dashboard-section { padding-top: 100px; padding-bottom: 100px; }
        .toast-container {
            left: 20px;
            right: 20px;
            top: 20px;
            align-items: center;
        }
        .toast-modern {
            width: 100%;
            min-width: auto;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<section class="dashboard-section" x-data="dashboardApp()">
    
    <!-- Toast Container -->
    <div class="toast-container" id="toast-container"></div>

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
        <div class="dashboard-header" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);">
            <h1>Dashboard Pendaftaran</h1>
            <div class="reg-number">{{ $registration->registration_number }}</div>
            <div>
                <strong>Paket:</strong> {{ $registration->schedule->package_name }}<br>
                <strong>Jamaah:</strong> {{ $registration->num_people }} orang<br>
                <strong>Total:</strong> Rp {{ number_format($registration->total_price, 0, ',', '.') }}
            </div>
            @if($registration->payment_deadline)
            <div class="deadline">
                <i class="bi bi-calendar-event-fill"></i>
                Jatuh Tempo DP: {{ $registration->payment_deadline->format('d M Y') }}
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
                    
                @elseif($dpPayment && ($dpPayment->proof_path || $dpPayment->status === 'pending'))
                    <!-- DP Uploaded/Confirmed Cash, Waiting Verification -->
                    <div class="status-message info">
                        <i class="bi bi-clock-fill"></i>
                        <div>
                            <strong>
                                @if($dpPayment->payment_method === 'cash')
                                    Menunggu Pembayaran Cash
                                @else
                                    Bukti DP Sudah Diupload
                                @endif
                            </strong><br>
                            <small>
                                @if($dpPayment->payment_method === 'cash')
                                    Silakan datang ke kantor untuk melakukan pembayaran.
                                @else
                                    Menunggu verifikasi admin (1x24 jam)
                                @endif
                            </small>
                        </div>
                    </div>

                    @if($dpPayment->payment_method === 'cash')
                        <div class="mt-3 text-center">
                            <a href="https://wa.me/6282184515310?text=Assalamu'alaikum%20Admin,%20saya%20{{ urlencode($registration->full_name) }}%20(Reg:%20{{ $registration->registration_number }})%20ingin%20melakukan%20pembayaran%20DP%20secara%20Cash%20di%20kantor.%20Mohon%20infonya." 
                               class="btn btn-success rounded-pill fw-bold" 
                               target="_blank">
                                <i class="bi bi-whatsapp me-2"></i> Konfirmasi Janji Temu via WA
                            </a>
                            <div class="mt-2">
                                <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="text-decoration-none small">
                                    <i class="bi bi-geo-alt-fill text-danger"></i> Lihat Lokasi Kantor di Google Maps
                                </a>
                            </div>
                        </div>
                    @endif
                    
                @else
                    <!-- Need to Upload DP -->
                    <div class="payment-instructions">
                        <h4>Transfer DP 30%</h4>
                        <p style="margin: 0; color: #6B7280;">
                            <strong style="font-size: 1.5rem; color: #001D5F;">Rp {{ number_format($registration->dp_amount, 0, ',', '.') }}</strong>
                        </p>
                    </div>
                    
                    <div class="bank-info">
                        <p style="margin: 0; opacity: 0.9;"><strong>PT. Makkah Madinah Berkah Bersama</strong></p>
                        <div style="margin-top: 15px;">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" alt="BRI" style="height: 30px; width: auto; margin-right: 15px;">
                                <div class="bank-account" style="margin: 0; font-size: 1.1rem;">0117 0100 4252 303</div>
                                <button class="btn-copy ms-3" @click="copyAccount('011701004252303')" style="padding: 4px 10px;">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a0/Bank_Syariah_Indonesia.svg" alt="BSI" style="height: 30px; width: auto; margin-right: 15px;">
                                <div class="bank-account" style="margin: 0; font-size: 1.1rem;">7256 7665 79</div>
                                <button class="btn-copy ms-3" @click="copyAccount('7256766579')" style="padding: 4px 10px;">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('register.payment', $registration->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data" 
                          class="upload-form"
                          x-data="{ method: 'transfer' }">
                        @csrf
                        
                        <div class="form-group-dash">
                            <label>Metode Pembayaran</label>
                            <select name="payment_method" class="form-control-dash" x-model="method" required>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cash">Cash di Kantor</option>
                            </select>
                        </div>
                        
                        <div x-show="method === 'transfer'" class="form-group-dash">
                            <label>Upload Bukti Transfer</label>
                            <input type="file" 
                                   name="payment_proof" 
                                   class="form-control-dash" 
                                   accept="image/*,application/pdf"
                                   :required="method === 'transfer'">
                            <small style="color: #6B7280; font-size: 0.85rem;">JPG, PNG, PDF (Max 2MB)</small>
                        </div>

                        <div x-show="method === 'cash'" class="alert alert-info d-flex align-items-start mb-3">
                            <i class="bi bi-info-circle-fill me-2 fs-4 mt-1"></i>
                            <div>
                                <strong>Pembayaran Cash</strong><br>
                                Silakan lakukan pembayaran di kantor kami. Klik tombol di bawah untuk konfirmasi.
                                <div class="mt-2">
                                    <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="text-decoration-none fw-bold">
                                        <i class="bi bi-map-fill text-danger"></i> Lihat Lokasi Kantor
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-upload">
                            <i class="bi" :class="method === 'transfer' ? 'bi-cloud-upload-fill' : 'bi-check-circle-fill'"></i> 
                            <span x-text="method === 'transfer' ? 'Upload Bukti DP' : 'Konfirmasi Pembayaran Cash'"></span>
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
                    
                    @if($pelunasan && ($pelunasan->status === 'pending' || $pelunasan->proof_path))
                        <div class="status-message info">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <strong>
                                    @if($pelunasan->payment_method === 'cash')
                                        Menunggu Pelunasan Cash
                                    @else
                                        Bukti Pelunasan Sudah Diupload
                                    @endif
                                </strong><br>
                                <small>
                                    @if($pelunasan->payment_method === 'cash')
                                        Silakan datang ke kantor untuk melakukan pelunasan.
                                    @else
                                        Menunggu verifikasi admin (1x24 jam)
                                    @endif
                                </small>
                            </div>
                        </div>

                        @if($pelunasan->payment_method === 'cash')
                            <div class="mt-3 text-center">
                                <a href="https://wa.me/6282184515310?text=Assalamu'alaikum%20Admin,%20saya%20{{ urlencode($registration->full_name) }}%20(Reg:%20{{ $registration->registration_number }})%20ingin%20melakukan%20PELUNASAN%20secara%20Cash%20di%20kantor.%20Mohon%20infonya." 
                                   class="btn btn-success rounded-pill fw-bold" 
                                   target="_blank">
                                    <i class="bi bi-whatsapp me-2"></i> Konfirmasi Janji Temu via WA
                                </a>
                                <div class="mt-2">
                            <div class="mt-2">
                                    <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="text-decoration-none small">
                                        <i class="bi bi-geo-alt-fill text-danger"></i> Lihat Lokasi Kantor di Google Maps
                                    </a>
                                </div>
                            </div>
                        @endif
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
                            <p style="margin: 0; opacity: 0.9;"><strong>PT. Makkah Madinah Berkah Bersama</strong></p>
                            <div style="margin-top: 15px;">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" alt="BRI" style="height: 30px; width: auto; margin-right: 15px;">
                                    <div class="bank-account" style="margin: 0; font-size: 1.1rem;">0117 0100 4252 303</div>
                                    <button class="btn-copy ms-3" @click="copyAccount('011701004252303')" style="padding: 4px 10px;">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a0/Bank_Syariah_Indonesia.svg" alt="BSI" style="height: 30px; width: auto; margin-right: 15px;">
                                    <div class="bank-account" style="margin: 0; font-size: 1.1rem;">7256 7665 79</div>
                                    <button class="btn-copy ms-3" @click="copyAccount('7256766579')" style="padding: 4px 10px;">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                </div>
                            </div>
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
                              class="upload-form"
                              x-data="{ method: 'transfer' }">
                            @csrf
                            <div class="form-group-dash">
                                <label>Metode Pembayaran</label>
                                <select name="payment_method" class="form-control-dash" x-model="method" required>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <div x-show="method === 'transfer'" class="form-group-dash">
                                <label>Upload Bukti Pelunasan</label>
                                <input type="file" name="payment_proof" class="form-control-dash" accept="image/*,.pdf" :required="method === 'transfer'">
                            </div>

                            <div x-show="method === 'cash'" class="alert alert-info d-flex align-items-start mb-3">
                                <i class="bi bi-info-circle-fill me-2 fs-4 mt-1"></i>
                                <div>
                                    <strong>Pembayaran Cash</strong><br>
                                    Silakan lakukan pelunasan di kantor kami. Klik tombol di bawah untuk konfirmasi.
                                    <div class="mt-2">
                                        <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="text-decoration-none fw-bold">
                                            <i class="bi bi-map-fill text-danger"></i> Lihat Lokasi Kantor
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-upload">
                                <i class="bi" :class="method === 'transfer' ? 'bi-cloud-upload-fill' : 'bi-check-circle-fill'"></i>
                                <span x-text="method === 'transfer' ? 'Upload Bukti Pelunasan' : 'Konfirmasi Pelunasan Cash'"></span>
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
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="modal-overlay"
         @click.self="showJamaahModal = false">
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
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="modal-overlay"
         @click.self="showDocModal = false">
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
                    
                    <!-- KTP & KK (Wajib Mutlak) -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-star-fill text-warning"></i> Dokumen Wajib</h6>
                        
                        <!-- KTP -->
                        <div class="doc-upload-card mb-3" :class="{ 'uploaded': documents.ktp.file }">
                            <div class="doc-header">
                                <div class="doc-title">KTP <span class="text-danger">*</span></div>
                                <span class="badge-status" :class="documents.ktp.file ? 'uploaded' : 'pending'">
                                    <span x-text="documents.ktp.file ? 'Siap Upload' : 'Belum Upload'"></span>
                                </span>
                            </div>
                            
                            <template x-if="!documents.ktp.file">
                                <label class="doc-upload-label">
                                    <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'ktp')">
                                    <i class="bi bi-cloud-upload"></i>
                                    <span>Klik untuk upload KTP</span>
                                    <small class="text-muted">JPG, PNG, PDF (Max 2MB)</small>
                                </label>
                            </template>
                            
                            <template x-if="documents.ktp.file">
                                <div class="doc-preview">
                                    <div class="doc-info">
                                        <i class="bi bi-file-earmark-check-fill text-success fs-4"></i>
                                        <span x-text="documents.ktp.file.name"></span>
                                    </div>
                                    <button type="button" class="btn-remove" @click="removeFile('ktp')"><i class="bi bi-trash"></i></button>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Kartu Keluarga -->
                        <div class="doc-upload-card" :class="{ 'uploaded': documents.kk.file }">
                            <div class="doc-header">
                                <div class="doc-title">Kartu Keluarga (KK) <span class="text-danger">*</span></div>
                                <span class="badge-status" :class="documents.kk.file ? 'uploaded' : 'pending'">
                                    <span x-text="documents.kk.file ? 'Siap Upload' : 'Belum Upload'"></span>
                                </span>
                            </div>
                            
                            <template x-if="!documents.kk.file">
                                <label class="doc-upload-label">
                                    <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'kk')">
                                    <i class="bi bi-cloud-upload"></i>
                                    <span>Klik untuk upload KK</span>
                                    <small class="text-muted">JPG, PNG, PDF (Max 2MB)</small>
                                </label>
                            </template>
                            
                            <template x-if="documents.kk.file">
                                <div class="doc-preview">
                                    <div class="doc-info">
                                        <i class="bi bi-file-earmark-check-fill text-success fs-4"></i>
                                        <span x-text="documents.kk.file.name"></span>
                                    </div>
                                    <button type="button" class="btn-remove" @click="removeFile('kk')"><i class="bi bi-trash"></i></button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Dokumen Pendukung (Pilih Satu) -->
                    <div class="mb-4 p-3 bg-light rounded border">
                        <h6 class="fw-bold text-primary mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i> Dokumen Pendukung (Wajib Pilih Salah Satu)
                        </h6>
                        <small class="d-block mb-3 text-muted">Silakan upload minimal satu dari dokumen berikut:</small>
                        
                        <div class="d-flex gap-2 mb-3">
                            <button type="button" class="btn btn-sm" :class="activeTab === 'ijazah' ? 'btn-primary' : 'btn-outline-primary'" @click="activeTab = 'ijazah'">Ijazah</button>
                            <button type="button" class="btn btn-sm" :class="activeTab === 'buku_nikah' ? 'btn-primary' : 'btn-outline-primary'" @click="activeTab = 'buku_nikah'">Buku Nikah</button>
                            <button type="button" class="btn btn-sm" :class="activeTab === 'akta' ? 'btn-primary' : 'btn-outline-primary'" @click="activeTab = 'akta'">Akta Lahir</button>
                        </div>

                        <!-- Ijazah Upload -->
                        <div x-show="activeTab === 'ijazah'" x-transition>
                            <label class="doc-upload-label">
                                <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'ijazah')">
                                <i class="bi bi-cloud-upload"></i>
                                <span x-text="documents.ijazah.file ? documents.ijazah.file.name : 'Upload Ijazah Terakhir'"></span>
                            </label>
                            <div class="mt-2 text-end" x-show="documents.ijazah.file">
                                <span class="badge bg-success">Siap Upload</span>
                                <button type="button" class="btn btn-sm btn-link text-danger" @click="removeFile('ijazah')">Hapus</button>
                            </div>
                        </div>

                        <!-- Buku Nikah Upload -->
                        <div x-show="activeTab === 'buku_nikah'" x-transition>
                            <label class="doc-upload-label">
                                <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'buku_nikah')">
                                <i class="bi bi-cloud-upload"></i>
                                <span x-text="documents.buku_nikah.file ? documents.buku_nikah.file.name : 'Upload Buku Nikah'"></span>
                            </label>
                            <div class="mt-2 text-end" x-show="documents.buku_nikah.file">
                                <span class="badge bg-success">Siap Upload</span>
                                <button type="button" class="btn btn-sm btn-link text-danger" @click="removeFile('buku_nikah')">Hapus</button>
                            </div>
                        </div>

                        <!-- Akta Upload -->
                        <div x-show="activeTab === 'akta'" x-transition>
                            <label class="doc-upload-label">
                                <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'akta_kelahiran')">
                                <i class="bi bi-cloud-upload"></i>
                                <span x-text="documents.akta_kelahiran.file ? documents.akta_kelahiran.file.name : 'Upload Akta Kelahiran'"></span>
                            </label>
                            <div class="mt-2 text-end" x-show="documents.akta_kelahiran.file">
                                <span class="badge bg-success">Siap Upload</span>
                                <button type="button" class="btn btn-sm btn-link text-danger" @click="removeFile('akta_kelahiran')">Hapus</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Passport Section (Optional) -->
                    <div class="mt-4 border-top pt-3">
                         <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold mb-0"><i class="bi bi-passport"></i> Passport (Opsional)</h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="hasPassport" x-model="showPassportUpload">
                                <label class="form-check-label" for="hasPassport">Saya sudah punya passport</label>
                            </div>
                        </div>

                        <div x-show="showPassportUpload" x-transition>
                            <div class="doc-upload-card" :class="{ 'uploaded': documents.passport.file }">
                                <div class="doc-header">
                                    <div class="doc-title">Upload Passport</div>
                                    <span class="badge-status" :class="documents.passport.file ? 'uploaded' : 'pending'">
                                        <span x-text="documents.passport.file ? 'Siap Upload' : 'Belum Upload'"></span>
                                    </span>
                                </div>
                                <template x-if="!documents.passport.file">
                                    <label class="doc-upload-label">
                                        <input type="file" class="doc-upload-input" accept="image/*,.pdf" @change="handleFileSelect($event, 'passport')">
                                        <i class="bi bi-cloud-upload"></i>
                                        <span>Klik untuk upload Passport</span>
                                    </label>
                                </template>
                                <template x-if="documents.passport.file">
                                    <div class="doc-preview">
                                        <div class="doc-info"><span x-text="documents.passport.file.name"></span></div>
                                        <button type="button" class="btn-remove" @click="removeFile('passport')"><i class="bi bi-trash"></i></button>
                                    </div>
                                </template>
                            </div>
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
        activeTab: 'ijazah',
        documents: {
            ktp: { file: null, preview: null, exists: false },
            kk: { file: null, preview: null, exists: false },
            ijazah: { file: null, preview: null, exists: false },
            akta_kelahiran: { file: null, preview: null, exists: false },
            buku_nikah: { file: null, preview: null, exists: false },
            passport: { file: null, preview: null, exists: false }
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
            this.showToast('Nomor rekening berhasil dicopy!', 'success');
        },

        showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast-modern';
            toast.innerHTML = `
                <i class="bi bi-check-circle-fill toast-icon"></i>
                <span>${message}</span>
            `;
            
            container.appendChild(toast);
            
            // Trigger animation
            requestAnimationFrame(() => {
                toast.classList.add('show');
            });
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 400);
            }, 3000);
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
            
            // Reset state
            this.activeTab = 'ijazah';
            this.showPassportUpload = false;
            this.noPassport = false;

            // Reset documents
            this.documents = {
                ktp: { file: null, preview: null, exists: false },
                kk: { file: null, preview: null, exists: false },
                ijazah: { file: null, preview: null, exists: false },
                akta_kelahiran: { file: null, preview: null, exists: false },
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

                    // Set active tab based on existing docs
                    if (this.documents.buku_nikah.exists) this.activeTab = 'buku_nikah';
                    else if (this.documents.akta_kelahiran.exists) this.activeTab = 'akta';
                    else if (this.documents.ijazah.exists) this.activeTab = 'ijazah';
                    
                    if (this.documents.passport.exists) this.showPassportUpload = true;
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
            // Note: KTP, KK are always required
            const ktpOk = this.documents.ktp.file;
            const kkOk = this.documents.kk.file;
            
            if (!ktpOk || !kkOk) {
                alert('❌ Mohon upload dokumen wajib: KTP dan Kartu Keluarga');
                return;
            }

            // Check One of Three (Ijazah / Buku Nikah / Akta)
            const hasIjazah = this.documents.ijazah.file;
            const hasBukuNikah = this.documents.buku_nikah.file;
            const hasAkta = this.documents.akta_kelahiran.file;
            
            if (!hasIjazah && !hasBukuNikah && !hasAkta) {
                alert('❌ Wajib upload salah satu: Ijazah / Buku Nikah / Akta Kelahiran');
                return;
            }
            
            this.isUploading = true;
            this.showToast('Sedang mengupload dokumen...', 'info');
            
            try {
                const docTypes = ['ktp', 'kk', 'ijazah', 'akta_kelahiran', 'buku_nikah', 'passport'];
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