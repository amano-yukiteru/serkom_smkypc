@props([
    'padding' => true,
])

<div {{ $attributes->merge([
    'class' => 'rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]'
]) }}>
    @if($padding)
        <div class="p-5 sm:p-6">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</div>