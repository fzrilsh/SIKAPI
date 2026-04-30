<x-layouts.app :page-title="'Detail Kebijakan - ' . $policy->title">
    <div class="p-6 md:p-10 lg:px-12 flex-1 overflow-y-auto">
        <div class="max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <div class="lg:col-span-8 flex flex-col gap-stack-lg">

                @php
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
                @endphp

                <section class="flex flex-col gap-stack-sm">
                    <div class="flex items-center gap-3 mb-2 flex-wrap">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-bold text-label-bold tracking-wide">
                            <span class="w-2 h-2 rounded-full bg-primary-container mr-2"></span>
                            {{ ucwords(str_replace('_', ' ', $policy->status)) }}
                        </span>
                        <span class="font-label-sm text-label-sm text-outline flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]!">calendar_today</span>
                            {{ \Carbon\Carbon::parse($policy->created_at)->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-1">
                        <h1 class="font-h1 text-2xl md:text-h1 text-on-background">{{ $policy->title }}</h1>

                        @if ($policy->document_url)
                            <a href="{{ $policy->document_url }}"
                                class="flex items-center gap-2 px-5 py-2.5 bg-error text-white rounded-lg hover:opacity-90 transition-opacity font-label-bold shadow-md whitespace-nowrap group shrink-0">
                                <span
                                    class="material-symbols-outlined group-hover:-translate-y-0.5 transition-transform">download</span>
                                Unduh Draf PDF
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-col gap-2 mt-4">
                        <div class="flex justify-between items-center">
                            <span class="font-label-sm text-on-background">Dukungan Publik</span>
                            <span
                                class="font-label-sm text-primary-container font-semibold">{{ $supportPercentage }}%</span>
                        </div>
                        <div class="w-full bg-surface-variant rounded-full h-3 overflow-hidden">
                            <div class="bg-primary-container h-full rounded-full transition-all duration-500"
                                style="width: {{ $supportPercentage }}%"></div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 flex-wrap mt-4">
                        <form action="{{ route('policies.interact', $policy) }}" method="POST" class="m-0 p-0">
                            @csrf
                            <input type="hidden" name="type" value="upvote">
                            <button type="submit"
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border text-sm transition-colors group/btn 
                                {{ $hasUpvoted ? 'bg-[#2e7d32] text-white border-transparent' : 'border-surface-variant text-on-background hover:bg-[#2e7d32] hover:text-white' }}">
                                <span
                                    class="material-symbols-outlined text-[18px]! {{ $hasUpvoted ? 'fill-current' : 'group-hover/btn:fill-current' }}">thumb_up</span>
                                <span class="font-label-sm">{{ number_format($upvotes) }}</span>
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
                                <span class="font-label-sm">{{ number_format($downvotes) }}</span>
                            </button>
                        </form>

                        <button
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-transparent text-on-background hover:bg-blue-600 hover:text-white transition-colors font-label-sm ml-auto group/btn cursor-default">
                            <span
                                class="material-symbols-outlined text-[18px]! group-hover/btn:fill-current">chat_bubble_outline</span>
                            {{ number_format($commentsCount) }} Diskusi
                        </button>
                    </div>

                    <div
                        class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm mt-4 animate-on-scroll opacity-0 scale-95 translate-y-8 transition-all duration-700">
                        <h2 class="font-h3 text-h3 text-on-surface mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container">subject</span> Ringkasan
                            Eksekutif
                        </h2>
                        <p class="font-body-lg text-on-surface-variant leading-relaxed">
                            {{ $policy->summary }}
                        </p>
                    </div>
                </section>

                @if ($policy->points->isNotEmpty())
                    @php
                        $pointCount = $policy->points->count();
                        $gridClass = $pointCount === 1 ? 'grid-cols-1' : 'grid-cols-1 sm:grid-cols-2';
                    @endphp

                    <section class="grid {{ $gridClass }} gap-4">
                        @foreach ($policy->points as $point)
                            <x-cards.policy-point icon="{{ $point->icon ?? 'label_important' }}"
                                title="{{ $point->title }}" description="{{ $point->description }}" />
                        @endforeach
                    </section>
                @endif

                <section class="border-t border-outline-variant pt-stack-md" x-data="{ showPublic: false, replyTo: null }" id="comments">
                    <h2 class="font-h2 text-h2 text-on-surface mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">forum</span> Diskusi Kebijakan
                    </h2>

                    @auth
                        <form action="{{ route('policies.comment', $policy) }}" method="POST"
                            class="bg-surface-container-lowest border border-outline-variant rounded-xl p-4 sm:p-6 mb-8 flex gap-4 shadow-sm">
                            @csrf
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                class="w-10 h-10 rounded-full hidden sm:block object-cover border border-outline-variant">
                            <div class="flex-1 flex flex-col gap-3">
                                <textarea name="content" required
                                    class="w-full bg-surface text-on-surface border border-outline-variant rounded-lg p-3 focus:ring-2 focus:ring-primary-fixed-dim outline-none resize-none transition-all"
                                    placeholder="{{ auth()->user()->is_expert_verified ? 'Berikan pandangan pakar Anda...' : 'Tulis pendapat Anda...' }}"
                                    rows="3"></textarea>
                                <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                                    <span class="text-xs text-outline">Posting publik menggunakan nama asli Anda.</span>
                                    <button type="submit"
                                        class="w-full sm:w-auto bg-primary text-white font-label-bold py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">Kirim
                                        Pendapat</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div
                            class="bg-surface-variant/20 border border-outline-variant rounded-xl p-6 mb-8 text-center shadow-sm">
                            <p class="text-on-surface-variant font-body-md mb-3">Silakan masuk untuk ikut berpartisipasi
                                dalam diskusi ini.</p>
                            <a href="{{ route('login') }}"
                                class="inline-block bg-primary text-white font-label-bold py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">Masuk
                                / Daftar</a>
                        </div>
                    @endauth

                    <div class="border-b border-surface-variant pb-2 mb-4">
                        <h3
                            class="font-label-bold text-on-surface uppercase tracking-wider flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-primary-fixed-dim"
                                style="font-variation-settings: 'FILL' 1;">verified</span>
                            Pandangan Pakar
                        </h3>
                    </div>

                    <div class="flex flex-col gap-6 mb-6">
                        @forelse ($expertComments as $comment)
                            @php
                                $upvotesCount = $comment->interactions->where('type', 'upvote')->count();
                                $downvotesCount = $comment->interactions->where('type', 'downvote')->count();
                            @endphp

                            <div class="flex gap-3 sm:gap-4">
                                <img alt="{{ $comment->user->name }}"
                                    class="w-10 h-10 rounded-full border border-outline-variant flex-shrink-0"
                                    src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}" />
                                <div class="flex-1">
                                    <div
                                        class="bg-surface-container-lowest border border-outline-variant rounded-xl p-4 shadow-sm">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-label-bold text-label-bold text-on-surface">
                                                {{ $comment->user->name }}
                                            </span>
                                            <span class="material-symbols-outlined text-primary-fixed-dim text-[16px]!"
                                                style="font-variation-settings: 'FILL' 1;">verified</span>
                                            <span class="font-label-sm text-label-sm text-outline ml-auto">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="font-body-md text-body-md text-on-surface-variant mb-3">
                                            {{ $comment->content }}
                                        </p>
                                        <div class="flex items-center gap-4">
                                            @php
                                                $userInteraction = auth()->check()
                                                    ? $comment->interactions->where('user_id', auth()->id())->first()
                                                    : null;
                                                $hasUpvoted = $userInteraction && $userInteraction->type === 'upvote';
                                                $hasDownvoted =
                                                    $userInteraction && $userInteraction->type === 'downvote';
                                            @endphp

                                            <form action="{{ route('comments.interact', $comment->id) }}"
                                                method="POST" class="m-0 p-0 inline-flex">
                                                @csrf
                                                <input type="hidden" name="type" value="upvote">
                                                <button type="submit"
                                                    class="flex items-center gap-1 px-2 py-1 rounded font-label-sm text-label-sm transition-colors group/btn 
                                                    {{ $hasUpvoted ? 'bg-[#2e7d32] text-white' : 'text-on-background hover:bg-[#2e7d32] hover:text-white' }}">
                                                    <span
                                                        class="material-symbols-outlined text-[18px] {{ $hasUpvoted ? 'fill-current' : 'group-hover/btn:fill-current group-hover/btn:scale-110 transition-transform' }}">thumb_up</span>
                                                    {{ $upvotesCount }}
                                                </button>
                                            </form>

                                            <form action="{{ route('comments.interact', $comment->id) }}"
                                                method="POST" class="m-0 p-0 inline-flex">
                                                @csrf
                                                <input type="hidden" name="type" value="downvote">
                                                <button type="submit"
                                                    class="flex items-center gap-1 px-2 py-1 rounded font-label-sm text-label-sm transition-colors group/btn 
                                                    {{ $hasDownvoted ? 'bg-red-600 text-white' : 'text-on-background hover:bg-red-600 hover:text-white' }}">
                                                    <span
                                                        class="material-symbols-outlined text-[18px] {{ $hasDownvoted ? 'fill-current' : 'group-hover/btn:fill-current group-hover/btn:scale-110 transition-transform' }}">thumb_down</span>
                                                    {{ $downvotesCount }}
                                                </button>
                                            </form>

                                            @if (auth()->check() && auth()->user()->is_expert_verified)
                                                <button
                                                    @click="replyTo = replyTo === '{{ $comment->id }}' ? null : '{{ $comment->id }}'"
                                                    class="flex items-center gap-1 font-label-sm text-label-sm text-on-background hover:text-primary-container transition-colors ml-2">
                                                    <span class="material-symbols-outlined text-[18px]">reply</span>
                                                    Balas
                                                </button>

                                                <form x-show="replyTo === '{{ $comment->id }}'" x-transition
                                                    action="{{ route('policies.comment', $policy) }}" method="POST"
                                                    class="w-full mt-3">
                                                    @csrf
                                                    <input type="hidden" name="parent_id"
                                                        value="{{ $comment->id }}">
                                                    <div class="flex gap-2">
                                                        <input type="text" name="content" required
                                                            class="flex-1 text-sm border border-outline-variant rounded-lg px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                                                            placeholder="Tulis balasan untuk {{ $comment->user->name }}...">
                                                        <button type="submit"
                                                            class="bg-surface-variant text-on-surface-variant px-4 py-2 rounded-lg text-sm font-bold hover:bg-surface-container-highest transition-colors">Kirim</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="text-center py-6 border border-dashed border-outline-variant rounded-xl bg-surface-container-lowest/50">
                                <span
                                    class="material-symbols-outlined text-outline text-3xl mb-2">hourglass_empty</span>
                                <p class="text-outline text-sm">Belum ada pandangan dari pakar terverifikasi.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="flex items-center justify-center my-10 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-outline-variant"></div>
                        </div>
                        <button @click="showPublic = !showPublic"
                            class="relative bg-surface-container-lowest px-5 py-2.5 border border-outline-variant rounded-full text-sm font-label-bold text-primary hover:bg-surface-container-low transition-all shadow-sm active:scale-95 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]!">group</span>
                            <span
                                x-text="showPublic ? 'Sembunyikan Ruang Publik' : 'Lihat {{ $citizenComments->count() }} pendapat dari ruang publik'"></span>
                            <span class="material-symbols-outlined text-[20px]! transition-transform duration-300"
                                :class="showPublic ? 'rotate-180' : ''">expand_more</span>
                        </button>
                    </div>

                    <div x-show="showPublic" x-transition.origin.top class="flex flex-col gap-6"
                        style="display: none;">
                        @forelse ($citizenComments as $comment)
                            @php
                                $upvotesCount = $comment->interactions->where('type', 'upvote')->count();
                                $downvotesCount = $comment->interactions->where('type', 'downvote')->count();

                                $userInteraction = auth()->check()
                                    ? $comment->interactions->where('user_id', auth()->id())->first()
                                    : null;
                                $hasUpvoted = $userInteraction && $userInteraction->type === 'upvote';
                                $hasDownvoted = $userInteraction && $userInteraction->type === 'downvote';
                            @endphp

                            <div class="flex gap-4">
                                <img src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                                    class="w-10 h-10 rounded-full object-cover border border-outline-variant flex-shrink-0">
                                <div
                                    class="flex-1 bg-surface-bright border border-outline-variant rounded-xl p-5 shadow-sm {{ $comment->is_highlighted ? 'ring-2 ring-[#f59e0b]' : '' }}">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-label-bold text-label-bold text-on-surface">
                                            {{ $comment->user->name }}
                                            @if (($reputations[$comment->user_id] ?? 0) > 10)
                                                <span title="Warga Teraktif"
                                                    class="material-symbols-outlined text-[16px] text-[#f59e0b]"
                                                    style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                                            @endif
                                        </span>
                                        <span class="font-label-sm text-label-sm text-outline ml-auto">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <p class="text-on-surface-variant text-sm leading-relaxed mb-3">
                                        {{ $comment->content }}
                                    </p>

                                    <div class="flex items-center gap-4">
                                        <form action="{{ route('comments.interact', $comment->id) }}" method="POST"
                                            class="m-0 p-0 inline-flex">
                                            @csrf
                                            <input type="hidden" name="type" value="upvote">
                                            <button type="submit"
                                                class="flex items-center gap-1 px-2 py-1 rounded font-label-sm text-label-sm transition-colors group/btn 
                                                {{ $hasUpvoted ? 'bg-[#2e7d32] text-white' : 'text-on-background hover:bg-[#2e7d32] hover:text-white' }}">
                                                <span
                                                    class="material-symbols-outlined text-[18px] {{ $hasUpvoted ? 'fill-current' : 'group-hover/btn:fill-current group-hover/btn:scale-110 transition-transform' }}">thumb_up</span>
                                                {{ $upvotesCount }}
                                            </button>
                                        </form>

                                        <form action="{{ route('comments.interact', $comment->id) }}" method="POST"
                                            class="m-0 p-0 inline-flex">
                                            @csrf
                                            <input type="hidden" name="type" value="downvote">
                                            <button type="submit"
                                                class="flex items-center gap-1 px-2 py-1 rounded font-label-sm text-label-sm transition-colors group/btn 
                                                {{ $hasDownvoted ? 'bg-red-600 text-white' : 'text-on-background hover:bg-red-600 hover:text-white' }}">
                                                <span
                                                    class="material-symbols-outlined text-[18px] {{ $hasDownvoted ? 'fill-current' : 'group-hover/btn:fill-current group-hover/btn:scale-110 transition-transform' }}">thumb_down</span>
                                                {{ $downvotesCount }}
                                            </button>
                                        </form>

                                        @auth
                                            <button
                                                @click="replyTo = replyTo === '{{ $comment->id }}' ? null : '{{ $comment->id }}'"
                                                class="flex items-center gap-1 font-label-sm text-label-sm text-on-background hover:text-primary-container transition-colors ml-2">
                                                <span class="material-symbols-outlined text-[18px]">reply</span> Balas
                                            </button>
                                        @endauth
                                    </div>

                                    @auth
                                        <form x-show="replyTo === '{{ $comment->id }}'" x-transition
                                            action="{{ route('policies.comment', $policy) }}" method="POST"
                                            class="w-full mt-3">
                                            @csrf
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <div class="flex gap-2">
                                                <input type="text" name="content" required
                                                    class="flex-1 text-sm border border-outline-variant rounded-lg px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                                                    placeholder="Tulis balasan untuk {{ $comment->user->name }}...">
                                                <button type="submit"
                                                    class="bg-surface-variant text-on-surface-variant px-4 py-2 rounded-lg text-sm font-bold hover:bg-surface-container-highest transition-colors">Kirim</button>
                                            </div>
                                        </form>
                                    @endauth

                                    @foreach ($comment->replies as $reply)
                                        <div class="mt-4 pt-4 border-t border-surface-variant flex gap-3">
                                            <img src="{{ $reply->user->avatar ? asset('storage/' . $reply->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($reply->user->name) }}"
                                                class="w-8 h-8 rounded-full object-cover border border-outline-variant flex-shrink-0">
                                            <div>
                                                <h4 class="font-bold text-on-surface text-sm">
                                                    {{ $reply->user->name }}
                                                    @if ($reply->user->is_expert_verified)
                                                        <span
                                                            class="material-symbols-outlined text-primary-fixed-dim text-[16px]!"
                                                            style="font-variation-settings: 'FILL' 1;">verified</span>
                                                    @endif
                                                    <span
                                                        class="text-xs text-outline font-normal ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                                                </h4>
                                                <p class="text-on-surface-variant text-sm mt-1">{{ $reply->content }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <p class="text-outline text-sm">Belum ada diskusi dari ruang publik. Jadilah yang
                                    pertama memberikan suara!</p>
                            </div>
                        @endforelse
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
                    <a href="{{ route('policies.index') }}"
                        class="w-full mt-6 py-2 border border-outline text-on-surface font-label-bold text-label-bold rounded hover:bg-surface-container-low transition-colors block text-center">
                        Lihat Semua
                    </a>
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
