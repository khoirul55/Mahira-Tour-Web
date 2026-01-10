<!DOCTYPE html>
<html>
<head>
    <title>Kelola Jadwal Paket - Mahira Tour Admin</title>
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
        .schedule-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .schedule-card:hover {
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .flyer-img {
            width: 150px;
            height: 200px;
            object-fit: cover;
        }
        .sidebar nav a {
            text-decoration: none;
            transition: all 0.3s;
            padding: 8px 12px;
            border-radius: 8px;
            display: block;
            color: white;
            margin-bottom: 5px;
        }
        .sidebar nav a:hover, .sidebar nav a.active {
            background: rgba(255,255,255,0.1);
        }
        .badge-status {
            font-size: 0.75rem;
            padding: 5px 12px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3><i class="bi bi-shield-check"></i> Admin Panel</h3>
    
    <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px; margin: 15px 0;">
        <div style="font-size: 1.1rem; font-weight: 600; margin-bottom: 5px;">
            <i class="bi bi-person-circle"></i> {{ session('admin_name', 'Admin') }}
        </div>
        <div style="font-size: 0.85rem; opacity: 0.8;">
            {{ session('admin_email') }}
        </div>
    </div>
    
    <hr style="border-color: rgba(255,255,255,0.3);">
    
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
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
                     class="flyer-img">
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
                    
                    <form action="{{ route('admin.schedules.toggle', $schedule->id) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-warning w-100">
                            <i class="bi bi-toggle-{{ $schedule->status === 'active' ? 'on' : 'off' }}"></i> 
                            {{ $schedule->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin hapus paket ini? Data tidak bisa dikembalikan!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>