@props(['isExpert' => false, 'name', 'time', 'avatar'])

<div class="flex gap-3 sm:gap-4">
    <img src="{{ $avatar }}" alt="{{ $name }}"
        class="w-10 h-10 rounded-full border border-outline-variant flex-shrink-0">
    <div class="flex-1">
        <div
            class="{{ $isExpert ? 'bg-surface-container-lowest' : 'bg-surface-container-low' }} border border-outline-variant rounded-xl p-4 shadow-sm">
            <div class="flex items-center gap-2 mb-1">
                <span class="font-label-bold text-label-bold text-on-surface">{{ $name }}</span>
                @if ($isExpert)
                    <span class="material-symbols-outlined text-primary-fixed-dim text-[16px]!"
                        style="font-variation-settings: 'FILL' 1;">verified</span>
                @endif
                <span class="font-label-sm text-label-sm text-outline ml-auto">{{ $time }}</span>
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant mb-3 leading-relaxed">
                {{ $slot }}
            </p>
            <div class="flex items-center gap-4">
                <button
                    class="flex items-center gap-1 px-2 py-1 rounded font-label-sm text-on-background hover:bg-[#2e7d32] hover:text-white transition-colors group/btn">
                    <span class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">thumb_up</span>
                    124
                </button>
                <button
                    class="flex items-center gap-1 px-2 py-1 rounded font-label-sm text-on-background hover:bg-red-600 hover:text-white transition-colors group/btn">
                    <span class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">thumb_down</span>
                    3
                </button>
                @if ($isExpert)
                    <button
                        class="flex items-center gap-1 font-label-sm text-on-background hover:text-primary transition-colors ml-2">
                        <span class="material-symbols-outlined text-[18px]!">reply</span> Balas
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
