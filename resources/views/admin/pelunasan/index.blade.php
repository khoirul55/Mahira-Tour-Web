@extends('layouts.admin')

@section('title', 'Perlu Pelunasan')

@section('content')
    <div class="page-header">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-wallet" style="font-size: 2rem; color: #F59E0B;"></i>
            <div>
                <h1 class="mb-0">Perlu Pelunasan</h1>
                <p class="text-muted mb-0">Daftar jamaah dengan status pembayaran pending atau belum lunas</p>
            </div>
        </div>
    </div>
    
    <div x-data="pelunasanApp()">
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
@endpush

@push('scripts')
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
@endpush