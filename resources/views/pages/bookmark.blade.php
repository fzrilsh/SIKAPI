<x-layouts.app :page-title="'Kebijakan Tersimpan'">
    <div class="p-6 md:p-10 lg:px-12 max-w-container-max mx-auto w-full flex-1 flex flex-col gap-6 overflow-y-auto">

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
                <br>
                <span class="font-semibold text-on-background">{{ $counts['semua'] }} kebijakan tersimpan</span>
            </p>
        </div>

        <form method="GET" action="{{ route('policies.bookmarks') }}" class="flex flex-col sm:flex-row gap-4 bg-surface-container-lowest p-4 rounded-xl border border-surface-variant shadow-sm items-center">
            
            <div class="relative w-full sm:w-1/3">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input name="search" value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-2.5 bg-surface-bright border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all"
                    placeholder="Cari kebijakan tersimpan..." type="text" onsearch="this.form.submit()" />
            </div>

            <div class="flex flex-wrap gap-2 w-full sm:w-auto ml-auto">
                <button type="submit" name="status" value="semua"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200 
                    {{ request('status', 'semua') === 'semua' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container' }}">
                    Semua
                    <span class="text-xs px-1.5 py-0.5 rounded-full {{ request('status', 'semua') === 'semua' ? 'bg-white/20' : 'bg-surface-container' }}">
                        {{ $counts['semua'] }}
                    </span>
                </button>

                <button type="submit" name="status" value="public_evaluation"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200
                    {{ request('status') === 'public_evaluation' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container' }}">
                    Dalam Tinjauan
                    <span class="text-xs px-1.5 py-0.5 rounded-full {{ request('status') === 'public_evaluation' ? 'bg-white/20' : 'bg-surface-container' }}">
                        {{ $counts['public_evaluation'] }}
                    </span>
                </button>

                <button type="submit" name="status" value="draft"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200
                    {{ request('status') === 'draft' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container' }}">
                    Pengumpulan Draft
                    <span class="text-xs px-1.5 py-0.5 rounded-full {{ request('status') === 'draft' ? 'bg-white/20' : 'bg-surface-container' }}">
                        {{ $counts['draft'] }}
                    </span>
                </button>

                <button type="submit" name="status" value="approved"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-full font-label-bold text-label-bold border transition-all duration-200
                    {{ request('status') === 'approved' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-surface-bright border-outline-variant text-on-surface hover:bg-surface-container' }}">
                    Disetujui
                    <span class="text-xs px-1.5 py-0.5 rounded-full {{ request('status') === 'approved' ? 'bg-white/20' : 'bg-surface-container' }}">
                        {{ $counts['approved'] }}
                    </span>
                </button>
            </div>
        </form>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-stack-md mb-8">
            @forelse ($policies as $policy)
                @php
                    $daysLeft = now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($policy->deadline_date)->startOfDay(), false);
                    $isUrgent = $daysLeft <= 7;

                    $upvotes = $policy->upvotes_count ?? 0;
                    $downvotes = $policy->downvotes_count ?? 0;
                    $commentsCount = $policy->comments_count ?? 0;
                    
                    $totalVotes = $upvotes + $downvotes;
                    $supportPercentage = $totalVotes > 0 ? round(($upvotes / $totalVotes) * 100) : 0;

                    $userInteractions = auth()->check() ? $policy->interactions->where('user_id', auth()->id())->pluck('type')->toArray() : [];
                    $hasUpvoted = in_array('upvote', $userInteractions);
                    $hasDownvoted = in_array('downvote', $userInteractions);
                    $hasBookmarked = in_array('bookmark', $userInteractions);
                @endphp

                <article class="animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700 ease-out bg-surface-container-lowest rounded-xl border border-surface-variant p-6 flex flex-col gap-4 hover:shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:shadow-primary/5 relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary-fixed-dim opacity-10 rounded-full blur-2xl group-hover:opacity-20 transition-opacity duration-500 pointer-events-none"></div>

                    <div class="flex justify-between items-start mb-2 z-10">
                        <div class="flex flex-col gap-1">
                            <span class="font-label-bold text-label-bold text-primary-container bg-primary-fixed-dim/20 px-3 py-1 rounded-full border border-primary-fixed-dim/30 w-fit inline-flex items-center gap-1.5">
                                @if($policy->ministry && $policy->ministry->image)
                                    <img src="{{ asset('storage/' . $policy->ministry->image) }}" alt="Logo {{ $policy->ministry->name }}" class="w-4 h-4 rounded-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-[14px]!">account_balance</span>
                                @endif
                                {{ $policy->ministry->name ?? 'Pemerintah Pusat' }}
                            </span>
                            <span class="font-label-sm text-label-sm {{ $isUrgent ? 'text-error font-semibold' : 'text-on-background' }} mt-1">
                                {{ $daysLeft > 0 ? "Tersisa " . floor($daysLeft) . " hari untuk partisipasi" : "Batas waktu berakhir" }}
                            </span>
                        </div>
                        
                        <form action="{{ route('policies.interact', $policy) }}" method="POST" class="m-0 p-0 relative">
                            @csrf
                            <input type="hidden" name="type" value="bookmark">
                            <button type="submit" class="transition-colors group/bm text-primary-container hover:text-error" title="Hapus dari tersimpan">
                                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">bookmark</span>
                                <span class="absolute -top-1 -right-1 w-4 h-4 bg-error text-white rounded-full text-[10px] font-bold flex items-center justify-center opacity-0 group-hover/bm:opacity-100 transition-opacity shadow-sm">✕</span>
                            </button>
                        </form>
                    </div>

                    <div class="cursor-pointer group/link flex-1 z-10" onclick="window.location.href='{{ url('/kebijakan/' . $policy->slug) }}'">
                        <h2 class="font-h3 text-h3 text-on-background mb-2 group-hover/link:text-primary-container transition-colors line-clamp-2">
                            {{ $policy->title }}
                        </h2>
                        <p class="font-body-md text-body-md text-on-background line-clamp-2">{{ Str::limit($policy->summary, 130) }}</p>
                    </div>

                    <div class="mt-auto pt-4 border-t border-surface-variant z-10">
                        <div class="flex justify-between items-end mb-2">
                            <span class="font-label-sm text-label-sm text-on-background">Dukungan Publik</span>
                            <span class="font-label-bold text-label-bold text-primary-container">{{ $supportPercentage }}%</span>
                        </div>
                        <div class="w-full bg-surface-variant rounded-full h-2 mb-4 overflow-hidden">
                            <div class="bg-primary-container h-full rounded-full transition-all duration-500" style="width: {{ $supportPercentage }}%"></div>
                        </div>
                        
                        <div class="flex items-center gap-4 flex-wrap">
                            <form action="{{ route('policies.interact', $policy) }}" method="POST" class="m-0 p-0">
                                @csrf
                                <input type="hidden" name="type" value="upvote">
                                <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border text-sm transition-colors group/btn 
                                    {{ $hasUpvoted ? 'bg-[#2e7d32] text-white border-transparent' : 'border-surface-variant text-on-background hover:bg-[#2e7d32] hover:text-white' }}">
                                    <span class="material-symbols-outlined text-[18px]! {{ $hasUpvoted ? 'fill-current' : 'group-hover/btn:fill-current' }}">thumb_up</span>
                                    <span class="font-label-sm font-semibold">{{ number_format($upvotes) }}</span>
                                </button>
                            </form>

                            <form action="{{ route('policies.interact', $policy) }}" method="POST" class="m-0 p-0">
                                @csrf
                                <input type="hidden" name="type" value="downvote">
                                <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border text-sm transition-colors group/btn 
                                    {{ $hasDownvoted ? 'bg-red-600 text-white border-transparent' : 'border-surface-variant text-on-background hover:bg-red-600 hover:text-white' }}">
                                    <span class="material-symbols-outlined text-[18px]! {{ $hasDownvoted ? 'fill-current' : 'group-hover/btn:fill-current' }}">thumb_down</span>
                                    <span class="font-label-sm font-semibold">{{ number_format($downvotes) }}</span>
                                </button>
                            </form>

                            <a href="{{ url('/kebijakan/' . $policy->slug . '#comments') }}" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-[#2563EB] hover:text-white transition-colors font-label-sm text-label-sm ml-auto group/btn">
                                <span class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">chat_bubble_outline</span>
                                {{ number_format($commentsCount) }} Diskusi
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 gap-6">
                    <div class="w-24 h-24 bg-surface-container rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-outline text-[48px]!">bookmark_border</span>
                    </div>
                    <div class="text-center max-w-md">
                        <h3 class="font-h3 text-h3 text-on-background mb-2">
                            {{ request()->filled('search') || (request()->filled('status') && request('status') !== 'semua') ? 'Tidak ada hasil ditemukan' : 'Belum ada kebijakan tersimpan' }}
                        </h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            {{ request()->filled('search') || (request()->filled('status') && request('status') !== 'semua') ? 'Coba ubah kata kunci pencarian atau filter kategori Anda.' : 'Simpan kebijakan yang menarik perhatian Anda dengan menekan ikon bookmark di setiap kartu kebijakan.' }}
                        </p>
                    </div>
                    
                    @if(request()->filled('search') || (request()->filled('status') && request('status') !== 'semua'))
                        <a href="{{ route('policies.bookmarks') }}" class="flex items-center gap-2 px-6 py-3 bg-surface-container text-on-surface font-label-bold rounded-full hover:bg-surface-container-high transition-colors">
                            <span class="material-symbols-outlined">restart_alt</span> Reset Filter
                        </a>
                    @else
                        <a href="{{ route('policies.index') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white font-label-bold rounded-full hover:bg-blue-700 transition-colors shadow-md group">
                            <span class="material-symbols-outlined group-hover:-translate-x-0.5 transition-transform">policy</span> Jelajahi Kebijakan
                        </a>
                    @endif
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
                    entries.forEach((entry, index) => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.remove('opacity-0', 'scale-95', 'translate-y-8');
                                entry.target.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                            }, index * 100);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
            });
        </script>
    @endpush
</x-layouts.app>