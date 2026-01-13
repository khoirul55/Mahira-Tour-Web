<!DOCTYPE html>
<html>
<head>
    <title>Semua Pendaftaran - Admin Mahira Tour</title>
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
            justify-content: between;
            align-items: center;
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
        
        .stat-mini {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.2s;
        }
        
        .stat-mini:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }
        
        .stat-mini h4 {
            margin: 0;
            font-size: 2rem;
            color: #001D5F;
            font-weight: 700;
        }
        
        .stat-mini small {
            color: #6B7280;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
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
        
        .badge-status {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-draft { background: #E5E7EB; color: #374151; }
        .badge-pending { background: #FEF3C7; color: #D97706; }
        .badge-confirmed { background: #D1FAE5; color: #059669; }
        .badge-cancelled { background: #FEE2E2; color: #DC2626; }
        
        .progress-mini {
            height: 8px;
            border-radius: 4px;
            background: #E8EBF3;
        }
        
        .progress-bar {
            background: linear-gradient(90deg, #10B981 0%, #059669 100%);
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
            <i class="bi bi-person-circle"></i> {{ session('admin_name', 'Admin') }}
        </div>
        <small style="opacity: 0.8;">{{ session('admin_email') }}</small>
    </div>
    
    <hr style="border-color: rgba(255,255,255,0.2);">
    
    <nav>
        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.registrations.index') }}" class="active">
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
    <div class="page-header">
        <div>
            <h2><i class="bi bi-file-earmark-text" style="color: #3B82F6;"></i> Semua Pendaftaran</h2>
            <small class="text-muted">Kelola semua data pendaftaran jamaah</small>
        </div>
        <div>
            <a href="{{ route('admin.registrations.export') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-mini">
                <h4>{{ $stats['total'] ?? $registrations->total() }}</h4>
                <small>Total Pendaftaran</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini">
                <h4>{{ $stats['draft'] ?? 0 }}</h4>
                <small>Draft</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini">
                <h4>{{ $stats['pending'] ?? 0 }}</h4>
                <small>Pending</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini">
                <h4>{{ $stats['confirmed'] ?? 0 }}</h4>
                <small>Confirmed</small>
            </div>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.registrations.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-bold">Cari</label>
                    <input type="text" name="search" class="form-control" placeholder="No. Reg / Nama / Email" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Jadwal/Paket</label>
                    <select name="schedule_id" class="form-select">
                        <option value="">Semua Jadwal</option>
                        @foreach($schedules ?? [] as $schedule)
                        <option value="{{ $schedule->id }}" {{ request('schedule_id') == $schedule->id ? 'selected' : '' }}>
                            {{ $schedule->package_name }} - {{ $schedule->departure_date->format('d M Y') }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Urutkan</label>
                    <select name="sort" class="form-select">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($registrations->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h5>Tidak Ada Data</h5>
                    <p class="text-muted">Belum ada pendaftaran sesuai filter</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. Registrasi</th>
                                <th>Nama</th>
                                <th>Paket</th>
                                <th>Jamaah</th>
                                <th>Total</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $reg)
                            <tr>
                                <td>
                                    <strong class="text-primary">{{ $reg->registration_number }}</strong>
                                </td>
                                <td>
                                    <div><strong>{{ $reg->full_name }}</strong></div>
                                    <small class="text-muted">
                                        <i class="bi bi-telephone"></i> {{ $reg->phone }}
                                    </small>
                                </td>
                                <td>
                                    <div>{{ $reg->schedule->package_name ?? '-' }}</div>
                                    <small class="text-muted">{{ $reg->schedule?->departure_date?->format('d M Y') }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $reg->num_people }} org</span>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($reg->total_price, 0, ',', '.') }}</strong>
                                </td>
                                <td style="min-width: 120px;">
                                    <div class="progress progress-mini">
                                        <div class="progress-bar" style="width: {{ $reg->completion_percentage }}%"></div>
                                    </div>
                                    <small class="text-muted">{{ $reg->completion_percentage }}%</small>
                                </td>
                                <td>
                                    <span class="badge-status badge-{{ $reg->status }}">
                                        {{ ucfirst($reg->status) }}
                                    </span>
                                </td>
                                <td>
                                    <small>{{ $reg->created_at->format('d M Y') }}</small><br>
                                    <small class="text-muted">{{ $reg->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.registrations.show', $reg->id) }}">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('registration.dashboard', ['reg' => $reg->registration_number, 'token' => $reg->access_token]) }}" target="_blank">
                                                    <i class="bi bi-box-arrow-up-right"></i> Dashboard User
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.registrations.export-single', $reg->id) }}">
                                                    <i class="bi bi-file-earmark-excel"></i> Export Data
                                                </a>
                                            </li>
                                            @if($reg->jamaah->flatMap->documents->count() > 0)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.documents.download-all', $reg->id) }}">
                                                    <i class="bi bi-file-zip"></i> Download Dokumen
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center p-3 border-top">
                    <small class="text-muted">
                        Menampilkan {{ $registrations->firstItem() ?? 0 }} - {{ $registrations->lastItem() ?? 0 }} dari {{ $registrations->total() }} data
                    </small>
                    {{ $registrations->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>