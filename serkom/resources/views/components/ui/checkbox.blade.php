@props([
    'name',
    'label' => null,
    'checked' => false,
    'value' => '1',
    'disabled' => false,
])

@php
    $id = $name;
    $isChecked = old($name) !== null ? (bool) old($name) : (bool) $checked;
@endphp

<label
    for="{{ $id }}"
    @class([
        'inline-flex cursor-pointer select-none items-center gap-2.5 text-sm font-medium',
        'text-gray-300 dark:text-gray-600 cursor-not-allowed' => $disabled,
        'text-gray-700 dark:text-gray-400' => !$disabled,
        $attributes->get('class'),
    ])
>
    <input
        type="checkbox"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @checked($isChecked)
        @disabled($disabled)
        class="sr-only"
    />

    {{-- Kotak custom --}}
    <span @class([
        'flex h-5 w-5 shrink-0 items-center justify-center rounded-md border-[1.5px] transition-all duration-150',
        'border-indigo-500 bg-indigo-500' => $isChecked && !$disabled,
        'bg-transparent border-gray-300 hover:border-indigo-500 dark:border-gray-600 dark:hover:border-indigo-500' => !$isChecked && !$disabled,
        'bg-gray-100 dark:bg-gray-800 border-gray-200 dark:border-gray-700' => $disabled,
    ])>
        {{-- Ikon centang --}}
        <svg
            @class([
                'h-4 w-4 translate-y-px text-white transition-opacity duration-150',
                'opacity-100' => $isChecked && !$disabled,
                'opacity-0' => !$isChecked || $disabled,
            ])
            viewBox="0 0 14 14"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M11.6666 3.5L5.24992 9.91667L2.33325 7"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
    </span>

    @if($label){{ $label }}@endif
</label>