@if ($paginator->hasPages())
<div class="pagination-wrapper mt-5">
    <div class="d-flex justify-content-center">
        <ul class="page-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span><span class="fa fa-angle-left"></span></span></li>
            @else
                <li class="page-numbers"><a class="page-numbers" href="{{ $paginator->previousPageUrl() }}" rel="prev"><span class="fa fa-angle-left"></span></a></li>
            @endif

            @if($paginator->currentPage() > 3)
                <li class="hidden-xs"><a class="page-numbers" href="{{ $paginator->url(1) }}">1</a></li>
            @endif
            @if($paginator->currentPage() > 4)
                <li class="page-numbers"><span>...</span></li>
            @endif
            @foreach(range(1, $paginator->lastPage()) as $i)
                @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <li class="active"><span aria-current="page" class="page-numbers current">{{ $i }}</span></li>
                    @else
                        <li class="page-numbers"><a class="page-numbers" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if($paginator->currentPage() < $paginator->lastPage() - 3)
                <li><span>...</span></li>
            @endif
            @if($paginator->currentPage() < $paginator->lastPage() - 2)
                <li class="hidden-xs"><a class="page-numbers" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a class="page-numbers" href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="fa fa-angle-right"></span></a></li>
            @else
                <li class="disabled"><span><span class="fa fa-angle-right"></span></span></li>
            @endif
        </ul>
    </div>
</div>
@endif