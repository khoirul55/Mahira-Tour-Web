{{-- resources/views/pages/articles/show.blade.php --}}
@use('App\Helpers\ArticleHelper')
@extends('layouts.app')

@section('title', ($article->meta_title ?? $article->title) . ' | Mahira Tour')
@section('meta_description', $article->meta_description ?? ($article->excerpt ?? Str::limit(strip_tags($article->body), 155)))
@section('og_image', $article->featured_image ? Storage::url($article->featured_image) : asset('images/hero/video-poster.webp'))
@section('body-class', 'navbar-solid')

@push('styles')
<style>
    /* Bypass Tailwind Preflight: Memunculkan list bullet tanpa perlu rebuild Vite */
    .article-content ul { list-style-type: disc !important; padding-left: 1.5rem !important; margin-bottom: 1.25rem !important; }
    .article-content ol { list-style-type: decimal !important; padding-left: 1.5rem !important; margin-bottom: 1.25rem !important; }
    .article-content li { display: list-item !important; margin-bottom: 0.4rem !important; }
    .article-content a { color: #1a6dd4 !important; text-decoration: underline !important; text-underline-offset: 3px; text-decoration-color: rgba(26,109,212,0.4) !important; transition: all 0.2s; }
    .article-content a:hover { color: #1250a0 !important; text-decoration-color: #1250a0 !important; }
</style>
@endpush

@section('content')

{{-- ==================== ARTICLE HEADER ==================== --}}
<section class="pt-24 sm:pt-32 pb-8 bg-white">
    <div class="container-main max-w-4xl mx-auto px-4 sm:px-6">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-[13px] sm:text-sm text-gray-500 mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors no-underline">Beranda</a>
            <span class="text-gray-300">/</span>
            <a href="{{ route('articles.index') }}" class="hover:text-primary transition-colors no-underline">Artikel</a>
            <span class="text-gray-300">/</span>
            <a href="{{ route('articles.category', $article->category->slug) }}" class="hover:text-primary transition-colors no-underline">{{ $article->category->name }}</a>
            <span class="text-gray-300">/</span>
            <span class="text-gray-400 truncate max-w-[150px] sm:max-w-xs">{{ $article->title }}</span>
        </nav>

        {{-- Category Badge --}}
        <div class="flex items-center gap-3 mb-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold text-white" 
                  style="background: {{ $article->category->color }};">
                {{ $article->category->name }}
            </span>
            <span class="text-xs text-taupe">{{ $article->reading_time }} menit membaca</span>
        </div>

        {{-- Title --}}
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold font-serif text-primary leading-tight mb-6">
            {{ $article->title }}
        </h1>

        {{-- Author & Date --}}
        <div class="pb-6 border-b border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-primary mb-0.5">{{ $article->author->name ?? 'Admin Mahira Tour' }}</p>
                    <div class="flex items-center gap-2 text-xs text-taupe">
                        <span>{{ $article->formatted_date }}</span>
                        <span class="w-1 h-1 rounded-full bg-taupe/50"></span>
                        <span>{{ number_format($article->views_count) }}x dibaca</span>
                    </div>
                </div>
            </div>
            {{-- Share Buttons --}}
            <div class="flex items-center gap-2">
                <span class="text-xs text-taupe mr-1">Bagikan:</span>
                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
                   target="_blank" rel="noopener"
                   class="w-8 h-8 rounded-full bg-[#25D366]/10 flex items-center justify-center text-[#25D366] hover:bg-[#25D366] hover:text-white transition-all duration-300 no-underline"
                   title="Bagikan ke WhatsApp">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                   target="_blank" rel="noopener"
                   class="w-8 h-8 rounded-full bg-[#1877F2]/10 flex items-center justify-center text-[#1877F2] hover:bg-[#1877F2] hover:text-white transition-all duration-300 no-underline"
                   title="Bagikan ke Facebook">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <button onclick="navigator.clipboard.writeText(window.location.href); this.querySelector('svg').innerHTML='<path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M5 13l4 4L19 7\'/>'; setTimeout(() => this.querySelector('svg').innerHTML='<path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1\'/>', 2000)"
                        class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-primary hover:text-white transition-all duration-300 cursor-pointer border-0"
                        title="Salin Link">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

{{-- ==================== FEATURED IMAGE ==================== --}}
@if($article->featured_image)
<section class="pb-8 bg-white">
    <div class="container-main max-w-4xl mx-auto px-4 sm:px-6">
        <div class="w-full max-w-lg md:max-w-2xl mx-auto">
            <div class="rounded-xl overflow-hidden shadow-sm">
                <img src="{{ Storage::url($article->featured_image) }}" 
                     alt="{{ $article->image_caption ?? $article->title }}"
                     class="w-full h-auto">
            </div>
            @if($article->image_caption)
            <p class="text-[13px] text-gray-400 italic mt-3 text-center">{{ $article->image_caption }}</p>
            @endif
        </div>
    </div>
</section>
@endif

{{-- ==================== ARTICLE BODY ==================== --}}
<section class="pb-12 bg-white">
    <div class="container-main max-w-4xl mx-auto px-4 sm:px-6">
        {{-- Prose Content --}}
        {{-- Article content styles are in app.css --}}
        <div class="prose prose-lg max-w-none article-content
                    prose-headings:font-serif prose-headings:text-primary prose-headings:font-bold
                    prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4
                    prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                    prose-a:text-[#1a6dd4] prose-a:underline prose-a:underline-offset-2 prose-a:decoration-[#1a6dd4]/40 hover:prose-a:text-[#1250a0] hover:prose-a:decoration-[#1250a0]
                    prose-img:rounded-xl prose-img:shadow-md
                     prose-li:mb-2">
            {!! ArticleHelper::processEmbeds($article->body) !!}
        </div>

        {{-- Tags --}}
        @if($article->tags && count($article->tags) > 0)
        <div class="mt-10 pt-6 border-t border-gray-200">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-sm font-semibold text-primary">Tags:</span>
                @foreach($article->tags as $tag)
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                    #{{ $tag }}
                </span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Bottom Share --}}
        <div class="mt-8 p-6 sm:p-8 rounded-2xl bg-gray-50 text-center">
            <p class="text-sm font-semibold text-primary mb-5">Bagikan artikel ini:</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                {{-- WhatsApp --}}
                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
                   target="_blank" rel="noopener"
                   class="flex flex-col items-center gap-1.5 no-underline group" title="WhatsApp">
                    <span class="w-12 h-12 rounded-full bg-[#25D366] flex items-center justify-center text-white group-hover:shadow-lg group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </span>
                    <span class="text-[11px] text-gray-500 font-medium">WhatsApp</span>
                </a>
                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                   target="_blank" rel="noopener"
                   class="flex flex-col items-center gap-1.5 no-underline group" title="Facebook">
                    <span class="w-12 h-12 rounded-full bg-[#1877F2] flex items-center justify-center text-white group-hover:shadow-lg group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </span>
                    <span class="text-[11px] text-gray-500 font-medium">Facebook</span>
                </a>
                {{-- Twitter/X --}}
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}" 
                   target="_blank" rel="noopener"
                   class="flex flex-col items-center gap-1.5 no-underline group" title="Twitter/X">
                    <span class="w-12 h-12 rounded-full bg-[#000000] flex items-center justify-center text-white group-hover:shadow-lg group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </span>
                    <span class="text-[11px] text-gray-500 font-medium">Twitter</span>
                </a>
                {{-- Instagram --}}
                <a href="https://www.instagram.com/" 
                   target="_blank" rel="noopener"
                   onclick="navigator.clipboard.writeText(window.location.href); alert('Link artikel telah disalin! Buka Instagram dan paste di Story atau DM Anda.');"
                   class="flex flex-col items-center gap-1.5 no-underline group" title="Instagram">
                    <span class="w-12 h-12 rounded-full bg-gradient-to-br from-[#F58529] via-[#DD2A7B] to-[#8134AF] flex items-center justify-center text-white group-hover:shadow-lg group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </span>
                    <span class="text-[11px] text-gray-500 font-medium">Instagram</span>
                </a>
                {{-- Salin Link --}}
                <button onclick="navigator.clipboard.writeText(window.location.href); this.querySelector('.copy-label').innerText='Tersalin!'; setTimeout(() => this.querySelector('.copy-label').innerText='Salin Link', 2000)"
                        class="flex flex-col items-center gap-1.5 cursor-pointer border-0 bg-transparent p-0 group" title="Salin Link">
                    <span class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 group-hover:bg-primary group-hover:text-white group-hover:shadow-lg group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </span>
                    <span class="copy-label text-[11px] text-gray-500 font-medium">Salin Link</span>
                </button>
            </div>
        </div>
    </div>
