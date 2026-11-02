<header class="fixed inset-x-0 top-0 z-50 border-b border-slate-100 bg-white shadow-sm">
    @php
        $isHome = request()->is('/');
        $isUmkm = request()->is('daftar_umkm');
        $isProducts = request()->is('daftar_produk');
        $sessionProfilePhoto = session('user_profile_photo');
        $profilePhotoUrl = $sessionProfilePhoto
            && file_exists(public_path('profile_photos/' . $sessionProfilePhoto))
            ? asset('profile_photos/' . $sessionProfilePhoto)
            : asset('img/U.png');
    @endphp
    <div class="mx-auto flex h-[88px] max-w-[1440px] items-center justify-between px-5 sm:px-8 lg:px-12">
        <a href="{{ url('/') }}" class="flex shrink-0 items-center gap-2.5 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-[#087f7b]" aria-label="Beranda UMKM Lemahmulya">
            <img src="{{ asset('img/logo-web-umkm.png') }}" alt="" class="h-12 w-12 object-contain">
            <span class="hidden leading-none sm:block">
                <strong class="block text-[13px] font-extrabold tracking-tight text-[#073f3b]">UMKM DESA LEMAHMULYA</strong>
                <small class="mt-1 block text-[8px] font-medium tracking-[0.16em] text-[#073f3b]">RUANG UMKM LOKAL</small>
            </span>
        </a>

        <nav class="hidden items-center gap-9 md:flex" aria-label="Navigasi utama">
            <a href="{{ url('/') }}" class="group relative py-4 text-sm font-medium transition focus:outline-none {{ $isHome ? 'text-[#087f7b]' : 'text-slate-500 hover:text-[#087f7b] focus-visible:text-[#087f7b]' }}">
                Beranda
                <span class="absolute inset-x-0 bottom-1 h-0.5 rounded-full bg-[#087f7b] transition-transform duration-300 {{ $isHome ? 'scale-x-100' : 'origin-left scale-x-0 group-hover:scale-x-100 group-focus-visible:scale-x-100' }}"></span>
            </a>
            <a href="{{ url('/daftar_umkm') }}" class="group relative py-4 text-sm font-medium transition focus:outline-none {{ $isUmkm ? 'text-[#087f7b]' : 'text-slate-500 hover:text-[#087f7b] focus-visible:text-[#087f7b]' }}">
                UMKM
                <span class="absolute inset-x-0 bottom-1 h-0.5 rounded-full bg-[#087f7b] transition-transform duration-300 {{ $isUmkm ? 'scale-x-100' : 'origin-left scale-x-0 group-hover:scale-x-100 group-focus-visible:scale-x-100' }}"></span>
            </a>
            <a href="{{ url('/daftar_produk') }}" class="group relative py-4 text-sm font-medium transition focus:outline-none {{ $isProducts ? 'text-[#087f7b]' : 'text-slate-500 hover:text-[#087f7b] focus-visible:text-[#087f7b]' }}">
                Produk
                <span class="absolute inset-x-0 bottom-1 h-0.5 rounded-full bg-[#087f7b] transition-transform duration-300 {{ $isProducts ? 'scale-x-100' : 'origin-left scale-x-0 group-hover:scale-x-100 group-focus-visible:scale-x-100' }}"></span>
            </a>
        </nav>

        <div class="hidden items-center gap-5 md:flex">
            @if(session('user_id'))
                <div class="relative">
                    <button type="button" data-account-toggle class="flex items-center gap-2 rounded-full py-1 pl-1 pr-2 text-sm font-medium text-slate-600 transition hover:text-[#087f7b] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#087f7b]" aria-expanded="false" aria-controls="desktop-account-menu">
                        <img src="{{ $profilePhotoUrl }}" alt="{{ session('user_name') }}" class="h-8 w-8 rounded-full object-cover">
                        <span>{{ session('user_name') }}</span>
                        <svg class="h-4 w-4 text-slate-400 transition-transform" data-account-chevron fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" /></svg>
                    </button>
                    <div id="desktop-account-menu" data-account-menu class="absolute right-0 top-12 hidden w-44 overflow-hidden rounded-xl border border-slate-100 bg-white py-1 shadow-xl">
                        <a href="{{ url('profile_page') }}" class="block px-4 py-2.5 text-sm text-slate-600 transition hover:bg-cyan-50 hover:text-cyan-700">Profil</a>
                        <form method="POST" action="{{ url('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2.5 text-left text-sm text-slate-600 transition hover:bg-cyan-50 hover:text-cyan-700">Keluar</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ url('/login') }}" class="text-sm font-medium text-slate-700 transition hover:text-[#087f7b] focus:outline-none focus-visible:text-[#087f7b]">Masuk</a>
                <a href="{{ url('/register') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#147b7b] px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0e6262] hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b] focus-visible:ring-offset-2">
                    Daftarkan usaha
                    <span class="text-lg font-normal leading-none">+</span>
                </a>
            @endif
        </div>

        <button type="button" data-menu-toggle class="rounded-lg p-2 text-[#073f3b] transition hover:bg-slate-100 hover:text-[#087f7b] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#087f7b] md:hidden" aria-expanded="false" aria-controls="mobile-menu" aria-label="Buka menu navigasi">
            <svg data-menu-open class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            <svg data-menu-close class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" /></svg>
        </button>
    </div>

    <div id="mobile-menu" data-mobile-menu class="hidden border-t border-slate-100 bg-white px-5 py-4 shadow-lg md:hidden">
        <nav class="flex flex-col gap-1" aria-label="Navigasi mobile">
            <a href="{{ url('/') }}" class="rounded-lg px-4 py-3 text-sm font-semibold transition hover:bg-teal-50 hover:text-[#087f7b] {{ $isHome ? 'bg-teal-50 text-[#087f7b]' : 'text-slate-600' }}">Beranda</a>
            <a href="{{ url('/daftar_umkm') }}" class="rounded-lg px-4 py-3 text-sm font-semibold transition hover:bg-teal-50 hover:text-[#087f7b] {{ $isUmkm ? 'bg-teal-50 text-[#087f7b]' : 'text-slate-600' }}">UMKM</a>
            <a href="{{ url('/daftar_produk') }}" class="rounded-lg px-4 py-3 text-sm font-semibold transition hover:bg-teal-50 hover:text-[#087f7b] {{ $isProducts ? 'bg-teal-50 text-[#087f7b]' : 'text-slate-600' }}">Produk</a>
            @if(session('user_id'))
                <a href="{{ url('profile_page') }}" class="rounded-lg px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-teal-50 hover:text-[#087f7b]">Profil ({{ session('user_name') }})</a>
                <form method="POST" action="{{ url('logout') }}">
                    @csrf
                    <button type="submit" class="w-full rounded-lg px-4 py-3 text-left text-sm font-semibold text-slate-600 transition hover:bg-teal-50 hover:text-[#087f7b]">Keluar</button>
                </form>
            @else
                <a href="{{ url('/login') }}" class="mt-2 rounded-lg px-4 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-teal-50 hover:text-[#087f7b]">Masuk</a>
                <a href="{{ url('/register') }}" class="mt-2 inline-flex items-center justify-center gap-2 rounded-lg bg-[#147b7b] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#0e6262]">Daftarkan usaha <span class="text-lg font-normal leading-none">+</span></a>
            @endif
        </nav>
    </div>
</header>

<script>
    (() => {
        const toggle = document.querySelector('[data-menu-toggle]');
        const menu = document.querySelector('[data-mobile-menu]');
        const openIcon = document.querySelector('[data-menu-open]');
        const closeIcon = document.querySelector('[data-menu-close]');
        const accountToggle = document.querySelector('[data-account-toggle]');
        const accountMenu = document.querySelector('[data-account-menu]');
        const chevron = document.querySelector('[data-account-chevron]');

        if (toggle && menu) {
            toggle.addEventListener('click', () => {
                const isOpen = toggle.getAttribute('aria-expanded') === 'true';
                toggle.setAttribute('aria-expanded', String(!isOpen));
                menu.classList.toggle('hidden', isOpen);
                openIcon?.classList.toggle('hidden', !isOpen);
                closeIcon?.classList.toggle('hidden', isOpen);
            });
        }

        if (accountToggle && accountMenu) {
            accountToggle.addEventListener('click', (event) => {
                event.stopPropagation();
                const isOpen = accountToggle.getAttribute('aria-expanded') === 'true';
                accountToggle.setAttribute('aria-expanded', String(!isOpen));
                accountMenu.classList.toggle('hidden', isOpen);
                chevron?.classList.toggle('rotate-180', !isOpen);
            });

            document.addEventListener('click', () => {
                accountToggle.setAttribute('aria-expanded', 'false');
                accountMenu.classList.add('hidden');
                chevron?.classList.remove('rotate-180');
            });
        }
    })();
</script>
