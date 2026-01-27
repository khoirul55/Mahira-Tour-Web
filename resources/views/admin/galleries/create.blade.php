@extends('layouts.admin')

@section('title', 'Upload Foto Baru')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Galeri
        </a>
    </div>

    <h1 class="mb-4">Upload Foto Baru</h1>

    <div x-data="createGalleryApp()">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
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
                                       placeholder="Contoh: Jamaah di Masjidil Haram"
                                       value="{{ old('title') }}" 
                                       required>
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
                                <input type="number" 
                                       name="display_order" 
                                       class="form-control" 
                                       value="{{ old('display_order', 0) }}" 
                                       min="0">
                                <small class="text-muted">Semakin kecil angka, semakin awal muncul</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Upload Foto *</label>
                                <input type="file" 
                                       name="image" 
                                       class="form-control" 
                                       accept="image/jpeg,image/jpg,image/png,image/webp" 
                                       @change="previewImage($event)" 
                                       required>
                                <small class="text-muted">Format: JPG, PNG, WEBP. Max 5MB</small>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" 
                                       name="is_active" 
                                       class="form-check-input" 
                                       id="is_active" 
                                       value="1" 
                                       checked>
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
                            <div class="preview-container">
                                <div x-show="!imagePreview" class="text-muted">
                                    <i class="bi bi-image" style="font-size: 3rem;"></i>
                                    <p class="mt-2">Belum ada foto dipilih</p>
                                </div>
                                <img x-show="imagePreview" 
                                     :src="imagePreview" 
                                     class="preview-image" 
                                     alt="Preview"
                                     x-cloak>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
<style>
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
</style>
@endpush

@push('scripts')
<script>
function createGalleryApp() {
    return {
        imagePreview: null,
        
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }
}
</script>
@endpush