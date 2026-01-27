@extends('layouts.admin')

@section('title', 'Kelola Jadwal Paket')

@section('content')
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="mb-1">Kelola Jadwal Paket</h1>
                <p class="text-muted mb-0">Upload dan kelola paket umrah</p>
            </div>
            <div>
                <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary btn-action">
                    <i class="bi bi-plus-circle"></i> Tambah Paket Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-mini">
                <h4>{{ $schedules->total() }}</h4>
                <small>Total Paket</small>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="full" {{ request('status') == 'full' ? 'selected' : '' }}>Penuh</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Jalur Keberangkatan</label>
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

    <!-- Schedule List -->
    <div x-data="scheduleApp()">
        @if($schedules->isEmpty())
        <div class="empty-state">
            <i class="bi bi-calendar-x"></i>
            <h5>Belum Ada Paket</h5>
            <p class="text-muted">Belum ada paket jadwal yang tersedia.</p>
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary btn-action mt-3">
                <i class="bi bi-plus-circle"></i> Tambah Paket Pertama
            </a>
        </div>
        @else
        @foreach($schedules as $schedule)
        <div class="schedule-card">
            <div class="row g-0">
                <!-- Flyer Image -->
                <div class="col-md-2">
                    <div style="height: 100%; overflow: hidden;">
                        <img src="{{ Storage::url($schedule->flyer_image) }}" 
                             alt="{{ $schedule->package_name }}" 
                             class="flyer-img"
                             @click="openPreview('{{ Storage::url($schedule->flyer_image) }}', '{{ $schedule->package_name }}')">
                    </div>
                </div>
                
                <!-- Schedule Info -->
                <div class="col-md-7">
                    <div class="card-body h-100 d-flex flex-column justify-content-center">
                        <h5 class="card-title mb-2 fw-bold text-primary">{{ $schedule->package_name }}</h5>
                        
                        <div class="mb-3">
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
                                <p class="mb-1"><i class="bi bi-calendar text-muted me-2"></i> <strong>Berangkat:</strong> {{ $schedule->departure_date->format('d M Y') }}</p>
                                <p class="mb-1"><i class="bi bi-calendar-check text-muted me-2"></i> <strong>Pulang:</strong> {{ $schedule->return_date->format('d M Y') }}</p>
                                <p class="mb-1"><i class="bi bi-clock text-muted me-2"></i> <strong>Durasi:</strong> {{ $schedule->duration }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><i class="bi bi-airplane text-muted me-2"></i> <strong>Maskapai:</strong> {{ $schedule->airline }}</p>
                                <p class="mb-1"><i class="bi bi-people text-muted me-2"></i> <strong>Quota:</strong> {{ $schedule->seats_taken }}/{{ $schedule->quota }} (Tersisa: {{ $schedule->available_seats }})</p>
                                <p class="mb-1"><i class="bi bi-currency-dollar text-muted me-2"></i> <strong>Harga:</strong> Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="col-md-3 border-start">
                    <div class="card-body h-100 d-flex flex-column justify-content-center">
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
        <div class="d-flex justify-content-between align-items-center mt-4">
            <small class="text-muted">
                Menampilkan {{ $schedules->firstItem() ?? 0 }} - {{ $schedules->lastItem() ?? 0 }} dari {{ $schedules->total() }} paket
            </small>
            {{ $schedules->links() }}
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
        transform: translateY(-5px);
    }
    
    .flyer-img {
        width: 100%;
        height: 100%;
        min-height: 200px;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s;
    }
    
    .flyer-img:hover {
        transform: scale(1.05);
    }
    
    .badge-status {
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 50px;
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
@endpush