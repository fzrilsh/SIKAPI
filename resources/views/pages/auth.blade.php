<x-layouts.guests>
    <div class="bg-white w-full max-w-md rounded-[2rem] shadow-xl p-8 sm:p-10 flex flex-col relative overflow-hidden">

        <div class="flex items-center justify-center gap-3 mb-10">
            <h1 class="font-bold text-2xl text-slate-800 tracking-tight">SIKAPI</h1>
        </div>

        <div class="flex-1 flex flex-col justify-center w-full">
            <div class="flex gap-6 mb-8 border-b border-slate-200">
                <button type="button" id="tab-signup" onclick="setAuthMode('signup')"
                    class="pb-3 font-bold text-blue-600 border-b-2 border-blue-600 transition-colors">Daftar</button>
                <button type="button" id="tab-signin" onclick="setAuthMode('signin')"
                    class="pb-3 font-medium text-slate-400 hover:text-slate-600 border-b-2 border-transparent transition-colors">Masuk</button>
            </div>

            <form id="auth-form" method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data"
                class="flex flex-col">
                @csrf
                
                @error('login')
                    <span class="p-2 w-full text-sm text-red-600 rounded-sm">* {{ $message }}</span>
                @enderror
                <input type="hidden" name="auth_mode" id="auth_mode" value="signup">

                <div id="field-fullname" class="transition-all duration-300 overflow-hidden mb-5">
                    <label for="name" class="text-blue-600 text-sm font-semibold mb-1 block">Nama Lengkap</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap sesuai KTP"
                        value="{{ old('name') }}" required
                        class="w-full border-b border-slate-300 py-2 text-sm focus:outline-none focus:border-blue-600 focus:ring-0 transition-colors placeholder-slate-400 bg-transparent">
                    @error('name')
                        <span class="p-2 w-full text-sm text-red-600 rounded-sm">* {{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="text-blue-600 text-sm font-semibold mb-1 block">Email</label>
                    <input type="email" id="email" name="email" placeholder="nama@email.com"
                        value="{{ old('email') }}" required
                        class="w-full border-b border-slate-300 py-2 text-sm focus:outline-none focus:border-blue-600 focus:ring-0 transition-colors placeholder-slate-400 bg-transparent">
                    @error('email')
                        <span class="p-2 w-full text-sm text-red-600 rounded-sm">* {{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="text-blue-600 text-sm font-semibold mb-1 block">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required minlength="8"
                        class="w-full border-b border-slate-300 py-2 text-sm focus:outline-none focus:border-blue-600 focus:ring-0 transition-colors placeholder-slate-400 bg-transparent">
                    @error('password')
                        <span class="p-2 w-full text-sm text-red-600 rounded-sm">* {{ $message }}</span>
                    @enderror
                </div>

                <div id="field-password-confirm" class="transition-all duration-300 overflow-hidden mb-5">
                    <label for="password_confirmation" class="text-blue-600 text-sm font-semibold mb-1 block">Konfirmasi
                        Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="••••••••" required minlength="8"
                        class="w-full border-b border-slate-300 py-2 text-sm focus:outline-none focus:border-blue-600 focus:ring-0 transition-colors placeholder-slate-400 bg-transparent">
                    @error('password_confirmation')
                        <span class="p-2 w-full text-sm text-red-600 rounded-sm">* {{ $message }}</span>
                    @enderror
                </div>

                <div id="field-avatar" class="transition-all duration-300 overflow-hidden mb-5">
                    <label for="avatar" class="text-blue-600 text-sm font-semibold mb-1 block">Avatar
                        (Opsional)</label>
                    <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg, image/jpg"
                        class="w-full border-b border-slate-300 py-1.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-0 transition-colors bg-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer">
                    @error('avatar')
                        <span class="p-2 w-full text-sm text-red-600 rounded-sm">* {{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" id="btn-submit"
                    class="mt-4 w-full bg-[#4F75FF] hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg active:scale-[0.98]">
                    Daftar
                </button>

                <div class="text-center mt-3">
                    <button type="button" id="link-toggle" onclick="toggleAuthMode()"
                        class="text-red-400 text-sm font-medium hover:text-red-500 transition-colors">
                        Sudah punya akun? Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let currentMode = 'signup';

            const form = document.getElementById('auth-form');
            const authModeInput = document.getElementById('auth_mode');
            const tabSignup = document.getElementById('tab-signup');
            const tabSignin = document.getElementById('tab-signin');

            const fieldFullname = document.getElementById('field-fullname');
            const inputName = document.getElementById('name');
            const fieldPasswordConfirm = document.getElementById('field-password-confirm');
            const inputPasswordConfirm = document.getElementById('password_confirmation');
            const fieldAvatar = document.getElementById('field-avatar');

            const btnSubmit = document.getElementById('btn-submit');
            const linkToggle = document.getElementById('link-toggle');

            const activeTabClasses = ['font-bold', 'text-blue-600', 'border-blue-600'];
            const inactiveTabClasses = ['font-medium', 'text-slate-400', 'hover:text-slate-600', 'border-transparent'];

            const extraFields = [fieldFullname, fieldPasswordConfirm, fieldAvatar];

            const registerRoute = "{{ route('register.post') }}";
            const loginRoute = "{{ route('login.post') }}";

            function setAuthMode(mode) {
                currentMode = mode;
                authModeInput.value = mode;

                if (mode === 'signin') {
                    tabSignin.classList.add(...activeTabClasses);
                    tabSignin.classList.remove(...inactiveTabClasses);
                    tabSignup.classList.remove(...activeTabClasses);
                    tabSignup.classList.add(...inactiveTabClasses);

                    extraFields.forEach(field => {
                        field.style.height = '0px';
                        field.style.opacity = '0';
                        field.classList.remove('mb-5');
                    });

                    inputName.removeAttribute('required');
                    inputPasswordConfirm.removeAttribute('required');

                    btnSubmit.innerText = 'Masuk';
                    linkToggle.innerText = "Belum punya akun? Daftar";
                    form.action = loginRoute;
                } else {
                    tabSignup.classList.add(...activeTabClasses);
                    tabSignup.classList.remove(...inactiveTabClasses);
                    tabSignin.classList.remove(...activeTabClasses);
                    tabSignin.classList.add(...inactiveTabClasses);

                    extraFields.forEach(field => {
                        field.style.height = 'fit-content';
                        field.style.opacity = '1';
                        field.classList.add('mb-5');
                    });

                    inputName.setAttribute('required', 'required');
                    inputPasswordConfirm.setAttribute('required', 'required');

                    btnSubmit.innerText = 'Daftar';
                    linkToggle.innerText = 'Sudah punya akun? Masuk';
                    form.action = registerRoute;
                }
            }

            function toggleAuthMode() {
                setAuthMode(currentMode === 'signup' ? 'signin' : 'signup');
            }

            const initialMode = "{{ old('auth_mode', 'signup') }}";
            setAuthMode(initialMode);
        </script>
    @endpush
</x-layouts.guests>
