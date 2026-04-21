@if ($paginator->hasPages())
    <div class="timeline-pagination-wrap">
        <nav class="timeline-pagination" aria-label="Pagination">
            @if ($paginator->onFirstPage())
                <span class="timeline-page-link is-disabled">«</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="timeline-page-link" rel="prev">«</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="timeline-page-link is-disabled">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="timeline-page-link is-active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="timeline-page-link">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="timeline-page-link" rel="next">»</a>
            @else
                <span class="timeline-page-link is-disabled">»</span>
            @endif
        </nav>
    </div>
@endif
