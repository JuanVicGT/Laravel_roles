@if ($paginator->hasPages())
    <div class="flex justify-between md:px-4">
        <section class="grid content-center text-gray-500 dark:text-gray-400">
            {{ __('Showing :init to :end from :count results', [
                'init' => $paginator->firstItem(),
                'end' => $paginator->lastItem(),
                'count' => $paginator->total(),
            ]) }}
        </section>
        <section class="grid content-center">
            <ul class="inline-flex -space-x-px text-base h-10">
                {{-- Previous Page Link --}}
                @if (!$paginator->onFirstPage())
                    <li>
                        <button
                            class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:click="previousPage">
                            <span class="sr-only">{{ __('previous') }}</span>
                            <x-zondicon-cheveron-left class="w-6 h-6" />
                        </button>
                    </li>
                @endif

                {{-- Pagination Element Here --}}
                @foreach ($elements as $element)
                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <!--  Use three dots when current page is greater than 2.  -->
                            @if ($paginator->currentPage() > 2 && $page === 2)
                                <li class="hidden md:inline-block md:pr-2">
                                    <button
                                        class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        wire:click="gotoPage(1)">1</button>
                                </li>
                            @endif

                            <!--  Show active page two pages before and after it.  -->
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <button
                                        class="flex items-center justify-center px-4 h-10 text-blue-800 border border-gray-300 bg-blue-100 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                        aria-current="page">{{ $paginator->currentPage() }}</button>
                                </li>
                            @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() - 1)
                                <li>
                                    <button
                                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        wire:click="gotoPage({{ $page }})">{{ $page }}</button>
                                </li>
                            @endif

                            <!--  Use three dots when current page is away from end.  -->
                            @if ($paginator->currentPage() < $paginator->lastPage() - 1 && $page === $paginator->lastPage() - 1)
                                <li class="hidden md:inline-block md:pl-2">
                                    <button
                                        class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        wire:click="gotoPage({{ $paginator->lastPage() }})">{{ __($paginator->lastPage()) }}</button>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <button
                            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:click="nextPage">
                            <span class="sr-only">{{ __('next') }}</span>
                            <x-zondicon-cheveron-right class="w-6 h-6" />
                        </button>
                    </li>
                @endif
            </ul>
        </section>
    </div>
@endif
