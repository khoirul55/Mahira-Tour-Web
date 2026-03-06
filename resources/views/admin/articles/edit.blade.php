@extends('layouts.admin')
@section('title', 'Edit Berita')

@push('styles')
{{-- Quill CSS --}}
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    .slug-preview { font-size: 0.8rem; color: #6B7280; font-family: monospace; background: #F3F4F6; padding: 4px 10px; border-radius: 6px; display: inline-block; margin-top: 4px; }
    .image-preview { max-height: 200px; border-radius: 12px; object-fit: cover; }
    .char-count { font-size: 0.75rem; color: #9CA3AF; text-align: right; }
    /* Quill Custom Style */
    .ql-toolbar.ql-snow { border-top-left-radius: 6px; border-top-right-radius: 6px; border-color: #dee2e6; }
    .ql-container.ql-snow { border-color: #dee2e6; border-bottom-left-radius: 6px; border-bottom-right-radius: 6px; font-family: 'Inter', sans-serif; font-size: 15px; }
    .ql-editor { min-height: 400px; padding: 1.5rem; }
    .ql-editor p { margin-bottom: 1rem; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: #001D5F;">✏️ Edit Berita</h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ Str::limit($article->title, 60) }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="btn btn-outline-info">
            <i class="bi bi-eye me-1"></i> Lihat
        </a>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
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

<form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    
    <div class="row">
        {{-- Main Content --}}
        <div class="col-lg-8">
            <div class="card p-4 mb-4">
                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control form-control-lg" 
                           value="{{ old('title', $article->title) }}" required
                           oninput="document.getElementById('slug-preview').textContent = '/informasi/' + this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-')">
                </div>

                {{-- Slug --}}
                <div class="mb-3">
                    <label class="form-label" style="font-size: 0.85rem;">Slug URL</label>
                    <div class="input-group">
                        <span class="input-group-text" style="font-size: 0.85rem;">/informasi/</span>
                        <input type="text" name="slug" class="form-control form-control-sm" 
                               value="{{ old('slug', $article->slug) }}">
                    </div>
                    <div class="slug-preview mt-1" id="slug-preview">/informasi/{{ $article->slug }}</div>
                </div>

                {{-- Excerpt --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ringkasan (Excerpt)</label>
                    <textarea name="excerpt" class="form-control" rows="2" maxlength="300" 
                              placeholder="Ringkasan singkat artikel..."
                              oninput="document.getElementById('excerpt-count').textContent = this.value.length + '/300'">{{ old('excerpt', $article->excerpt) }}</textarea>
                    <div class="char-count" id="excerpt-count">{{ strlen($article->excerpt ?? '') }}/300</div>
                </div>

                {{-- Body (WYSIWYG) --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Konten Artikel <span class="text-danger">*</span></label>
                    <div id="editor-container" style="background-color: white;">{!! old('body', $article->body) !!}</div>
                    <textarea name="body" id="article-body" class="d-none">{{ old('body', $article->body) }}</textarea>
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
                                   {{ old('status', $article->status) === 'draft' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status-draft">Draft</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="published" id="status-published"
                                   {{ old('status', $article->status) === 'published' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status-published">Published</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is-featured"
                           {{ old('is_featured', $article->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is-featured">
                        ⭐ Tandai sebagai artikel unggulan
                    </label>
                </div>

                @if($article->published_at)
                <div class="p-2 rounded" style="background: #ECFDF5; font-size: 0.8rem; color: #059669;">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Dipublish: {{ $article->published_at->format('d M Y H:i') }}
                </div>
                @endif
            </div>

            {{-- Featured Image --}}
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color: #001D5F;">Gambar Utama</h6>
                
                @if($article->featured_image)
                <div class="mb-3">
                    <img src="{{ Storage::url($article->featured_image) }}" class="image-preview w-100" alt="Current image">
                    <small class="text-muted d-block mt-1">Gambar saat ini</small>
                </div>
                @endif

                <div class="mb-3" x-data="{ preview: null }">
                    <label class="form-label" style="font-size: 0.85rem;">{{ $article->featured_image ? 'Ganti Gambar' : 'Upload Gambar' }}</label>
                    <input type="file" name="featured_image" class="form-control form-control-sm" accept="image/*"
                           @change="preview = URL.createObjectURL($event.target.files[0])">
                    <small class="text-muted">Maks 2MB. Format: JPG, PNG, WebP</small>
                    <template x-if="preview">
                        <img :src="preview" class="image-preview w-100 mt-2">
                    </template>
                </div>
                <div class="mb-0">
                    <label class="form-label" style="font-size: 0.85rem;">Caption Gambar</label>
                    <input type="text" name="image_caption" class="form-control form-control-sm" 
                           value="{{ old('image_caption', $article->image_caption) }}">
                </div>
            </div>

            {{-- SEO --}}
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color: #001D5F;">🔍 SEO Settings</h6>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 0.85rem;">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control form-control-sm" maxlength="70"
                           value="{{ old('meta_title', $article->meta_title) }}"
                           oninput="document.getElementById('meta-title-count').textContent = this.value.length + '/70'">
                    <div class="char-count" id="meta-title-count">{{ strlen($article->meta_title ?? '') }}/70</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 0.85rem;">Meta Description</label>
                    <textarea name="meta_description" class="form-control form-control-sm" rows="2" maxlength="160"
                              oninput="document.getElementById('meta-desc-count').textContent = this.value.length + '/160'">{{ old('meta_description', $article->meta_description) }}</textarea>
                    <div class="char-count" id="meta-desc-count">{{ strlen($article->meta_description ?? '') }}/160</div>
                </div>
                <div class="mb-0">
                    <label class="form-label" style="font-size: 0.85rem;">Tags <small class="text-muted">(pisahkan dengan koma)</small></label>
                    <input type="text" name="tags" class="form-control form-control-sm" 
                           value="{{ old('tags', is_array($article->tags) ? implode(', ', $article->tags) : $article->tags) }}">
                </div>
            </div>

            {{-- Stats --}}
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color: #001D5F;">📊 Statistik</h6>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted" style="font-size: 0.85rem;">Total Views</span>
                    <strong>{{ number_format($article->views_count) }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted" style="font-size: 0.85rem;">Dibuat</span>
                    <span style="font-size: 0.85rem;">{{ $article->created_at->format('d M Y') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted" style="font-size: 0.85rem;">Terakhir Update</span>
                    <span style="font-size: 0.85rem;">{{ $article->updated_at->format('d M Y') }}</span>
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
{{-- Quill JS CDN --}}
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'align': [] }],
        [{ 'color': [] }, { 'background': [] }],
        ['link', 'image', 'video'],
        ['clean']
    ];

    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: {
                container: toolbarOptions,
                handlers: {
                    image: imageHandler
                }
            }
        },
        placeholder: 'Tulis isi artikel di sini...',
        theme: 'snow'
    });

    // Sycn with hidden textarea on submit
    var form = document.querySelector('form');
    form.addEventListener('submit', function() {
        var html = quill.root.innerHTML;
        document.getElementById('article-body').value = html === '<p><br></p>' ? '' : html;
    });

    // Custom Image handler for Quill
    function imageHandler() {
        var range = this.quill.getSelection();
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = () => {
            var file = input.files[0];
            if (file) {
                var formData = new FormData();
                formData.append('image', file);

                var csrfToken = document.querySelector('meta[name="csrf-token"]');
                var token = csrfToken ? csrfToken.content : '';

                fetch('{{ route("admin.articles.upload-image") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': token },
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.location) {
                        this.quill.insertEmbed(range.index, 'image', result.location);
                    } else {
                        alert('Upload gagal');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Upload gagal: ' + error);
                });
            }
        };
    }
</script>
@endpush
