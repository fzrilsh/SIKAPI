<x-layouts.app page-title="Daftar Kebijakan">
    <div class="p-6 md:p-10 lg:px-12 max-w-container-max mx-auto w-full flex-1 flex flex-col gap-6 overflow-y-auto">
        <div class="mb-2">
            <h1 class="font-h1 text-h1 text-on-background mb-4">Daftar Kebijakan Menunggu Pengesahan</h1>
            <p class="font-body-lg text-body-lg text-on-background max-w-3xl">
                Tinjau, diskusikan, dan berikan suara Anda pada rancangan kebijakan publik yang sedang dalam tahap akhir
                sebelum diresmikan.
            </p>
        </div>

        <form method="GET" action="{{ route('policies.index') }}"
            class="flex flex-col sm:flex-row gap-4 mb-4 bg-surface-container-lowest p-4 rounded-xl border border-surface-variant shadow-sm items-center">
            <div class="relative w-full sm:w-1/3 flex-1">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input name="search" value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-2.5 bg-surface-bright border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all"
                    placeholder="Cari rancangan kebijakan..." type="text" onsearch="this.form.submit()" />
                <button type="submit" class="hidden"></button>
            </div>

            <div class="flex flex-wrap gap-4 w-full sm:w-auto ml-auto">
                <div class="relative w-full sm:w-auto">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[20px]!">filter_list</span>
                    <select name="ministry" onchange="this.form.submit()"
                        class="appearance-none w-full sm:w-auto pl-10 pr-10 py-2.5 bg-surface-bright border border-outline-variant rounded-lg font-label-bold text-label-bold text-on-surface hover:bg-surface-container transition-colors cursor-pointer focus:outline-none focus:border-primary-container">
                        <option value="">Semua Kementerian</option>
                        @foreach ($ministries as $min)
                            <option value="{{ $min->id }}" {{ request('ministry') == $min->id ? 'selected' : '' }}>
                                {{ $min->name }}
                            </option>
                        @endforeach
                    </select>
                    <span
                        class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[20px]!">expand_more</span>
                </div>

                <div class="relative w-full sm:w-auto">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[20px]!">sort</span>
                    <select name="sort" onchange="this.form.submit()"
                        class="appearance-none w-full sm:w-auto pl-10 pr-10 py-2.5 bg-surface-bright border border-outline-variant rounded-lg font-label-bold text-label-bold text-on-surface hover:bg-surface-container transition-colors cursor-pointer focus:outline-none focus:border-primary-container">
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                        <option value="terpopuler" {{ request('sort') == 'terpopuler' ? 'selected' : '' }}>Terpopuler
                        </option>
                    </select>
                    <span
                        class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[20px]!">expand_more</span>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-stack-md mb-8">
            @forelse ($policies as $policy)
                @php
                    $daysLeft = now()
                        ->startOfDay()
                        ->diffInDays(\Carbon\Carbon::parse($policy->deadline_date)->startOfDay(), false);
                    $isUrgent = $daysLeft <= 7;

                    $upvotes = $policy->upvotes_count ?? 0;
                    $downvotes = $policy->downvotes_count ?? 0;
                    $commentsCount = $policy->comments_count ?? 0;

                    $totalVotes = $upvotes + $downvotes;
                    $supportPercentage = $totalVotes > 0 ? round(($upvotes / $totalVotes) * 100) : 0;

                    $userInteractions = auth()->check()
                        ? $policy->interactions
                            ->where('user_id', auth()->id())
                            ->pluck('type')
                            ->toArray()
                        : [];
                    $hasUpvoted = in_array('upvote', $userInteractions);
                    $hasDownvoted = in_array('downvote', $userInteractions);
                    $hasBookmarked = in_array('bookmark', $userInteractions);
                @endphp

                <article
                    class="animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700 ease-out bg-surface-container-lowest rounded-xl border border-surface-variant p-6 flex flex-col gap-4 hover:shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:shadow-primary/5 cursor-pointer"
                    onclick="window.location.href='{{ route('policies.show', $policy->slug) }}'">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex flex-col gap-1">
                            <span class="font-label-bold text-label-bold text-primary-container bg-primary-fixed-dim/20 px-3 py-1 rounded-full border border-primary-fixed-dim/30 w-fit inline-flex items-center gap-1.5">
                                @if ($policy->ministry && $policy->ministry->logo)
                                    <img src="{{ asset('storage/' . $policy->ministry->logo) }}"
                                        alt="Logo {{ $policy->ministry->name }}"
                                        class="w-4 h-4 rounded-full object-cover">
                                @endif

                                {{ $policy->ministry->name ?? 'Pemerintah Pusat' }}
                            </span>

                            <span
                                class="font-label-sm text-label-sm {{ $isUrgent ? 'text-error font-semibold' : 'text-on-background' }} mt-1">
                                {{ $daysLeft > 0 ? 'Tersisa ' . floor($daysLeft) . ' hari untuk partisipasi' : 'Batas waktu berakhir' }}
                            </span>
                        </div>

                        <form action="{{ route('policies.interact', $policy) }}" method="POST" class="m-0 p-0">
                            @csrf
                            <input type="hidden" name="type" value="bookmark">
                            <button type="submit"
                                class="transition-colors {{ $hasBookmarked ? 'text-primary-container' : 'text-outline hover:text-primary-container' }}">
                                <span class="material-symbols-outlined"
                                    style="{{ $hasBookmarked ? "font-variation-settings: 'FILL' 1;" : '' }}">{{ $hasBookmarked ? 'bookmark' : 'bookmark_border' }}</span>
                            </button>
                        </form>
                    </div>

                    <div class="group flex-1">
                        <h2 class="font-h3 text-h3 text-on-background mb-2 transition-colors line-clamp-2">
                            {{ $policy->title }}
                        </h2>
                        <p class="font-body-md text-body-md text-on-background line-clamp-2">
                            {{ Str::limit($policy->summary, 130) }}</p>
                    </div>

                    <div class="mt-auto pt-4 border-t border-surface-variant">
                        <div class="flex justify-between items-end mb-2">
                            <span class="font-label-sm text-label-sm text-on-background">Dukungan Publik</span>
                            <span
                                class="font-label-bold text-label-bold text-primary-container">{{ $supportPercentage }}%</span>
                        </div>
                        <div class="w-full bg-surface-variant rounded-full h-2 mb-4 overflow-hidden">
                            <div class="bg-primary-container h-full rounded-full transition-all duration-500"
                                style="width: {{ $supportPercentage }}%"></div>
                        </div>

                        <div class="flex items-center gap-4 flex-wrap">
                            <form action="{{ route('policies.interact', $policy) }}" method="POST" class="m-0 p-0">
                                @csrf
                                <input type="hidden" name="type" value="upvote">
                                <button type="submit"
                                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border text-sm transition-colors group/btn 
                                    {{ $hasUpvoted ? 'bg-[#2e7d32] text-white border-transparent' : 'border-surface-variant text-on-background hover:bg-[#2e7d32] hover:text-white' }}">
                                    <span
                                        class="material-symbols-outlined text-[18px]! {{ $hasUpvoted ? 'fill-current' : 'group-hover/btn:fill-current' }}">thumb_up</span>
                                    <span class="font-label-sm font-semibold">{{ number_format($upvotes) }}</span>
                                </button>
                            </form>

                            <form action="{{ route('policies.interact', $policy) }}" method="POST" class="m-0 p-0">
                                @csrf
                                <input type="hidden" name="type" value="downvote">
                                <button type="submit"
                                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border text-sm transition-colors group/btn 
                                    {{ $hasDownvoted ? 'bg-red-600 text-white border-transparent' : 'border-surface-variant text-on-background hover:bg-red-600 hover:text-white' }}">
                                    <span
                                        class="material-symbols-outlined text-[18px]! {{ $hasDownvoted ? 'fill-current' : 'group-hover/btn:fill-current' }}">thumb_down</span>
                                    <span class="font-label-sm font-semibold">{{ number_format($downvotes) }}</span>
                                </button>
                            </form>

                            <a href="{{ url('/kebijakan/' . $policy->slug . '#comments') }}"
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-[#2563EB] hover:text-white transition-colors font-label-sm text-label-sm ml-auto group/btn">
                                <span
                                    class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">chat_bubble_outline</span>
                                {{ number_format($commentsCount) }} Diskusi
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="col-span-full py-16 flex flex-col items-center justify-center bg-surface-container-lowest border border-outline-variant rounded-xl border-dashed">
                    <span
                        class="material-symbols-outlined text-5xl text-on-surface-variant mb-4 opacity-50">search_off</span>
                    <h3 class="font-h3 text-h3 text-on-background">Kebijakan Tidak Ditemukan</h3>
                    <p class="text-on-surface-variant mt-2 max-w-md text-center">Coba gunakan kata kunci pencarian yang
                        berbeda atau sesuaikan filter kementerian.</p>
                    <a href="{{ route('policies.index') }}"
                        class="mt-6 text-primary-container hover:underline font-label-bold">Reset Pencarian</a>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $policies->links() }}
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
