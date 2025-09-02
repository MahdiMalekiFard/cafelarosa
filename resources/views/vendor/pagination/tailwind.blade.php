@if ($paginator->hasPages())
    <div class="tractour-pagination">

        <ul class="pagination justify-center flex pl-0">
            @if ($paginator->onFirstPage())
                <li class="page-item m-[0_5px] first:ml-0 disabled" aria-disabled="true">
                    <p class="page-link bg-[#f1f1f1] border text-[#444444] block font-normal leading-tight relative text-center w-20 px-3 py-2 border-solid border-transparent focus:shadow-none ml-0 rounded-none">
                        <span>{{trans('general.back_page')}}</span>
                    </p>
                </li>
            @else
                <li class="page-item m-[0_5px] first:ml-0">
                    <a class="page-link bg-[#f1f1f1] border text-[#444444] block font-normal leading-tight relative text-center w-20 px-3 py-2 border-solid border-transparent focus:shadow-none ml-0 rounded-none"
                       href="{{ $paginator->previousPageUrl() }}">
                        <span>{{trans('general.back_page')}}</span>
                    </a>
                </li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item m-[0_5px] first:ml-0 active">
                                <a class="page-link bg-[#f1f1f1] border text-[#444444] block font-normal leading-tight relative text-center w-10 -ml-px px-3 py-2 border-solid border-transparent focus:shadow-none"
                                   href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item m-[0_5px] first:ml-0">
                                <a class="page-link bg-[#f1f1f1] border text-[#444444] block font-normal leading-tight relative text-center w-10 -ml-px px-3 py-2 border-solid border-transparent focus:shadow-none"
                                   href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach


            @if ($paginator->hasMorePages())
                <li class="page-item m-[0_5px] first:ml-0">
                    <a class="page-link bg-[#f1f1f1] border text-[#444444] block font-normal leading-tight relative text-center w-20 -ml-px px-3 py-2 border-solid border-transparent focus:shadow-none rounded-none"
                       href="{{ $paginator->nextPageUrl() }}">
                        <span>{{trans('general.next_page')}}</span>
                    </a>
                </li>
            @else
                <li class="page-item m-[0_5px] first:ml-0 disabled" aria-disabled="true">
                    <p class="page-link disabled bg-[#f1f1f1] border text-[#444444] block font-normal leading-tight relative text-center w-20 -ml-px px-3 py-2 border-solid border-transparent focus:shadow-none rounded-none">
                        <span>{{trans('general.next_page')}}</span>
                    </p>
                </li>
            @endif

        </ul>
    </div>
@endif
