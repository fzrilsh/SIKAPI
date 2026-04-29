@props(['title', 'status', 'statusClass'])

<li class="group cursor-pointer">
    <a href="#" class="block">
        <div class="flex items-start justify-between gap-2 mb-1">
            <h4 class="font-label-bold text-label-bold text-primary-container group-hover:underline">
                {{ $title }}
            </h4>
            <span
                class="material-symbols-outlined text-outline text-[16px]! group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </div>
        <span
            class="inline-block px-2 py-0.5 {{ $statusClass }} font-label-sm text-[10px] rounded uppercase tracking-wide">
            {{ $status }}
        </span>
    </a>
</li>
<li class="border-t border-surface-variant last:hidden"></li>
