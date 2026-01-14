<!DOCTYPE html>
<html>
<head>
    <title>Kelola Galeri - Mahira Tour Admin</title>
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
            justify-content: space-between;
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
        
        .gallery-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .gallery-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .gallery-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s;
            cursor: pointer;
        }
        
        .gallery-card:hover .gallery-img {
            transform: scale(1.05);
        }
        
        .gallery-info {
            padding: 20px;
        }
        
        .badge {
            padding: 6px 12px;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.75rem;
        }
        
        .stat-mini {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            text-align: center;
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
        
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
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
    </style>
</head>
<body x-data="galleryApp()">

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
        <a href="{{ route('admin.registrations.index') }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Semua Pendaftaran</span>
        </a>
        <a href="{{ route('admin.pelunasan.index') }}">
            <i class="bi bi-wallet"></i>
            <span>Perlu Pelunasan</span>
        </a>
        <a href="{{ route('admin.galleries.index') }}" class="active">
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
        <div>
            <h2><i class="bi bi-images" style="color: #8B5CF6;"></i> Kelola Galeri</h2>
            <p class="text-muted mb-0">Upload dan kelola foto untuk halaman galeri website</p>
        </div>
        <div>
            <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-action">
                <i class="bi bi-plus-circle"></i> Upload Foto Baru
            </a>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" x-data="{ show: true }" x-show="show">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" @click="show = false"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" x-data="{ show: true }" x-show="show">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        {{ $errors->first() }}
        <button type="button" class="btn-close" @click="show = false"></button>
    </div>
    @endif

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-mini">
                <h4>{{ $galleries->total() }}</h4>
                <small>Total Foto</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini">
                <h4>{{ $galleries->where('is_active', true)->count() }}</h4>
                <small>Aktif</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini">
                <h4>{{ $galleries->where('is_active', false)->count() }}</h4>
                <small>Nonaktif</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini">
                <h4>{{ count($categories ?? []) }}</h4>
                <small>Kategori</small>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Kategori</label>
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
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset Filter
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Gallery Grid -->
    @if($galleries->isEmpty())
    <div class="empty-state">
        <i class="bi bi-images"></i>
        <h5>Belum Ada Foto</h5>
        <p class="text-muted">Belum ada foto di galeri</p>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-action mt-3">
            <i class="bi bi-plus-circle"></i> Upload Foto Pertama
        </a>
    </div>
    @else
    <div class="row g-4">
        @foreach($galleries as $gallery)
        <div class="col-md-3">
            <div class="gallery-card">
                <div style="overflow: hidden;">
                    <img src="{{ $gallery->image_url }}" 
                         alt="{{ $gallery->title }}" 
                         class="gallery-img"
                         @click="openPreview('{{ $gallery->image_url }}', '{{ $gallery->title }}')">
                </div>
                <div class="gallery-info">
                    <h6 class="mb-2 fw-bold">{{ Str::limit($gallery->title, 40) }}</h6>
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $gallery->category }}</span>
                        <span class="badge {{ $gallery->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $gallery->is_active ? '✓ Aktif' : '○ Nonaktif' }}
                        </span>
                    </div>
                    <small class="text-muted d-block mb-3">
                        <i class="bi bi-sort-numeric-down"></i> Urutan: {{ $gallery->display_order }}
                    </small>
                    
                    <div class="btn-group w-100">
                        <a href="{{ route('admin.galleries.edit', $gallery->id) }}" 
                           class="btn btn-sm btn-outline-primary" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button @click="toggleStatus({{ $gallery->id }})" 
                                class="btn btn-sm btn-outline-warning" 
                                title="Toggle Status">
                            <i class="bi bi-eye{{ $gallery->is_active ? '-slash' : '' }}"></i>
                        </button>
                        <button @click="confirmDelete({{ $gallery->id }})" 
                                class="btn btn-sm btn-outline-danger" 
                                title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <small class="text-muted">
            Menampilkan {{ $galleries->firstItem() ?? 0 }} - {{ $galleries->lastItem() ?? 0 }} dari {{ $galleries->total() }} foto
        </small>
        {{ $galleries->links() }}
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
function galleryApp() {
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
            form.action = `/admin/galleries/${id}/toggle`;
            form.submit();
        },
        
        confirmDelete(id) {
            if (confirm('Yakin hapus foto ini? Data tidak bisa dikembalikan!')) {
                const form = document.getElementById('deleteForm');
                form.action = `/admin/galleries/${id}`;
                form.submit();
            }
        }
    }
}
</script>
</body>
</html>