<x-layouts.app :page-title="'Detail Kebijakan - RUU PDP'">
    <div class="p-6 md:p-10 lg:px-12 flex-1 overflow-y-auto">
        <div class="max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <div class="lg:col-span-8 flex flex-col gap-stack-lg">
                <section class="flex flex-col gap-stack-sm">
                    <div class="flex items-center gap-3 mb-2 flex-wrap">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-bold text-label-bold tracking-wide">
                            <span class="w-2 h-2 rounded-full bg-primary-container mr-2"></span>
                            RUU Dalam Pembahasan
                        </span>
                        <span class="font-label-sm text-label-sm text-outline flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]!">calendar_today</span>
                            12 Nov 2023
                        </span>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-1">
                        <h1 class="font-h1 text-2xl md:text-h1 text-on-background">RUU Perlindungan Data Pribadi (RUU
                            PDP)</h1>
                        <a href="#"
                            class="flex items-center gap-2 px-5 py-2.5 bg-error text-white rounded-lg hover:opacity-90 transition-opacity font-label-bold shadow-md whitespace-nowrap group shrink-0">
                            <span
                                class="material-symbols-outlined group-hover:-translate-y-0.5 transition-transform">download</span>
                            Unduh Draf PDF
                        </a>
                    </div>

                    <div class="flex flex-col gap-2 mt-4">
                        <div class="flex justify-between items-center">
                            <span class="font-label-sm text-on-background">Dukungan Publik</span>
                            <span class="font-label-sm text-primary-container font-semibold">65%</span>
                        </div>
                        <div class="w-full bg-surface-variant rounded-full h-3">
                            <div class="bg-primary-container h-3 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 flex-wrap mt-4">
                        <button
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-surface-variant text-on-background hover:bg-[#2e7d32] hover:text-white transition-colors font-label-sm group/btn">
                            <span
                                class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">thumb_up</span>
                            12.4k
                        </button>
                        <button
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-surface-variant text-on-background hover:bg-red-600 hover:text-white transition-colors font-label-sm group/btn">
                            <span
                                class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">thumb_down</span>
                            2.1k
                        </button>
                        <button
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-blue-600 hover:text-white transition-colors font-label-sm ml-auto group/btn">
                            <span
                                class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">chat_bubble_outline</span>
                            843 Diskusi
                        </button>
                    </div>

                    <div
                        class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm mt-4 animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700">
                        <h2 class="font-h3 text-h3 text-on-surface mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container">subject</span> Ringkasan
                            Eksekutif
                        </h2>
                        <p class="font-body-lg text-on-surface-variant leading-relaxed">
                            Rancangan Undang-Undang Perlindungan Data Pribadi (RUU PDP) bertujuan untuk menjamin hak
                            dasar warga negara terkait pelindungan diri dan data pribadi mereka. RUU ini krusial untuk
                            memberikan kepastian hukum dan keamanan di era digital bagi seluruh masyarakat Indonesia.
                        </p>
                    </div>
                </section>

                <section class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-cards.policy-point icon="shield_person" title="Hak Subjek Data"
                        description="Masyarakat berhak mengakses, memperbaiki, dan menghapus data pribadi mereka." />
                    <x-cards.policy-point icon="gavel" title="Sanksi Tegas"
                        description="Penerapan sanksi administratif hingga pidana bagi penyalahguna data." />
                </section>

                <section class="border-t border-outline-variant pt-stack-md" x-data="{ showPublic: false }">
                    <h2 class="font-h2 text-h2 text-on-surface mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">forum</span> Diskusi Kebijakan
                    </h2>

                    <div
                        class="bg-surface-container-lowest border border-outline-variant rounded-xl p-4 sm:p-6 mb-8 flex gap-4 shadow-sm">
                        <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=User' }}"
                            class="w-10 h-10 rounded-full hidden sm:block">
                        <div class="flex-1 flex flex-col gap-3">
                            <textarea
                                class="w-full bg-surface text-on-surface border border-outline-variant rounded-lg p-3 focus:ring-2 focus:ring-primary-fixed-dim outline-none resize-none transition-all"
                                placeholder="Tulis pendapat Anda..." rows="3"></textarea>
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                                <span class="text-xs text-outline">Posting publik menggunakan nama asli Anda.</span>
                                <button
                                    class="w-full sm:w-auto bg-primary text-white font-label-bold py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">Kirim</button>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-surface-variant pb-2 mb-4">
                        <h3
                            class="font-label-bold text-on-surface uppercase tracking-wider flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-primary-fixed-dim"
                                style="font-variation-settings: 'FILL' 1;">verified</span>
                            Pandangan Pakar
                        </h3>
                    </div>

                    <div class="flex flex-col gap-6 mb-6">
                        <x-cards.comment :is-expert="true" name="Dr. Budi Santoso, S.H., M.H." time="2 jam yang lalu"
                            avatar="https://lh3.googleusercontent.com/aida-public/AB6AXuBhVKHE3xZtcW3HogmuAZkTuPg4GOAuzBcNchchBv5aEY6rFWr0y1JSp7L_4zqBGpHBfVK3hvxhfDt9pNIaF5kfI60CsMNSrVOdjJTrRTw9e3-qAj--9kMp1doi40ZXeOMaFhXnVzrcbxyWbpGpbceO3wtZHPFQUDf2NbICyGmQbOLnLE1hC6h4p-Tdo1C9Pzjfw67nsUezV5LPPfKEE1so0bw2R3HxCKtnhyoxTxxApI3QfWV42HJOLxZdDTWky5tiiisoXhdBGQU">
                            Pasal mengenai kewajiban korporasi melaporkan kebocoran data dalam 3x24 jam sangat krusial.
                            Namun, apakah sanksi yang diberikan cukup memberikan efek jera?
                        </x-cards.comment>
                    </div>

                    <div class="flex items-center justify-center my-10 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-outline-variant"></div>
                        </div>
                        <button @click="showPublic = !showPublic"
                            class="relative bg-surface-container-lowest px-5 py-2.5 border border-outline-variant rounded-full text-sm font-label-bold text-primary hover:bg-surface-container-low transition-all shadow-sm active:scale-95 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]!">group</span>
                            <span
                                x-text="showPublic ? 'Sembunyikan Ruang Publik' : 'Lihat 843 pendapat dari ruang publik'"></span>
                            <span class="material-symbols-outlined text-[20px]! transition-transform duration-300"
                                :class="showPublic ? 'rotate-180' : ''">expand_more</span>
                        </button>
                    </div>

                    <div x-show="showPublic" x-transition.origin.top class="flex flex-col gap-6">
                        <x-cards.comment :is-expert="false" name="Siti Aminah" time="1 jam yang lalu"
                            avatar="https://lh3.googleusercontent.com/aida-public/AB6AXuBqg44TTwXA9RKBjRTq8vMjvvP6MAluFeuI1yx_w7AhwPAuhLTWoEk0nWrhYV45Zn3-xVIm4xi0p8Y6NtnOC0QKhYIpghN3y2gslodzaz4myot_SDQkITCjq4I_9qmSp-JykQqAF9Vwg3ZKObKwog8cHK5TL_zc38Zl5Zt396C4mtLCgIrSUYJLFqACVcsGtGecHbodTMJM0J_O25Es3UVnlJcg9c1NiqvNYZzFdFSY8yX8LfkBsaBN3Bn9UFPU_lEt8SwGI4Vewo4">
                            Setuju dengan Pakar. Denda seharusnya berdasarkan persentase pendapatan tahunan perusahaan
                            agar lebih adil.
                        </x-cards.comment>
                    </div>
                </section>
            </div>

            <aside class="lg:col-span-4 mt-8 lg:mt-0">
                <div
                    class="animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700 ease-out bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-[0_4px_12px_rgba(0,0,0,0.02)] sticky top-24">
                    <h3
                        class="font-label-bold text-label-bold text-on-surface uppercase tracking-wider mb-5 flex items-center gap-2 border-b border-outline-variant pb-3">
                        <span class="material-symbols-outlined text-outline">radar</span>
                        Kebijakan Dalam Pantauan
                    </h3>
                    <ul class="flex flex-col gap-4">
                        <x-cards.sidebar-policy-item title="RUU Perampasan Aset" status="Butuh Revisi"
                            status-class="bg-error-container text-on-error-container" />
                        <x-cards.sidebar-policy-item title="Revisi UU ITE" status="Disetujuui"
                            status-class="bg-[#e8f5e9] text-[#2e7d32]" />
                        <x-cards.sidebar-policy-item title="UU Kesehatan Baru" status="Evaluasi Publik"
                            status-class="bg-tertiary-fixed text-on-tertiary-fixed" />
                    </ul>
                    <button
                        class="w-full mt-6 py-2 border border-outline text-on-surface font-label-bold text-label-bold rounded hover:bg-surface-container-low transition-colors">
                        Lihat Semua
                    </button>
                </div>
            </aside>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.remove('opacity-0', 'scale-95', 'translate-y-8');
                            entry.target.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                        }
                    });
                }, {
                    threshold: 0.1
                });
                document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
            });
        </script>
    @endpush
</x-layouts.app>
