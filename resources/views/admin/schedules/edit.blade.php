<!DOCTYPE html>
<html>
<head>
    <title>Edit Paket - Mahira Tour Admin</title>
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
        .sidebar nav a {
            text-decoration: none;
            transition: all 0.3s;
            padding: 8px 12px;
            border-radius: 8px;
            display: block;
            color: white;
            margin-bottom: 5px;
        }
        .sidebar nav a:hover {
            background: rgba(255,255,255,0.1);
        }
        .preview-container {
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            background: #f8f9fa;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .preview-image {
            max-width: 100%;
            max-height: 500px;
            border-radius: 8px;
        }
        .form-label {
            font-weight: 600;
        }
        .required::after {
            content: " *";
            color: red;
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
    <div class="mb-4">
        <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Jadwal
        </a>
    </div>

    <h1 class="mb-4">Edit Paket: {{ $schedule->package_name }}</h1>

    <!-- Info Alert -->
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> <strong>Info:</strong> 
        Sudah ada {{ $schedule->seats_taken }} jamaah terdaftar. 
        Quota minimal: {{ $schedule->seats_taken }} orang.
    </div>

    @if($errors->any())
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle"></i> Ada kesalahan:
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Paket</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Nama Paket</label>
                            <input type="text" name="package_name" class="form-control" 
                                   value="{{ old('package_name', $schedule->package_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Jalur Keberangkatan</label>
                            <select name="departure_route" class="form-select" required>
                                <option value="Lampung" {{ old('departure_route', $schedule->departure_route) == 'Lampung' ? 'selected' : '' }}>Lampung</option>
                                <option value="Padang" {{ old('departure_route', $schedule->departure_route) == 'Padang' ? 'selected' : '' }}>Padang</option>
                                <option value="Jambi" {{ old('departure_route', $schedule->departure_route) == 'Jambi' ? 'selected' : '' }}>Jambi</option>
                                <option value="Jakarta" {{ old('departure_route', $schedule->departure_route) == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                                <option value="Bengkulu" {{ old('departure_route', $schedule->departure_route) == 'Bengkulu' ? 'selected' : '' }}>Bengkulu</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Maskapai</label>
                            <select name="airline" class="form-select" required>
                                <option value="Garuda Indonesia" {{ old('airline', $schedule->airline) == 'Garuda Indonesia' ? 'selected' : '' }}>Garuda Indonesia</option>
                                <option value="Saudi Airlines" {{ old('airline', $schedule->airline) == 'Saudi Airlines' ? 'selected' : '' }}>Saudi Airlines</option>
                                <option value="Batik Air" {{ old('airline', $schedule->airline) == 'Batik Air' ? 'selected' : '' }}>Batik Air</option>
                                <option value="Lion Air" {{ old('airline', $schedule->airline) == 'Lion Air' ? 'selected' : '' }}>Lion Air</option>
                                <option value="Super Air Jet" {{ old('airline', $schedule->airline) == 'Super Air Jet' ? 'selected' : '' }}>Super Air Jet</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Durasi</label>
                            <input type="text" name="duration" class="form-control" 
                                   value="{{ old('duration', $schedule->duration) }}" required>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-calendar"></i> Tanggal & Harga</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Tanggal Keberangkatan</label>
                            <input type="date" name="departure_date" class="form-control" 
                                   value="{{ old('departure_date', $schedule->departure_date->format('Y-m-d')) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Tanggal Kepulangan</label>
                            <input type="date" name="return_date" class="form-control" 
                                   value="{{ old('return_date', $schedule->return_date->format('Y-m-d')) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Harga per Orang</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price" class="form-control" 
                                       value="{{ old('price', $schedule->price) }}" min="0" step="100000" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Kuota Jamaah</label>
                            <input type="number" name="quota" class="form-control" 
                                   value="{{ old('quota', $schedule->quota) }}" 
                                   min="{{ $schedule->seats_taken }}" required>
                            <small class="text-danger">Minimal {{ $schedule->seats_taken }} (sudah terdaftar)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active" {{ old('status', $schedule->status) == 'active' ? 'selected' : '' }}>Aktif (Bisa Daftar)</option>
                                <option value="full" {{ old('status', $schedule->status) == 'full' ? 'selected' : '' }}>Penuh</option>
                                <option value="cancelled" {{ old('status', $schedule->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-image"></i> Flyer Paket</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Ganti Flyer (Opsional)</label>
                            <input type="file" name="flyer_image" class="form-control" 
                                   accept="image/jpeg,image/jpg,image/png,image/webp" 
                                   onchange="previewImage(event)">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti flyer</small>
                        </div>

                        <div class="preview-container" id="preview-container">
                            <div>
                                <img src="{{ Storage::url($schedule->flyer_image) }}" 
                                     class="preview-image" 
                                     alt="{{ $schedule->package_name }}">
                                <p class="mt-3 text-muted">Flyer saat ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary btn-lg px-5">
                <i class="bi bi-x-circle"></i> Batal
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const container = document.getElementById('preview-container');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            container.innerHTML = `
                <div>
                    <img src="${e.target.result}" class="preview-image" alt="Preview Flyer">
                    <p class="mt-3 text-success"><i class="bi bi-check-circle"></i> Flyer baru siap diupload</p>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>