@props([
    'items' => [],
])

@if(count($items))
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex flex-wrap items-center gap-1 text-lg">
            {{-- Home icon --}}
            <li class="inline-flex items-center">
                <a href="{{ url('/dashboard') }}"
                   class="flex items-center gap-1 text-gray-500 transition hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">
                    {{-- <svg class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="none">
                        <path d="M3 8l7-5 7 5v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"
                              stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 18v-5h4v5"
                              stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> --}}
                    <i class="fa-solid fa-house text-lg"></i>

                    <span class="hidden sm:inline">Dashboard</span>
                </a>
            </li>

            @foreach($items as $index => $item)
                @php $isLast = $index === count($items) - 1; @endphp

                <li class="inline-flex items-center gap-1">
                    {{-- Separator --}}
                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-600" viewBox="0 0 20 20" fill="none">
                        <path d="m8 15 5-5-5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    @if($isLast || empty($item['url']))
                        <span class="font-medium text-gray-800 dark:text-white/90" aria-current="page">
                            {{ $item['label'] }}
                        </span>
                    @else
                        <a href="{{ $item['url'] }}"
                           class="text-gray-500 transition hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">
                            {{ $item['label'] }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif