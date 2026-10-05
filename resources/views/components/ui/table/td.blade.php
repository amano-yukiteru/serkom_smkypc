@props([
    'last' => false,
    'align' => 'left',
    'fit' => false,
])

@php
    $alignClass = match($align) {
        'center' => 'text-center',
        'right'  => 'text-right',
        default  => 'text-left',
    };

    $fitClass = $fit ? 'w-px whitespace-nowrap' : '';
    $padding = $fit ? 'pl-2 pr-3 py-3' : 'px-5 py-4';
@endphp

<td {{ $attributes->merge([
    'class' => 'text-gray-700 dark:text-gray-300 ' . $alignClass . ' ' . $padding . ' ' . $fitClass
]) }}>
    {{ $slot }}
</td>