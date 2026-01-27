@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="mb-1">Kelola Galeri</h1>
                <p class="text-muted mb-0">Upload dan kelola foto untuk halaman galeri website</p>
            </div>
            <div>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-action">
                    <i class="bi bi-plus-circle"></i> Upload Foto Baru
                </a>
            </div>
        </div>
    </div>

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
    <div x-data="galleryApp()">
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
    </div>

    <!-- Hidden Forms -->
    <form id="toggleForm" method="POST" style="display: none;">
        @csrf
    </form>

    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('styles')
<style>
    .page-header {
        background: white;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 30px;
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
@endpush

@push('scripts')
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
@endpush