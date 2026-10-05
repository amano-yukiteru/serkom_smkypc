@props([
    'paginator',
])

@if($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $from = $paginator->firstItem();
        $to = $paginator->lastItem();
        $total = $paginator->total();

        $window = 2;
        $totalVisible = $window * 2 + 1;
        $start = max(1, min($currentPage - $window, $lastPage - $totalVisible + 1));
        if ($start < 1) $start = 1;
        $end = min($lastPage, $start + $totalVisible - 1);
        $pages = range($start, $end);

        $btnBase = 'flex h-8 min-w-8 select-none items-center justify-center rounded-md text-xs font-medium transition-colors';
        $btnDefault = 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700/50';
        $btnActive = 'bg-indigo-500 text-white shadow-sm';
        $btnDisabled = 'cursor-not-allowed text-gray-300 dark:text-gray-600';
    @endphp

    <div class="border-t border-gray-100 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-900/40">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            {{-- Info --}}
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Menampilkan
                <span class="font-medium text-gray-700 dark:text-gray-200">{{ $from }}–{{ $to }}</span>
                dari
                <span class="font-medium text-gray-700 dark:text-gray-200">{{ $total }}</span>
            </p>

            {{-- Navigasi --}}
            <div class="flex select-none items-center gap-1">
                {{-- Prev --}}
                @if($start <= 1)
                    <span class="{{ $btnBase }} {{ $btnDisabled }}">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none">
                            <path d="M12 15 7 10l5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->url($start - 1) }}" class="{{ $btnBase }} {{ $btnDefault }}">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none">
                            <path d="M12 15 7 10l5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                @endif

                {{-- Nomor --}}
                @foreach($pages as $page)
                    @if($page == $currentPage)
                        <span class="{{ $btnBase }} {{ $btnActive }}">{{ $page }}</span>
                    @else
                        <a href="{{ $paginator->url($page) }}" class="{{ $btnBase }} {{ $btnDefault }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($end >= $lastPage)
                    <span class="{{ $btnBase }} {{ $btnDisabled }}">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none">
                            <path d="m8 15 5-5-5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->url($end + 1) }}" class="{{ $btnBase }} {{ $btnDefault }}">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none">
                            <path d="m8 15 5-5-5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endif