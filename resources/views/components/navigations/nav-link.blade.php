@props(['active' => false, 'icon' => null])

@php
    $classes = $active
        ? 'group flex items-center gap-4 text-on-background hover:bg-surface-container px-4 py-3 rounded-full transition-all duration-200 w-fit relative'
        : 'group flex items-center gap-4 text-on-surface hover:bg-surface-container px-4 py-3 rounded-full transition-all duration-200 w-fit relative';

    $textClasses = $active ? 'text-[19px] font-bold' : 'text-[19px] font-medium';

    $iconStyle = $active ? "font-variation-settings: 'FILL' 1;" : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
        <span class="material-symbols-outlined text-[28px]!" style="{{ $iconStyle }}">{{ $icon }}</span>
    @endif

    <span class="{{ $textClasses }}">{{ $slot }}</span>

    @if (isset($append))
        {{ $append }}
    @endif
</a>
