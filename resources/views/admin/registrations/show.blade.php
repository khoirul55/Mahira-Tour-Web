<!DOCTYPE html>
<html>
<head>
    <title>Detail Pendaftaran - Admin Mahira Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Inter', -apple-system, system-ui, sans-serif;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(135deg, #001D5F 0%, #003087 100%);
            color: white;
            padding: 30px 20px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }
        
        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .admin-info {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .sidebar nav a:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(5px);
        }
        
        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }
        
        .page-header {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        
        .detail-card h5 {
            color: #001D5F;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #E8EBF3;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-card h5 i { 
            color: #3B82F6;
            font-size: 1.3rem;
        }
        
        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #F3F4F6;
        }
        
        .info-row:last-child { border-bottom: none; }
        
        .info-label {
            min-width: 180px;
            color: #6B7280;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .info-value {
            flex: 1;
            color: #111827;
            font-weight: 600;
        }
        
        .jamaah-card {
            background: #F8F9FF;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #E8EBF3;
            transition: all 0.3s;
        }
        
        .jamaah-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateX(5px);
        }
        
        .jamaah-card.complete {
            background: #D1FAE5;
            border-left-color: #10B981;
        }
        
        .doc-thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .doc-thumb:hover {
            transform: scale(1.1);
        }
        
        .doc-item {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            margin-right: 20px;
            text-align: center;
        }
        
        .badge-status {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .badge-draft { background: #E5E7EB; color: #374151; }
        .badge-pending { background: #FEF3C7; color: #D97706; }
        .badge-confirmed { background: #D1FAE5; color: #059669; }
        .badge-verified { background: #D1FAE5; color: #059669; }
        .badge-rejected { background: #FEE2E2; color: #DC2626; }
        
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #E8EBF3;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -24px;
            top: 4px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #10B981;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
        }
        
        .timeline-item.pending::before { 
            background: #F59E0B; 
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4);
        }
        
        .btn-action {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        /* New styles for payment alerts */
        .payment-alert {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            border-left: 4px solid #F59E0B;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .payment-alert.danger {
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
            border-left-color: #DC2626;
        }
        
        .payment-alert.success {
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
            border-left-color: #10B981;
        }
        
        .payment-breakdown {
            background: #F8F9FA;
            padding: 12px;
            border-radius: 6px;
            margin-top: 10px;
        }
        
        .payment-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #E5E7EB;
        }
        
        .payment-item:last-child {
            border-bottom: none;
            font-weight: 700;
            color: #001D5F;
            font-size: 1.1rem;
        }
        
        .wa-template-box {
            background: #F0FDF4;
            border: 2px dashed #10B981;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            font-size: 0.85rem;
            line-height: 1.6;
        }
        
        .copy-btn {
            font-size: 0.75rem;
            padding: 4px 10px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>
        <i class="bi bi-shield-check"></i>
        Admin Panel
    </h4>
    
    <div class="admin-info">
        <div style="font-weight: 600;">
            <i class="bi bi-person-circle"></i> {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
        </div>
        <small style="opacity: 0.8;">{{ Auth::guard('admin')->user()->email ?? '' }}</small>
    </div>
    
    <hr style="border-color: rgba(255,255,255,0.2);">
    
    <nav>
        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house"></i> Dashboard
        </a>
        <a href="{{ route('admin.registrations.index') }}">
            <i class="bi bi-file-earmark-text"></i> Semua Pendaftaran
        </a>
        <a href="{{ route('admin.pelunasan.index') }}">
            <i class="bi bi-wallet"></i> Perlu Pelunasan
        </a>
        <a href="{{ route('admin.galleries.index') }}">
            <i class="bi bi-images"></i> Kelola Galeri
        </a>
        <a href="{{ route('admin.schedules.index') }}">
            <i class="bi bi-calendar-event"></i> Kelola Jadwal
        </a>
        <a href="{{ route('admin.logout') }}">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </nav>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('admin.registrations.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <h2 class="mb-0"><i class="bi bi-file-text" style="color: #3B82F6;"></i> {{ $registration->registration_number }}</h2>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.registrations.export-single', $registration->id) }}" class="btn btn-success btn-action">
                    <i class="bi bi-file-earmark-excel"></i> Export
                </a>
                @if($registration->jamaah->flatMap->documents->count() > 0)
                <a href="{{ route('admin.documents.download-all', $registration->id) }}" class="btn btn-primary btn-action">
                    <i class="bi bi-file-zip"></i> Download Dokumen
                </a>
                @endif
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Info Pendaftaran -->
            <div class="detail-card">
                <h5><i class="bi bi-info-circle"></i> Informasi Pendaftaran</h5>
                <div class="info-row">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="badge-status badge-{{ $registration->status }}">
                            {{ ucfirst($registration->status) }}
                        </span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Progress</div>
                    <div class="info-value">
                        <div class="progress" style="height: 10px; width: 200px; background: #E8EBF3; border-radius: 50px;">
                            <div class="progress-bar" style="width: {{ $registration->completion_percentage }}%; background: linear-gradient(90deg, #10B981 0%, #059669 100%);"></div>
                        </div>
                        <small class="text-muted">{{ $registration->completion_percentage }}%</small>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nama Pemesan</div>
                    <div class="info-value">{{ $registration->full_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $registration->email }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. HP</div>
                    <div class="info-value">{{ $registration->phone }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jumlah Jamaah</div>
                    <div class="info-value">{{ $registration->num_people }} orang</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Catatan</div>
                    <div class="info-value">{{ $registration->notes ?: '-' }}</div>
                </div>
            </div>
            
            <!-- Info Paket -->
            <div class="detail-card">
                <h5><i class="bi bi-airplane"></i> Paket Perjalanan</h5>
                <div class="info-row">
                    <div class="info-label">Nama Paket</div>
                    <div class="info-value">{{ $registration->schedule->package_name ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Berangkat</div>
                    <div class="info-value">{{ $registration->schedule?->departure_date?->format('d F Y') ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Pulang</div>
                    <div class="info-value">{{ $registration->schedule?->return_date?->format('d F Y') ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Rute</div>
                    <div class="info-value">{{ $registration->schedule->departure_route ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Maskapai</div>
                    <div class="info-value">{{ $registration->schedule->airline ?? '-' }}</div>
                </div>
            </div>
            
            <!-- Data Jamaah -->
            <div class="detail-card">
                <h5><i class="bi bi-people"></i> Data Jamaah ({{ $registration->jamaah->count() }})</h5>
                
                @foreach($registration->jamaah as $index => $jamaah)
                <div class="jamaah-card {{ $jamaah->completion_status === 'complete' ? 'complete' : '' }}">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <strong style="font-size: 1.1rem; color: #001D5F;">Jamaah {{ $index + 1 }}: {{ $jamaah->full_name }}</strong>
                            @if($jamaah->completion_status === 'complete')
                                <span class="badge bg-success ms-2">✓ Lengkap</span>
                            @elseif($jamaah->completion_status === 'partial')
                                <span class="badge bg-warning ms-2">⚠ Sebagian</span>
                            @else
                                <span class="badge bg-secondary ms-2">○ Belum Lengkap</span>
                            @endif
                            
                            @if($jamaah->need_passport)
                                <span class="badge bg-info ms-1"><i class="bi bi-passport"></i> Butuh Passport</span>
                            @endif
                        </div>
                    </div>
                    
                    @if($jamaah->nik !== 'PENDING')
                    <div class="row" style="font-size: 0.9rem;">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>NIK:</strong> {{ $jamaah->nik }}</p>
                            <p class="mb-2"><strong>TTL:</strong> {{ $jamaah->birth_place }}, {{ $jamaah->birth_date?->format('d M Y') }}</p>
                            <p class="mb-2"><strong>Gender:</strong> {{ $jamaah->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Alamat:</strong> {{ $jamaah->address }}</p>
                            <p class="mb-2"><strong>Darurat:</strong> {{ $jamaah->emergency_name }} ({{ $jamaah->emergency_phone }})</p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Dokumen -->
                    @if($jamaah->documents->count() > 0)
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-muted d-block mb-2 fw-bold">Dokumen:</small>
                        @foreach($jamaah->documents as $doc)
                        <div class="doc-item">
                            @if(in_array(pathinfo($doc->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                <img src="{{ route('admin.secure.file', ['path' => $doc->file_path]) }}" class="doc-thumb" alt="{{ $doc->document_type }}">
                            @else
                                <div class="doc-thumb d-flex align-items-center justify-content-center bg-light">
                                    <i class="bi bi-file-pdf text-danger" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                            <small class="d-block mt-1 fw-bold">{{ strtoupper($doc->document_type) }}</small>
                            @if($doc->is_verified)
                                <i class="bi bi-check-circle-fill text-success"></i>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Pembayaran dengan Status Pelunasan -->
            <div class="detail-card">
                <h5><i class="bi bi-credit-card"></i> Pembayaran</h5>
                
                @php
                    $dpPayment = $registration->payments->where('payment_type', 'dp')->first();
                    $pelunasanPayment = $registration->payments->where('payment_type', 'pelunasan')->first();
                    $totalPaid = $registration->payments->where('status', 'verified')->sum('amount');
                    $remaining = $registration->total_price - $totalPaid;
                    $isLunas = $registration->is_lunas;
                @endphp
                
                <!-- Status Pelunasan Alert -->
                @if(!$isLunas && $dpPayment && $dpPayment->status === 'verified')
                    <div class="payment-alert danger">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.5rem; color: #DC2626;"></i>
                            <strong style="color: #DC2626;">Belum Lunas</strong>
                        </div>
                        <small style="color: #991B1B;">Menunggu pembayaran pelunasan sebesar <strong>Rp {{ number_format($remaining, 0, ',', '.') }}</strong></small>
                    </div>
                @elseif($isLunas)
                    <div class="payment-alert success">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill" style="font-size: 1.5rem; color: #059669;"></i>
                            <strong style="color: #059669;">Sudah Lunas ✓</strong>
                        </div>
                    </div>
                @elseif(!$dpPayment || $dpPayment->status !== 'verified')
                    <div class="payment-alert">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock-fill" style="font-size: 1.5rem; color: #D97706;"></i>
                            <strong style="color: #D97706;">Menunggu DP</strong>
                        </div>
                    </div>
                @endif
                
                <!-- Payment Breakdown -->
                <div class="payment-breakdown">
                    <div class="payment-item">
                        <span class="text-muted">Total Biaya</span>
                        <strong>Rp {{ number_format($registration->total_price, 0, ',', '.') }}</strong>
                    </div>
                    <div class="payment-item">
                        <span class="text-muted">DP ({{ round(($registration->dp_amount / $registration->total_price) * 100) }}%)</span>
                        <span>Rp {{ number_format($registration->dp_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="payment-item">
                        <span class="text-muted">Sudah Dibayar</span>
                        <strong style="color: #10B981;">Rp {{ number_format($totalPaid, 0, ',', '.') }}</strong>
                    </div>
                    <div class="payment-item">
                        <span>Sisa Pembayaran</span>
                        <strong style="color: {{ $remaining > 0 ? '#DC2626' : '#10B981' }};">
                            Rp {{ number_format($remaining, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>
                
                <hr>
                
                <!-- Detail Pembayaran -->
                @foreach($registration->payments as $payment)
                <div class="mb-3 pb-3" style="border-bottom: 1px dashed #E5E7EB;">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <strong style="text-transform: uppercase;">
                                {{ $payment->payment_type === 'dp' ? 'Down Payment (DP)' : 'Pelunasan' }}
                            </strong>
                            <div class="text-muted small">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                        </div>
                        <span class="badge-status badge-{{ $payment->status }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </div>
                    
                    @if($payment->proof_path)
                    <div class="d-flex gap-2 mt-2">
                        <a href="{{ route('admin.secure.file', ['path' => $payment->proof_path]) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Lihat Bukti
                        </a>
                        <a href="{{ route('admin.secure.file', ['path' => $payment->proof_path]) }}" download class="btn btn-sm btn-outline-success">
                            <i class="bi bi-download"></i> Download
                        </a>
                    </div>
                    @else
                    <small class="text-muted d-block mt-2">
                        <i class="bi bi-info-circle"></i> Belum upload bukti pembayaran
                    </small>
                    @endif
                    
                    @if($payment->verified_at)
                    <small class="text-success d-block mt-2">
                        <i class="bi bi-check-circle-fill"></i> Diverifikasi: {{ $payment->verified_at->format('d M Y H:i') }}
                    </small>
                    @endif
                </div>
                @endforeach
                
                @if($registration->payments->isEmpty())
                <div class="text-center text-muted py-3">
                    <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.3;"></i>
                    <p class="mb-0 small">Belum ada pembayaran</p>
                </div>
                @endif
            </div>
            
            <!-- Timeline -->
            <div class="detail-card">
                <h5><i class="bi bi-clock-history"></i> Timeline</h5>
                <div class="timeline">
                    <div class="timeline-item">
                        <strong>Pendaftaran Dibuat</strong>
                        <small class="text-muted d-block">{{ $registration->created_at->format('d M Y H:i') }}</small>
                    </div>
                    
                    @if($dpPayment && $dpPayment->proof_path)
                    <div class="timeline-item {{ $dpPayment->status !== 'verified' ? 'pending' : '' }}">
                        <strong>Bukti DP Diupload</strong>
                        <small class="text-muted d-block">{{ $dpPayment->updated_at->format('d M Y H:i') }}</small>
                    </div>
                    @endif
                    
                    @if($dpPayment && $dpPayment->status === 'verified')
                    <div class="timeline-item">
                        <strong>DP Diverifikasi</strong>
                        <small class="text-muted d-block">{{ $dpPayment->verified_at->format('d M Y H:i') }}</small>
                    </div>
                    @endif
                    
                    @if($pelunasanPayment && $pelunasanPayment->proof_path)
                    <div class="timeline-item {{ $pelunasanPayment->status !== 'verified' ? 'pending' : '' }}">
                        <strong>Bukti Pelunasan Diupload</strong>
                        <small class="text-muted d-block">{{ $pelunasanPayment->updated_at->format('d M Y H:i') }}</small>
                    </div>
                    @endif
                    
                    @if($isLunas)
                    <div class="timeline-item">
                        <strong>Pembayaran Lunas ✓</strong>
                        <small class="text-muted d-block">{{ $pelunasanPayment?->verified_at?->format('d M Y H:i') }}</small>
                    </div>
                    @endif
                </div>
            </div>
            
<!-- Quick Actions dengan Template -->
<div class="detail-card">
    <h5><i class="bi bi-lightning"></i> Quick Actions</h5>
    
    @php
        $waNumber = preg_replace('/^0/', '62', $registration->phone);
        
        // Template WhatsApp berdasarkan status
        if (!$isLunas && $dpPayment && $dpPayment->status === 'verified') {
            $waMessage = "Assalamualaikum Bapak/Ibu *{$registration->full_name}*,\n\n";
            $waMessage .= "Terima kasih atas pembayaran DP untuk paket *{$registration->schedule->package_name}*.\n\n";
            $waMessage .= "📋 *Detail Pembayaran:*\n";
            $waMessage .= "- Total: Rp " . number_format($registration->total_price, 0, ',', '.') . "\n";
            $waMessage .= "- DP: Rp " . number_format($registration->dp_amount, 0, ',', '.') . " ✅\n";
            $waMessage .= "- Sisa: Rp " . number_format($remaining, 0, ',', '.') . "\n\n";
            $waMessage .= "Mohon segera melakukan pelunasan agar proses pendaftaran dapat dilanjutkan.\n\n";
            $waMessage .= "Terima kasih 🙏\n*Mahira Tour*";
        } elseif (!$dpPayment || $dpPayment->status !== 'verified') {
            $waMessage = "Assalamualaikum Bapak/Ibu *{$registration->full_name}*,\n\n";
            $waMessage .= "Terima kasih telah mendaftar paket *{$registration->schedule->package_name}*.\n\n";
            $waMessage .= "📋 *No. Registrasi:* {$registration->registration_number}\n";
            $waMessage .= "💰 *DP yang harus dibayar:* Rp " . number_format($registration->dp_amount, 0, ',', '.') . "\n\n";
            $waMessage .= "Silakan upload bukti pembayaran melalui dashboard Anda.\n\n";
            $waMessage .= "Terima kasih 🙏\n*Mahira Tour*";
        } else {
            $waMessage = "Assalamualaikum Bapak/Ibu *{$registration->full_name}*,\n\n";
            $waMessage .= "Alhamdulillah, pembayaran Anda untuk paket *{$registration->schedule->package_name}* telah LUNAS! ✅\n\n";
            $waMessage .= "📋 *No. Registrasi:* {$registration->registration_number}\n";
            $waMessage .= "✈️ *Keberangkatan:* " . ($registration->schedule?->departure_date?->format('d F Y') ?? '-') . "\n\n";
            $waMessage .= "Silakan lengkapi data jamaah dan dokumen melalui dashboard Anda.\n\n";
            $waMessage .= "Terima kasih 🙏\n*Mahira Tour*";
        }
        
        // Template Email
        if (!$isLunas && $dpPayment && $dpPayment->status === 'verified') {
            $emailSubject = "Reminder Pelunasan - {$registration->registration_number}";
            $emailBody = "Yth. Bapak/Ibu {$registration->full_name},\n\n";
            $emailBody .= "Terima kasih atas pembayaran DP untuk paket {$registration->schedule->package_name}.\n\n";
            $emailBody .= "DETAIL PEMBAYARAN:\n";
            $emailBody .= "- Total Biaya: Rp " . number_format($registration->total_price, 0, ',', '.') . "\n";
            $emailBody .= "- DP (Sudah Dibayar): Rp " . number_format($registration->dp_amount, 0, ',', '.') . "\n";
            $emailBody .= "- Sisa Pelunasan: Rp " . number_format($remaining, 0, ',', '.') . "\n\n";
            $emailBody .= "Mohon segera melakukan pelunasan agar proses pendaftaran dapat dilanjutkan.\n\n";
            $emailBody .= "Silakan login ke dashboard Anda untuk upload bukti pembayaran.\n\n";
            $emailBody .= "Terima kasih,\nMahira Tour";
        } elseif (!$dpPayment || $dpPayment->status !== 'verified') {
            $emailSubject = "Reminder Pembayaran DP - {$registration->registration_number}";
            $emailBody = "Yth. Bapak/Ibu {$registration->full_name},\n\n";
            $emailBody .= "Terima kasih telah mendaftar paket {$registration->schedule->package_name}.\n\n";
            $emailBody .= "DETAIL PEMBAYARAN:\n";
            $emailBody .= "- No. Registrasi: {$registration->registration_number}\n";
            $emailBody .= "- DP yang harus dibayar: Rp " . number_format($registration->dp_amount, 0, ',', '.') . "\n\n";
            $emailBody .= "Silakan segera melakukan pembayaran dan upload bukti melalui dashboard Anda.\n\n";
            $emailBody .= "Terima kasih,\nMahira Tour";
        } else {
            $emailSubject = "Konfirmasi Pembayaran Lunas - {$registration->registration_number}";
            $emailBody = "Yth. Bapak/Ibu {$registration->full_name},\n\n";
            $emailBody .= "Alhamdulillah, pembayaran Anda untuk paket {$registration->schedule->package_name} telah LUNAS!\n\n";
            $emailBody .= "DETAIL:\n";
            $emailBody .= "- No. Registrasi: {$registration->registration_number}\n";
            $emailBody .= "- Tanggal Keberangkatan: " . ($registration->schedule?->departure_date?->format('d F Y') ?? '-') . "\n";
            $emailBody .= "- Total Pembayaran: Rp " . number_format($registration->total_price, 0, ',', '.') . "\n\n";
            $emailBody .= "Silakan lengkapi data jamaah dan dokumen melalui dashboard Anda.\n\n";
            $emailBody .= "Terima kasih,\nMahira Tour";
        }
    @endphp
    
    <!-- WhatsApp Button - TANPA PREVIEW -->
    <div class="mb-3">
        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waMessage) }}" 
           target="_blank" 
           class="btn btn-success btn-action w-100">
            <i class="bi bi-whatsapp"></i> Hubungi via WhatsApp
        </a>
    </div>
    
    <!-- Email Button - TANPA PREVIEW -->
    <div class="mb-3">
        <button class="btn btn-outline-primary btn-action w-100" 
                data-bs-toggle="modal" 
                data-bs-target="#emailModal">
            <i class="bi bi-envelope"></i> Template Email
        </button>
    </div>
    
    <!-- Additional Actions -->
    <div class="d-grid gap-2">
        <a href="{{ route('registration.dashboard', ['reg' => $registration->registration_number, 'token' => $registration->access_token]) }}" 
           target="_blank" 
           class="btn btn-outline-secondary btn-action">
            <i class="bi bi-box-arrow-up-right"></i> Buka Dashboard User
        </a>
        
        @if(!$isLunas && $remaining > 0)
        <button class="btn btn-outline-warning btn-action" onclick="copyToClipboard('paymentInfo')">
            <i class="bi bi-clipboard-check"></i> Copy Info Pembayaran
        </button>
        <div id="paymentInfo" style="display: none;">Total: Rp {{ number_format($registration->total_price, 0, ',', '.') }}
Sudah Dibayar: Rp {{ number_format($totalPaid, 0, ',', '.') }}
Sisa: Rp {{ number_format($remaining, 0, ',', '.') }}</div>
        @endif
    </div>
</div>

<!-- Modal Email Template -->
<div class="modal fade" id="emailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-envelope"></i> Template Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">To:</label>
                    <input type="text" class="form-control" value="{{ $registration->email }}" readonly>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Subject:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="emailSubject" value="{{ $emailSubject }}" readonly>
                        <button class="btn btn-outline-secondary" onclick="copyText('emailSubject')">
                            <i class="bi bi-clipboard"></i>
                        </button>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Body:</label>
                    <textarea class="form-control" id="emailBody" rows="12" readonly>{{ $emailBody }}</textarea>
                </div>
                
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle"></i> 
                    <strong>Cara Menggunakan:</strong>
                    <ol class="mb-0 mt-2">
                        <li>Klik tombol "Copy Subject" dan "Copy Body"</li>
                        <li>Buka email client Anda (Gmail, Outlook, dll)</li>
                        <li>Paste subject dan body yang sudah dicopy</li>
                        <li>Atau gunakan tombol "Buka Gmail" di bawah</li>
                    </ol>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="copyText('emailSubject')">
                    <i class="bi bi-clipboard"></i> Copy Subject
                </button>
                <button type="button" class="btn btn-secondary" onclick="copyText('emailBody')">
                    <i class="bi bi-clipboard"></i> Copy Body
                </button>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $registration->email }}&su={{ urlencode($emailSubject) }}&body={{ urlencode($emailBody) }}" 
                   target="_blank" 
                   class="btn btn-primary">
                    <i class="bi bi-google"></i> Buka Gmail
                </a>
            </div>
        </div>
    </div>
</div>
                <!-- Additional Actions -->
                <div class="d-grid gap-2">
                    <a href="{{ route('registration.dashboard', ['reg' => $registration->registration_number, 'token' => $registration->access_token]) }}" 
                       target="_blank" 
                       class="btn btn-outline-secondary btn-action">
                        <i class="bi bi-box-arrow-up-right"></i> Buka Dashboard User
                    </a>
                    
                    @if(!$isLunas && $remaining > 0)
                    <button class="btn btn-outline-warning btn-action" onclick="copyToClipboard('paymentInfo')">
                        <i class="bi bi-clipboard-check"></i> Copy Info Pembayaran
                    </button>
                    <div id="paymentInfo" style="display: none;">Total: Rp {{ number_format($registration->total_price, 0, ',', '.') }}
Sudah Dibayar: Rp {{ number_format($totalPaid, 0, ',', '.') }}
Sisa: Rp {{ number_format($remaining, 0, ',', '.') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    const text = element.innerText || element.textContent;
    
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    
    textarea.select();
    document.execCommand('copy');
    
    document.body.removeChild(textarea);
    
    const button = event.target.closest('button');
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="bi bi-check"></i> Copied!';
    button.classList.add('btn-success');
    button.classList.remove('btn-outline-warning');
    
    setTimeout(() => {
        button.innerHTML = originalHTML;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-warning');
    }, 2000);
}

function copyText(elementId) {
    const element = document.getElementById(elementId);
    element.select();
    document.execCommand('copy');
    
    const button = event.target;
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="bi bi-check"></i> Copied!';
    button.classList.add('btn-success');
    button.classList.remove('btn-secondary', 'btn-outline-secondary');
    
    setTimeout(() => {
        button.innerHTML = originalHTML;
        button.classList.remove('btn-success');
        button.classList.add('btn-secondary');
    }, 2000);
}
</script>
</body>
</html>