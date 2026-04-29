<x-layouts.app page-title="Beranda">
    <div class="p-margin-page max-w-container-max mx-auto w-full flex-1 flex flex-col gap-stack-lg overflow-y-auto">
        <section class="bg-gradient-to-r from-blue-800 to-blue-600 rounded-2xl shadow-md overflow-hidden mb-4">
            <div class="flex flex-col md:flex-row items-center md:items-end gap-4 md:gap-0 p-6 md:p-0">
                <div class="hidden md:flex w-[220px] flex-shrink-0 items-end justify-center self-end pl-8 pb-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/7068/7068243.png"
                        alt="Ilustrasi Partisipasi Kebijakan Rakyat"
                        class="w-40 lg:w-44 object-contain drop-shadow-lg" />
                </div>

                <div class="flex-1 md:py-7 md:pr-8 md:pl-6 flex flex-col gap-4">
                    <div class="text-center md:text-left flex flex-wrap items-center gap-x-3 gap-y-2 justify-center md:justify-start">
                        <h1 class="text-xl md:text-2xl font-bold text-white leading-tight tracking-tight">
                            Berikan Suaramu.
                        </h1>
                        <span class="inline-block bg-white text-blue-800 font-bold text-lg md:text-xl px-4 py-1 rounded-full shadow-sm">
                            Tentukan Nasib Negaramu.
                        </span>
                    </div>

                    <div class="flex items-center gap-3 w-full bg-white/10 p-2 rounded-xl border border-white/20">
                        <img alt="User profile"
                            class="w-10 h-10 rounded-full object-cover border border-white/40 hidden sm:block shadow-sm"
                            src="{{ auth()->user()->avatar ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuBS_N8OmRXB7bXjg3tsO7jOS6Kezf6wTMS-rrs5TReo7cGFVTXRLsQ1lO_EOrG1H7HbnlJ_FRbLo2cHIyp1WQ1Aq4M5-Y0-51F8A2Tf2vbE4iDqu507LAEU8kPvnLUFDheSloX4bY4Okdyvuy6d9hZm0aoyDyl8Pu58i4M1lOcDyTbNcs3BP_f-sPPdUvaR-g05YeddvmTHnExh46TvBxLp5tWuz3K4Ce3P7BgbK1wjqotrliRrdfz13QosC8G1CETiIr6RRtTZCyQ' }}" />
                        <div class="flex flex-1 h-12 shadow-sm bg-white rounded-lg transition-all focus-within:ring-4 focus-within:ring-white/30">
                            <input id="hero-search"
                                class="flex-1 px-4 bg-transparent border-none text-slate-900 text-sm md:text-base outline-none rounded-l-lg placeholder:text-slate-500"
                                placeholder="Cari nama kebijakan atau kementerian..." type="text" />
                            <button class="bg-[#f3f2f1] hover:bg-[#e5e5e5] text-[#1d70b8] px-5 flex items-center justify-center transition-colors outline-none rounded-r-lg border-l border-slate-200 group">
                                <span class="material-symbols-outlined text-[24px] group-hover:scale-110 transition-transform">search</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flex flex-col gap-stack-md">
            <div class="flex items-center justify-between border-b border-outline-variant pb-4">
                <h2 class="font-h2 text-h2 text-on-background">Kebijakan Trending Hari Ini</h2>
                <a class="font-label-bold text-label-bold text-primary-container hover:underline flex items-center gap-1"
                    href="{{ url('/kebijakan') }}">
                    Lihat Semua <span class="material-symbols-outlined text-sm!">arrow_forward</span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col gap-6 hover:shadow-[0px_12px_32px_rgba(0,0,0,0.1)] transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary-fixed-dim opacity-20 rounded-full blur-2xl group-hover:opacity-40 transition-opacity"></div>
                    
                    <div class="flex justify-between items-start z-10">
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-primary-container bg-surface-container-low px-2 py-1 rounded w-fit inline-flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]!">local_hospital</span>
                                Kementerian Kesehatan
                            </span>
                            <span class="font-label-sm text-label-sm text-on-background">Tersisa 14 hari untuk partisipasi</span>
                        </div>
                        <span class="font-label-sm text-label-sm font-semibold text-surface-tint bg-[#465f881a] px-3 py-1 rounded-full border border-[#465f8833]">Dalam Tinjauan</span>
                    </div>
                    
                    <div class="flex flex-col gap-2 z-10 cursor-pointer" onclick="window.location.href='{{ url('/kebijakan/ruu-kesehatan') }}'">
                        <h3 class="font-h3 text-h3 text-on-background line-clamp-2 hover:text-primary-container transition-colors">RUU Sistem Kesehatan Nasional 2024</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant line-clamp-3">Pembaruan komprehensif terhadap infrastruktur kesehatan publik, berfokus pada digitalisasi rekam medis dan pemerataan fasilitas layanan tingkat pertama di daerah tertinggal.</p>
                    </div>
                    
                    <div class="flex flex-col gap-2 z-10">
                        <div class="flex justify-between items-center">
                            <span class="font-label-sm text-label-sm text-on-background">Dukungan Publik</span>
                            <span class="font-label-sm text-label-sm text-primary-container font-semibold">65%</span>
                        </div>
                        <div class="w-full bg-surface-container-highest rounded-full h-2">
                            <div class="bg-primary-container h-2 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between border-t border-surface-container-highest pt-4 z-10">
                        <div class="flex items-center gap-4">
                            <button class="flex items-center gap-1 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-[#2e7d32] hover:text-white transition-colors group/btn">
                                <span class="material-symbols-outlined group-hover/btn:fill-current">thumb_up</span>
                                <span class="font-label-sm text-label-sm">4.2k</span>
                            </button>
                            <button class="flex items-center gap-1 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-red-600 hover:text-white transition-colors group/btn">
                                <span class="material-symbols-outlined group-hover/btn:fill-current">thumb_down</span>
                                <span class="font-label-sm text-label-sm">1.1k</span>
                            </button>
                            <button class="flex items-center gap-1 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-[#2563EB] hover:text-white transition-colors group/btn">
                                <span class="material-symbols-outlined group-hover/btn:fill-current">chat_bubble</span>
                                <span class="font-label-sm text-label-sm">856</span>
                            </button>
                        </div>
                        <button class="text-on-background hover:text-primary-container transition-colors">
                            <span class="material-symbols-outlined text-2xl">bookmark</span>
                        </button>
                    </div>
                </div>

                <div class="bg-error-container border border-error/30 rounded-xl p-6 flex flex-col gap-6 hover:shadow-[0px_12px_32px_rgba(0,0,0,0.1)] transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-error opacity-10 rounded-full blur-2xl group-hover:opacity-20 transition-opacity"></div>
                    
                    <div class="flex justify-between items-start z-10">
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-on-tertiary-fixed-variant bg-tertiary-fixed px-2 py-1 rounded w-fit inline-flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]!">school</span> Kementerian Pendidikan
                            </span>
                            <span class="font-label-sm text-label-sm text-error font-semibold flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]!">warning</span>Tersisa 5 hari untuk partisipasi
                            </span>
                        </div>
                        <span class="font-label-sm text-label-sm font-semibold text-[#006874] bg-[#0068741a] px-3 py-1 rounded-full border border-[#00687433]">Pengumpulan Draft</span>
                    </div>
                    
                    <div class="flex flex-col gap-2 z-10 cursor-pointer" onclick="window.location.href='{{ url('/kebijakan/kurikulum-merdeka') }}'">
                        <h3 class="font-h3 text-h3 text-on-background line-clamp-2 hover:text-primary-container transition-colors">Revisi Kurikulum Merdeka Terpadu</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant line-clamp-3">Penyesuaian indikator pencapaian siswa berbasis proyek, integrasi kemampuan literasi digital sejak sekolah dasar, dan fleksibilitas jam mengajar bagi tenaga pendidik.</p>
                    </div>
                    
                    <div class="flex flex-col gap-2 z-10">
                        <div class="flex justify-between items-center">
                            <span class="font-label-sm text-label-sm text-on-background">Dukungan Publik</span>
                            <span class="font-label-sm text-label-sm text-primary-container font-semibold">30%</span>
                        </div>
                        <div class="w-full bg-surface-container-highest rounded-full h-2">
                            <div class="bg-primary-container h-2 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between border-t border-surface-container-highest pt-4 z-10">
                        <div class="flex items-center gap-4">
                            <button class="flex items-center gap-1 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-[#2e7d32] hover:text-white transition-colors group/btn">
                                <span class="material-symbols-outlined group-hover/btn:fill-current">thumb_up</span>
                                <span class="font-label-sm text-label-sm">8.9k</span>
                            </button>
                            <button class="flex items-center gap-1 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-red-600 hover:text-white transition-colors group/btn">
                                <span class="material-symbols-outlined group-hover/btn:fill-current">thumb_down</span>
                                <span class="font-label-sm text-label-sm">432</span>
                            </button>
                            <button class="flex items-center gap-1 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-[#2563EB] hover:text-white transition-colors group/btn">
                                <span class="material-symbols-outlined group-hover/btn:fill-current">chat_bubble</span>
                                <span class="font-label-sm text-label-sm">1.2k</span>
                            </button>
                        </div>
                        <button class="text-on-background hover:text-primary-container transition-colors">
                            <span class="material-symbols-outlined text-2xl">bookmark_border</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="flex flex-col gap-stack-md">
            <h2 class="font-h2 text-h2 text-on-background border-b border-outline-variant pb-4">Statistik Kebijakan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                
                <div class="bg-[#475569] rounded-xl p-5 md:p-6 flex justify-between relative overflow-hidden min-h-[160px] group shadow-sm hover:shadow-md transition-all">
                    <div class="flex flex-col justify-between relative z-10 w-2/3">
                        <h3 class="font-bold text-white text-lg leading-snug">Evaluasi Publik</h3>
                        <div class="mt-4">
                            <span class="inline-flex items-center justify-center bg-white text-slate-800 font-bold px-4 py-1.5 rounded-full text-sm shadow-sm group-hover:bg-slate-50 transition-colors">
                                45 Kebijakan
                            </span>
                        </div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-32 h-32 md:w-36 md:h-36 transition-transform group-hover:scale-105 opacity-90 drop-shadow-2xl">
                        <img src="https://cdn-icons-png.flaticon.com/512/2936/2936769.png" alt="Evaluasi Publik" class="w-full h-full object-contain drop-shadow-xl" />
                    </div>
                </div>

                <div class="bg-[#dc2626] rounded-xl p-5 md:p-6 flex justify-between relative overflow-hidden min-h-[160px] group shadow-sm hover:shadow-md transition-all">
                    <div class="flex flex-col justify-between relative z-10 w-2/3">
                        <h3 class="font-bold text-white text-lg leading-snug">Butuh Revisi</h3>
                        <div class="mt-4">
                            <span class="inline-flex items-center justify-center bg-white text-red-800 font-bold px-4 py-1.5 rounded-full text-sm shadow-sm group-hover:bg-red-50 transition-colors">
                                12 Kebijakan
                            </span>
                        </div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-32 h-32 md:w-36 md:h-36 transition-transform group-hover:scale-105 opacity-90 drop-shadow-2xl">
                        <img src="https://cdn-icons-png.flaticon.com/512/2666/2666060.png" alt="Butuh Revisi" class="w-full h-full object-contain drop-shadow-xl" />
                    </div>
                </div>

                <div class="bg-[#059669] rounded-xl p-5 md:p-6 flex justify-between relative overflow-hidden min-h-[160px] group shadow-sm hover:shadow-md transition-all">
                    <div class="flex flex-col justify-between relative z-10 w-2/3">
                        <h3 class="font-bold text-white text-lg leading-snug">Disetujui</h3>
                        <div class="mt-4">
                            <span class="inline-flex items-center justify-center bg-white text-green-800 font-bold px-4 py-1.5 rounded-full text-sm shadow-sm group-hover:bg-green-50 transition-colors">
                                18 Kebijakan
                            </span>
                        </div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-32 h-32 md:w-36 md:h-36 transition-transform group-hover:scale-105 opacity-90 drop-shadow-2xl">
                        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Disetujui" class="w-full h-full object-contain drop-shadow-xl" />
                    </div>
                </div>
                
            </div>
        </section>
    </div>
</x-layouts.app>