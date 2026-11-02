<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar UMKM Lemahmulya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800">
    @include('components.navbar')

    <main class="mx-auto max-w-7xl px-5 pb-16 pt-[112px] sm:px-8 lg:px-12">
        <div class="mb-5 flex items-center justify-between text-[11px] text-slate-400 sm:text-xs">
            <span class="inline-flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5 text-[#147b7b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z" />
                    <circle cx="12" cy="9" r="2.2" stroke-width="1.8" />
                </svg>
                Dari warga, untuk Lemahmulya.
            </span>
            <span class="hidden sm:inline">Data contoh</span>
        </div>

        <section class="rounded-[22px] border border-[#d6e8e4] bg-[#edf8f5] px-6 py-8 sm:px-10 sm:py-10">
            <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b] sm:text-xs">Ruang usaha lokal</p>
                    <h1 class="mt-2 max-w-2xl text-3xl font-extrabold leading-tight tracking-tight text-[#073f3b] sm:text-4xl">Temukan usaha lokal Lemahmulya.</h1>
                    <p class="mt-3 max-w-xl text-sm leading-6 text-slate-500 sm:text-base">Kenali usaha di sekitar kita dan dukung produk karya warga desa.</p>
                </div>
                <span class="hidden rounded-full bg-white px-3 py-1.5 text-[10px] font-medium text-slate-500 shadow-sm lg:inline-flex">{{ $umkms->count() }} usaha terdaftar</span>
            </div>

            <form method="GET" action="{{ url('/daftar_umkm') }}" class="mt-7 grid max-w-2xl grid-cols-[minmax(0,1fr)_auto] overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm focus-within:ring-2 focus-within:ring-[#147b7b]/30">
                <label for="umkm-search" class="sr-only">Cari usaha lokal</label>
                <div class="flex min-w-0 items-center gap-2 px-3 sm:px-4">
                    <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m2.1-5.15a7.25 7.25 0 1 1-14.5 0 7.25 7.25 0 0 1 14.5 0Z" />
                    </svg>
                    <input id="umkm-search" type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama usaha, kategori, atau lokasi..." class="h-12 min-w-0 w-full border-0 bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                </div>
                <button type="submit" class="h-12 min-w-[68px] bg-[#147b7b] px-4 text-sm font-semibold text-white transition hover:bg-[#0e6262] focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-white">Cari</button>
            </form>
        </section>

        <section class="mt-8">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-extrabold tracking-tight text-[#073f3b]">Pilih kategori usaha</h2>
                <a href="{{ url('/daftar_umkm') }}" class="text-xs font-semibold text-[#147b7b] transition hover:text-[#0e6262] sm:text-sm">Reset filter</a>
            </div>
            <div class="flex gap-3 overflow-x-auto pb-2 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <a href="{{ url('/daftar_umkm') }}" class="inline-flex min-w-max items-center gap-2 rounded-xl border px-4 py-3 text-sm font-semibold transition {{ request('q') ? 'border-slate-200 bg-white text-slate-600 hover:border-[#147b7b] hover:bg-[#edf8f5] hover:text-[#147b7b]' : 'border-[#147b7b] bg-[#147b7b] text-white' }}">
                    <span aria-hidden="true">▦</span> Semua usaha
                </a>
                @forelse($categories as $category)
                    <a href="{{ url('/daftar_umkm') . '?q=' . urlencode($category) }}" class="inline-flex min-w-max items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 shadow-sm transition hover:border-[#147b7b] hover:bg-[#edf8f5] hover:text-[#147b7b]">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-[#edf8f5] text-xs font-bold text-[#147b7b]">{{ strtoupper(substr($category, 0, 1)) }}</span>
                        {{ $category }}
                    </a>
                @empty
                    <span class="py-3 text-sm text-slate-400">Belum ada kategori usaha.</span>
                @endforelse
            </div>
        </section>

        <section class="mt-10">
            <div class="mb-6 flex items-end justify-between gap-4">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b] sm:text-xs">Kenali tetangga</p>
                    <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-[#073f3b] sm:text-3xl">Usaha lokal Lemahmulya</h2>
                </div>
                <span class="text-xs text-slate-400 sm:text-sm">{{ $umkms->count() }} hasil</span>
            </div>

            @if($umkms->isNotEmpty())
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($umkms as $umkm)
                        @include('components.umkm-card', ['umkm' => $umkm])
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-16 text-center">
                    <h3 class="font-bold text-[#073f3b]">Usaha tidak ditemukan</h3>
                    <p class="mt-2 text-sm text-slate-500">Coba gunakan kata kunci pencarian yang berbeda.</p>
                    <a href="{{ url('/daftar_umkm') }}" class="mt-5 inline-flex rounded-lg bg-[#147b7b] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#0e6262]">Lihat semua usaha</a>
                </div>
            @endif
        </section>
    </main>

    @include('components.footer')
</body>

</html>
