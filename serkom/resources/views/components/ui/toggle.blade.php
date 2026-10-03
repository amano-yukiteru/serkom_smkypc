@props([
    'name',
    'label' => null,
    'checked' => false,
    'disabled' => false,
    'value' => '1',
])

@php
    $isChecked = old($name) !== null ? (bool) old($name) : (bool) $checked;
@endphp

<label @class([
    'inline-flex cursor-pointer select-none items-center gap-2.5 text-sm font-medium',
    'cursor-not-allowed text-gray-400 dark:text-gray-600' => $disabled,
    'text-gray-700 dark:text-gray-400' => !$disabled,
])>
    <div
        class="relative inline-block h-6 w-11"
        x-data="{ on: {{ $isChecked ? 'true' : 'false' }} }"
    >
        <input
            type="checkbox"
            name="{{ $name }}"
            value="{{ $value }}"
            class="sr-only"
            @checked($isChecked)
            @disabled($disabled)
            x-on:change="on = !on"
        />

        {{-- Track --}}
        <div
            class="absolute inset-0 rounded-full transition-colors duration-200"
            :class="{
                'bg-brand-500': on && !{{ $disabled ? 'true' : 'false' }},
                'bg-gray-200 dark:bg-gray-700': !on && !{{ $disabled ? 'true' : 'false' }},
                'bg-gray-100 dark:bg-gray-800 opacity-50': {{ $disabled ? 'true' : 'false' }},
            }"
        ></div>

        {{-- Knob --}}
        <div
            class="absolute top-0.5 left-0.5 flex h-5 w-5 items-center justify-center rounded-full bg-white shadow-sm transition-transform duration-200"
            :class="on ? 'translate-x-5' : 'translate-x-0'"
        ></div>
    </div>

    @if($label){{ $label }}@endif
</label>