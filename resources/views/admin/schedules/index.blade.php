<!DOCTYPE html>
<html>
<head>
    <title>Kelola Jadwal Paket - Mahira Tour Admin</title>
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
            height: 100vh;
            width: 260px;
            background: linear-gradient(135deg, #001D5F 0%, #003087 100%);
            color: white;
            padding: 30px 20px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }
        .main-content {
            margin-left: 260px;
            padding: 30px;
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
        .schedule-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        .schedule-card:hover {
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .flyer-img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
        }
        .badge-status {
            font-size: 0.75rem;
            padding: 5px 12px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
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
    </style>
</head>
<body x-data="scheduleApp()">

<!-- Sidebar -->
<div class="sidebar">
    <h4>
        <i class="bi bi-shield-check"></i> Admin Panel
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
            <i class="bi bi-house"></i> Dashboard
        </a>
        <a href="{{ route('admin.galleries.index') }}">
            <i class="bi bi-images"></i> Kelola Galeri
        </a>
        <a href="{{ route('admin.schedules.index') }}" class="active">
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Kelola Jadwal Paket</h1>
            <p class="text-muted mb-0">Upload dan kelola paket umrah</p>
        </div>
        <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Paket Baru
        </a>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" x-data="{ show: true }" x-show="show">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" @click="show = false"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" x-data="{ show: true }" x-show="show">
        <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
        <button type="button" class="btn-close" @click="show = false"></button>
    </div>
    @endif

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="full" {{ request('status') == 'full' ? 'selected' : '' }}>Penuh</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jalur Keberangkatan</label>
                    <select name="route" class="form-select" onchange="this.form.submit()">
                        <option value="all" {{ request('route') == 'all' ? 'selected' : '' }}>Semua Jalur</option>
                        @foreach($routes as $route)
                        <option value="{{ $route }}" {{ request('route') == $route ? 'selected' : '' }}>
                            {{ $route }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">Total Paket</h6>
                    <h3>{{ $schedules->total() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule List -->
    @if($schedules->isEmpty())
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Belum ada paket jadwal. 
        <a href="{{ route('admin.schedules.create') }}">Tambah paket pertama</a>
    </div>
    @else
    @foreach($schedules as $schedule)
    <div class="schedule-card">
        <div class="row g-0">
            <!-- Flyer Image -->
            <div class="col-md-2">
                <img src="{{ Storage::url($schedule->flyer_image) }}" 
                     alt="{{ $schedule->package_name }}" 
                     class="flyer-img"
                     @click="openPreview('{{ Storage::url($schedule->flyer_image) }}', '{{ $schedule->package_name }}')">
            </div>
            
            <!-- Schedule Info -->
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title mb-2">{{ $schedule->package_name }}</h5>
                    
                    <div class="mb-2">
                        @if($schedule->status === 'active')
                        <span class="badge bg-success badge-status">Aktif</span>
                        @elseif($schedule->status === 'full')
                        <span class="badge bg-warning badge-status">Penuh</span>
                        @else
                        <span class="badge bg-secondary badge-status">Dibatalkan</span>
                        @endif
                        
                        <span class="badge bg-primary badge-status">{{ $schedule->departure_route }}</span>
                    </div>
                    
                    <div class="row text-sm">
                        <div class="col-md-6">
                            <p class="mb-1"><i class="bi bi-calendar"></i> <strong>Berangkat:</strong> {{ $schedule->departure_date->format('d M Y') }}</p>
                            <p class="mb-1"><i class="bi bi-calendar-check"></i> <strong>Pulang:</strong> {{ $schedule->return_date->format('d M Y') }}</p>
                            <p class="mb-1"><i class="bi bi-clock"></i> <strong>Durasi:</strong> {{ $schedule->duration }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><i class="bi bi-airplane"></i> <strong>Maskapai:</strong> {{ $schedule->airline }}</p>
                            <p class="mb-1"><i class="bi bi-people"></i> <strong>Quota:</strong> {{ $schedule->seats_taken }}/{{ $schedule->quota }} (Tersisa: {{ $schedule->available_seats }})</p>
                            <p class="mb-1"><i class="bi bi-currency-dollar"></i> <strong>Harga:</strong> Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="col-md-3">
                <div class="card-body text-end">
                    <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-sm btn-outline-primary mb-2 w-100">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    
                    <button @click="toggleStatus({{ $schedule->id }})" class="btn btn-sm btn-outline-warning mb-2 w-100">
                        <i class="bi bi-toggle-{{ $schedule->status === 'active' ? 'on' : 'off' }}"></i> 
                        {{ $schedule->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                    
                    <button @click="confirmDelete({{ $schedule->id }})" class="btn btn-sm btn-outline-danger w-100">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Pagination -->
    <div class="mt-4">
        {{ $schedules->links() }}
    </div>
    @endif
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
                <img :src="previewUrl" class="img-fluid" style="max-height: 70vh; border-radius: 8px;">
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

<!-- Hidden Forms -->
<form id="toggleForm" method="POST" style="display: none;">
    @csrf
</form>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function scheduleApp() {
    return {
        previewUrl: '',
        previewTitle: '',
        
        openPreview(url, title) {
            this.previewUrl = url;
            this.previewTitle = title;
            new bootstrap.Modal(this.$refs.previewModal).show();
        },
        
        toggleStatus(id) {
            const form = document.getElementById('toggleForm');
            form.action = `/admin/schedules/${id}/toggle`;
            form.submit();
        },
        
        confirmDelete(id) {
            if (confirm('Yakin hapus paket ini? Data tidak bisa dikembalikan!')) {
                const form = document.getElementById('deleteForm');
                form.action = `/admin/schedules/${id}`;
                form.submit();
            }
        }
    }
}
</script>
</body>
</html>