<!DOCTYPE html>
<html>
<head>
    <title>Edit Paket - Mahira Tour Admin</title>
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
<body x-data="editScheduleApp()">

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
    <div class="alert alert-info" x-data="{ show: true }" x-show="show">
        <i class="bi bi-info-circle"></i> <strong>Info:</strong> 
        Sudah ada {{ $schedule->seats_taken }} jamaah terdaftar. 
        Quota minimal: {{ $schedule->seats_taken }} orang.
        <button type="button" class="btn-close" @click="show = false"></button>
    </div>

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

                </div>

                <!-- New Card: Page Details -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-layout-text-window-reverse"></i> Detail Halaman</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Singkat</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $schedule->description) }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hotel Makkah</label>
                                <input type="text" name="hotel_makkah" class="form-control mb-2" 
                                       value="{{ old('hotel_makkah', $schedule->hotel_makkah) }}" placeholder="Contoh: Anjum Hotel">
                                <input type="file" name="hotel_makkah_image" class="form-control form-control-sm mb-1" accept="image/*">
                                @if($schedule->hotel_makkah_image)
                                    <small class="d-block"><a href="{{ Storage::url($schedule->hotel_makkah_image) }}" target="_blank">Lihat Foto Makkah</a></small>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hotel Madinah</label>
                                <input type="text" name="hotel_madinah" class="form-control mb-2" 
                                       value="{{ old('hotel_madinah', $schedule->hotel_madinah) }}" placeholder="Contoh: Rove Hotel">
                                <input type="file" name="hotel_madinah_image" class="form-control form-control-sm mb-1" accept="image/*">
                                @if($schedule->hotel_madinah_image)
                                    <small class="d-block"><a href="{{ Storage::url($schedule->hotel_madinah_image) }}" target="_blank">Lihat Foto Madinah</a></small>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Itinerary (Teks)</label>
                            <textarea name="itinerary" class="form-control" rows="4" 
                                      placeholder="Hari 1: ...">{{ old('itinerary', $schedule->itinerary) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fasilitas Termasuk (Includes)</label>
                            <textarea name="features" class="form-control" rows="3"
                                      placeholder="Visa, Tiket, dll (Pisahkan koma)">{{ old('features', $schedule->features) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tidak Termasuk (Excludes)</label>
                            <textarea name="excludes" class="form-control" rows="3"
                                      placeholder="Paspor, Vaksin, dll (Pisahkan koma)">{{ old('excludes', $schedule->excludes) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hadiah Umrah (Gifts)</label>
                            <textarea name="gifts" class="form-control" rows="3"
                                      placeholder="Koper, Tas Selempang, dll (Pisahkan koma)">{{ old('gifts', $schedule->gifts) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Informasi Tambahan</label>
                            <textarea name="additional_info" class="form-control" rows="3"
                                      placeholder="Informasi penting lainnya...">{{ old('additional_info', $schedule->additional_info) }}</textarea>
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
                            <input type="date" 
                                   name="departure_date" 
                                   class="form-control" 
                                   x-model="departureDate"
                                   value="{{ old('departure_date', $schedule->departure_date->format('Y-m-d')) }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Tanggal Kepulangan</label>
                            <input type="date" 
                                   name="return_date" 
                                   class="form-control" 
                                   x-model="returnDate"
                                   :min="departureDate"
                                   value="{{ old('return_date', $schedule->return_date->format('Y-m-d')) }}" 
                                   required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Harga Quad/Base</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price" class="form-control" 
                                           value="{{ old('price', $schedule->price) }}" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Triple</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price_triple" class="form-control" 
                                           value="{{ old('price_triple', $schedule->price_triple) }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Double</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price_double" class="form-control" 
                                           value="{{ old('price_double', $schedule->price_double) }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Child</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price_child" class="form-control" 
                                           value="{{ old('price_child', $schedule->price_child) }}" min="0">
                                </div>
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
                            <input type="file" 
                                   name="flyer_image" 
                                   class="form-control" 
                                   accept="image/jpeg,image/jpg,image/png,image/webp" 
                                   @change="previewNewImage($event)">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti flyer</small>
                        </div>

                        <div class="preview-container">
                            <div>
                                <img :src="currentImage" 
                                     class="preview-image" 
                                     alt="{{ $schedule->package_name }}">
                                <p class="mt-3" :class="hasNewImage ? 'text-success' : 'text-muted'" x-text="previewText"></p>
                            </div>
                        </div>
                        
                        <div class="mt-3 text-center" x-show="hasNewImage" x-cloak>
                            <button type="button" 
                                    class="btn btn-sm btn-outline-secondary" 
                                    @click="resetPreview()">
                                <i class="bi bi-arrow-counterclockwise"></i> Lihat Flyer Asli
                            </button>
                        </div>
                        
                        <hr>
                        
                        <!-- Itinerary PDF -->
                        <div class="mb-3">
                            <label class="form-label">Update Itinerary PDF</label>
                            <input type="file" name="itinerary_pdf" class="form-control" accept="application/pdf">
                            <small class="text-muted">Upload baru untuk mengganti. Max 5MB.</small>
                            
                            @if($schedule->itinerary_pdf)
                            <div class="mt-2">
                                <a href="{{ Storage::url($schedule->itinerary_pdf) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-file-earmark-pdf"></i> Lihat PDF Saat Ini
                                </a>
                            </div>
                            @endif
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function editScheduleApp() {
    return {
        originalImage: '{{ Storage::url($schedule->flyer_image) }}',
        currentImage: '{{ Storage::url($schedule->flyer_image) }}',
        hasNewImage: false,
        previewText: 'Flyer saat ini',
        departureDate: '{{ old("departure_date", $schedule->departure_date->format("Y-m-d")) }}',
        returnDate: '{{ old("return_date", $schedule->return_date->format("Y-m-d")) }}',
        
        previewNewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.currentImage = e.target.result;
                    this.hasNewImage = true;
                    this.previewText = '✓ Flyer baru siap diupload';
                };
                reader.readAsDataURL(file);
            }
        },
        
        resetPreview() {
            this.currentImage = this.originalImage;
            this.hasNewImage = false;
            this.previewText = 'Flyer saat ini';
            // Reset file input
            document.querySelector('input[name="flyer_image"]').value = '';
        }
    }
}
</script>
</body>
</html>