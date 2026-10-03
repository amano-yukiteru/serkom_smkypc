@props([
    'cols' => null,
])

@php
    $gridClass = $cols
        ? match((int) $cols) {
            1 => 'grid-cols-1',
            2 => 'grid-cols-1 sm:grid-cols-2',
            3 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
            4 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
            default => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
        }
        : '';
@endphp

@if($cols)
    <div {{ $attributes->merge(['class' => "grid gap-4 md:gap-5 $gridClass"]) }}>
        {{ $slot }}
    </div>
@else
    <div
        {{ $attributes->merge(['class' => 'grid gap-4 md:gap-5']) }}
        style="grid-template-columns: repeat(auto-fit, minmax(min(100%, 200px), 1fr));"
    >
        {{ $slot }}
    </div>
@endif