{{-- resources/views/pages/articles/index.blade.php --}}
@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - Artikel Umrah | Mahira Tour' : 'Artikel & Panduan Umrah | Mahira Tour')
@section('meta_description', isset($category) ? $category->description : 'Baca artikel terbaru seputar umrah, tips ibadah, kabar Mahira Tour, promo & penawaran, dan kisah jamaah. Panduan lengkap sebelum berangkat umrah.')

@section('content')

{{-- ==================== HERO BANNER ==================== --}}
<section class="relative h-[250px] sm:h-[280px] overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 z-[1]">
        <div class="w-full h-full bg-gradient-to-br from-[#001D5F] via-[#1a3a6e] to-[#2d5a8a]"></div>
    </div>
    <div class="absolute inset-0 z-[2] bg-primary/60"></div>
    <div class="relative z-[3] text-center max-w-[900px] px-5 pt-8">
        <div class="inline-flex items-center gap-2 px-4 sm:px-6 py-2 rounded-full mb-4 text-xs sm:text-sm bg-white/15 backdrop-blur-sm">
            <a href="{{ route('home') }}" class="text-white no-underline font-medium hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                Beranda
            </a>
            <span class="text-white/70">/</span>
            @if(isset($category))
                <a href="{{ route('articles.index') }}" class="text-white/70 no-underline hover:text-white transition-colors">Artikel</a>
                <span class="text-white/70">/</span>
                <span class="text-white/70">{{ $category->name }}</span>
            @else
                <span class="text-white/70">Artikel</span>
            @endif
        </div>
        <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold font-serif text-white mb-3 leading-tight">
            {{ isset($category) ? $category->name : 'Artikel & Panduan Umrah' }}
        </h1>
        <p class="text-sm md:text-base max-w-[600px] mx-auto leading-relaxed text-white/80">
            {{ isset($category) ? $category->description : 'Pelajari tips, baca kisah jamaah, dan temukan info terbaru sebelum berangkat umrah' }}
        </p>
    </div>
</section>

