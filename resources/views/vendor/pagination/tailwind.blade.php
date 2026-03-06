@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col sm:flex-row items-center justify-between gap-4">
        {{-- Mobile: Simple Previous/Next --}}
        <div class="flex justify-between w-full sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    &laquo; Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="px-4 py-2.5 text-sm font-medium text-primary bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors no-underline">
                    &laquo; Sebelumnya
                </a>
            @endif

            <span class="flex items-center px-3 text-sm text-gray-500">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="px-4 py-2.5 text-sm font-medium text-primary bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors no-underline">
                    Berikutnya &raquo;
                </a>
            @else
                <span class="px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    Berikutnya &raquo;
                </span>
            @endif
        </div>

        {{-- Desktop: Full Pagination --}}
        <div class="hidden sm:flex items-center gap-1">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 bg-gray-100 cursor-not-allowed" aria-disabled="true">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 bg-white border border-gray-200 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 no-underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-10 h-10 flex items-center justify-center text-sm text-gray-400">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-semibold text-white bg-primary shadow-md" aria-current="page">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-medium text-gray-600 bg-white border border-gray-200 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 no-underline">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 bg-white border border-gray-200 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 no-underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 bg-gray-100 cursor-not-allowed" aria-disabled="true">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>

        {{-- Results Info --}}
        <p class="text-sm text-gray-500 m-0">
            Menampilkan <strong class="text-primary">{{ $paginator->firstItem() ?? 0 }}</strong> - <strong class="text-primary">{{ $paginator->lastItem() ?? 0 }}</strong> dari <strong class="text-primary">{{ $paginator->total() }}</strong> artikel
        </p>
    </nav>
@endif
