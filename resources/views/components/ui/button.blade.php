@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'disabled' => false,
])

@php
    // Base — TailAdmin pakai rounded-lg dan gap-2
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg font-medium transition disabled:cursor-not-allowed disabled:opacity-50 focus:outline-none';

    // Size — TailAdmin pakai padding lebih besar
    $sizes = [
        'sm' => 'px-4 py-2 text-xs',
        'md' => 'px-5 py-3 text-sm',
        'lg' => 'px-6 py-3.5 text-base',
    ];

    // Variant — mengikuti style TailAdmin
    $variants = [
        'primary'   => 'bg-indigo-500 text-white shadow-sm hover:bg-indigo-600 disabled:bg-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-500',
        'secondary' => 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600',
        'success'   => 'bg-emerald-500 text-white shadow-sm hover:bg-emerald-600 dark:bg-emerald-600 dark:hover:bg-emerald-500',
        'danger'    => 'bg-red-500 text-white shadow-sm hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-500',
        'outline'   => 'bg-white text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03] dark:hover:text-gray-300',
    ];

    $classes = $base . ' ' . ($sizes[$size] ?? $sizes['md']) . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @isset($icon){{ $icon }}@endisset
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" @disabled($disabled) {{ $attributes->merge(['class' => $classes]) }}>
        @isset($icon){{ $icon }}@endisset
        {{ $slot }}
    </button>
@endif
