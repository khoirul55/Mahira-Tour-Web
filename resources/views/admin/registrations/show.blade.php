<!DOCTYPE html>
<html>
<head>
    <title>Detail Pendaftaran - Admin Mahira Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: #001D5F;
            color: white;
            padding: 20px;
            overflow-y: auto;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .admin-info {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
        }
        .sidebar nav a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
            display: block;
            margin-bottom: 8px;
        }
        .sidebar nav a:hover { background: rgba(255,255,255,0.15); }
        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .detail-card h5 {
            color: #001D5F;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #E8EBF3;
        }
        .detail-card h5 i { color: #D4AF37; }
        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #F3F4F6;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label {
            width: 180px;
            color: #6B7280;
            font-weight: 500;
        }
        .info-value {
            flex: 1;
            color: #111827;
            font-weight: 600;
        }
        .jamaah-card {
            background: #F8F9FF;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 12px;
        }
        .jamaah-card.complete {
            background: #D1FAE5;
            border: 2px solid #10B981;
        }
        .doc-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
        }
        .doc-item {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            margin-right: 15px;
            text-align: center;
        }
        .badge-status {
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 600;
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
        }
        .timeline-item.pending::before { background: #F59E0B; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4><i class="bi bi-shield-check"></i> Admin Panel</h4>
    <div class="admin-info">
        <div style="font-weight: 600;"><i class="bi bi-person-circle"></i> {{ session('admin_name', 'Admin') }}</div>
        <small style="opacity: 0.8;">{{ session('admin_email') }}</small>
    </div>
    <hr style="border-color: rgba(255,255,255,0.2);">
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="text-white"><i class="bi bi-house"></i> Dashboard</a>
        <a href="{{ route('admin.registrations.index') }}" class="text-white"><i class="bi bi-file-earmark-text"></i> Semua Pendaftaran</a>
        <a href="{{ route('admin.galleries.index') }}" class="text-white"><i class="bi bi-images"></i> Kelola Galeri</a>
        <a href="{{ route('admin.schedules.index') }}" class="text-white"><i class="bi bi-calendar-event"></i> Kelola Jadwal</a>
        <a href="{{ route('admin.logout') }}" class="text-white"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </nav>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.registrations.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <h2 class="mb-0 mt-2">{{ $registration->registration_number }}</h2>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.registrations.export-single', $registration->id) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Export
            </a>
            @if($registration->jamaah->flatMap->documents->count() > 0)
            <a href="{{ route('admin.documents.download-all', $registration->id) }}" class="btn btn-primary">
                <i class="bi bi-file-zip"></i> Download Dokumen
            </a>
            @endif
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
                        <div class="progress" style="height: 10px; width: 200px;">
                            <div class="progress-bar bg-success" style="width: {{ $registration->completion_percentage }}%"></div>
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
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong>Jamaah {{ $index + 1 }}: {{ $jamaah->full_name }}</strong>
                            @if($jamaah->completion_status === 'complete')
                                <span class="badge bg-success ms-2">Lengkap</span>
                            @elseif($jamaah->completion_status === 'partial')
                                <span class="badge bg-warning ms-2">Sebagian</span>
                            @else
                                <span class="badge bg-secondary ms-2">Belum Lengkap</span>
                            @endif
                            
                            @if($jamaah->need_passport)
                                <span class="badge bg-info ms-1"><i class="bi bi-passport"></i> Butuh Passport</span>
                            @endif
                        </div>
                    </div>
                    
                    @if($jamaah->nik !== 'PENDING')
                    <div class="row mt-3" style="font-size: 0.9rem;">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>NIK:</strong> {{ $jamaah->nik }}</p>
                            <p class="mb-1"><strong>TTL:</strong> {{ $jamaah->birth_place }}, {{ $jamaah->birth_date?->format('d M Y') }}</p>
                            <p class="mb-1"><strong>Gender:</strong> {{ $jamaah->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Alamat:</strong> {{ $jamaah->address }}</p>
                            <p class="mb-1"><strong>Darurat:</strong> {{ $jamaah->emergency_name }} ({{ $jamaah->emergency_phone }})</p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Dokumen -->
                    @if($jamaah->documents->count() > 0)
                    <div class="mt-3">
                        <small class="text-muted d-block mb-2">Dokumen:</small>
                        @foreach($jamaah->documents as $doc)
                        <div class="doc-item">
                            @if(in_array(pathinfo($doc->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                <img src="{{ Storage::url($doc->file_path) }}" class="doc-thumb" alt="{{ $doc->document_type }}">
                            @else
                                <div class="doc-thumb d-flex align-items-center justify-content-center bg-light">
                                    <i class="bi bi-file-pdf text-danger" style="font-size: 1.5rem;"></i>
                                </div>
                            @endif
                            <small>{{ strtoupper($doc->document_type) }}</small>
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
            <!-- Pembayaran -->
            <div class="detail-card">
                <h5><i class="bi bi-credit-card"></i> Pembayaran</h5>
                <div class="info-row">
                    <div class="info-label">Total</div>
                    <div class="info-value">Rp {{ number_format($registration->total_price, 0, ',', '.') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">DP (30%)</div>
                    <div class="info-value">Rp {{ number_format($registration->dp_amount, 0, ',', '.') }}</div>
                </div>
                
                <hr>
                
                @foreach($registration->payments as $payment)
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>{{ strtoupper($payment->payment_type) }}</strong>
                        <span class="badge-status badge-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span>
                    </div>
                    <small class="text-muted">Rp {{ number_format($payment->amount, 0, ',', '.') }}</small>
                    
                    @if($payment->proof_path)
                    <div class="mt-2">
                        <a href="{{ Storage::url($payment->proof_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Lihat Bukti
                        </a>
                        <a href="{{ Storage::url($payment->proof_path) }}" download class="btn btn-sm btn-outline-success">
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                    @endif
                    
                    @if($payment->verified_at)
                    <small class="text-muted d-block mt-1">
                        Verified: {{ $payment->verified_at->format('d M Y H:i') }}
                    </small>
                    @endif
                </div>
                @endforeach
            </div>
            
            <!-- Timeline -->
            <div class="detail-card">
                <h5><i class="bi bi-clock-history"></i> Timeline</h5>
                <div class="timeline">
                    <div class="timeline-item">
                        <strong>Pendaftaran Dibuat</strong>
                        <small class="text-muted d-block">{{ $registration->created_at->format('d M Y H:i') }}</small>
                    </div>
                    
                    @php $dpPayment = $registration->payments->where('payment_type', 'dp')->first(); @endphp
                    
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
                    
                    @if($registration->completion_percentage >= 70)
                    <div class="timeline-item">
                        <strong>Dokumen Dilengkapi</strong>
                        <small class="text-muted d-block">{{ $registration->updated_at->format('d M Y H:i') }}</small>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="detail-card">
                <h5><i class="bi bi-lightning"></i> Quick Actions</h5>
                <div class="d-grid gap-2">
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $registration->phone) }}" target="_blank" class="btn btn-success">
                        <i class="bi bi-whatsapp"></i> Hubungi via WA
                    </a>
                    <a href="mailto:{{ $registration->email }}" class="btn btn-outline-primary">
                        <i class="bi bi-envelope"></i> Kirim Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>