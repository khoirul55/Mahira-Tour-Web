<!DOCTYPE html>
<html>
<head>
    <title>Edit Foto - Mahira Tour Admin</title>
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
            height: 100vh;
            width: 260px;
            background: linear-gradient(135deg, #001D5F 0%, #003087 100%);
            color: white;
            padding: 30px 20px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }
        .main-content {
            margin-left: 260px;
            padding: 30px;
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
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
        }
    </style>
</head>
<body x-data="editGalleryApp()">

<!-- Sidebar -->
<div class="sidebar">
    <h4>
        <i class="bi bi-shield-check"></i> Admin Panel
    </h4>
    
    <div class="admin-info">
        <div style="font-weight: 600;">
            <i class="bi bi-person-circle"></i> {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
        </div>
        <small style="opacity: 0.8;">{{ Auth::guard('admin')->user()->email ?? '' }}</small>
    </div>
    
    <hr style="border-color: rgba(255,255,255,0.2);">
    
    <nav>
        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house"></i> Dashboard
        </a>
        <a href="{{ route('admin.galleries.index') }}" class="active">
            <i class="bi bi-images"></i> Kelola Galeri
        </a>
        <a href="{{ route('admin.schedules.index') }}">
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
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Galeri
        </a>
    </div>

    <h1 class="mb-4">Edit Foto</h1>

    @if($errors->any())
    <div class="alert alert-danger" x-data="{ show: true }" x-show="show">
        <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
        <button type="button" class="btn-close" @click="show = false"></button>
    </div>
    @endif

    <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Form Fields -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Foto *</label>
                            <input type="text" 
                                   name="title" 
                                   class="form-control" 
                                   value="{{ old('title', $gallery->title) }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori *</label>
                            <select name="category" class="form-select" required>
                                @foreach($categories as $cat)
                                <option value="{{ $cat }}" 
                                    {{ old('category', $gallery->category) == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Urutan Tampil</label>
                            <input type="number" 
                                   name="display_order" 
                                   class="form-control" 
                                   value="{{ old('display_order', $gallery->display_order) }}" 
                                   min="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ganti Foto (Opsional)</label>
                            <input type="file" 
                                   name="image" 
                                   class="form-control" 
                                   accept="image/jpeg,image/jpg,image/png,image/webp" 
                                   @change="previewNewImage($event)">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" 
                                   name="is_active" 
                                   class="form-check-input" 
                                   id="is_active" 
                                   value="1" 
                                   {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Aktifkan foto (tampil di website)
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Preview -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3" x-text="previewTitle"></h5>
                        <div class="preview-container">
                            <img :src="currentImage" class="preview-image" alt="{{ $gallery->title }}">
                        </div>
                        <div class="mt-3 text-center" x-show="hasNewImage" x-cloak>
                            <button type="button" 
                                    class="btn btn-sm btn-outline-secondary" 
                                    @click="resetPreview()">
                                <i class="bi bi-arrow-counterclockwise"></i> Lihat Foto Asli
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function editGalleryApp() {
    return {
        originalImage: '{{ $gallery->image_url }}',
        currentImage: '{{ $gallery->image_url }}',
        hasNewImage: false,
        previewTitle: 'Foto Saat Ini',
        
        previewNewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.currentImage = e.target.result;
                    this.hasNewImage = true;
                    this.previewTitle = 'Preview Foto Baru';
                };
                reader.readAsDataURL(file);
            }
        },
        
        resetPreview() {
            this.currentImage = this.originalImage;
            this.hasNewImage = false;
            this.previewTitle = 'Foto Saat Ini';
            // Reset file input
            document.querySelector('input[name="image"]').value = '';
        }
    }
}
</script>
</body>
</html>