<aside id="sidebar"
    class="fixed left-0 top-0 h-screen  w-sidebar-width bg-background border-r border-outline-variant flex flex-col py-4 px-4 font-public-sans z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">

    <div class="mb-4 flex items-center justify-between">
        <a href="/"
            class="flex items-center gap-3 w-fit hover:bg-surface-container rounded-full p-2 pr-4 transition-colors">
            <div>
                <h1 class="text-xl font-black text-on-background leading-none tracking-tight">SIKAPI</h1>
            </div>
        </a>
        <button onclick="toggleSidebar()"
            class="md:hidden text-on-surface-variant hover:bg-surface-container p-2 rounded-full transition-colors">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <nav class="flex flex-col gap-1 mt-2">
        <x-navigations.nav-link href="/" icon="home" active="{{ request()->is('/') }}">Beranda</x-navigations.nav-link>
        <x-navigations.nav-link href="/kebijakan" icon="policy" active="{{ request()->is('kebijakan*') }}">Kebijakan</x-navigations.nav-link>
        <x-navigations.nav-link href="/notifikasi" icon="notifications">
            Notifikasi

            <x-slot:append>
                <span
                    class="absolute top-3 left-8 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-background"></span>
            </x-slot:append>
        </x-navigations.nav-link>
        <x-navigations.nav-link href="/aktivitas" icon="analytics">Aktivitas Saya</x-navigations.nav-link>
        <x-navigations.nav-link href="/pengaturan" icon="settings">Pengaturan</x-navigations.nav-link>
        <x-navigations.nav-link href="/bantuan" icon="help">Bantuan</x-navigations.nav-link>

        <button
            class="mt-4 bg-blue-600 text-white font-bold text-lg py-3 rounded-full hover:bg-blue-700 transition-all w-[90%]">
            Mulai Diskusi
        </button>
    </nav>

    <div class="mt-auto relative" x-data="{ open: false }">
        <button @click="open = !open"
            class="flex items-center gap-3 p-3 rounded-full hover:bg-surface-container w-full transition-colors">
            <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=Fazril+Syaveral' }}"
                class="w-10 h-10 rounded-full border border-outline-variant">
            <div class="flex flex-col overflow-hidden text-left flex-1">
                <span class="font-bold text-sm truncate">Fazril Syaveral</span>
                <span class="text-xs text-slate-500 truncate">@fazril_sh</span>
            </div>
            <span class="material-symbols-outlined text-slate-400">more_horiz</span>
        </button>

        <div x-show="open" @click.away="open = false"
            class="absolute bottom-full left-0 mb-2 w-full bg-white border border-outline-variant rounded-xl shadow-lg py-2 z-50">
            <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-sm font-semibold">
                <span class="material-symbols-outlined text-blue-600">workspace_premium</span> Ajukan Jadi Pakar
            </a>
            <hr class="my-1 border-slate-100">
            <form method="POST" action="/logout">
                @csrf
                <button
                    class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 text-red-600 text-sm font-semibold">
                    <span class="material-symbols-outlined">logout</span> Keluar
                </button>
            </form>
        </div>
    </div>
</aside>
