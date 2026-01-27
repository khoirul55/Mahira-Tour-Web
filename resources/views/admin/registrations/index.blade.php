@extends('layouts.admin')

@section('title', 'Semua Pendaftaran')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="mb-1">Semua Pendaftaran</h1>
                <p class="text-muted mb-0">Kelola semua data pendaftaran jamaah</p>
            </div>
            <div>
                <a href="{{ route('admin.registrations.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>
            </div>
        </div>
    </div>
    
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
    
    .page-header h1 {
        margin: 0;
        font-weight: 700;
        color: #1a1a1a;
        font-size: 1.8rem;
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
@endpush