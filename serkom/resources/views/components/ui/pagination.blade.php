@props([
    'paginator',
    'variant' => 'default',
    'perPage' => true,
    'perPageOptions' => [10, 25, 50, 100],
    'paramName' => 'per_page',
])

@if($paginator->hasPages() || $perPage)
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $onFirstPage = $paginator->onFirstPage();
        $hasMorePages = $paginator->hasMorePages();
        $total = $paginator->total();
        $from = $paginator->firstItem();
        $to = $paginator->lastItem();

        $currentPerPage = (int) request($paramName, $paginator->perPage());

        $window = 1;
        $start = max(1, $currentPage - $window);
        $end = min($lastPage, $currentPage + $window);

        if ($currentPage <= 3) {
            $end = min($lastPage, 4);
        }
        if ($currentPage >= $lastPage - 2) {
            $start = max(1, $lastPage - 3);
        }

        $pages = range($start, $end);

        $baseBtn = 'flex h-9 min-w-9 items-center justify-center rounded-lg text-sm font-medium transition-colors';
        $btnDefault = 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700/50';
        $btnActive = 'bg-[#1E90D6] text-white shadow-sm hover:bg-[#1E5CD6]';
        $btnDisabled = 'cursor-not-allowed text-gray-300 dark:text-gray-600';
    @endphp

    <div
        class="flex flex-col gap-3 border-t border-gray-100 px-5 py-4 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between">

        {{-- KIRI: Per Page + Info --}}
        <div class="flex flex-wrap items-center gap-3">

            @if($perPage)
                <div class="flex items-center gap-2">
                    <label class="text-xs text-gray-500 dark:text-gray-400">Tampilkan</label>

                    {{-- Custom Alpine Dropdown --}}
                    <div x-data="{
                        open: false,
                        current: {{ $currentPerPage }},
                        options: @js($perPageOptions),
                        label: null,
                        init() {
                            this.label = this.current;
                        },
                        pick(val) {
                            this.current = val;
                            this.label = val;
                            this.open = false;
                            const url = new URL(window.location.href);
                            url.searchParams.set('{{ $paramName }}', val);
                            url.searchParams.delete('page');
                            window.location.href = url.toString();
                        }
                    }" @click.outside="open = false" @keydown.escape.window="open = false" class="relative">
                        <button type="button" @click="open = !open"
                            class="inline-flex h-9 min-w-[80px] items-center justify-between gap-2 rounded-lg border border-gray-200 bg-white px-3 text-xs font-medium text-gray-700 transition hover:border-gray-300 focus:border-[#1E90D6] focus:outline-none focus:ring-2 focus:ring-[#1E90D6]/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                            <span x-text="label"></span>
                            <svg class="h-3.5 w-3.5 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''"
                                fill="none" viewBox="0 0 20 20">
                                <path d="m6 8 4 4 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div x-show="open" x-cloak x-transition
                            class="absolute bottom-full left-0 z-50 mb-1 w-full min-w-[80px] overflow-hidden rounded-lg border border-gray-200 bg-white py-1 shadow-lg dark:border-gray-700 dark:bg-gray-800">
                            <template x-for="opt in options" :key="opt">
                                <button type="button" @click="pick(opt)"
                                    class="flex w-full items-center justify-between px-3 py-1.5 text-xs font-medium transition"
                                    :class="current === opt
                                    ? 'bg-[#1E90D6]/10 text-[#1E90D6]'
                                    : 'text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/50'">
                                    <span x-text="opt"></span>
                                    <svg x-show="current === opt" class="h-3 w-3" fill="none" viewBox="0 0 20 20">
                                        <path d="M16.6666 5L8.24992 13.4167L3.33325 8.5" stroke="currentColor"
                                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </template>
                        </div>
                    </div>

                    <label class="text-xs text-gray-500 dark:text-gray-400">data</label>
                </div>
            @endif

            @if($variant !== 'simple')
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    <span class="font-medium text-gray-700 dark:text-gray-200">{{ $from }}–{{ $to }}</span>
                    dari
                    <span class="font-medium text-gray-700 dark:text-gray-200">{{ $total }}</span>
                </p>
            @endif

            @if($variant === 'simple' && $paginator->hasPages())
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Halaman <span class="font-medium text-gray-700 dark:text-gray-200">{{ $currentPage }}</span>
                    dari <span class="font-medium text-gray-700 dark:text-gray-200">{{ $lastPage }}</span>
                </p>
            @endif

        </div>

        {{-- KANAN: Navigasi --}}
        @if($paginator->hasPages())

            @if($variant === 'compact')
                <div class="flex items-center gap-1">
                    @if($onFirstPage)
                        <span class="{{ $baseBtn }} {{ $btnDisabled }}">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                <path d="M12 15 7 10l5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="{{ $baseBtn }} {{ $btnDefault }}">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                <path d="M12 15 7 10l5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    @endif

                    <span class="px-3 text-xs font-medium text-gray-700 dark:text-gray-300">
                        {{ $currentPage }} / {{ $lastPage }}
                    </span>

                    @if($hasMorePages)
                        <a href="{{ $paginator->nextPageUrl() }}" class="{{ $baseBtn }} {{ $btnDefault }}">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                <path d="m8 15 5-5-5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    @else
                        <span class="{{ $baseBtn }} {{ $btnDisabled }}">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                <path d="m8 15 5-5-5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    @endif
                </div>

            @elseif($variant === 'simple')
                <div class="flex items-center gap-1">
                    @if($onFirstPage)
                        <span class="{{ $baseBtn }} {{ $btnDisabled }} w-auto gap-1 px-3">Sebelumnya</span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                            class="{{ $baseBtn }} {{ $btnDefault }} w-auto gap-1 px-3">Sebelumnya</a>
                    @endif

                    @if($hasMorePages)
                        <a href="{{ $paginator->nextPageUrl() }}"
                            class="{{ $baseBtn }} {{ $btnDefault }} w-auto gap-1 px-3">Selanjutnya</a>
                    @else
                        <span class="{{ $baseBtn }} {{ $btnDisabled }} w-auto gap-1 px-3">Selanjutnya</span>
                    @endif
                </div>

            @else
                <div class="flex items-center gap-1">
                    @if($onFirstPage)
                        <span class="{{ $baseBtn }} {{ $btnDisabled }}">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                <path d="M12 15 7 10l5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="{{ $baseBtn }} {{ $btnDefault }}">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                <path d="M12 15 7 10l5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    @endif

                    @if($start > 1)
                        <a href="{{ $paginator->url(1) }}" class="{{ $baseBtn }} {{ $btnDefault }}">1</a>
                        @if($start > 2)
                            <span class="flex h-9 min-w-9 items-center justify-center text-sm text-gray-400 dark:text-gray-500">···</span>
                        @endif
                    @endif

                    @foreach($pages as $page)
                        @if($page == $currentPage)
                            <span class="{{ $baseBtn }} {{ $btnActive }}" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $paginator->url($page) }}" class="{{ $baseBtn }} {{ $btnDefault }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($end < $lastPage)
                        @if($end < $lastPage - 1)
                            <span class="flex h-9 min-w-9 items-center justify-center text-sm text-gray-400 dark:text-gray-500">···</span>
                        @endif
                        <a href="{{ $paginator->url($lastPage) }}" class="{{ $baseBtn }} {{ $btnDefault }}">{{ $lastPage }}</a>
                    @endif

                    @if($hasMorePages)
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="{{ $baseBtn }} {{ $btnDefault }}">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                <path d="m8 15 5-5-5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    @else
                        <span class="{{ $baseBtn }} {{ $btnDisabled }}">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                <path d="m8 15 5-5-5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    @endif
                </div>
            @endif

        @endif

    </div>
@endif