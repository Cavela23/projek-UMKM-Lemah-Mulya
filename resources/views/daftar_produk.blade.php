<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800">
    @include('components.navbar')

    <main class="mx-auto max-w-7xl px-5 pb-16 pt-[120px] sm:px-8 lg:px-12">
        <div class="mb-8 max-w-2xl">
            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b] sm:text-xs">Jelajahi karya warga</p>
            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-[#073f3b] sm:text-4xl">Temukan produk UMKM Lemahmulya</h1>
            <p class="mt-3 text-sm leading-6 text-slate-500">Dukung usaha lokal dengan menemukan produk pilihan dari pelaku UMKM di sekitar kita.</p>
        </div>

        <form method="GET" action="{{ url('/daftar_produk') }}" class="mb-12 grid max-w-xl grid-cols-[minmax(0,1fr)_auto] overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm focus-within:ring-2 focus-within:ring-[#147b7b]/30">
            <label for="product-search" class="sr-only">Cari produk, kategori, atau UMKM</label>
            <input id="product-search" type="search" name="q" value="{{ request('q') }}" placeholder="Cari produk, kategori, atau UMKM..." class="h-12 min-w-0 border-0 px-4 text-sm outline-none placeholder:text-slate-400">
            <button type="submit" class="h-12 bg-[#147b7b] px-5 text-sm font-semibold text-white transition hover:bg-[#0e6262] focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-white">Cari</button>
        </form>

        @include('components.product-carousel', ['products' => $produks])
    </main>

    @include('components.footer')
</body>

</html>
