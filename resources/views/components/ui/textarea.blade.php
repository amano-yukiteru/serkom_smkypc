@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'rows' => 4,
    'hint' => null,
    'resize' => 'none',   // none | vertical | horizontal | both
])

@php
    $hasError = $errors->has($name);

    // Map resize
    $resizeClass = [
        'none'       => 'resize-none',
        'vertical'   => 'resize-y',
        'horizontal' => 'resize-x',
        'both'       => 'resize',
    ][$resize] ?? 'resize-none';

    // Base
    $baseClass = 'w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800
                  placeholder:text-gray-400 shadow-theme-xs outline-hidden transition
                  focus:ring-3 ' . $resizeClass . '
                  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30';

    // Border & focus
    $borderClass = $hasError
        ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10 dark:border-red-500 dark:focus:border-red-500'
        : 'border-gray-300 focus:border-indigo-300 focus:ring-indigo-500/10 dark:border-gray-700 dark:focus:border-indigo-800';
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        {{ $attributes->merge(['class' => "$baseClass $borderClass"]) }}
    >{{ old($name, $value) }}</textarea>

    @if($hint && !$hasError)
        <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-500">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>