{{-- ==================== CATEGORY FILTER + SEARCH ==================== --}}
<section class="py-6 bg-white border-b border-gray-200 sticky top-[76px] md:top-[80px] z-30">
    <div class="container-main">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            {{-- Category Pills --}}
            <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-hide w-full sm:w-auto">
                <a href="{{ route('articles.index') }}" 
                   class="shrink-0 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 no-underline
                          {{ !$categorySlug ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('articles.category', $cat->slug) }}" 
                   class="shrink-0 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 no-underline
                          {{ $categorySlug === $cat->slug ? 'text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                   @if($categorySlug === $cat->slug) style="background: {{ $cat->color }};" @endif>
                    {{ $cat->name }}
                    @if($cat->articles_count > 0)
                        <span class="ml-1 text-xs opacity-70">({{ $cat->articles_count }})</span>
                    @endif
                </a>
                @endforeach
            </div>

            {{-- Search --}}
            <form action="{{ route('articles.index') }}" method="GET" class="relative w-full sm:w-auto sm:min-w-[260px]">
                <input type="text" name="search" value="{{ $search ?? '' }}" 
                       placeholder="Cari artikel..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-full border border-gray-200 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all bg-gray-50">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </form>
        </div>
    </div>
</section>

{{-- ==================== FEATURED ARTICLE ==================== --}}
@if($featuredArticle && !$categorySlug && !$search)
<section class="py-6 sm:py-10 lg:py-14 bg-gray-50">
    <div class="container-main">
        {{-- Section Label (helps mobile users understand context) --}}
        <div class="flex items-center gap-3 mb-4 sm:mb-6">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-gold-accessible border-b-2 border-gold pb-1">⭐ Artikel Unggulan</span>
        </div>
        
        <a href="{{ route('articles.show', $featuredArticle->slug) }}" 
           class="group block rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 bg-white no-underline">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="aspect-[16/9] sm:aspect-[16/10] lg:aspect-auto overflow-hidden">
                    @if($featuredArticle->featured_image)
                        <img src="{{ Storage::url($featuredArticle->featured_image) }}" 
                             alt="{{ $featuredArticle->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full min-h-[200px] sm:min-h-[250px] bg-gradient-to-br from-primary to-gold/30 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                </div>
                <div class="p-5 sm:p-8 lg:p-12 flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-3 sm:mb-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold text-white" 
                              style="background: {{ $featuredArticle->category->color }};">
                            {{ $featuredArticle->category->name }}
                        </span>
                    </div>
                    <h2 class="text-lg sm:text-xl lg:text-3xl font-bold font-serif text-primary mb-3 sm:mb-4 leading-snug group-hover:text-gold transition-colors duration-300">
                        {{ $featuredArticle->title }}
                    </h2>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4 sm:mb-6 line-clamp-2 sm:line-clamp-3">
                        {{ $featuredArticle->excerpt ?? Str::limit(strip_tags($featuredArticle->body), 200) }}
                    </p>
                    <div class="flex items-center gap-4 text-xs text-taupe">
                        <span>{{ $featuredArticle->formatted_date }}</span>
                        <span>•</span>
                        <span>{{ $featuredArticle->reading_time }} menit membaca</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</section>
@endif

{{-- ==================== ARTICLE GRID ==================== --}}
<section class="py-8 sm:py-12 lg:py-16 {{ ($featuredArticle && !$categorySlug && !$search) ? 'bg-white' : 'bg-gray-50' }}">
    <div class="container-main">
        @if($articles->count() > 0)
            {{-- Section header for clarity on mobile --}}
            @if($featuredArticle && !$categorySlug && !$search)
            <div class="flex items-center gap-3 mb-6 sm:mb-8">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-gold-accessible border-b-2 border-gold pb-1">📰 Semua Artikel</span>
            </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($articles as $article)
                <a href="{{ route('articles.show', $article->slug) }}" 
                   class="group block rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 bg-white no-underline">
                    {{-- Image --}}
                    <div class="aspect-[16/10] overflow-hidden">
                        @if($article->featured_image)
                            <img src="{{ Storage::url($article->featured_image) }}" 
                                 alt="{{ $article->title }}" loading="lazy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-primary/10 to-gold/10 flex items-center justify-center">
                                <svg class="w-12 h-12 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                    </div>
                    {{-- Content --}}
                    <div class="p-5 sm:p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold text-white" 
                                  style="background: {{ $article->category->color }};">
                                {{ $article->category->name }}
                            </span>
                            <span class="text-xs text-taupe">{{ $article->reading_time }} mnt</span>
                        </div>
                        <h3 class="text-base font-bold font-serif text-primary mb-2 leading-snug line-clamp-2 group-hover:text-gold transition-colors duration-300">
                            {{ $article->title }}
                        </h3>
                        <p class="text-sm text-gray-500 leading-relaxed line-clamp-2 mb-4">
                            {{ $article->excerpt ?? Str::limit(strip_tags($article->body), 120) }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-taupe">{{ $article->formatted_date }}</span>
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-gold-accessible group-hover:text-gold transition-colors">
                                Baca Selengkapnya
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
            <div class="mt-10 sm:mt-12 flex justify-center">
                {{ $articles->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="text-center py-16">
                <svg class="w-20 h-20 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <h3 class="text-xl font-bold text-primary mb-2">Belum Ada Artikel</h3>
                <p class="text-sm text-taupe mb-6">
                    @if($search)
                        Tidak ditemukan artikel untuk pencarian "{{ $search }}"
                    @elseif(isset($category))
                        Belum ada artikel dalam kategori {{ $category->name }}
                    @else
                        Artikel sedang dalam proses penulisan. Kunjungi kembali nanti!
                    @endif
                </p>
                @if($search || isset($category))
                    <a href="{{ route('articles.index') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-primary text-white font-semibold text-sm no-underline hover:bg-gold transition-colors duration-300">
                        Lihat Semua Artikel
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
@include('partials.cta-section')

@endsection
