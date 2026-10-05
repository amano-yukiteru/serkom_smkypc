@props([
    'name',
    'value',
    'label' => null,
    'checked' => false,
    'disabled' => false,
])

@php
    $id = $name . '-' . $value;
    $isChecked = old($name) !== null
        ? (string) old($name) === (string) $value
        : (bool) $checked;
@endphp

<label
    for="{{ $id }}"
    @class([
        'inline-flex cursor-pointer select-none items-center gap-3 text-sm font-medium',
        'text-gray-300 dark:text-gray-600 cursor-not-allowed' => $disabled,
        'text-gray-700 dark:text-gray-400' => !$disabled,
        $attributes->get('class'),
    ])
>
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="radio"
        value="{{ $value }}"
        @checked($isChecked)
        @disabled($disabled)
        class="sr-only"
    />

    {{-- Bulatan luar --}}
    <span @class([
        'relative flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-[1.25px] transition-all duration-150',
        'border-indigo-500 bg-indigo-500' => $isChecked && !$disabled,
        'bg-transparent border-gray-300 hover:border-indigo-500 dark:border-gray-700 dark:hover:border-indigo-500' => !$isChecked && !$disabled,
        'bg-gray-100 dark:bg-gray-800 border-gray-200 dark:border-gray-700' => $disabled,
    ])>
        {{-- Bulatan dalam — absolute center --}}
        <span @class([
            'absolute inset-0 m-auto h-2 w-2 rounded-full bg-white transition-opacity duration-150',
            'opacity-100' => $isChecked && !$disabled,
            'opacity-0' => !$isChecked || $disabled,
        ])></span>
    </span>

    @if($label){{ $label }}@endif
</label>