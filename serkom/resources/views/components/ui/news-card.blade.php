@props([
    'image' => null,
    'video' => null,
    'title' => null,
    'excerpt' => null,
    'date' => null,
    'author' => null,
    'editHref' => null,
    'deleteModal' => null,
])

<div {{ $attributes->merge([
    'class' => 'flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800'
]) }}>

    {{-- Media --}}
    <div class="p-3 pb-0">
        <div class="relative aspect-[16/10] w-full overflow-hidden rounded-sm bg-gray-100 dark:bg-gray-700">

            {{-- Video --}}
            @if($video)
                <video src="{{ $video }}" class="h-full w-full object-cover" muted preload="metadata"></video>
                <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white/90">
                        <svg class="h-5 w-5 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>

            {{-- Image --}}
            @elseif($image)
                <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover">

            {{-- Fallback --}}
            @else
                <div class="flex h-full w-full items-center justify-center text-gray-300 dark:text-gray-600">
                    <svg class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Z" />
                    </svg>
                </div>
            @endif

            {{-- Date badge --}}
            @if($date)
                <div class="absolute left-2.5 top-2.5 inline-flex items-center gap-1.5 rounded-full bg-white/95 px-2.5 py-1 text-[11px] font-semibold text-gray-700 shadow-sm backdrop-blur-sm dark:bg-gray-900/90 dark:text-gray-200">
                    <svg class="h-3 w-3 text-[#1E90D6]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    {{ $date }}
                </div>
            @endif
        </div>
    </div>

    {{-- Body --}}
    <div class="flex flex-1 flex-col p-4">

        @if($title)
            <h3 class="line-clamp-2 text-base font-semibold leading-snug text-gray-800 dark:text-white/90">
                {{ $title }}
            </h3>
        @endif

        @if($excerpt)
            <p class="mt-1.5 line-clamp-3 flex-1 text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                {{ $excerpt }}
            </p>
        @endif

        <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-3 dark:border-gray-700">

            {{-- Author --}}
            @if($author)
                <div class="flex min-w-0 items-center gap-2">
                    {{-- <div class="flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 text-[10px] font-bold text-white"> --}}
                        {{-- {{ strtoupper(substr($author, 0, 1)) }} --}}
                    {{-- </div> --}}
                    <span class="truncate text-xs font-medium text-gray-600 dark:text-gray-400">
                        <strong class="fw-bold">Pembina</strong> : {{ $author }}
                    </span>
                </div>
            @else
                <div></div>
            @endif

            {{-- Actions --}}
            <div class="flex shrink-0 items-center gap-1">
                @if($editHref)
                    <a href="{{ $editHref }}" title="Edit"
                       class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 dark:bg-amber-500/10 dark:text-amber-400 dark:hover:bg-amber-500/20">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.06 2.06 0 0 1 2.914 2.914L8.5 18.677l-4 1 1-4Z" />
                        </svg>
                    </a>
                @endif

                @if($deleteModal)
                    <button type="button"
                        @click="$dispatch('open-modal-{{ $deleteModal }}')"
                        title="Hapus"
                        class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 7h12M9.5 7V5.5A1.5 1.5 0 0 1 11 4h2a1.5 1.5 0 0 1 1.5 1.5V7m1.5 0-.6 12.1a2 2 0 0 1-2 1.9H9.6a2 2 0 0 1-2-1.9L7 7" />
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>