<!DOCTYPE html>
<html>
<head>
    <title>Perlu Pelunasan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (sama seperti dashboard admin) -->
        
        <!-- Main Content -->
        <div class="col-md-10">
            <h2 class="mb-4"><i class="bi bi-wallet"></i> Perlu Pelunasan</h2>
            
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. Reg</th>
                                <th>Nama</th>
                                <th>Paket</th>
                                <th>Berangkat</th>
                                <th>Total</th>
                                <th>Sisa</th>
                                <th>Deadline</th>
                                <th>Status Pelunasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registrations as $reg)
                            @php
                                $pelunasan = $reg->pelunasanPayment();
                                $sisa = $reg->sisaPelunasan();
                            @endphp
                            <tr>
                                <td><strong>{{ $reg->registration_number }}</strong></td>
                                <td>{{ $reg->full_name }}<br><small>{{ $reg->phone }}</small></td>
                                <td>{{ $reg->schedule->package_name }}</td>
                                <td>{{ $reg->schedule->departure_date->format('d M Y') }}</td>
                                <td>Rp {{ number_format($reg->total_price, 0, ',', '.') }}</td>
                                <td><strong class="text-danger">Rp {{ number_format($sisa, 0, ',', '.') }}</strong></td>
                                <td>{{ $reg->pelunasan_deadline?->format('d M Y') }}</td>
                                <td>
                                    @if($pelunasan)
                                        @if($pelunasan->status === 'pending')
                                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                                        @elseif($pelunasan->status === 'rejected')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Belum Bayar</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$pelunasan || $pelunasan->status === 'rejected')
                                        <form action="{{ route('admin.pelunasan.send-tagihan', $reg->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-primary">
                                                <i class="bi bi-send"></i> Kirim Tagihan
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($pelunasan && $pelunasan->status === 'pending')
                                        <a href="{{ Storage::url($pelunasan->proof_path) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> Lihat Bukti
                                        </a>
                                        <form action="{{ route('admin.pelunasan.verify', $pelunasan->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="action" value="approve">
                                            <button class="btn btn-sm btn-success">
                                                <i class="bi bi-check"></i> Approve
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Tidak ada yang perlu pelunasan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>