<x-layouts.app :page-title="'Kebijakan Tersimpan'">
    <div class="p-6 md:p-10 lg:px-12 max-w-container-max mx-auto w-full flex-1 flex flex-col gap-6 overflow-y-auto"
        x-data="{
            activeTab: 'semua',
            searchQuery: '',
            bookmarks: [
                {
                    id: 1,
                    title: 'RUU Sistem Kesehatan Nasional 2024',
                    description: 'Pembaruan komprehensif terhadap infrastruktur kesehatan publik, berfokus pada digitalisasi rekam medis dan pemerataan fasilitas layanan tingkat pertama di daerah tertinggal.',
                    ministry: 'Kementerian Kesehatan',
                    ministryIcon: 'local_hospital',
                    daysLeft: 14,
                    status: 'Dalam Tinjauan',
                    statusKey: 'tinjauan',
                    support: 65,
                    likes: '4.2k',
                    dislikes: '1.1k',
                    comments: '856',
                    saved: true,
                    url: '/kebijakan/ruu-kesehatan'
                },
                {
                    id: 2,
                    title: 'RUU Perlindungan Data Pribadi (RUU PDP)',
                    description: 'Menjamin hak dasar warga negara terkait pelindungan diri dan data pribadi mereka di era digital, termasuk kewajiban korporasi melaporkan kebocoran data.',
                    ministry: 'Kementerian Kominfo',
                    ministryIcon: 'cell_tower',
                    daysLeft: 21,
                    status: 'Dalam Tinjauan',
                    statusKey: 'tinjauan',
                    support: 78,
                    likes: '12.4k',
                    dislikes: '2.1k',
                    comments: '1.8k',
                    saved: true,
                    url: '/kebijakan/ruu-kesehatan'
                },
                {
                    id: 3,
                    title: 'Revisi Kurikulum Merdeka Terpadu',
                    description: 'Penyesuaian indikator pencapaian siswa berbasis proyek, integrasi kemampuan literasi digital sejak sekolah dasar, dan fleksibilitas jam mengajar bagi tenaga pendidik.',
                    ministry: 'Kementerian Pendidikan',
                    ministryIcon: 'school',
                    daysLeft: 5,
                    status: 'Pengumpulan Draft',
                    statusKey: 'draft',
                    support: 30,
                    likes: '8.9k',
                    dislikes: '432',
                    comments: '1.2k',
                    saved: true,
                    url: '/kebijakan/kurikulum-merdeka'
                },
                {
                    id: 4,
                    title: 'RUU Perampasan Aset Koruptor',
                    description: 'Regulasi baru untuk mempercepat proses perampasan aset hasil tindak pidana korupsi, termasuk aset yang diparkir di luar negeri melalui kerja sama internasional.',
                    ministry: 'Kementerian Hukum',
                    ministryIcon: 'gavel',
                    daysLeft: 0,
                    status: 'Disetujui',
                    statusKey: 'disetujui',
                    support: 92,
                    likes: '24.1k',
                    dislikes: '890',
                    comments: '3.4k',
                    saved: true,
                    url: '#'
                },
                {
                    id: 5,
                    title: 'Revisi UU Ketenagakerjaan Omnibus',
                    description: 'Penyempurnaan aturan outsourcing, upah minimum sektoral, dan jaminan perlindungan pekerja gig economy di platform digital.',
                    ministry: 'Kementerian Ketenagakerjaan',
                    ministryIcon: 'engineering',
                    daysLeft: 9,
                    status: 'Pengumpulan Draft',
                    statusKey: 'draft',
                    support: 45,
                    likes: '6.7k',
                    dislikes: '3.2k',
                    comments: '2.1k',
                    saved: true,
                    url: '#'
                }
            ],
            get filteredBookmarks() {
                return this.bookmarks.filter(b => {
                    const matchTab = this.activeTab === 'semua' || b.statusKey === this.activeTab;
                    const matchSearch = this.searchQuery === '' || b.title.toLowerCase().includes(this.searchQuery.toLowerCase()) || b.ministry.toLowerCase().includes(this.searchQuery.toLowerCase());
                    return matchTab && matchSearch && b.saved;
                });
            },
            removeBookmark(id) {
                const idx = this.bookmarks.findIndex(b => b.id === id);
                if (idx !== -1) this.bookmarks[idx].saved = false;
            },
            get counts() {
                const saved = this.bookmarks.filter(b => b.saved);
                return {
                    semua: saved.length,
                    tinjauan: saved.filter(b => b.statusKey === 'tinjauan').length,
                    draft: saved.filter(b => b.statusKey === 'draft').length,
                    disetujui: saved.filter(b => b.statusKey === 'disetujui').length,
                };
            }
        }">

        {{-- Header --}}
        <div class="mb-2">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 bg-primary-fixed rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary-container text-[28px]!"
                        style="font-variation-settings: 'FILL' 1;">bookmarks</span>
                </div>
                <div>
                    <h1 class="font-h1 text-h1 text-on-background leading-tight">Kebijakan Tersimpan</h1>
                </div>
            </div>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
                Kumpulan kebijakan yang Anda simpan untuk ditinjau dan diikuti perkembangannya.
                <span class="font-semibold text-on-background" x-text="counts.semua + ' kebijakan tersimpan'"></span>
            </p>
        </div>

        {{-- Filter Bar --}}
        <div
            class="flex flex-col sm:flex-row gap-4 bg-surface-container-lowest p-4 rounded-xl border border-surface-variant shadow-sm items-center">
            <div class="relative w-full sm:w-1/3">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input x-model="searchQuery"
                    class="w-full pl-10 pr-4 py-2.5 bg-surface-bright border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all"
                    placeholder="Cari kebijakan tersimpan..." type="text" />
            </div>

            <div class="flex flex-wrap gap-2 w-full sm:w-auto ml-auto">
                <button @click="activeTab = 'semua'"
                    :class="activeTab === 'semua'
                        ? 'bg-primary text-white border-primary shadow-sm'
                        : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container'"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200">
                    Semua
                    <span
                        class="text-xs bg-white/20 px-1.5 py-0.5 rounded-full"
                        :class="activeTab === 'semua' ? 'bg-white/20' : 'bg-surface-container'"
                        x-text="counts.semua"></span>
                </button>
                <button @click="activeTab = 'tinjauan'"
                    :class="activeTab === 'tinjauan'
                        ? 'bg-primary text-white border-primary shadow-sm'
                        : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container'"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200">
                    Dalam Tinjauan
                    <span
                        class="text-xs px-1.5 py-0.5 rounded-full"
                        :class="activeTab === 'tinjauan' ? 'bg-white/20' : 'bg-surface-container'"
                        x-text="counts.tinjauan"></span>
                </button>
                <button @click="activeTab = 'draft'"
                    :class="activeTab === 'draft'
                        ? 'bg-primary text-white border-primary shadow-sm'
                        : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container'"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200">
                    Pengumpulan Draft
                    <span
                        class="text-xs px-1.5 py-0.5 rounded-full"
                        :class="activeTab === 'draft' ? 'bg-white/20' : 'bg-surface-container'"
                        x-text="counts.draft"></span>
                </button>
                <button @click="activeTab = 'disetujui'"
                    :class="activeTab === 'disetujui'
                        ? 'bg-primary text-white border-primary shadow-sm'
                        : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container'"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200">
                    Disetujui
                    <span
                        class="text-xs px-1.5 py-0.5 rounded-full"
                        :class="activeTab === 'disetujui' ? 'bg-white/20' : 'bg-surface-container'"
                        x-text="counts.disetujui"></span>
                </button>
            </div>
        </div>

        {{-- Bookmarked Cards Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-stack-md"
            x-show="filteredBookmarks.length > 0">
            <template x-for="item in filteredBookmarks" :key="item.id">
                <article
                    class="animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700 ease-out bg-surface-container-lowest rounded-xl border border-surface-variant p-6 flex flex-col gap-4 hover:shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:shadow-primary/5 relative overflow-hidden group">

                    {{-- Decorative blur --}}
                    <div
                        class="absolute -top-10 -right-10 w-32 h-32 bg-primary-fixed-dim opacity-15 rounded-full blur-2xl group-hover:opacity-30 transition-opacity duration-500">
                    </div>

                    {{-- Top row: ministry + status --}}
                    <div class="flex justify-between items-start z-10">
                        <div class="flex flex-col gap-1">
                            <span
                                class="font-label-bold text-label-bold text-primary-container bg-primary-fixed-dim/20 px-3 py-1 rounded-full border border-primary-fixed-dim/30 w-fit inline-flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]!" x-text="item.ministryIcon"></span>
                                <span x-text="item.ministry"></span>
                            </span>
                            <span class="font-label-sm text-label-sm mt-1"
                                :class="item.daysLeft <= 5 && item.daysLeft > 0
                                    ? 'text-error font-semibold'
                                    : (item.daysLeft === 0 ? 'text-on-surface-variant' : 'text-on-background')">
                                <span x-show="item.daysLeft <= 5 && item.daysLeft > 0"
                                    class="material-symbols-outlined text-[14px]! align-middle mr-0.5">warning</span>
                                <span
                                    x-text="item.daysLeft > 0 ? 'Tersisa ' + item.daysLeft + ' hari untuk partisipasi' : 'Periode partisipasi selesai'"></span>
                            </span>
                        </div>
                        <span class="font-label-sm text-label-sm font-semibold px-3 py-1 rounded-full border shrink-0"
                            :class="{
                                'text-surface-tint bg-[#465f881a] border-[#465f8833]': item.statusKey === 'tinjauan',
                                'text-[#006874] bg-[#0068741a] border-[#00687433]': item.statusKey === 'draft',
                                'text-[#2e7d32] bg-[#e8f5e9] border-[#2e7d3233]': item.statusKey === 'disetujui'
                            }"
                            x-text="item.status"></span>
                    </div>

                    {{-- Title & description --}}
                    <div class="flex flex-col gap-2 z-10 cursor-pointer" :onclick="'window.location.href=\'' + item.url + '\''">
                        <h2 class="font-h3 text-h3 text-on-background line-clamp-2 group-hover:text-primary-container transition-colors"
                            x-text="item.title"></h2>
                        <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2" x-text="item.description">
                        </p>
                    </div>

                    {{-- Progress bar --}}
                    <div class="mt-auto pt-4 border-t border-surface-variant z-10">
                        <div class="flex justify-between items-end mb-2">
                            <span class="font-label-sm text-label-sm text-on-background">Dukungan Publik</span>
                            <span class="font-label-bold text-label-bold text-primary-container"
                                x-text="item.support + '%'"></span>
                        </div>
                        <div class="w-full bg-surface-variant rounded-full h-2 mb-4">
                            <div class="bg-primary-container h-2 rounded-full transition-all duration-500"
                                :style="'width: ' + item.support + '%'"></div>
                        </div>

                        {{-- Action buttons --}}
                        <div class="flex items-center gap-4 flex-wrap">
                            <button
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-surface-variant text-on-background hover:bg-[#2e7d32] hover:text-white transition-colors font-label-sm text-label-sm group/btn">
                                <span
                                    class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">thumb_up</span>
                                <span x-text="item.likes"></span>
                            </button>
                            <button
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-surface-variant text-on-background hover:bg-red-600 hover:text-white transition-colors font-label-sm text-label-sm group/btn">
                                <span
                                    class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">thumb_down</span>
                                <span x-text="item.dislikes"></span>
                            </button>
                            <button
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-[#2563EB] hover:text-white transition-colors font-label-sm text-label-sm group/btn">
                                <span
                                    class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">chat_bubble_outline</span>
                                <span x-text="item.comments + ' Diskusi'"></span>
                            </button>

                            <button @click="removeBookmark(item.id)"
                                class="ml-auto text-primary-container hover:text-error transition-colors group/bm relative"
                                title="Hapus dari bookmark">
                                <span class="material-symbols-outlined text-2xl"
                                    style="font-variation-settings: 'FILL' 1;">bookmark</span>
                                <span
                                    class="absolute -top-1 -right-1 w-4 h-4 bg-error text-white rounded-full text-[10px] font-bold flex items-center justify-center opacity-0 group-hover/bm:opacity-100 transition-opacity">✕</span>
                            </button>
                        </div>
                    </div>
                </article>
            </template>
        </div>

        {{-- Empty State --}}
        <div x-show="filteredBookmarks.length === 0" x-transition.opacity.duration.300ms
            class="flex flex-col items-center justify-center py-20 gap-6">
            <div
                class="w-24 h-24 bg-surface-container rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-outline text-[48px]!">bookmark_border</span>
            </div>
            <div class="text-center max-w-md">
                <h3 class="font-h3 text-h3 text-on-background mb-2"
                    x-text="searchQuery !== '' || activeTab !== 'semua'
                        ? 'Tidak ada hasil ditemukan'
                        : 'Belum ada kebijakan tersimpan'">
                </h3>
                <p class="font-body-md text-body-md text-on-surface-variant"
                    x-text="searchQuery !== '' || activeTab !== 'semua'
                        ? 'Coba ubah kata kunci pencarian atau filter kategori Anda.'
                        : 'Simpan kebijakan yang menarik perhatian Anda dengan menekan ikon bookmark di setiap kartu kebijakan.'">
                </p>
            </div>
            <a href="{{ url('/kebijakan') }}"
                x-show="searchQuery === '' && activeTab === 'semua'"
                class="flex items-center gap-2 px-6 py-3 bg-primary text-white font-label-bold rounded-full hover:bg-blue-700 transition-colors shadow-md group">
                <span class="material-symbols-outlined group-hover:-translate-x-0.5 transition-transform">policy</span>
                Jelajahi Kebijakan
            </a>
            <button x-show="searchQuery !== '' || activeTab !== 'semua'"
                @click="searchQuery = ''; activeTab = 'semua'"
                class="flex items-center gap-2 px-6 py-3 bg-surface-container text-on-surface font-label-bold rounded-full hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined">restart_alt</span>
                Reset Filter
            </button>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry, index) => {
                        if (entry.isIntersecting) {
                            // Staggered animation delay
                            setTimeout(() => {
                                entry.target.classList.remove('opacity-0', 'scale-95', 'translate-y-8');
                                entry.target.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                            }, index * 100);
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.1,
                    rootMargin: '0px 0px -20px 0px'
                });

                // Initial observe + re-observe on Alpine DOM updates
                const observeCards = () => {
                    document.querySelectorAll('.animate-on-scroll').forEach(el => {
                        if (el.classList.contains('opacity-0')) {
                            observer.observe(el);
                        }
                    });
                };

                observeCards();

                // MutationObserver to handle Alpine template re-renders
                const container = document.querySelector('[x-data]');
                if (container) {
                    const mutObs = new MutationObserver(() => {
                        requestAnimationFrame(observeCards);
                    });
                    mutObs.observe(container, { childList: true, subtree: true });
                }
            });
        </script>
    @endpush
</x-layouts.app>
