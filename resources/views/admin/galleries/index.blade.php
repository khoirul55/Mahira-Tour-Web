<!DOCTYPE html>
<html>
<head>
    <title>Kelola Galeri - Mahira Tour Admin</title>
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
        .gallery-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .gallery-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .gallery-info {
            padding: 15px;
        }
        .badge-category {
            font-size: 0.75rem;
            padding: 5px 10px;
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
    <a href="{{ route('admin.dashboard') }}" class="text-white d-block mb-3">
        <i class="bi bi-house"></i> Dashboard
    </a>
    <a href="{{ route('admin.galleries.index') }}" class="text-white d-block mb-3">
        <i class="bi bi-images"></i> Kelola Galeri
    </a>
    <!-- TAMBAH INI -->
    <a href="{{ route('admin.schedules.index') }}" class="text-white d-block mb-3">
        <i class="bi bi-calendar-event"></i> Kelola Jadwal
    </a>
    <a href="{{ route('admin.logout') }}" class="text-white d-block">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</nav>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Kelola Galeri</h1>
            <p class="text-muted mb-0">Upload dan kelola foto untuk halaman galeri website</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Upload Foto Baru
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
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Reset Filter
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
                    <h6 class="text-muted">Total Foto</h6>
                    <h3>{{ $galleries->total() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    @if($galleries->isEmpty())
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Belum ada foto di galeri. 
        <a href="{{ route('admin.galleries.create') }}">Upload foto pertama</a>
    </div>
    @else
    <div class="row g-4">
        @foreach($galleries as $gallery)
        <div class="col-md-3">
            <div class="gallery-card">
                <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="gallery-img">
                <div class="gallery-info">
                    <h6 class="mb-2">{{ $gallery->title }}</h6>
                    <div class="mb-2">
                        <span class="badge bg-primary badge-category">{{ $gallery->category }}</span>
                        <span class="badge {{ $gallery->is_active ? 'bg-success' : 'bg-secondary' }} badge-category">
                            {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <small class="text-muted d-block mb-2">
                        <i class="bi bi-sort-numeric-down"></i> Order: {{ $gallery->display_order }}
                    </small>
                    
                    <div class="btn-group w-100">
                        <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.galleries.toggle', $gallery->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Toggle Status">
                                <i class="bi bi-eye{{ $gallery->is_active ? '-slash' : '' }}"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin hapus foto ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $galleries->links() }}
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>