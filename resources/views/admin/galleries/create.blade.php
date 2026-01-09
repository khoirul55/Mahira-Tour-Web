<!DOCTYPE html>
<html>
<head>
    <title>Upload Foto Baru - Mahira Tour Admin</title>
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
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .preview-image {
            max-width: 100%;
            max-height: 400px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<!-- Sidebar (sama seperti index) -->
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
        <a href="{{ route('admin.galleries.index') }}" class="active">
            <i class="bi bi-images"></i> Kelola Galeri
        </a>
        <a href="{{ route('admin.logout') }}">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </nav>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="mb-4">
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Galeri
        </a>
    </div>

    <h1 class="mb-4">Upload Foto Baru</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <!-- Form Fields -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Foto *</label>
                            <input type="text" name="title" class="form-control" 
                                   placeholder="Contoh: Jamaah di Masjidil Haram"
                                   value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori *</label>
                            <select name="category" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Urutan Tampil</label>
                            <input type="number" name="display_order" class="form-control" 
                                   value="{{ old('display_order', 0) }}" min="0">
                            <small class="text-muted">Semakin kecil angka, semakin awal muncul</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Upload Foto *</label>
                            <input type="file" name="image" class="form-control" 
                                   accept="image/jpeg,image/jpg,image/png,image/webp" 
                                   onchange="previewImage(event)" required>
                            <small class="text-muted">Format: JPG, PNG, WEBP. Max 5MB</small>
                        </div>

<div class="form-check mb-3">
    <input type="checkbox" name="is_active" class="form-check-input" 
           id="is_active" value="1" checked>
    <label class="form-check-label" for="is_active">
        Aktifkan foto (tampil di website)
    </label>
</div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-upload"></i> Upload Foto
                        </button>
                    </div>
                </div>
            </div>

            <!-- Preview -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Preview Foto</h5>
                        <div class="preview-container" id="preview-container">
                            <div class="text-muted">
                                <i class="bi bi-image" style="font-size: 3rem;"></i>
                                <p class="mt-2">Belum ada foto dipilih</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            container.innerHTML = `<img src="${e.target.result}" class="preview-image" alt="Preview">`;
        };
        reader.readAsDataURL(file);
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>