</section>

{{-- ==================== RELATED ARTICLES ==================== --}}
@if($relatedArticles->count() > 0)
<section class="py-12 lg:py-16 bg-gray-50">
    <div class="container-main">
        <div class="text-center mb-10">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest mb-3 pb-1 text-gold-accessible border-b-2 border-gold">Artikel Terkait</span>
            <h2 class="text-xl md:text-2xl font-semibold font-serif text-primary">Baca Juga</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach($relatedArticles as $related)
            <a href="{{ route('articles.show', $related->slug) }}" 
               class="group block rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 bg-white no-underline">
                <div class="aspect-[16/10] overflow-hidden">
                    @if($related->featured_image)
                        <img src="{{ Storage::url($related->featured_image) }}" 
                             alt="{{ $related->title }}" loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-primary/10 to-gold/10 flex items-center justify-center">
                            <svg class="w-10 h-10 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                </div>
                <div class="p-5">
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-semibold text-white mb-2" 
                          style="background: {{ $related->category->color }};">{{ $related->category->name }}</span>
                    <h3 class="text-sm font-bold font-serif text-primary mb-2 leading-snug line-clamp-2 group-hover:text-gold transition-colors">{{ $related->title }}</h3>
                    <span class="text-xs text-taupe">{{ $related->formatted_date }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Article CTA Banner --}}
