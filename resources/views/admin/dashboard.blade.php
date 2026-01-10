<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Mahira Tour</title>
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
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .payment-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
        }
        .sidebar nav a:hover {
            background: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h3><i class="bi bi-shield-check"></i> Admin Panel</h3>
    
    <!-- INFO ADMIN -->
    <div class="admin-info">
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
    
<div class="main-content">
    <!-- WELCOME HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Dashboard Admin</h1>
            <p class="text-muted mb-0">
                Selamat datang, <strong>{{ session('admin_name', 'Admin') }}</strong> 👋
            </p>
        </div>
        <div class="text-end">
            <small class="text-muted">
                <i class="bi bi-clock"></i> {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </small>
        </div>
    </div>
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <h6 class="text-muted">Pending Verifikasi</h6>
                <h2>{{ $stats['pending'] }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <h6 class="text-muted">Confirmed</h6>
                <h2>{{ $stats['confirmed'] }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <h6 class="text-muted">Total Revenue</h6>
                <h2>Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
    
    <!-- Pending Payments -->
    <h3 class="mb-3">Verifikasi DP</h3>
    
    @if($pendingPayments->isEmpty())
    <div class="alert alert-info">Tidak ada DP yang perlu diverifikasi</div>
    @endif
    
    @foreach($pendingPayments as $payment)
    <div class="payment-card">
        <div class="row align-items-center">
            <div class="col-md-3">
                <strong>{{ $payment->registration->registration_number }}</strong><br>
                <small>{{ $payment->registration->full_name }}</small>
            </div>
            <div class="col-md-2">
                <strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong>
            </div>
            <div class="col-md-3">
                @if($payment->proof_path)
                <a href="{{ Storage::url($payment->proof_path) }}" target="_blank" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Lihat Bukti
                </a>
                @else
                <span class="text-muted">Belum upload</span>
                @endif
            </div>
            <div class="col-md-4">
                <form action="{{ route('admin.verify-payment', $payment->id) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="action" value="approve">
                    <button class="btn btn-success btn-sm">
                        <i class="bi bi-check"></i> Approve
                    </button>
                </form>
                
                <button class="btn btn-danger btn-sm" onclick="rejectPayment({{ $payment->id }})">
                    <i class="bi bi-x"></i> Reject
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
function rejectPayment(id) {
    const reason = prompt('Alasan penolakan:');
    if (reason) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/verify-payment/${id}`;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        
        const action = document.createElement('input');
        action.type = 'hidden';
        action.name = 'action';
        action.value = 'reject';
        
        const notes = document.createElement('input');
        notes.type = 'hidden';
        notes.name = 'notes';
        notes.value = reason;
        
        form.appendChild(csrf);
        form.appendChild(action);
        form.appendChild(notes);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
</body>
</html>