@props(['icon', 'title', 'description'])

<div
    class="animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700 ease-out bg-surface-container-lowest border border-outline-variant rounded-xl p-6 hover:shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:border-surface-tint transition-all group">
    <div
        class="w-12 h-12 bg-secondary-container rounded-lg flex items-center justify-center text-on-secondary-container mb-4 group-hover:bg-primary-container group-hover:text-on-primary transition-colors">
        <span class="material-symbols-outlined !text-[24px]">{{ $icon }}</span>
    </div>
    <h3 class="font-label-bold text-label-bold text-on-surface mb-2">{{ $title }}</h3>
    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
        {{ $description }}
    </p>
</div>
