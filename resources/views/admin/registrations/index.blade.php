<!DOCTYPE html>
<html>
<head>
    <title>Semua Pendaftaran - Admin Mahira Tour</title>
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
            margin-bottom: 8px;
        }
        .sidebar nav a:hover, .sidebar nav a.active {
            background: rgba(255,255,255,0.15);
        }
        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .table-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .table th {
            background: #001D5F;
            color: white;
            font-weight: 600;
            border: none;
        }
        .table td {
            vertical-align: middle;
        }
        .badge-status {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .badge-draft { background: #E5E7EB; color: #374151; }
        .badge-pending { background: #FEF3C7; color: #D97706; }
        .badge-confirmed { background: #D1FAE5; color: #059669; }
        .badge-cancelled { background: #FEE2E2; color: #DC2626; }
        .btn-action {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
        }
        .progress-mini {
            height: 8px;
            border-radius: 4px;
        }
        .stats-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-mini {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            flex: 1;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .stat-mini h4 {
            margin: 0;
            font-size: 1.5rem;
            color: #001D5F;
        }
        .stat-mini small {
            color: #6B7280;
        }
    </style>
</head>
<body x-data="registrationsApp()">

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
        <a href="{{ route('admin.dashboard') }}" class="text-white">
            <i class="bi bi-house"></i> Dashboard
        </a>
        <a href="{{ route('admin.registrations.index') }}" class="text-white active">
            <i class="bi bi-file-earmark-text"></i> Semua Pendaftaran
        </a>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Semua Pendaftaran</h2>
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
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    <!-- Stats Row -->
    <div class="stats-row">
        <div class="stat-mini">
            <h4>{{ $stats['total'] ?? $registrations->total() }}</h4>
            <small>Total Pendaftaran</small>
        </div>
        <div class="stat-mini">
            <h4>{{ $stats['draft'] ?? 0 }}</h4>
            <small>Draft</small>
        </div>
        <div class="stat-mini">
            <h4>{{ $stats['pending'] ?? 0 }}</h4>
            <small>Pending</small>
        </div>
        <div class="stat-mini">
            <h4>{{ $stats['confirmed'] ?? 0 }}</h4>
            <small>Confirmed</small>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="filter-card">
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
    
    <!-- Table -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover">
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
                    @forelse($registrations as $reg)
                    <tr>
                        <td>
                            <strong>{{ $reg->registration_number }}</strong>
                        </td>
                        <td>
                            <div>{{ $reg->full_name }}</div>
                            <small class="text-muted">{{ $reg->phone }}</small>
                        </td>
                        <td>
                            <small>{{ $reg->schedule->package_name ?? '-' }}</small><br>
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
                                <div class="progress-bar bg-success" style="width: {{ $reg->completion_percentage }}%"></div>
                            </div>
                            <small class="text-muted">{{ $reg->completion_percentage }}%</small>
                        </td>
                        <td>
                            @switch($reg->status)
                                @case('draft')
                                    <span class="badge-status badge-draft">Draft</span>
                                    @break
                                @case('pending')
                                    <span class="badge-status badge-pending">Pending</span>
                                    @break
                                @case('confirmed')
                                    <span class="badge-status badge-confirmed">Confirmed</span>
                                    @break
                                @case('cancelled')
                                    <span class="badge-status badge-cancelled">Cancelled</span>
                                    @break
                                @default
                                    <span class="badge-status badge-draft">{{ $reg->status }}</span>
                            @endswitch
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
                                            <i class="bi bi-box-arrow-up-right"></i> Lihat Dashboard User
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
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #CBD5E1;"></i>
                            <p class="text-muted mt-2">Belum ada data pendaftaran</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Menampilkan {{ $registrations->firstItem() ?? 0 }} - {{ $registrations->lastItem() ?? 0 }} dari {{ $registrations->total() }} data
            </small>
            {{ $registrations->withQueryString()->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function registrationsApp() {
    return {
        // Future: Add bulk actions, etc
    }
}
</script>
</body>
</html>