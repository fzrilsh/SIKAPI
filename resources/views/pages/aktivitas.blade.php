<x-layouts.app :page-title="'Aktivitas Saya'">
    <div class="p-6 md:p-10 lg:px-12 max-w-container-max mx-auto w-full flex-1 flex flex-col gap-6 overflow-y-auto">
        <div class="mb-2">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 bg-primary-fixed rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary-container text-[28px]!"
                        style="font-variation-settings: 'FILL' 1;">analytics</span>
                </div>
                <div>
                    <h1 class="font-h1 text-h1 text-on-background leading-tight">Aktivitas Saya</h1>
                </div>
            </div>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
                Riwayat interaksi Anda terhadap kebijakan publik — mendukung, menolak, komentar, dan status akhir
                kebijakan.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <div
                class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-[#2e7d32]">thumb_up</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Mendukung</span>
                </div>
                <span class="font-h2 text-h2 text-on-background">{{ $stats['like'] }}</span>
            </div>
            <div
                class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-error">thumb_down</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Menolak</span>
                </div>
                <span class="font-h2 text-h2 text-on-background">{{ $stats['dislike'] }}</span>
            </div>
            <div
                class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-primary">chat_bubble</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Komentar</span>
                </div>
                <span class="font-h2 text-h2 text-on-background">{{ $stats['comment'] }}</span>
            </div>
            <div
                class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-[#2e7d32]">check_circle</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Disetujui</span>
                </div>
                <span class="font-h2 text-h2 text-on-background">{{ $stats['disetujui'] }}</span>
            </div>
            <div
                class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all col-span-2 sm:col-span-1">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-error">error</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Butuh Revisi</span>
                </div>
                <span class="font-h2 text-h2 text-on-background">{{ $stats['revisi'] }}</span>
            </div>
        </div>

        <form method="GET" action="{{ route('user.activities') }}" class="flex flex-wrap gap-2">
            @php
                $tabs = [
                    'semua' => 'Semua',
                    'like' => 'Mendukung',
                    'dislike' => 'Menolak',
                    'comment' => 'Komentar',
                    'disetujui' => 'Disetujui',
                    'revisi' => 'Butuh Revisi',
                ];
            @endphp

            @foreach ($tabs as $key => $label)
                <button type="submit" name="tab" value="{{ $key }}"
                    class="px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200
                    {{ $activeTab === $key ? 'bg-primary text-white border-primary shadow-sm' : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container' }}">
                    {{ $label }}
                </button>
            @endforeach
        </form>

        <div class="flex flex-col gap-4">
            @forelse ($paginatedActivities as $item)
                @php
                    $typeColor = match ($item->type) {
                        'like' => 'text-[#2e7d32] bg-[#e8f5e9]',
                        'dislike' => 'text-error bg-error-container',
                        'comment' => 'text-primary bg-primary-fixed',
                        default => '',
                    };

                    $isApproved = $item->outcome === 'approved';
                    $isRevision = $item->outcome === 'needs_revision';

                    $outcomeColor = $isApproved
                        ? 'text-[#2e7d32] bg-[#e8f5e9] border-[#2e7d3233]'
                        : ($isRevision
                            ? 'text-error bg-error-container border-error/30'
                            : 'text-surface-tint bg-[#465f881a] border-[#465f8833]');

                    $outcomeIcon = $isApproved ? 'check_circle' : ($isRevision ? 'error' : 'pending');

                    $outcomeLabel = $isApproved ? 'Disetujui' : ($isRevision ? 'Butuh Revisi' : 'Dalam Tinjauan');
                @endphp

                <div
                    class="animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700 ease-out bg-surface-container-lowest border border-surface-variant rounded-xl p-5 sm:p-6 flex gap-4 hover:shadow-[0_4px_12px_rgba(0,0,0,0.05)] group relative overflow-hidden">
                    <div
                        class="absolute -top-10 -right-10 w-28 h-28 bg-primary-fixed-dim opacity-10 rounded-full blur-2xl group-hover:opacity-25 transition-opacity duration-500 pointer-events-none">
                    </div>

                    <div
                        class="shrink-0 w-11 h-11 rounded-full flex items-center justify-center z-10 {{ $typeColor }}">
                        <span class="material-symbols-outlined text-[22px]!"
                            style="{{ $item->type !== 'dislike' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">{{ $item->icon }}</span>
                    </div>

                    <div class="flex-1 min-w-0 z-10">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-1">
                            <span
                                class="font-label-sm text-label-sm text-on-surface-variant">{{ $item->label }}</span>
                            <span class="font-label-sm text-label-sm text-outline flex items-center gap-1 shrink-0">
                                <span class="material-symbols-outlined text-[14px]!">schedule</span>
                                <span>{{ $item->time }}</span>
                            </span>
                        </div>

                        <a href="{{ $item->url }}" class="block group/title">
                            <h3
                                class="font-h3 text-[18px] sm:text-[20px] font-semibold text-on-background group-hover/title:text-primary-container transition-colors line-clamp-1 mb-1">
                                {{ $item->title }}</h3>
                        </a>

                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span
                                class="font-label-sm text-label-sm text-primary-container bg-primary-fixed-dim/20 px-2.5 py-1 rounded-full border border-primary-fixed-dim/30 inline-flex items-center gap-1.5">
                                @if ($item->ministryIcon)
                                    <img src="{{ asset('storage/' . $item->ministryIcon) }}"
                                        class="w-3.5 h-3.5 rounded-full object-cover">
                                @endif
                                <span>{{ $item->ministry }}</span>
                            </span>

                            <span
                                class="font-label-sm text-label-sm font-semibold px-2.5 py-0.5 rounded-full border inline-flex items-center gap-1 {{ $outcomeColor }}">
                                <span class="material-symbols-outlined text-[13px]!">{{ $outcomeIcon }}</span>
                                <span>{{ $outcomeLabel }}</span>
                            </span>
                        </div>

                        @if ($item->commentText)
                            <div class="bg-surface-container border-l-4 border-primary-fixed-dim rounded-lg p-3 mt-2">
                                <p
                                    class="font-body-md text-[14px] text-on-surface-variant italic leading-relaxed line-clamp-2">
                                    <span>{{ $item->commentText }}</span></p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-20 gap-6">
                    <div class="w-24 h-24 bg-surface-container rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-outline text-[48px]!">history</span>
                    </div>
                    <div class="text-center max-w-md">
                        <h3 class="font-h3 text-h3 text-on-background mb-2">Belum ada aktivitas</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Mulai berpartisipasi dengan
                            memberikan suara atau komentar pada kebijakan publik.</p>
                    </div>
                    <a href="{{ route('policies.index') }}"
                        class="flex items-center gap-2 px-6 py-3 bg-primary text-white font-label-bold rounded-full hover:bg-blue-700 transition-colors shadow-md group">
                        <span
                            class="material-symbols-outlined group-hover:-translate-x-0.5 transition-transform">policy</span>
                        Jelajahi Kebijakan
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $paginatedActivities->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry, index) => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.remove('opacity-0', 'scale-95',
                                    'translate-y-8');
                                entry.target.classList.add('opacity-100', 'scale-100',
                                    'translate-y-0');
                            }, index * 80);
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.1,
                    rootMargin: '0px 0px -20px 0px'
                });

                document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
            });
        </script>
    @endpush
</x-layouts.app>
