@extends('layouts.admin')
@section('title', 'Tambah Berita')

@push('styles')
<style>
    .slug-preview { font-size: 0.8rem; color: #6B7280; font-family: monospace; background: #F3F4F6; padding: 4px 10px; border-radius: 6px; display: inline-block; margin-top: 4px; }
    .image-preview { max-height: 200px; border-radius: 12px; object-fit: cover; }
    .char-count { font-size: 0.75rem; color: #9CA3AF; text-align: right; }
    .tag-input-wrapper { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; padding: 6px 10px; border: 1px solid #dee2e6; border-radius: 8px; min-height: 42px; }
    .tag-item { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; background: #EFF6FF; color: #2563EB; }
    .tag-remove { cursor: pointer; font-weight: bold; opacity: 0.7; }
    .tag-remove:hover { opacity: 1; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: #001D5F;">📝 Tambah Berita Baru</h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Tulis artikel informasi umrah untuk jamaah</p>
    </div>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        {{-- Main Content --}}
        <div class="col-lg-8">
            <div class="card p-4 mb-4">
                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control form-control-lg" 
                           placeholder="Masukkan judul artikel..."
                           value="{{ old('title') }}" required
                           oninput="document.getElementById('slug-preview').textContent = '/informasi/' + this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-')">
                    <div class="slug-preview mt-2" id="slug-preview">/informasi/...</div>
                </div>

                {{-- Excerpt --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ringkasan (Excerpt)</label>
                    <textarea name="excerpt" class="form-control" rows="2" maxlength="300" 
                              placeholder="Ringkasan singkat artikel (maks 300 karakter)..."
                              oninput="document.getElementById('excerpt-count').textContent = this.value.length + '/300'">{{ old('excerpt') }}</textarea>
                    <div class="char-count" id="excerpt-count">0/300</div>
                </div>

                {{-- Body (WYSIWYG) --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Konten Artikel <span class="text-danger">*</span></label>
                    <textarea name="body" id="article-body" class="form-control" rows="15" required>{{ old('body') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            {{-- Publish Settings --}}
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color: #001D5F;">Pengaturan Publikasi</h6>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="draft" id="status-draft" 
                                   {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status-draft">Draft</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="published" id="status-published"
                                   {{ old('status') === 'published' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status-published">Published</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is-featured"
                           {{ old('is_featured') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is-featured">
                        ⭐ Tandai sebagai artikel unggulan
                    </label>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color: #001D5F;">Gambar Utama</h6>
                <div class="mb-3" x-data="{ preview: null }">
                    <input type="file" name="featured_image" class="form-control" accept="image/*"
                           @change="preview = URL.createObjectURL($event.target.files[0])">
                    <small class="text-muted">Maks 2MB. Format: JPG, PNG, WebP</small>
                    <template x-if="preview">
                        <img :src="preview" class="image-preview w-100 mt-2">
                    </template>
                </div>
                <div class="mb-0">
                    <label class="form-label" style="font-size: 0.85rem;">Caption Gambar</label>
                    <input type="text" name="image_caption" class="form-control form-control-sm" 
                           placeholder="Deskripsi gambar..." value="{{ old('image_caption') }}">
                </div>
            </div>

            {{-- SEO --}}
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color: #001D5F;">🔍 SEO Settings</h6>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 0.85rem;">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control form-control-sm" maxlength="70"
                           placeholder="Judul SEO (maks 70 karakter)" value="{{ old('meta_title') }}"
                           oninput="document.getElementById('meta-title-count').textContent = this.value.length + '/70'">
                    <div class="char-count" id="meta-title-count">0/70</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 0.85rem;">Meta Description</label>
                    <textarea name="meta_description" class="form-control form-control-sm" rows="2" maxlength="160"
                              placeholder="Deskripsi SEO (maks 160 karakter)"
                              oninput="document.getElementById('meta-desc-count').textContent = this.value.length + '/160'">{{ old('meta_description') }}</textarea>
                    <div class="char-count" id="meta-desc-count">0/160</div>
                </div>
                <div class="mb-0">
                    <label class="form-label" style="font-size: 0.85rem;">Tags <small class="text-muted">(pisahkan dengan koma)</small></label>
                    <input type="text" name="tags" class="form-control form-control-sm" 
                           placeholder="umrah, tips, ibadah" value="{{ old('tags') }}">
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-save me-1"></i> Simpan Artikel
                </button>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
{{-- TinyMCE CDN --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#article-body',
        height: 500,
        menubar: false,
        plugins: 'lists link image table code wordcount fullscreen',
        toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image table | alignleft aligncenter alignright | code fullscreen',
        content_style: 'body { font-family: Inter, sans-serif; font-size: 15px; line-height: 1.8; color: #374151; }',
        branding: false,
        images_upload_url: '{{ route("admin.articles.upload-image") }}',
        images_upload_credentials: true,
        automatic_uploads: true,
        setup: function(editor) {
            editor.on('init', function() {
                // Add CSRF token to upload requests
                var csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    editor.settings.images_upload_handler = function(blobInfo, progress) {
                        return new Promise(function(resolve, reject) {
                            var formData = new FormData();
                            formData.append('image', blobInfo.blob(), blobInfo.filename());

                            fetch('{{ route("admin.articles.upload-image") }}', {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrfToken.content },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(result => resolve(result.location))
                            .catch(error => reject('Upload gagal: ' + error));
                        });
                    };
                }
            });
        }
    });
</script>
@endpush
