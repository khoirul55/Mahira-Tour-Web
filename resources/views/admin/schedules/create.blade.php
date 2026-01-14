<!DOCTYPE html>
<html>
<head>
    <title>Tambah Paket Baru - Mahira Tour Admin</title>
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
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .card-header {
            border-radius: 12px 12px 0 0 !important;
        }
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
        }
    </style>
</head>
<body x-data="createScheduleApp()">

<!-- Sidebar -->
<div class="sidebar">
    <h4>
        <i class="bi bi-shield-check"></i> Admin Panel
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

    <h1 class="mb-4">Tambah Paket Umrah Baru</h1>

    @if($errors->any())
    <div class="alert alert-danger" x-data="{ show: true }" x-show="show">
        <i class="bi bi-exclamation-circle"></i> Ada kesalahan:
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" @click="show = false"></button>
    </div>
    @endif

    <form action="{{ route('admin.schedules.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <!-- Left Column - Form Fields -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Paket</h5>
                    </div>
                    <div class="card-body">
                        <!-- Package Name -->
                        <div class="mb-3">
                            <label class="form-label required">Nama Paket</label>
                            <input type="text" name="package_name" class="form-control" 
                                   placeholder="Contoh: Umrah Reguler 12 Hari"
                                   value="{{ old('package_name') }}" required>
                            <small class="text-muted">Nama paket yang akan ditampilkan</small>
                        </div>

                        <!-- Departure Route -->
                        <div class="mb-3">
                            <label class="form-label required">Jalur Keberangkatan</label>
                            <select name="departure_route" class="form-select" required>
                                <option value="">-- Pilih Jalur --</option>
                                <option value="Lampung" {{ old('departure_route') == 'Lampung' ? 'selected' : '' }}>Lampung</option>
                                <option value="Padang" {{ old('departure_route') == 'Padang' ? 'selected' : '' }}>Padang</option>
                                <option value="Jambi" {{ old('departure_route') == 'Jambi' ? 'selected' : '' }}>Jambi</option>
                                <option value="Jakarta" {{ old('departure_route') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                                <option value="Bengkulu" {{ old('departure_route') == 'Bengkulu' ? 'selected' : '' }}>Bengkulu</option>
                            </select>
                        </div>

                        <!-- Airline -->
                        <div class="mb-3">
                            <label class="form-label required">Maskapai</label>
                            <select name="airline" class="form-select" required>
                                <option value="">-- Pilih Maskapai --</option>
                                <option value="Garuda Indonesia" {{ old('airline') == 'Garuda Indonesia' ? 'selected' : '' }}>Garuda Indonesia</option>
                                <option value="Saudi Airlines" {{ old('airline') == 'Saudi Airlines' ? 'selected' : '' }}>Saudi Airlines</option>
                                <option value="Batik Air" {{ old('airline') == 'Batik Air' ? 'selected' : '' }}>Batik Air</option>
                                <option value="Lion Air" {{ old('airline') == 'Lion Air' ? 'selected' : '' }}>Lion Air</option>
                                <option value="Super Air Jet" {{ old('airline') == 'Super Air Jet' ? 'selected' : '' }}>Super Air Jet</option>
                            </select>
                        </div>

                        <!-- Duration -->
                        <div class="mb-3">
                            <label class="form-label required">Durasi</label>
                            <input type="text" name="duration" class="form-control" 
                                   placeholder="Contoh: 12 Hari 11 Malam"
                                   value="{{ old('duration') }}" required>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-calendar"></i> Tanggal & Harga</h5>
                    </div>
                    <div class="card-body">
                        <!-- Departure Date -->
                        <div class="mb-3">
                            <label class="form-label required">Tanggal Keberangkatan</label>
                            <input type="date" 
                                   name="departure_date" 
                                   class="form-control" 
                                   x-model="departureDate"
                                   @change="updateReturnDate"
                                   value="{{ old('departure_date') }}" 
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                   required>
                        </div>

                        <!-- Return Date -->
                        <div class="mb-3">
                            <label class="form-label required">Tanggal Kepulangan</label>
                            <input type="date" 
                                   name="return_date" 
                                   class="form-control" 
                                   x-model="returnDate"
                                   :min="departureDate"
                                   value="{{ old('return_date') }}" 
                                   required>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label class="form-label required">Harga per Orang</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price" class="form-control" 
                                       placeholder="28000000"
                                       value="{{ old('price') }}" min="0" step="100000" required>
                            </div>
                            <small class="text-muted">Masukkan angka tanpa titik/koma</small>
                        </div>

                        <!-- Quota -->
                        <div class="mb-3">
                            <label class="form-label required">Kuota Jamaah</label>
                            <input type="number" name="quota" class="form-control" 
                                   placeholder="45"
                                   value="{{ old('quota', 45) }}" min="1" required>
                            <small class="text-muted">Jumlah maksimal jamaah untuk paket ini</small>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif (Bisa Daftar)</option>
                                <option value="full" {{ old('status') == 'full' ? 'selected' : '' }}>Penuh</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Flyer Upload & Preview -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-image"></i> Upload Flyer Paket</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Flyer / Poster Paket</label>
                            <input type="file" 
                                   name="flyer_image" 
                                   class="form-control" 
                                   accept="image/jpeg,image/jpg,image/png,image/webp" 
                                   @change="previewImage($event)" 
                                   required>
                            <small class="text-muted">Format: JPG, PNG, WEBP. Max 10MB. Rekomendasi ukuran: 1200x1600px (portrait)</small>
                        </div>

                        <div class="preview-container">
                            <div x-show="!imagePreview" class="text-muted">
                                <i class="bi bi-file-image" style="font-size: 4rem;"></i>
                                <p class="mt-3">Belum ada flyer dipilih</p>
                                <small>Flyer akan ditampilkan di halaman jadwal</small>
                            </div>
                            <div x-show="imagePreview" x-cloak>
                                <img :src="imagePreview" class="preview-image" alt="Preview Flyer">
                                <p class="mt-3 text-success">
                                    <i class="bi bi-check-circle"></i> Flyer siap diupload
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-save"></i> Simpan Paket Umrah
            </button>
            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary btn-lg px-5">
                <i class="bi bi-x-circle"></i> Batal
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function createScheduleApp() {
    return {
        imagePreview: null,
        departureDate: '{{ old("departure_date") }}',
        returnDate: '{{ old("return_date") }}',
        
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        
        updateReturnDate() {
            if (this.departureDate && !this.returnDate) {
                const departure = new Date(this.departureDate);
                const returnDate = new Date(departure);
                returnDate.setDate(returnDate.getDate() + 12); // Default 12 hari
                this.returnDate = returnDate.toISOString().split('T')[0];
            }
        }
    }
}
</script>
</body>
</html>