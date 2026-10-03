@props([
    'variant' => 'gray',
    'style' => 'light',
    'size' => 'md',
    'startIcon' => null,
    'endIcon' => null,
])

@php
    // Base — tambah leading-none biar text benar-benar center
    $baseStyles = 'inline-flex items-center justify-center gap-1.5 rounded-full font-medium capitalize leading-none whitespace-nowrap';

    // Size — padding ditambah biar lebih lega
    $sizeStyles = [
        'sm' => 'px-2.5 py-1 text-[11px]',
        'md' => 'px-3 py-1.5 text-xs',
    ];
    $sizeClass = $sizeStyles[$size] ?? $sizeStyles['md'];

    // Variant map
    $variants = [
        'light' => [
            'gray'    => 'bg-gray-100 text-gray-600 dark:bg-white/5 dark:text-white/80',
            'primary' => 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400',
            'success' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400',
            'warning' => 'bg-amber-50 text-amber-600 dark:bg-amber-500/15 dark:text-amber-400',
            'danger'  => 'bg-red-50 text-red-600 dark:bg-red-500/15 dark:text-red-400',
            'info'    => 'bg-sky-50 text-sky-600 dark:bg-sky-500/15 dark:text-sky-400',
        ],
        'solid' => [
            'gray'    => 'bg-gray-500 text-white dark:bg-gray-600',
            'primary' => 'bg-indigo-500 text-white',
            'success' => 'bg-emerald-500 text-white',
            'warning' => 'bg-amber-500 text-white',
            'danger'  => 'bg-red-500 text-white',
            'info'    => 'bg-sky-500 text-white',
        ],
    ];

    $styleClass = $variants[$style] ?? $variants['light'];
    $colorClass = $styleClass[$variant] ?? $styleClass['gray'];

    $classes = trim("$baseStyles $sizeClass $colorClass");
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($startIcon)
        <span class="inline-flex shrink-0 items-center justify-center">{!! $startIcon !!}</span>
    @endif

    <span>{{ $slot }}</span>

    @if($endIcon)
        <span class="inline-flex shrink-0 items-center justify-center">{!! $endIcon !!}</span>
    @endif
</span>