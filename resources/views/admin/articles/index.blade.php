@extends('layouts.admin')
@section('title', 'Kelola Berita')

@push('styles')
<style>
    .article-status { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
    .status-published { background: #ECFDF5; color: #059669; }
    .status-draft { background: #FEF3C7; color: #D97706; }
    .article-thumb { width: 60px; height: 45px; object-fit: cover; border-radius: 8px; }
    .article-title-link { color: #001D5F; text-decoration: none; font-weight: 600; }
    .article-title-link:hover { color: #D4AF37; }
    .category-badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; color: white; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h4 class="fw-bold mb-1" style="color: #001D5F;">📰 Kelola Berita</h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Tulis, edit, dan kelola artikel informasi umrah</p>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-success px-4">
        <i class="bi bi-plus-lg me-1"></i> Tambah Berita
    </a>
</div>

{{-- Filters --}}
<div class="card p-3 mb-4">
    <form action="{{ route('admin.articles.index') }}" method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari judul artikel..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i> Filter</button>
        </div>
    </form>
</div>

{{-- Articles Table --}}
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background: #F8F9FA;">
                <tr>
                    <th style="width: 40px;"></th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Tanggal</th>
                    <th style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr>
                    <td>
                        @if($article->featured_image)
                            <img src="{{ Storage::url($article->featured_image) }}" alt="" class="article-thumb">
                        @else
                            <div class="article-thumb d-flex align-items-center justify-content-center" style="background: #F0F0F0;">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="article-title-link">
                            {{ Str::limit($article->title, 50) }}
                        </a>
                        @if($article->is_featured)
                            <span class="ms-1" title="Artikel Unggulan">⭐</span>
                        @endif
                        <br>
                        <small class="text-muted">{{ $article->author->name ?? 'Admin' }}</small>
                    </td>
                    <td>
                        <span class="category-badge" style="background: {{ $article->category->color }};">
                            {{ $article->category->name }}
                        </span>
                    </td>
                    <td>
                        <span class="article-status {{ $article->status === 'published' ? 'status-published' : 'status-draft' }}">
                            <i class="bi {{ $article->status === 'published' ? 'bi-check-circle-fill' : 'bi-clock' }}"></i>
                            {{ $article->status === 'published' ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <span class="text-muted admin-font-sm">{{ number_format($article->views_count) }}</span>
                    </td>
                    <td>
                        <span class="admin-font-sm">
                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            {{-- Toggle Status --}}
                            <form action="{{ route('admin.articles.toggle', $article->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $article->status === 'published' ? 'btn-outline-warning' : 'btn-outline-success' }}" 
                                        title="{{ $article->status === 'published' ? 'Unpublish' : 'Publish' }}">
                                    <i class="bi {{ $article->status === 'published' ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                </button>
                            </form>
                            {{-- Edit --}}
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            {{-- Delete --}}
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="bi bi-newspaper admin-icon-xxl text-muted d-block mb-2" style="opacity: 0.2;"></i>
                        <p class="text-muted mb-0">Belum ada artikel</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
    <div class="p-3 d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
    @endif
</div>
@endsection
