<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Mahira Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        
        .sidebar nav a.active {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
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
        
        .page-header h1 {
            margin: 0;
            font-weight: 700;
            color: #1a1a1a;
            font-size: 1.8rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            border-left: 4px solid #001D5F;
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }
        
        .stat-card h6 {
            color: #6B7280;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        
        .stat-card h2 {
            color: #001D5F;
            font-weight: 700;
            margin: 0;
            font-size: 2rem;
        }
        
        .stat-card.pending { border-left-color: #F59E0B; }
        .stat-card.success { border-left-color: #10B981; }
        .stat-card.revenue { border-left-color: #3B82F6; }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        
        .nav-tabs-custom {
            border-bottom: 2px solid #E8EBF3;
            margin-bottom: 2rem;
            background: white;
            padding: 0 20px;
            border-radius: 12px 12px 0 0;
        }
        
        .nav-tabs-custom .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #6B7280;
            font-weight: 600;
            padding: 1rem 1.5rem;
            margin-bottom: -2px;
            transition: all 0.3s;
        }
        
        .nav-tabs-custom .nav-link:hover {
            color: #001D5F;
            background: rgba(0, 29, 95, 0.05);
        }
        
        .nav-tabs-custom .nav-link.active {
            border-bottom-color: #001D5F;
            color: #001D5F;
            background: transparent;
        }
        
        .payment-card, .doc-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid #E8EBF3;
            transition: all 0.3s;
        }
        
        .payment-card:hover, .doc-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transform: translateX(5px);
        }
        
        .payment-card.pending { border-left-color: #F59E0B; }
        .doc-card.pending { border-left-color: #F59E0B; }
        .doc-card.verified { border-left-color: #10B981; }
        
        .badge {
            padding: 6px 12px;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.75rem;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.813rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-sm:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .btn-xs {
            padding: 4px 8px;
            font-size: 0.75rem;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-xs:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }
        
        .jamaah-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #E8EBF3;
        }
        
        .jamaah-name {
            font-weight: 700;
            color: #001D5F;
            font-size: 1.1rem;
        }
        
        .doc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .doc-item {
            background: #F8F9FF;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s;
        }
        
        .doc-item:hover {
            background: #E8EBF3;
            transform: scale(1.05);
        }
        
        .doc-item img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        
        .doc-icon {
            width: 100%;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #E8EBF3;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        
        .doc-icon i { 
            font-size: 2rem; 
            color: #6B7280; 
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 4rem;
            opacity: 0.3;
            margin-bottom: 20px;
        }
        
        .modal-content {
            border: none;
            border-radius: 12px;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #001D5F 0%, #003087 100%);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 20px 25px;
        }
        
        .modal-body {
            padding: 25px;
        }

        /* Mobile Responsive Styles */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            padding: 10px 15px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: none;
            color: #001D5F;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
                padding-top: 80px; /* Space for toggle button */
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar-overlay.show {
                display: block;
                opacity: 1;
            }
            
            .stat-card, .payment-card, .doc-card {
                margin-bottom: 15px;
            }
            
            .nav-tabs-custom {
                padding: 0 10px;
                overflow-x: auto;
                flex-wrap: nowrap;
                white-space: nowrap;
            }
            
            .nav-tabs-custom .nav-link {
                padding: 1rem;
            }
        }
</head>
<body x-data="adminApp()">

<!-- Sidebar -->
<div class="sidebar">
    <h4>
        <i class="bi bi-shield-check"></i>
        Admin Panel
    </h4>
    
    <div class="admin-info">
        <div style="font-weight: 600;">
            <i class="bi bi-person-circle"></i> {{ session('admin_name', 'Admin') }}
        </div>
        <small style="opacity: 0.8;">{{ session('admin_email') }}</small>
    </div>
    
    <hr style="border-color: rgba(255,255,255,0.2);">
    
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="active">
            <i class="bi bi-house"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.registrations.index') }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Semua Pendaftaran</span>
        </a>
        <a href="{{ route('admin.pelunasan.index') }}">
            <i class="bi bi-wallet"></i>
            <span>Perlu Pelunasan</span>
            @php
                $countPelunasan = \App\Models\Registration::where('status', 'confirmed')
                    ->where('is_lunas', false)
                    ->whereHas('payments', function($q) {
                        $q->where('payment_type', 'dp')->where('status', 'verified');
                    })
                    ->count();
            @endphp
            @if($countPelunasan > 0)
                <span class="badge bg-danger ms-auto">{{ $countPelunasan }}</span>
            @endif
        </a>
        <a href="{{ route('admin.galleries.index') }}">
            <i class="bi bi-images"></i>
            <span>Kelola Galeri</span>
        </a>
        <a href="{{ route('admin.schedules.index') }}">
            <i class="bi bi-calendar-event"></i>
            <span>Kelola Jadwal</span>
        </a>
        <a href="{{ route('admin.logout') }}">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>
    </nav>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="mb-1">Dashboard Admin</h1>
                <p class="text-muted mb-0">Selamat datang, <strong>{{ session('admin_name', 'Admin') }}</strong> 👋</p>
            </div>
            <div class="text-end">
                <small class="text-muted">
                    <i class="bi bi-clock"></i> {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                </small>
            </div>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card pending">
                <h6>Pending Verifikasi DP</h6>
                <h2>{{ $stats['pending'] ?? 0 }}</h2>
                <small class="text-muted">Butuh verifikasi</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card pending">
                <h6>Dokumen Pending</h6>
                <h2>{{ $stats['pending_docs'] ?? 0 }}</h2>
                <small class="text-muted">Perlu review</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card success">
                <h6>Confirmed</h6>
                <h2>{{ $stats['confirmed'] ?? 0 }}</h2>
                <small class="text-muted">Jamaah aktif</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card revenue">
                <h6>Total Revenue</h6>
                <h2>{{ number_format(($stats['total_revenue'] ?? 0) / 1000000, 1) }}M</h2>
                <small class="text-muted">Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</small>
            </div>
        </div>
    </div>
    
    <!-- Tabs -->
    <ul class="nav nav-tabs-custom" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-payments">
                <i class="bi bi-credit-card"></i> Verifikasi DP ({{ count($pendingPayments ?? []) }})
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-documents">
                <i class="bi bi-folder"></i> Dokumen Jamaah ({{ count($registrationsWithDocs ?? []) }})
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-passport">
                <i class="bi bi-passport"></i> Request Passport ({{ count($passportRequests ?? []) }})
            </button>
        </li>
    </ul>
    
    <div class="tab-content">
        <!-- Tab: Verifikasi DP -->
        <div class="tab-pane fade show active" id="tab-payments">
            @forelse($pendingPayments ?? [] as $payment)
            <div class="payment-card pending">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <strong class="text-primary">{{ $payment->registration->registration_number }}</strong><br>
                        <span>{{ $payment->registration->full_name }}</span><br>
                        <small class="text-muted">
                            <i class="bi bi-telephone"></i> {{ $payment->registration->phone }}
                        </small>
                    </div>
                    <div class="col-md-2">
                        <strong style="font-size: 1.1rem;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong><br>
                        <small class="text-muted">{{ ucfirst($payment->payment_method) }}</small>
                    </div>
                    <div class="col-md-3">
                        @if($payment->proof_path)
                        <button class="btn btn-sm btn-info" @click="openPreview('{{ route('admin.secure.file', ['path' => $payment->proof_path]) }}', 'Bukti DP')">
                            <i class="bi bi-eye"></i> Lihat Bukti
                        </button>
                        @else
                        <span class="text-muted">Belum upload</span>
                        @endif
                    </div>
                    <div class="col-md-4 text-end">
                        <form action="{{ route('admin.verify-payment', $payment->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="action" value="approve">
                            <button class="btn btn-success btn-sm">
                                <i class="bi bi-check-lg"></i> Approve
                            </button>
                        </form>
                        <button class="btn btn-danger btn-sm" @click="rejectPayment({{ $payment->id }})">
                            <i class="bi bi-x-lg"></i> Reject
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="bi bi-check-circle"></i>
                <h5>Tidak Ada DP Pending</h5>
                <p class="text-muted">Semua pembayaran DP sudah diverifikasi</p>
            </div>
            @endforelse
        </div>
        
        <!-- Tab: Dokumen -->
        <div class="tab-pane fade" id="tab-documents">
            @forelse($registrationsWithDocs ?? [] as $registration)
            <div class="doc-card">
                <div class="jamaah-header">
                    <div>
                        <span class="jamaah-name">{{ $registration->registration_number }}</span>
                        <span class="badge bg-{{ $registration->status === 'confirmed' ? 'success' : 'warning' }} ms-2">
                            {{ ucfirst($registration->status) }}
                        </span>
                    </div>
                    <span class="text-muted">{{ $registration->full_name }} | {{ $registration->num_people }} Jamaah</span>
                </div>
                
                @foreach($registration->jamaah as $jamaah)
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">
                        <i class="bi bi-person-fill text-primary"></i> {{ $jamaah->full_name }}
                        @if($jamaah->need_passport ?? false)
                        <span class="badge bg-info ms-2">
                            <i class="bi bi-passport"></i> Butuh Passport
                        </span>
                        @endif
                    </h6>
                    
                    @if($jamaah->documents->count() > 0)
                    <div class="doc-grid">
                        @foreach($jamaah->documents as $doc)
                        <div class="doc-item">
                            @if(in_array(pathinfo($doc->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                <img src="{{ route('admin.secure.file', ['path' => $doc->file_path]) }}" alt="{{ $doc->document_type }}" style="cursor: pointer;" @click="openPreview('{{ route('admin.secure.file', ['path' => $doc->file_path]) }}', '{{ $doc->document_type }}')">
                            @else
                                <div class="doc-icon"><i class="bi bi-file-pdf text-danger"></i></div>
                            @endif
                            <small class="d-block fw-bold">{{ strtoupper($doc->document_type) }}</small>
                            @if($doc->is_verified)
                                <i class="bi bi-check-circle-fill text-success"></i>
                            @endif
                            <div class="mt-2">
                                <button class="btn btn-xs btn-outline-primary" @click="openPreview('{{ route('admin.secure.file', ['path' => $doc->file_path]) }}', '{{ strtoupper($doc->document_type) }}')">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <a href="{{ route('admin.secure.file', ['path' => $doc->file_path]) }}" download class="btn btn-xs btn-outline-success">
                                    <i class="bi bi-download"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <small class="text-muted">Belum ada dokumen</small>
                    @endif
                </div>
                @endforeach
                
                @if($registration->jamaah->flatMap->documents->count() > 0)
                <div class="pt-3 border-top mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="bi bi-file-earmark-check"></i> 
                            Total {{ $registration->jamaah->flatMap->documents->count() }} dokumen
                        </small>
                        <a href="{{ route('admin.documents.download-all', $registration->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-file-zip"></i> Download Semua (ZIP)
                        </a>
                    </div>
                </div>
                @endif
            </div>
            @empty
            <div class="empty-state">
                <i class="bi bi-folder"></i>
                <h5>Tidak Ada Dokumen</h5>
                <p class="text-muted">Belum ada jamaah yang upload dokumen</p>
            </div>
            @endforelse
        </div>
        
        <!-- Tab: Passport -->
        <div class="tab-pane fade" id="tab-passport">
            @forelse($passportRequests ?? [] as $jamaah)
            <div class="payment-card">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <strong>{{ $jamaah->full_name }}</strong><br>
                        <small class="text-muted">NIK: {{ $jamaah->nik }}</small>
                    </div>
                    <div class="col-md-3">
                        <strong class="text-primary">{{ $jamaah->registration->registration_number }}</strong>
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-telephone"></i> {{ $jamaah->registration->phone }}
                    </div>
                    <div class="col-md-3 text-end">
                        <form action="{{ route('admin.passport.process', $jamaah->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success">
                                <i class="bi bi-check-lg"></i> Proses
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="bi bi-passport"></i>
                <h5>Tidak Ada Request Passport</h5>
                <p class="text-muted">Semua jamaah sudah memiliki passport</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" x-ref="previewModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" x-text="previewTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <template x-if="previewType === 'image'">
                    <img :src="previewUrl" class="img-fluid" style="max-height: 70vh; border-radius: 8px;">
                </template>
                <template x-if="previewType === 'pdf'">
                    <iframe :src="previewUrl" style="width:100%; height:70vh; border:none;"></iframe>
                </template>
            </div>
            <div class="modal-footer">
                <a :href="previewUrl" download class="btn btn-success">
                    <i class="bi bi-download"></i> Download
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function adminApp() {
    return {
        previewUrl: '',
        previewTitle: '',
        previewType: 'image',
        
        openPreview(url, title) {
            this.previewUrl = url;
            this.previewTitle = title;
            this.previewType = url.toLowerCase().endsWith('.pdf') ? 'pdf' : 'image';
            new bootstrap.Modal(this.$refs.previewModal).show();
        },
        
        rejectPayment(id) {
            const reason = prompt('Alasan penolakan:');
            if (reason) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/verify-payment/${id}`;
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="action" value="reject">
                    <input type="hidden" name="notes" value="${reason}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    }
}
</script>
</body>
</html>