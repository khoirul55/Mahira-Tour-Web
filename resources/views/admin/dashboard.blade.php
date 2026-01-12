<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Mahira Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .payment-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .admin-info {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
        }
        .sidebar nav a {
            text-decoration: none;
            transition: all 0.3s;
            padding: 8px 12px;
            border-radius: 8px;
            display: block;
            margin-bottom: 10px;
        }
        .sidebar nav a:hover, .sidebar nav a.active {
            background: rgba(255,255,255,0.15);
        }
        
        /* Tab Navigation */
        .nav-tabs-custom {
            border-bottom: 2px solid #E8EBF3;
            margin-bottom: 2rem;
        }
        .nav-tabs-custom .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #6B7280;
            font-weight: 600;
            padding: 1rem 1.5rem;
            margin-bottom: -2px;
        }
        .nav-tabs-custom .nav-link:hover {
            border-color: transparent;
            color: #001D5F;
        }
        .nav-tabs-custom .nav-link.active {
            border-bottom-color: #001D5F;
            color: #001D5F;
            background: transparent;
        }
        
        /* Document Card */
        .doc-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid #001D5F;
        }
        .doc-card.pending { border-left-color: #F59E0B; }
        .doc-card.verified { border-left-color: #10B981; }
        
        .jamaah-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #E8EBF3;
        }
        .jamaah-name {
            font-weight: 700;
            color: #001D5F;
            font-size: 1.1rem;
        }
        .doc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }
        .doc-item {
            background: #F8F9FF;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
        }
        .doc-item img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        .doc-item .doc-icon {
            width: 100%;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #E8EBF3;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        .doc-item .doc-icon i { font-size: 2rem; color: #6B7280; }
        .badge-passport-request {
            background: #FEF3C7;
            color: #F59E0B;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
        }
        
        /* Modal */
        .modal-preview .modal-content { border-radius: 16px; }
        .modal-preview .modal-header {
            background: linear-gradient(135deg, #001D5F 0%, #002B8F 100%);
            color: white;
            border-radius: 16px 16px 0 0;
        }
        .modal-preview img {
            max-width: 100%;
            max-height: 70vh;
            border-radius: 8px;
        }
    </style>
</head>
<body x-data="adminApp()">

<!-- Sidebar -->
<div class="sidebar">
    <h4><i class="bi bi-shield-check"></i> Admin Panel</h4>
    
    <div class="admin-info">
        <div style="font-weight: 600;">
            <i class="bi bi-person-circle"></i> {{ session('admin_name', 'Admin') }}
        </div>
        <small style="opacity: 0.8;">{{ session('admin_email') }}</small>
    </div>
    
    <hr style="border-color: rgba(255,255,255,0.2);">
    
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="text-white active">
            <i class="bi bi-house"></i> Dashboard
        </a>
        <a href="{{ route('admin.registrations.index') }}" class="text-white">
            <i class="bi bi-file-earmark-text"></i> Semua Pendaftaran
        </a>
            <a href="{{ route('admin.pelunasan.index') }}" class="text-white">
        <i class="bi bi-wallet"></i> Perlu Pelunasan
        @php
            $countPelunasan = \App\Models\Registration::where('status', 'confirmed')
                ->where('is_lunas', false)
                ->whereHas('payments', function($q) {
                    $q->where('payment_type', 'dp')->where('status', 'verified');
                })
                ->count();
        @endphp
        @if($countPelunasan > 0)
            <span class="badge bg-danger">{{ $countPelunasan }}</span>
        @endif
    </a>
        {{-- Dokumen diakses via tab di dashboard --}}
        <a href="{{ route('admin.galleries.index') }}" class="text-white">
            <i class="bi bi-images"></i> Kelola Galeri
        </a>
        <a href="{{ route('admin.schedules.index') }}" class="text-white">
            <i class="bi bi-calendar-event"></i> Kelola Jadwal
        </a>
        <a href="{{ route('admin.logout') }}" class="text-white">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </nav>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Dashboard Admin</h1>
            <p class="text-muted mb-0">Selamat datang, <strong>{{ session('admin_name', 'Admin') }}</strong> 👋</p>
        </div>
        <div class="text-end">
            <small class="text-muted">
                <i class="bi bi-clock"></i> {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </small>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <h6 class="text-muted">Pending Verifikasi DP</h6>
                <h2>{{ $stats['pending'] ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <h6 class="text-muted">Dokumen Pending</h6>
                <h2>{{ $stats['pending_docs'] ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <h6 class="text-muted">Confirmed</h6>
                <h2>{{ $stats['confirmed'] ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <h6 class="text-muted">Total Revenue</h6>
                <h2>Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
    
    <!-- Tabs -->
    <ul class="nav nav-tabs-custom" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-payments">
                <i class="bi bi-credit-card"></i> Verifikasi DP
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-documents">
                <i class="bi bi-folder"></i> Dokumen Jamaah
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-passport">
                <i class="bi bi-passport"></i> Request Passport
            </button>
        </li>
    </ul>
    
    <div class="tab-content">
        <!-- Tab: Verifikasi DP -->
        <div class="tab-pane fade show active" id="tab-payments">
            <h4 class="mb-3">Verifikasi DP</h4>
            
            @forelse($pendingPayments ?? [] as $payment)
            <div class="payment-card">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <strong>{{ $payment->registration->registration_number }}</strong><br>
                        <small>{{ $payment->registration->full_name }}</small><br>
                        <small class="text-muted">{{ $payment->registration->phone }}</small>
                    </div>
                    <div class="col-md-2">
                        <strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong><br>
                        <small class="text-muted">{{ ucfirst($payment->payment_method) }}</small>
                    </div>
                    <div class="col-md-3">
                        @if($payment->proof_path)
                        <button class="btn btn-sm btn-info" @click="openPreview('{{ Storage::url($payment->proof_path) }}', 'Bukti DP')">
                            <i class="bi bi-eye"></i> Lihat
                        </button>
                        <a href="{{ Storage::url($payment->proof_path) }}" download class="btn btn-sm btn-success">
                            <i class="bi bi-download"></i>
                        </a>
                        @else
                        <span class="text-muted">Belum upload</span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <form action="{{ route('admin.verify-payment', $payment->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="action" value="approve">
                            <button class="btn btn-success btn-sm"><i class="bi bi-check"></i> Approve</button>
                        </form>
                        <button class="btn btn-danger btn-sm" @click="rejectPayment({{ $payment->id }})">
                            <i class="bi bi-x"></i> Reject
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info">Tidak ada DP yang perlu diverifikasi</div>
            @endforelse
        </div>
        
        
        <!-- Tab: Dokumen -->
        <div class="tab-pane fade" id="tab-documents">
            <h4 class="mb-3">Dokumen Jamaah</h4>
            
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
                        <span class="badge-passport-request ms-2"><i class="bi bi-passport"></i> Butuh Passport</span>
                        @endif
                    </h6>
                    
                    @if($jamaah->documents->count() > 0)
                    <div class="doc-grid">
                        @foreach($jamaah->documents as $doc)
                        <div class="doc-item">
                            @if(in_array(pathinfo($doc->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                <img src="{{ Storage::url($doc->file_path) }}" alt="{{ $doc->document_type }}">
                            @else
                                <div class="doc-icon"><i class="bi bi-file-pdf text-danger"></i></div>
                            @endif
                            <small class="d-block">{{ strtoupper($doc->document_type) }}</small>
                            <div class="mt-1">
                                <button class="btn btn-xs btn-outline-primary" @click="openPreview('{{ Storage::url($doc->file_path) }}', '{{ $doc->document_type }}')">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <a href="{{ Storage::url($doc->file_path) }}" download class="btn btn-xs btn-outline-success">
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
                <div class="text-end pt-2 border-top">
                    <a href="{{ route('admin.documents.download-all', $registration->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-file-zip"></i> Download Semua (ZIP)
                    </a>
                </div>
                @endif
            </div>
            @empty
            <div class="alert alert-info">Belum ada dokumen</div>
            @endforelse
        </div>
        
        <!-- Tab: Passport -->
        <div class="tab-pane fade" id="tab-passport">
            <h4 class="mb-3">Request Pembuatan Passport</h4>
            
            @forelse($passportRequests ?? [] as $jamaah)
            <div class="payment-card">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <strong>{{ $jamaah->full_name }}</strong><br>
                        <small class="text-muted">NIK: {{ $jamaah->nik }}</small>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">Registrasi:</small><br>
                        <strong>{{ $jamaah->registration->registration_number }}</strong>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">Kontak:</small><br>
                        {{ $jamaah->registration->phone }}
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('admin.passport.process', $jamaah->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-success"><i class="bi bi-check"></i> Proses</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info">Tidak ada request passport</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade modal-preview" id="previewModal" tabindex="-1" x-ref="previewModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" x-text="previewTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <template x-if="previewType === 'image'">
                    <img :src="previewUrl" class="img-fluid">
                </template>
                <template x-if="previewType === 'pdf'">
                    <iframe :src="previewUrl" style="width:100%; height:70vh; border:none;"></iframe>
                </template>
            </div>
            <div class="modal-footer">
                <a :href="previewUrl" download class="btn btn-success"><i class="bi bi-download"></i> Download</a>
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