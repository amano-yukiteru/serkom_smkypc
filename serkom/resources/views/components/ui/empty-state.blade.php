@props([
    'title' => 'Belum ada data',
    'message' => 'Data akan muncul di sini setelah ditambahkan.',
    'icon' => 'default',       // default | search | file | user | error
    'actionLabel' => null,
    'actionHref' => null,
])

@php
    $icons = [
        'default' => '<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>',
        'search'  => '<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>',
        'file'    => '<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
        'user'    => '<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 5-6 8-6s6.5 2 8 6"/></svg>',
        'error'   => '<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16.5v.5"/></svg>',
    ];
    $iconSvg = $icons[$icon] ?? $icons['default'];
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center px-6 py-16 text-center']) }}>
    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
        {!! $iconSvg !!}
    </div>

    <h3 class="mt-5 text-base font-semibold text-gray-800 dark:text-white/90">
        {{ $title }}
    </h3>

    <p class="mt-1 max-w-sm text-sm text-gray-500 dark:text-gray-400">
        {{ $message }}
    </p>

    @if($actionLabel && $actionHref)
        <a href="{{ $actionHref }}"
           class="mt-6 inline-flex h-10 items-center gap-2 rounded-lg bg-indigo-500 px-4 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-600">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            {{ $actionLabel }}
        </a>
    @endif

    {{ $slot }}
</div>