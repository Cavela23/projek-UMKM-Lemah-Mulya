<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Lemahmulya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800">
    @include('components.navbar')

    <!-- Hero Section -->
    <section class="bg-white px-5 pb-10 pt-[112px] sm:px-8 lg:px-12 lg:pb-14">
        <div class="mx-auto max-w-[1240px]">
            <div class="mb-4 flex items-center justify-between px-1 text-[11px] text-slate-400 sm:text-xs">
                <span class="inline-flex items-center gap-1.5">
                    <svg class="h-3.5 w-3.5 text-[#147b7b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z" />
                        <circle cx="12" cy="9" r="2.2" stroke-width="1.8" />
                    </svg>
                    Dari warga, untuk Lemahmulya.
                </span>
            </div>

            <div class="grid overflow-hidden rounded-[22px] border border-[#d6e8e4] bg-[#edf8f5] shadow-sm lg:grid-cols-12">
                <div class="flex flex-col justify-center px-6 py-9 sm:px-10 sm:py-12 lg:col-span-7 lg:px-12 lg:py-14">
                    <p class="mb-3 text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b] sm:text-xs">Kenali tetangga, dukung usahanya</p>
                    <h1 class="max-w-xl text-3xl font-extrabold leading-[1.08] tracking-tight text-[#073f3b] sm:text-4xl lg:text-[48px]">
                        Temukan yang istimewa,<br class="hidden sm:block"> dari Lemahmulya.
                    </h1>
                    <p class="mt-4 max-w-lg text-sm leading-6 text-slate-500 sm:text-base">
                        Jelajahi usaha, produk, dan karya warga. Belanja dekat, manfaatnya untuk masyarakat.
                    </p>

                    <form method="GET" action="{{ url('/daftar_umkm') }}" class="mt-7 grid w-full grid-cols-[minmax(0,1fr)_auto] items-stretch overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm focus-within:ring-2 focus-within:ring-[#147b7b]/30">
                        <label for="hero-search" class="sr-only">Cari usaha atau produk lokal</label>
                        <div class="flex min-w-0 items-center gap-2 px-3 sm:px-4">
                            <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m2.1-5.15a7.25 7.25 0 1 1-14.5 0 7.25 7.25 0 0 1 14.5 0Z" />
                            </svg>
                            <input id="hero-search" type="search" name="q" value="{{ request('q') }}" placeholder="Cari usaha atau produk lokal..." class="h-12 min-w-0 w-full border-0 bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                        </div>
                        <button type="submit" class="h-12 min-w-[68px] bg-[#147b7b] px-4 text-sm font-semibold text-white transition hover:bg-[#0e6262] focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-white">
                            Cari
                        </button>
                    </form>
                </div>

                <div class="relative min-h-[230px] lg:col-span-5 lg:min-h-[390px]">
                    <img src="{{ asset('img/latar.jpg') }}" alt="Aktivitas warga di lahan pertanian Lemahmulya" class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#edf8f5]/30 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 rounded-full bg-white/90 px-3 py-1.5 text-[10px] font-medium text-slate-600 shadow-sm backdrop-blur-sm sm:left-6">
                        ♡ Karya lokal, cerita kita.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="bg-white px-5 pb-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-[1240px]">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-bold text-[#073f3b] sm:text-xl">Jelajahi kategori usaha</h2>
                <a href="{{ url('/daftar_umkm') }}" class="text-xs font-semibold text-[#147b7b] hover:text-[#0e6262] sm:text-sm">Semua kategori</a>
            </div>
            <div class="flex gap-3 overflow-x-auto pb-2 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                @forelse($categories as $category)
                    <a href="{{ url('/daftar_umkm') . '?q=' . urlencode($category) }}" class="inline-flex min-w-max items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 shadow-sm transition hover:border-[#147b7b] hover:bg-[#edf8f5] hover:text-[#147b7b]">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#edf8f5] text-xs font-bold text-[#147b7b]">{{ strtoupper(substr($category, 0, 1)) }}</span>
                        {{ $category }}
                    </a>
                @empty
                    <span class="text-sm text-slate-400">Kategori usaha akan tampil setelah data UMKM tersedia.</span>
                @endforelse
            </div>
        </div>
    </section>

    <!-- UMKM Carousel -->
    <section class="bg-white px-5 py-10 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-[1240px]">
            @include('components.umkm-carousel', ['umkms' => $umkms->take(8)])
        </div>
    </section>

    <!-- Product Carousel -->
    <section class="bg-[#f8fbfa] px-5 py-10 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-[1240px]">
            @include('components.product-carousel', ['products' => $products])
        </div>
    </section>

    @include('components.footer')

</body>

</html>
