<footer class="bg-white px-5 pb-6 pt-2 sm:px-8 lg:px-12">
    <div class="mx-auto max-w-[1240px]">
        <section class="flex flex-col gap-6 rounded-[22px] bg-[#106b6b] px-5 py-5 text-white sm:flex-row sm:items-center sm:justify-between sm:px-7 sm:py-6">
            <div class="flex items-center gap-4">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/10 text-2xl" aria-hidden="true">⌂</span>
                <div>
                    <h2 class="text-xl font-extrabold tracking-tight sm:text-2xl">Punya usaha di Lemahmulya?</h2>
                    <p class="mt-1 text-xs text-teal-100 sm:text-sm">Mari kenalkan produk Anda ke lebih banyak orang. Mulai dari lingkungan sendiri.</p>
                </div>
            </div>
            <div class="shrink-0 sm:text-right">
                <a href="{{ url('/register') }}" class="inline-flex items-center gap-3 rounded-lg bg-white px-5 py-3 text-sm font-bold text-[#106b6b] shadow-sm transition hover:bg-teal-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-[#106b6b]">
                    Daftar UMKM sekarang
                    <span class="text-lg font-normal leading-none" aria-hidden="true">→</span>
                </a>
                <p class="mt-2 text-[10px] text-teal-100">Gratis dan terbuka untuk usaha lokal</p>
            </div>
        </section>

        <p class="mt-4 text-[10px] text-slate-400 sm:text-xs">
            ⓘ Data contoh — nama usaha, produk, harga, dan agenda hanya ilustrasi, bukan informasi resmi.
        </p>

        <div class="mt-6 flex flex-col gap-3 border-t border-slate-100 pt-4 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ url('/') }}" class="font-bold text-[#073f3b] transition hover:text-[#147b7b]">© 2025 UMKM Lemahmulya Fauzziyan Rachman. All rights reserved. <span class="font-normal text-slate-400">· Tumbuh dari potensi desa.</span></a>
            <nav class="flex flex-wrap gap-x-5 gap-y-2" aria-label="Tautan footer">
                <a href="{{ url('/profile') }}" class="transition hover:text-[#147b7b]">Tentang kami</a>
                <a href="{{ url('/register') }}" class="transition hover:text-[#147b7b]">Panduan daftar</a>
                <a href="{{ url('/daftar_umkm') }}" class="transition hover:text-[#147b7b]">Hubungi kami</a>
            </nav>
        </div>
    </div>
</footer>
