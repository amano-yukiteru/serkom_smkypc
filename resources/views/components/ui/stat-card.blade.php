@props([
    'label' => null,
    'value' => null,
    'icon' => null,
    'trend' => null,
    'trendLabel' => null,
    'color' => 'gray',   // indigo | emerald | blue | amber | purple | rose | cyan | gray
    'size' => 'md',      // sm | md | lg
])

@php
    $isUp = $trend !== null && !str_starts_with(trim((string) $trend), '-');
    $isDown = $trend !== null && str_starts_with(trim((string) $trend), '-');

    // Warna — HANYA untuk icon & trend (subtle, bukan background besar)
    $colorMap = [
        'indigo'  => ['icon' => 'text-indigo-500 dark:text-indigo-400'],
        'emerald' => ['icon' => 'text-emerald-500 dark:text-emerald-400'],
        'blue'    => ['icon' => 'text-blue-500 dark:text-blue-400'],
        'amber'   => ['icon' => 'text-amber-500 dark:text-amber-400'],
        'purple'  => ['icon' => 'text-purple-500 dark:text-purple-400'],
        'rose'    => ['icon' => 'text-rose-500 dark:text-rose-400'],
        'cyan'    => ['icon' => 'text-cyan-500 dark:text-cyan-400'],
        'gray'    => ['icon' => 'text-gray-400 dark:text-gray-500'],
    ];

    $c = $colorMap[$color] ?? $colorMap['gray'];

    // Size
    $sizeMap = [
        'sm' => [
            'padding'    => 'px-4 py-3.5',
            'label'      => 'text-[11px]',
            'value'      => 'text-xl',
            'icon_svg'   => 'h-4 w-4',
            'trend_size' => 'text-[10px]',
        ],
        'md' => [
            'padding'    => 'px-5 py-5',
            'label'      => 'text-xs',
            'value'      => 'text-2xl',
            'icon_svg'   => 'h-5 w-5',
            'trend_size' => 'text-xs',
        ],
        'lg' => [
            'padding'    => 'px-7 py-7',
            'label'      => 'text-sm',
            'value'      => 'text-4xl',
            'icon_svg'   => 'h-6 w-6',
            'trend_size' => 'text-sm',
        ],
    ];

    $s = $sizeMap[$size] ?? $sizeMap['md'];
@endphp

<div {{ $attributes->merge([
    'class' => "rounded-lg border border-gray-200 bg-white {$s['padding']}
                transition-colors duration-200
                hover:border-gray-300
                dark:bg-gray-900 dark:border-gray-800 dark:hover:border-gray-700"
]) }}>

    {{-- Header: Label + Icon --}}
    <div class="flex items-start justify-between gap-3">

        @if($label)
            <p class="font-normal text-gray-500 dark:text-gray-400 {{ $s['label'] }}">
                {{ $label }}
            </p>
        @endif

        @if($icon)
            <div class="shrink-0 {{ $c['icon'] }} {{ $s['icon_svg'] }}">
                {!! $icon !!}
            </div>
        @endif

    </div>

    {{-- Value --}}
    @if($value !== null)
        <p class="mt-2 font-semibold text-gray-900 dark:text-white tracking-tight {{ $s['value'] }}">
            {{ $value }}
        </p>
    @endif

    {{-- Trend --}}
    @if($trend !== null || $trendLabel)
        <div class="mt-1.5 flex items-center gap-2">

            @if($trend !== null)
                <span @class([
                    'inline-flex items-center gap-0.5 font-medium',
                    'text-emerald-600 dark:text-emerald-400' => $isUp,
                    'text-rose-600 dark:text-rose-400'       => $isDown,
                    'text-gray-500 dark:text-gray-400'       => !$isUp && !$isDown,
                    $s['trend_size'],
                ])>
                    @if($isUp)
                        <svg class="h-3 w-3" viewBox="0 0 12 12" fill="none">
                            <path d="M6 10V2M6 2L2 6M6 2L10 6" stroke="currentColor" stroke-width="1.8"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @elseif($isDown)
                        <svg class="h-3 w-3" viewBox="0 0 12 12" fill="none">
                            <path d="M6 2V10M6 10L2 6M6 10L10 6" stroke="currentColor" stroke-width="1.8"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @endif
                    {{ $trend }}%
                </span>
            @endif

            @if($trendLabel)
                <span class="truncate text-gray-400 dark:text-gray-500 {{ $s['trend_size'] }}">
                    {{ $trendLabel }}
                </span>
            @endif

        </div>
    @endif

    {{ $slot }}
</div>