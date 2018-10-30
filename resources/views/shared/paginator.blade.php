@if ($paginator->hasPages())
    <div class="flex justify-between mt-6 p-6 pt-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" rel="prev" class="button-prev button-disabled">
                <span><i class="far fa-angle-left"></i></span>
                @lang('pagination.previous')
            </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="button-prev">
                <span><i class="far fa-angle-left"></i></span>
                @lang('pagination.previous')
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="button-next">
                @lang('pagination.next')
                <span><i class="far fa-angle-right"></i></span>
            </a>
        @else
            <a href="#" rel="next" class="button-next button-disabled">
                @lang('pagination.next')
                <span><i class="far fa-angle-right"></i></span>
            </a>
        @endif
    </div>
@endif
