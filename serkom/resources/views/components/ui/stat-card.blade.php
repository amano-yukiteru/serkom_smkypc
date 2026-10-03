@props([
    'label' => null,
    'value' => null,
    'icon' => null,
    'trend' => null,
    'trendLabel' => null,
    'color' => 'indigo',   // indigo | emerald | blue | amber | purple | rose | cyan | gray
    'size' => 'md',        // sm | md | lg
])

@php
    $isUp = $trend !== null && !str_starts_with(trim((string) $trend), '-');
    $isDown = $trend !== null && str_starts_with(trim((string) $trend), '-');

    // Warna — background icon + text + border accent
    $colorMap = [
        'indigo' => [
            'border'  => 'border-l-indigo-500',
            'icon_bg' => 'bg-indigo-50 dark:bg-indigo-500/15',
            'icon_tx' => 'text-indigo-600 dark:text-indigo-400',
        ],
        'emerald' => [
            'border'  => 'border-l-emerald-500',
            'icon_bg' => 'bg-emerald-50 dark:bg-emerald-500/15',
            'icon_tx' => 'text-emerald-600 dark:text-emerald-400',
        ],
        'blue' => [
            'border'  => 'border-l-blue-500',
            'icon_bg' => 'bg-blue-50 dark:bg-blue-500/15',
            'icon_tx' => 'text-blue-600 dark:text-blue-400',
        ],
        'amber' => [
            'border'  => 'border-l-amber-500',
            'icon_bg' => 'bg-amber-50 dark:bg-amber-500/15',
            'icon_tx' => 'text-amber-600 dark:text-amber-400',
        ],
        'purple' => [
            'border'  => 'border-l-purple-500',
            'icon_bg' => 'bg-purple-50 dark:bg-purple-500/15',
            'icon_tx' => 'text-purple-600 dark:text-purple-400',
        ],
        'rose' => [
            'border'  => 'border-l-rose-500',
            'icon_bg' => 'bg-rose-50 dark:bg-rose-500/15',
            'icon_tx' => 'text-rose-600 dark:text-rose-400',
        ],
        'cyan' => [
            'border'  => 'border-l-cyan-500',
            'icon_bg' => 'bg-cyan-50 dark:bg-cyan-500/15',
            'icon_tx' => 'text-cyan-600 dark:text-cyan-400',
        ],
        'gray' => [
            'border'  => 'border-l-gray-400',
            'icon_bg' => 'bg-gray-100 dark:bg-gray-700/50',
            'icon_tx' => 'text-gray-600 dark:text-gray-300',
        ],
    ];

    $c = $colorMap[$color] ?? $colorMap['indigo'];

    // Size — padding, font size, icon size
    $sizeMap = [
        'sm' => [
            'padding'    => 'p-3.5',
            'label'      => 'text-[11px]',
            'value'      => 'text-lg',
            'icon_box'   => 'h-9 w-9',
            'icon_svg'   => 'h-4 w-4',
            'trend_size' => 'text-[10px]',
        ],
        'md' => [
            'padding'    => 'p-5',
            'label'      => 'text-xs',
            'value'      => 'text-2xl',
            'icon_box'   => 'h-11 w-11',
            'icon_svg'   => 'h-5 w-5',
            'trend_size' => 'text-xs',
        ],
        'lg' => [
            'padding'    => 'p-8',
            'label'      => 'text-sm',
            'value'      => 'text-4xl',
            'icon_box'   => 'h-14 w-14',
            'icon_svg'   => 'h-6 w-6',
            'trend_size' => 'text-sm',
        ],
    ];

    $s = $sizeMap[$size] ?? $sizeMap['md'];
@endphp

<div {{ $attributes->merge([
    'class' => "rounded-xl border border-gray-200 border-l-4 {$c['border']} bg-white {$s['padding']} shadow-md border-gray-700 dark:bg-gray-800"
]) }}>

    <div class="flex items-center justify-between gap-3">

        {{-- KIRI: Label + Value + Trend --}}
        <div class="min-w-0 flex-1">

            @if($label)
                <p class="font-medium uppercase tracking-wider text-gray-600 dark:text-gray-500 {{ $s['label'] }}">
                    {{ $label }}
                </p>
            @endif

            @if($value !== null)
                <p class="mt-1 font-bold text-gray-800 dark:text-white {{ $s['value'] }}">
                    {{ $value }}
                </p>
            @endif

            @if($trend !== null || $trendLabel)
                <div class="mt-1.5 flex items-center gap-1.5">

                    @if($trend !== null)
                        <span @class([
                            'inline-flex items-center gap-0.5 rounded-full px-1.5 py-0.5 font-medium',
                            'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400' => $isUp,
                            'bg-red-50 text-red-600 dark:bg-red-500/15 dark:text-red-400' => $isDown,
                            $s['trend_size'],
                        ])>
                            @if($isUp)
                                <svg class="h-2.5 w-2.5" viewBox="0 0 12 12" fill="none">
                                    <path d="M6 10V2M6 2L2 6M6 2L10 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            @elseif($isDown)
                                <svg class="h-2.5 w-2.5" viewBox="0 0 12 12" fill="none">
                                    <path d="M6 2V10M6 10L2 6M6 10L10 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
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

        </div>

        {{-- KANAN: Icon --}}
        @if($icon)
            <div class="flex shrink-0 items-center justify-center rounded-xl {{ $s['icon_box'] }} {{ $c['icon_bg'] }} {{ $c['icon_tx'] }}">
                <div class="{{ $s['icon_svg'] }}">
                    {!! $icon !!}
                </div>
            </div>
        @endif

    </div>

    {{ $slot }}
</div>