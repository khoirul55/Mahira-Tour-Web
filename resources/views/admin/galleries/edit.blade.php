@extends('layouts.admin')

@section('title', 'Edit Foto')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Galeri
        </a>
    </div>

    <h1 class="mb-4">Edit Foto</h1>

    <div x-data="editGalleryApp()">
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
@endpush