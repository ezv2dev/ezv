@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled me-2 me-lg-0" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link font-light" aria-hidden="true">
                        <button style="width: 50px; height: 50px;" class="button-next 	d-block d-sm-none" id="modal-map-right-prev"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="d-none d-sm-block">
                            &lsaquo;
                        </div>
                    </span>
                </li>
            @else
                <li class="page-item me-2 ms-lg-0">
                    <a class="page-link font-light" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <button style="width: 50px; height: 50px;" class="button-next d-block d-sm-none" id="modal-map-right-prev"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="d-none d-sm-block">
                            &lsaquo;
                        </div>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled d-none d-sm-block" aria-disabled="true"><span class="page-link font-light">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link font-light">{{ $page }}</span></li>
                        @else
                            <li class="page-item d-none d-sm-block"><a class="page-link font-light" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- show pagination number when on small size --}}
            <div class="d-flex align-items-center">
                <span class="d-block d-sm-none">
                    {{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}
                </span>
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item ms-3 ms-lg-0">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <button style="width: 50px; height: 50px;" class="button-prev d-block d-sm-none" id="modal-map-right-next"><i class="fa-solid fa-chevron-right"></i></button>
                        <div class="d-none d-sm-block">
                            &rsaquo;
                        </div>
                    </a>
                </li>
            @else
                <li class="page-item disabled ms-3 ms-lg-0" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">
                        <button style="width: 50px; height: 50px;" class="button-prev d-block d-sm-none" id="modal-map-right-next"><i class="fa-solid fa-chevron-right"></i></button>
                        <div class="d-none d-sm-block">
                            &rsaquo;
                        </div>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
