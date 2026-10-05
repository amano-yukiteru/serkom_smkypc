@props([
    'name',
    'title' => null,
    'maxWidth' => 'md',
])

@php
    $maxWidthClass = [
        'sm'  => 'max-w-sm',
        'md'  => 'max-w-md',
        'lg'  => 'max-w-lg',
        'xl'  => 'max-w-xl',
        '2xl' => 'max-w-2xl',
    ][$maxWidth] ?? 'max-w-md';
@endphp

<div
    x-data="{ open: false }"
    @open-modal-{{ $name }}.window="open = true"
    @close-modal-{{ $name }}.window="open = false"
    @keydown.escape.window="open = false"
>
    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[999999] flex items-center justify-center p-4"
    >
        {{-- Overlay --}}
        <div
            x-show="open"
            x-transition.opacity
            @click="open = false"
            class="absolute inset-0 bg-black/50"
        ></div>

        {{-- Panel --}}
        <div
            x-show="open"
            x-transition
            class="relative w-full {{ $maxWidthClass }} rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800"
        >
            @if($title)
                <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">
                    {{ $title }}
                </h3>
            @endif

            <div class="text-sm text-gray-600 dark:text-gray-300">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="mt-6 flex justify-end gap-3">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>