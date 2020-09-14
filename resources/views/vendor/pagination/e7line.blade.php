@if ($paginator->hasPages())
    <nav class="center">
        <div class="row">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
{{--                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                    <span aria-hidden="true">&lsaquo;</span>--}}
{{--                </li>--}}
            @else
{{--                <li>--}}
{{--                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>--}}
{{--                </li>--}}
                <a class="center" href="{{ $paginator->previousPageUrl() }}"><img src="img/left.svg" alt=""></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
{{--                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>--}}
                    <a class="center">...</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
{{--                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>--}}
                            <a class="center" href="{{ $url }}">{{ $page }}</a>
                        @else
{{--                            <li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                            <a class="center" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
{{--                <li>--}}
{{--                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"--}}
{{--                       aria-label="@lang('pagination.next')">&rsaquo;</a>--}}
{{--                </li>--}}
                <a class="center" href="{{ $paginator->nextPageUrl() }}"><img src="e7line/img/right.svg" alt=""></a>

            @else
{{--                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                    <span aria-hidden="true">&rsaquo;</span>--}}
{{--                </li>--}}
            @endif
        </div>
    </nav>
@endif


{{--<nav class="center">--}}
{{--    <div class="row">--}}
{{--        <a class="center" href="#"><img src="img/left.svg" alt=""></a>--}}
{{--        <a class="center active">1</a>--}}
{{--        <a class="center" href="#">2</a>--}}
{{--        <a class="center" href="#">3</a>--}}
{{--        <a class="center">...</a>--}}
{{--        <a class="center" href="#">10</a>--}}
{{--        <a class="center" href="#"><img src="img/right.svg" alt=""></a>--}}
{{--    </div>--}}
{{--</nav>--}}