<section class="py-10 bg-white">
    <div class="container-main max-w-4xl mx-auto px-4 sm:px-6">
        <div class="rounded-2xl bg-gradient-to-br from-primary to-primary-light p-8 sm:p-10 text-center">
            <h3 class="text-xl sm:text-2xl font-bold font-serif text-white mb-3">Siap Berangkat Umrah?</h3>
            <p class="text-sm text-white/80 mb-6 max-w-md mx-auto">Konsultasi GRATIS dengan tim Mahira Tour. Kami bantu wujudkan perjalanan ibadah Anda ke Tanah Suci.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" 
                   target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#25D366] text-white font-semibold text-sm no-underline hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <i class="bi bi-whatsapp"></i> Chat WhatsApp Sekarang
                </a>
                <a href="{{ route('schedule') }}" 
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-white/15 text-white font-semibold text-sm no-underline hover:bg-white/25 transition-all duration-300 border border-white/30">
                    Lihat Paket Umrah
                </a>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
@include('partials.cta-section')

@push('scripts')
{{-- Instagram Embed JS — lazy loaded via IntersectionObserver --}}
<script>
(function() {
    // Only load Instagram embed.js if there are Instagram embeds on the page
    var igEmbeds = document.querySelectorAll('.embed-wrapper.instagram');
    if (igEmbeds.length === 0) return;

    var igLoaded = false;

    function loadInstagramEmbed() {
        if (igLoaded) {
            // If already loaded, just reprocess
            if (window.instgrm) window.instgrm.Embeds.process();
            return;
        }
        igLoaded = true;
        var script = document.createElement('script');
        script.src = 'https://www.instagram.com/embed.js';
        script.async = true;
        script.defer = true;
        script.onload = function() {
            if (window.instgrm) window.instgrm.Embeds.process();
        };
        document.body.appendChild(script);
    }

    // Use IntersectionObserver to lazy-load Instagram when embed enters viewport
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    loadInstagramEmbed();
                    observer.unobserve(entry.target);
                }
            });
        }, { rootMargin: '200px' });

        igEmbeds.forEach(function(el) { observer.observe(el); });
    } else {
        // Fallback: load immediately
        loadInstagramEmbed();
    }
})();
</script>
@endpush

@endsection
