<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perlu Pelunasan - Admin</title>
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
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .page-header h2 {
            margin: 0;
            font-weight: 700;
            color: #1a1a1a;
            font-size: 1.8rem;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 15px;
        }
        
        .table tbody td {
            vertical-align: middle;
            padding: 15px;
            border-bottom: 1px solid #f1f3f5;
        }
        
        .table tbody tr:hover {
            background: #f8f9fa;
        }
        
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
        
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
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
            border-bottom: 1px solid #f1f3f5;
            padding: 20px 25px;
        }
        
        .modal-body {
            padding: 25px;
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
            <i class="bi bi-house"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.registrations.index') }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Semua Pendaftaran</span>
        </a>
        <a href="{{ route('admin.pelunasan.index') }}" class="active">
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
<div class="main-content" x-data="pelunasanApp()">
    <div class="page-header">
        <i class="bi bi-wallet" style="font-size: 2rem; color: #F59E0B;"></i>
        <h2>Perlu Pelunasan</h2>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    <div class="card">
        <div class="card-body p-0">
            @if($registrations->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-check-circle"></i>
                    <h5>Tidak Ada Pelunasan Pending</h5>
                    <p class="text-muted">Semua pembayaran sudah lunas atau belum ada yang perlu pelunasan</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. Reg</th>
                                <th>Nama Jamaah</th>
                                <th>Paket</th>
                                <th>Total Biaya</th>
                                <th>Sisa Pelunasan</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $reg)
                            @php
                                $pelunasan = $reg->pelunasanPayment();
                                $sisa = $reg->sisaPelunasan();
                                $isOverdue = $reg->pelunasan_deadline && $reg->pelunasan_deadline->isPast();
                            @endphp
                            <tr>
                                <td>
                                    <strong class="text-primary">{{ $reg->registration_number }}</strong>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $reg->full_name }}</strong>
                                    </div>
                                    <small class="text-muted">
                                        <i class="bi bi-telephone"></i> {{ $reg->phone }}
                                    </small><br>
                                    <small class="text-muted">
                                        <i class="bi bi-envelope"></i> {{ $reg->email }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $reg->schedule->package_name }}</span>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($reg->total_price, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <strong class="text-danger" style="font-size: 1.1rem;">
                                        Rp {{ number_format($sisa, 0, ',', '.') }}
                                    </strong>
                                </td>
                                <td>
                                    @if($reg->pelunasan_deadline)
                                        <div class="{{ $isOverdue ? 'text-danger' : 'text-warning' }}">
                                            <i class="bi bi-calendar-event"></i>
                                            <strong>{{ $reg->pelunasan_deadline->format('d M Y') }}</strong>
                                        </div>
                                        <small class="text-muted">
                                            {{ $reg->pelunasan_deadline->diffForHumans() }}
                                        </small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pelunasan)
                                        @if($pelunasan->status === 'pending')
                                            <span class="badge bg-warning">
                                                <i class="bi bi-clock"></i> Menunggu Verifikasi
                                            </span>
                                        @elseif($pelunasan->status === 'rejected')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle"></i> Ditolak
                                            </span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-exclamation-circle"></i> Belum Bayar
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- Tombol Kirim Tagihan -->
                                        @if(!$pelunasan || $pelunasan->status === 'rejected')
                                            <form action="{{ route('admin.pelunasan.send-tagihan', $reg->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-primary" type="submit" title="Kirim Email Tagihan">
                                                    <i class="bi bi-send"></i> Kirim Tagihan
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <!-- Tombol Lihat/Approve/Reject -->
                                        @if($pelunasan && $pelunasan->status === 'pending')
                                            <a href="{{ Storage::url($pelunasan->proof_path) }}" target="_blank" class="btn btn-sm btn-info" title="Lihat Bukti">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            
                                            <form action="{{ route('admin.pelunasan.verify', $pelunasan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="action" value="approve">
                                                <button class="btn btn-sm btn-success" type="submit" title="Approve Pelunasan">
                                                    <i class="bi bi-check-lg"></i> Approve
                                                </button>
                                            </form>
                                            
                                            <button class="btn btn-sm btn-danger" @click="openRejectModal({{ $pelunasan->id }})" title="Tolak Pelunasan">
                                                <i class="bi bi-x-lg"></i> Reject
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Reject -->
<div class="modal fade" id="rejectModal" tabindex="-1" x-ref="rejectModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form :action="'/admin/pelunasan/' + rejectPaymentId + '/verify'" method="POST">
                @csrf
                <input type="hidden" name="action" value="reject">
                
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle text-danger"></i>
                        Tolak Pelunasan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alasan Penolakan:</label>
                        <textarea name="rejection_reason" class="form-control" rows="4" required 
                                  placeholder="Contoh: Nominal transfer tidak sesuai, bukti tidak jelas, dll."></textarea>
                    </div>
                    <div class="alert alert-warning">
                        <i class="bi bi-info-circle"></i>
                        <small>Jamaah akan menerima email notifikasi dengan alasan penolakan ini</small>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> Tolak Pelunasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function pelunasanApp() {
    return {
        rejectPaymentId: null,
        
        openRejectModal(paymentId) {
            this.rejectPaymentId = paymentId;
            new bootstrap.Modal(this.$refs.rejectModal).show();
        }
    }
}
</script>

</body>
</html>