@php
    $store = $produk->user;
    $productImage = $produk->foto_produk
        ? asset('profile_photos/' . $produk->foto_produk)
        : asset('img/UMKM.png');
    $phone = preg_replace('/[^0-9]/', '', $store->phone ?? '');
    if (str_starts_with($phone, '0')) {
        $phone = '62' . substr($phone, 1);
    }
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk }} - UMKM Lemahmulya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-slate-700">
    @include('components.navbar')

    <main class="mx-auto max-w-7xl px-5 pb-16 pt-[112px] sm:px-8 lg:px-12">
        <nav class="mb-6 flex items-center gap-2 text-xs text-slate-400" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="transition hover:text-[#147b7b]">Beranda</a>
            <span aria-hidden="true">/</span>
            <a href="{{ url('/daftar_produk') }}" class="transition hover:text-[#147b7b]">Produk</a>
            <span aria-hidden="true">/</span>
            <span class="truncate text-slate-500">{{ $produk->nama_produk }}</span>
        </nav>

        <section class="grid overflow-hidden rounded-[22px] border border-[#d6e8e4] bg-[#edf8f5] lg:grid-cols-12">
            <div class="relative min-h-[300px] lg:col-span-6 lg:min-h-[440px]">
                <img src="{{ $productImage }}" alt="Foto {{ $produk->nama_produk }}" class="absolute inset-0 h-full w-full object-cover">
                <span class="absolute left-5 top-5 rounded-full bg-white/95 px-3 py-1.5 text-xs font-semibold text-[#147b7b] shadow-sm">
                    {{ $produk->kategori ?: 'Produk lokal' }}
                </span>
            </div>
            <div class="flex flex-col justify-center px-6 py-8 sm:px-10 lg:col-span-6 lg:px-12">
                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b] sm:text-xs">Produk pilihan warga</p>
                <h1 class="mt-3 text-3xl font-extrabold leading-tight tracking-tight text-[#073f3b] sm:text-4xl">{{ $produk->nama_produk }}</h1>
                <p class="mt-4 text-2xl font-extrabold text-[#147b7b]">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                <div class="mt-4 flex items-center gap-2 text-sm text-slate-500">
                    <span class="h-2 w-2 rounded-full bg-[#147b7b]"></span>
                    Dijual oleh <a href="{{ url('detail_umkm/' . $store->id) }}" class="font-semibold text-[#147b7b] hover:text-[#0e6262]">{{ $store->nama_umkm ?: $store->name }}</a>
                </div>
                @if($phone)
                    <a href="https://wa.me/{{ $phone }}" target="_blank" rel="noopener noreferrer" class="mt-7 inline-flex h-11 w-full items-center justify-center rounded-lg bg-[#147b7b] px-5 text-sm font-bold text-white transition hover:bg-[#0e6262] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b] focus-visible:ring-offset-2 sm:w-fit">
                        Hubungi penjual
                        <span class="ml-2 text-lg font-normal" aria-hidden="true">→</span>
                    </a>
                @endif
            </div>
        </section>

        <div class="mt-8 grid gap-8 lg:grid-cols-12">
            <section class="lg:col-span-8">
                <div class="border-b border-slate-200">
                    <h2 class="inline-block border-b-2 border-[#147b7b] pb-3 text-sm font-bold text-[#147b7b]">Detail produk</h2>
                </div>
                <div class="pt-6">
                    <h2 class="text-2xl font-extrabold text-[#073f3b]">Kenal dan nikmati pilihan Anda</h2>
                    <p class="mt-4 whitespace-pre-line text-sm leading-7 text-slate-500">{{ $produk->deskripsi ?: 'Produk pilihan karya pelaku UMKM Lemahmulya.' }}</p>
                </div>
            </section>

            <aside class="h-fit rounded-2xl border border-slate-100 bg-white p-5 shadow-sm lg:col-span-4">
                <h2 class="text-lg font-extrabold text-[#073f3b]">Tentang penjual</h2>
                <div class="mt-5 flex items-center gap-3">
                    <img src="{{ $store->profile_photo ? asset('profile_photos/' . $store->profile_photo) : asset('img/UMKM.png') }}" alt="" class="h-12 w-12 rounded-full object-cover">
                    <div class="min-w-0">
                        <a href="{{ url('detail_umkm/' . $store->id) }}" class="block truncate font-bold text-[#073f3b] hover:text-[#147b7b]">{{ $store->nama_umkm ?: $store->name }}</a>
                        <p class="mt-1 truncate text-xs text-slate-400">{{ $store->alamat_umkm ?: 'Lemahmulya' }}</p>
                    </div>
                </div>
                <a href="{{ url('detail_umkm/' . $store->id) }}" class="mt-5 inline-flex w-full items-center justify-center rounded-lg border border-[#147b7b] px-4 py-2.5 text-sm font-semibold text-[#147b7b] transition hover:bg-[#147b7b] hover:text-white">Lihat profil usaha</a>
            </aside>
        </div>

        @if($produkLainnya->isNotEmpty())
            <section class="mt-12">
                <div class="mb-6 flex items-end justify-between">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b]">Pilihan lainnya</p>
                        <h2 class="mt-1 text-2xl font-extrabold text-[#073f3b]">Produk terkait</h2>
                    </div>
                    <a href="{{ url('/daftar_produk') }}" class="text-sm font-semibold text-[#147b7b] hover:text-[#0e6262]">Lihat semua</a>
                </div>
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($produkLainnya as $relatedProduct)
                        @include('components.product-card', ['product' => $relatedProduct])
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    @include('components.footer')
</body>

</html>
