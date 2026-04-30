<x-layouts.app :page-title="'Aktivitas Saya'">
    <div class="p-6 md:p-10 lg:px-12 max-w-container-max mx-auto w-full flex-1 flex flex-col gap-6 overflow-y-auto"
        x-data="{
            activeTab: 'semua',
            activities: [
                { id: 1, type: 'like', icon: 'thumb_up', label: 'Anda mendukung kebijakan', title: 'RUU Sistem Kesehatan Nasional 2024', ministry: 'Kementerian Kesehatan', ministryIcon: 'local_hospital', time: '2 jam yang lalu', date: '30 Apr 2025', outcome: 'tinjauan', outcomeLabel: 'Dalam Tinjauan', url: '/kebijakan/ruu-kesehatan' },
                { id: 2, type: 'comment', icon: 'chat_bubble', label: 'Anda mengomentari kebijakan', title: 'RUU Perlindungan Data Pribadi (RUU PDP)', ministry: 'Kementerian Kominfo', ministryIcon: 'cell_tower', time: '5 jam yang lalu', date: '30 Apr 2025', outcome: 'disetujui', outcomeLabel: 'Disetujui', commentText: 'Pasal mengenai kewajiban korporasi melaporkan kebocoran data dalam 3x24 jam sangat krusial.', url: '/kebijakan/ruu-kesehatan' },
                { id: 3, type: 'dislike', icon: 'thumb_down', label: 'Anda menolak kebijakan', title: 'Revisi Kurikulum Merdeka Terpadu', ministry: 'Kementerian Pendidikan', ministryIcon: 'school', time: '1 hari yang lalu', date: '29 Apr 2025', outcome: 'revisi', outcomeLabel: 'Butuh Revisi', url: '/kebijakan/kurikulum-merdeka' },
                { id: 4, type: 'like', icon: 'thumb_up', label: 'Anda mendukung kebijakan', title: 'RUU Perampasan Aset Koruptor', ministry: 'Kementerian Hukum', ministryIcon: 'gavel', time: '2 hari yang lalu', date: '28 Apr 2025', outcome: 'disetujui', outcomeLabel: 'Disetujui', url: '#' },
                { id: 5, type: 'comment', icon: 'chat_bubble', label: 'Anda mengomentari kebijakan', title: 'Revisi UU Ketenagakerjaan Omnibus', ministry: 'Kementerian Ketenagakerjaan', ministryIcon: 'engineering', time: '3 hari yang lalu', date: '27 Apr 2025', outcome: 'tinjauan', outcomeLabel: 'Dalam Tinjauan', commentText: 'Perlu ada perlindungan lebih untuk pekerja gig economy di platform digital.', url: '#' },
                { id: 6, type: 'dislike', icon: 'thumb_down', label: 'Anda menolak kebijakan', title: 'RUU Penyiaran Digital', ministry: 'Kementerian Kominfo', ministryIcon: 'cell_tower', time: '4 hari yang lalu', date: '26 Apr 2025', outcome: 'revisi', outcomeLabel: 'Butuh Revisi', url: '#' },
                { id: 7, type: 'like', icon: 'thumb_up', label: 'Anda mendukung kebijakan', title: 'RUU Energi Terbarukan Nasional', ministry: 'Kementerian ESDM', ministryIcon: 'bolt', time: '5 hari yang lalu', date: '25 Apr 2025', outcome: 'tinjauan', outcomeLabel: 'Dalam Tinjauan', url: '#' },
                { id: 8, type: 'comment', icon: 'chat_bubble', label: 'Anda mengomentari kebijakan', title: 'Revisi UU Lalu Lintas dan Angkutan Jalan', ministry: 'Kementerian Perhubungan', ministryIcon: 'directions_car', time: '1 minggu yang lalu', date: '23 Apr 2025', outcome: 'disetujui', outcomeLabel: 'Disetujui', commentText: 'Aturan batas kecepatan baru sangat membantu keselamatan di jalan tol.', url: '#' }
            ],
            get filtered() {
                if (this.activeTab === 'semua') return this.activities;
                if (this.activeTab === 'disetujui') return this.activities.filter(a => a.outcome === 'disetujui');
                if (this.activeTab === 'revisi') return this.activities.filter(a => a.outcome === 'revisi');
                return this.activities.filter(a => a.type === this.activeTab);
            },
            get stats() {
                return {
                    like: this.activities.filter(a => a.type === 'like').length,
                    dislike: this.activities.filter(a => a.type === 'dislike').length,
                    comment: this.activities.filter(a => a.type === 'comment').length,
                    disetujui: this.activities.filter(a => a.outcome === 'disetujui').length,
                    revisi: this.activities.filter(a => a.outcome === 'revisi').length,
                };
            },
            typeColor(type) {
                return { like: 'text-[#2e7d32] bg-[#e8f5e9]', dislike: 'text-error bg-error-container', comment: 'text-primary bg-primary-fixed' }[type] || '';
            },
            outcomeColor(outcome) {
                return { disetujui: 'text-[#2e7d32] bg-[#e8f5e9] border-[#2e7d3233]', revisi: 'text-error bg-error-container border-error/30', tinjauan: 'text-surface-tint bg-[#465f881a] border-[#465f8833]' }[outcome] || '';
            }
        }">

        {{-- Header --}}
        <div class="mb-2">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 bg-primary-fixed rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary-container text-[28px]!" style="font-variation-settings: 'FILL' 1;">analytics</span>
                </div>
                <div>
                    <h1 class="font-h1 text-h1 text-on-background leading-tight">Aktivitas Saya</h1>
                </div>
            </div>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
                Riwayat interaksi Anda terhadap kebijakan publik — mendukung, menolak, komentar, dan status akhir kebijakan.
            </p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <div class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-[#2e7d32]">thumb_up</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Mendukung</span>
                </div>
                <span class="font-h2 text-h2 text-on-background" x-text="stats.like"></span>
            </div>
            <div class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-error">thumb_down</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Menolak</span>
                </div>
                <span class="font-h2 text-h2 text-on-background" x-text="stats.dislike"></span>
            </div>
            <div class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-primary">chat_bubble</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Komentar</span>
                </div>
                <span class="font-h2 text-h2 text-on-background" x-text="stats.comment"></span>
            </div>
            <div class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-[#2e7d32]">check_circle</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Disetujui</span>
                </div>
                <span class="font-h2 text-h2 text-on-background" x-text="stats.disetujui"></span>
            </div>
            <div class="bg-surface-container-lowest border border-surface-variant rounded-xl p-4 flex flex-col gap-2 group hover:shadow-md transition-all col-span-2 sm:col-span-1">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]! text-error">error</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Butuh Revisi</span>
                </div>
                <span class="font-h2 text-h2 text-on-background" x-text="stats.revisi"></span>
            </div>
        </div>

        {{-- Tab Filters --}}
        <div class="flex flex-wrap gap-2">
            <template x-for="tab in [
                {key:'semua', label:'Semua'},
                {key:'like', label:'Mendukung'},
                {key:'dislike', label:'Menolak'},
                {key:'comment', label:'Komentar'},
                {key:'disetujui', label:'Disetujui'},
                {key:'revisi', label:'Butuh Revisi'}
            ]" :key="tab.key">
                <button @click="activeTab = tab.key"
                    :class="activeTab === tab.key
                        ? 'bg-primary text-white border-primary shadow-sm'
                        : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container'"
                    class="px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200"
                    x-text="tab.label">
                </button>
            </template>
        </div>

        {{-- Activity Timeline --}}
        <div class="flex flex-col gap-4" x-show="filtered.length > 0">
            <template x-for="item in filtered" :key="item.id">
                <div class="animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700 ease-out bg-surface-container-lowest border border-surface-variant rounded-xl p-5 sm:p-6 flex gap-4 hover:shadow-[0_4px_12px_rgba(0,0,0,0.05)] group relative overflow-hidden">
                    {{-- Decorative blur --}}
                    <div class="absolute -top-10 -right-10 w-28 h-28 bg-primary-fixed-dim opacity-10 rounded-full blur-2xl group-hover:opacity-25 transition-opacity duration-500"></div>

                    {{-- Action icon --}}
                    <div class="shrink-0 w-11 h-11 rounded-full flex items-center justify-center z-10" :class="typeColor(item.type)">
                        <span class="material-symbols-outlined text-[22px]!" :style="item.type !== 'dislike' ? 'font-variation-settings: \'FILL\' 1;' : ''" x-text="item.icon"></span>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0 z-10">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-1">
                            <span class="font-label-sm text-label-sm text-on-surface-variant" x-text="item.label"></span>
                            <span class="font-label-sm text-label-sm text-outline flex items-center gap-1 shrink-0">
                                <span class="material-symbols-outlined text-[14px]!">schedule</span>
                                <span x-text="item.time"></span>
                            </span>
                        </div>

                        <a :href="item.url" class="block group/title">
                            <h3 class="font-h3 text-[18px] sm:text-[20px] font-semibold text-on-background group-hover/title:text-primary-container transition-colors line-clamp-1 mb-1" x-text="item.title"></h3>
                        </a>

                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="font-label-sm text-label-sm text-primary-container bg-primary-fixed-dim/20 px-2.5 py-0.5 rounded-full border border-primary-fixed-dim/30 inline-flex items-center gap-1">
                                <span class="material-symbols-outlined text-[13px]!" x-text="item.ministryIcon"></span>
                                <span x-text="item.ministry"></span>
                            </span>
                            <span class="font-label-sm text-label-sm font-semibold px-2.5 py-0.5 rounded-full border inline-flex items-center gap-1" :class="outcomeColor(item.outcome)">
                                <span class="material-symbols-outlined text-[13px]!" x-text="item.outcome === 'disetujui' ? 'check_circle' : (item.outcome === 'revisi' ? 'error' : 'pending')"></span>
                                <span x-text="item.outcomeLabel"></span>
                            </span>
                        </div>

                        {{-- Show comment text if comment type --}}
                        <div x-show="item.commentText" class="bg-surface-container border-l-4 border-primary-fixed-dim rounded-lg p-3 mt-2">
                            <p class="font-body-md text-[14px] text-on-surface-variant italic leading-relaxed line-clamp-2"><span x-text="item.commentText"></span></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Empty State --}}
        <div x-show="filtered.length === 0" x-transition.opacity.duration.300ms class="flex flex-col items-center justify-center py-20 gap-6">
            <div class="w-24 h-24 bg-surface-container rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-outline text-[48px]!">history</span>
            </div>
            <div class="text-center max-w-md">
                <h3 class="font-h3 text-h3 text-on-background mb-2">Belum ada aktivitas</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Mulai berpartisipasi dengan memberikan suara atau komentar pada kebijakan publik.</p>
            </div>
            <a href="{{ url('/kebijakan') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white font-label-bold rounded-full hover:bg-blue-700 transition-colors shadow-md group">
                <span class="material-symbols-outlined group-hover:-translate-x-0.5 transition-transform">policy</span>
                Jelajahi Kebijakan
            </a>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry, index) => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.remove('opacity-0', 'scale-95', 'translate-y-8');
                                entry.target.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                            }, index * 80);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { root: null, threshold: 0.1, rootMargin: '0px 0px -20px 0px' });

                const observeCards = () => {
                    document.querySelectorAll('.animate-on-scroll').forEach(el => {
                        if (el.classList.contains('opacity-0')) observer.observe(el);
                    });
                };
                observeCards();

                const container = document.querySelector('[x-data]');
                if (container) {
                    const mutObs = new MutationObserver(() => requestAnimationFrame(observeCards));
                    mutObs.observe(container, { childList: true, subtree: true });
                }
            });
        </script>
    @endpush
</x-layouts.app>
