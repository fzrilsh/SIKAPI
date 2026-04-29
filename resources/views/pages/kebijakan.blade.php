<x-layouts.app page-title="Daftar Kebijakan">
    <div class="p-6 md:p-10 lg:px-12 max-w-container-max mx-auto w-full flex-1 flex flex-col gap-6 overflow-y-auto">
        <div class="mb-2">
            <h1 class="font-h1 text-h1 text-on-background mb-4">Daftar Kebijakan Menunggu Pengesahan</h1>
            <p class="font-body-lg text-body-lg text-on-background max-w-3xl">
                Tinjau, diskusikan, dan berikan suara Anda pada rancangan kebijakan publik yang sedang dalam tahap akhir
                sebelum diresmikan.
            </p>
        </div>

        <div
            class="flex flex-col sm:flex-row gap-4 mb-4 bg-surface-container-lowest p-4 rounded-xl border border-surface-variant shadow-sm items-center">
            <div class="relative w-full sm:w-1/3">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input
                    class="w-full pl-10 pr-4 py-2.5 bg-surface-bright border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all"
                    placeholder="Cari rancangan kebijakan..." type="text" />
            </div>

            <div class="flex flex-wrap gap-4 w-full sm:w-auto ml-auto">
                <div class="relative group w-full sm:w-auto">
                    <button
                        class="w-full sm:w-auto flex items-center justify-between gap-2 px-4 py-2.5 bg-surface-bright border border-outline-variant rounded-lg font-label-bold text-label-bold text-on-surface hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-[20px]!">filter_list</span>
                        Kementerian
                        <span class="material-symbols-outlined text-[20px]!">expand_more</span>
                    </button>
                </div>
                <div class="relative group w-full sm:w-auto">
                    <button
                        class="w-full sm:w-auto flex items-center justify-between gap-2 px-4 py-2.5 bg-surface-bright border border-outline-variant rounded-lg font-label-bold text-label-bold text-on-surface hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-[20px]!">sort</span>
                        Terbaru
                        <span class="material-symbols-outlined text-[20px]!">expand_more</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-stack-md">

            <article
                class="animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700 ease-out bg-surface-container-lowest rounded-xl border border-surface-variant p-6 flex flex-col gap-4 hover:shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:shadow-primary/5">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex flex-col gap-1">
                        <span
                            class="font-label-bold text-label-bold text-primary-container bg-primary-fixed-dim/20 px-3 py-1 rounded-full border border-primary-fixed-dim/30 w-fit inline-flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]!">local_hospital</span> Kemenkes RI
                        </span>
                        <span class="font-label-sm text-label-sm text-on-background mt-1">Tersisa 14 hari untuk
                            partisipasi</span>
                    </div>
                    <button class="text-outline hover:text-primary-container transition-colors">
                        <span class="material-symbols-outlined">bookmark_border</span>
                    </button>
                </div>

                <div class="cursor-pointer group"
                    onclick="window.location.href='{{ url('/kebijakan/ruu-kesehatan') }}'">
                    <h2
                        class="font-h3 text-h3 text-on-background mb-2 group-hover:text-primary-container transition-colors">
                        RUU Ketahanan Kesehatan Nasional
                    </h2>
                    <p class="font-body-md text-body-md text-on-background line-clamp-2">Pembaruan sistem respon medis
                        darurat dan alokasi dana darurat pandemi tingkat provinsi.</p>
                </div>

                <div class="mt-auto pt-4 border-t border-surface-variant">
                    <div class="flex justify-between items-end mb-2">
                        <span class="font-label-sm text-label-sm text-on-background">Dukungan Publik</span>
                        <span class="font-label-bold text-label-bold text-primary-container">65%</span>
                    </div>
                    <div class="w-full bg-surface-variant rounded-full h-2 mb-4">
                        <div class="bg-primary-container h-2 rounded-full" style="width: 65%"></div>
                    </div>
                    <div class="flex items-center gap-4 flex-wrap">
                        <button
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-surface-variant text-on-background hover:bg-[#2e7d32] hover:text-white transition-colors font-label-sm text-label-sm group/btn">
                            <span
                                class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">thumb_up</span>
                            12.4k
                        </button>
                        <button
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-surface-variant text-on-background hover:bg-red-600 hover:text-white transition-colors font-label-sm text-label-sm group/btn">
                            <span
                                class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">thumb_down</span>
                            2.1k
                        </button>
                        <button
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-[#2563EB] hover:text-white transition-colors font-label-sm text-label-sm ml-auto group/btn">
                            <span
                                class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">chat_bubble_outline</span>
                            843 Diskusi
                        </button>
                    </div>
                </div>
            </article>

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
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.1,
                    rootMargin: '0px 0px -20px 0px'
                });

                document.querySelectorAll('.animate-on-scroll').forEach(el => {
                    observer.observe(el);
                });
            });
        </script>
    @endpush
</x-layouts.app>
