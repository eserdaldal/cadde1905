@if ($paginator->hasPages())
    <style>
        .pagination-v4 {
            display: flex !important;
            align-items: center !important;
            gap: 6px !important;
            background: #1a1a1a !important;
            padding: 6px !important;
            border-radius: 12px !important;
            border: 1px solid rgba(255,255,255,0.08) !important;
        }
        .page-link-v4 {
            min-width: 36px !important;
            height: 36px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 8px !important;
            text-decoration: none !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            color: #999 !important;
            transition: all 0.2s !important;
        }
        .page-link-v4:hover {
            background: #252525 !important;
            color: #fff !important;
        }
        .page-link-v4.active {
            background: #A91D35 !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(169, 29, 53, 0.3) !important;
        }
        .page-link-v4.disabled {
            opacity: 0.3 !important;
            pointer-events: none !important;
        }
    </style>

    <div class="mt-12 flex justify-center">
        <nav class="pagination-v4">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="page-link-v4 disabled">«</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link-v4" rel="prev">«</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="page-link-v4 disabled">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page-link-v4 active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-link-v4">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link-v4" rel="next">»</a>
            @else
                <span class="page-link-v4 disabled">»</span>
            @endif
        </nav>
    </div>
@endif
