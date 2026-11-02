@php
    $umkmImage = $umkm->profile_photo
        ? asset('profile_photos/' . $umkm->profile_photo)
        : asset('img/UMKM.png');
    $phone = preg_replace('/[^0-9]/', '', $umkm->phone ?? '');
    if (str_starts_with($phone, '0')) {
        $phone = '62' . substr($phone, 1);
    }
    $is
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $umkm->nama_umkm ?: $umkm->name }} - UMKM Lemahmulya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-slate-700">
    @include('components.navbar')

    <main class="mx-auto max-w-7xl px-5 pb-16 pt-[112px] sm:px-8 lg:px-12">
        <nav class="mb-6 flex items-center gap-2 text-xs text-slate-400" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="transition hover:text-[#147b7b]">Beranda</a>
            <span aria-hidden="true">/</span>
            <a href="{{ url('/daftar_umkm') }}" class="transition hover:text-[#147b7b]">UMKM</a>
            <span aria-hidden="true">/</span>
            <span class="truncate text-slate-500">{{ $umkm->nama_umkm ?: $umkm->name }}</span>
        </nav>

        <section class="overflow-hidden rounded-[22px] border border-[#d6e8e4] bg-[#edf8f5]">
            <div class="grid lg:grid-cols-12">
                <div class="relative min-h-[280px] lg:col-span-6 lg:min-h-[390px]">
                    <img src="{{ $umkmImage }}" alt="Foto {{ $umkm->nama_umkm ?: $umkm->name }}" class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    <span class="absolute bottom-5 left-5 rounded-full bg-white/95 px-3 py-1.5 text-xs font-semibold text-[#147b7b] shadow-sm">
                        {{ $umkm->kategori_umkm ?: 'UMKM lokal' }}
                    </span>
                </div>
                <div class="flex flex-col justify-center px-6 py-8 sm:px-10 lg:col-span-6 lg:px-12">
                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b] sm:text-xs">Profil usaha lokal</p>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight tracking-tight text-[#073f3b] sm:text-4xl">
                        {{ $umkm->nama_umkm ?: $umkm->name }}
                    </h1>
                    <p class="mt-4 max-w-xl text-sm leading-6 text-slate-500">
                        {{ $umkm->deskripsi_umkm ?: 'Cerita, karya, dan produk pilihan dari pelaku UMKM Lemahmulya.' }}
                    </p>
                    <div class="mt-5 flex items-center gap-2 text-sm text-slate-500">
                        <svg class="h-4 w-4 shrink-0 text-[#147b7b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z" />
                            <circle cx="12" cy="9" r="2.2" stroke-width="1.8" />
                        </svg>
                        <span>{{ $umkm->alamat_umkm ?: 'Lemahmulya' }}</span>
                    </div>
                    @if($phone)
                        <a href="https://wa.me/{{ $phone }}" target="_blank" rel="noopener noreferrer" class="mt-7 inline-flex h-11 w-full items-center justify-center rounded-lg bg-[#147b7b] px-5 text-sm font-bold text-white transition hover:bg-[#0e6262] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b] focus-visible:ring-offset-2 sm:w-fit">
                            Hubungi {{ $umkm->nama_umkm ?: 'penjual' }}
                            <span class="ml-2 text-lg font-normal" aria-hidden="true">→</span>
                        </a>
                    @endif
                </div>
            </div>
        </section>

        <div class="mt-8 grid gap-8 lg:grid-cols-12">
            <section class="lg:col-span-8">
                <div class="flex gap-6 border-b border-slate-200 text-sm font-semibold">
                    <a href="#tentang" class="border-b-2 border-[#147b7b] pb-3 text-[#147b7b]">Tentang usaha</a>
                    <a href="#produk" class="pb-3 text-slate-400 transition hover:text-[#147b7b]">Produk ({{ $produks->count() }})</a>
                </div>
                <div id="tentang" class="pt-6">
                    <h2 class="text-xl font-extrabold text-[#073f3b]">Cerita dari {{ $umkm->nama_umkm ?: $umkm->name }}</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        {{ $umkm->deskripsi_umkm ?: 'Usaha lokal yang tumbuh bersama masyarakat Desa Lemahmulya. Temukan produk pilihan dan dukung karya warga di sini.' }}
                    </p>
                </div>

                <div id="produk" class="mt-10">
                    <div class="mb-5 flex items-end justify-between gap-4">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b]">Karya pilihan</p>
                            <h2 class="mt-1 text-2xl font-extrabold text-[#073f3b]">Produk dari usaha ini</h2>
                        </div>
                        <span class="text-xs text-slate-400">{{ $produks->count() }} produk</span>
                    </div>
                    @if($produks->isNotEmpty())
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            @foreach($produks as $produk)
                                @include('components.product-card', ['product' => $produk])
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center text-sm text-slate-500">
                            Belum ada produk yang ditambahkan oleh usaha ini.
                        </div>
                    @endif
                </div>
            </section>

            <aside class="h-fit rounded-2xl border border-slate-100 bg-white p-5 shadow-sm lg:col-span-4">
                <h2 class="text-lg font-extrabold text-[#073f3b]">Informasi usaha</h2>
                <dl class="mt-5 space-y-4 text-sm">
                    <div class="flex gap-3">
                        <dt class="w-20 shrink-0 text-slate-400">Kategori</dt>
                        <dd class="font-semibold text-slate-600">{{ $umkm->kategori_umkm ?: 'UMKM lokal' }}</dd>
                    </div>
                    <div class="flex gap-3">
                        <dt class="w-20 shrink-0 text-slate-400">Lokasi</dt>
                        <dd class="font-semibold text-slate-600">{{ $umkm->alamat_umkm ?: 'Lemahmulya' }}</dd>
                    </div>
                    @if($umkm->email)
                        <div class="flex gap-3">
                            <dt class="w-20 shrink-0 text-slate-400">Email</dt>
                            <dd class="break-all font-semibold text-slate-600">{{ $umkm->email }}</dd>
                        </div>
                    @endif
                    @if($umkm->phone)
                        <div class="flex gap-3">
                            <dt class="w-20 shrink-0 text-slate-400">Telepon</dt>
                            <dd class="font-semibold text-slate-600">{{ $umkm->phone }}</dd>
                        </div>
                    @endif
                </dl>
                @if($phone)
                    <a href="https://wa.me/{{ $phone }}" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex w-full items-center justify-center rounded-lg border border-[#147b7b] px-4 py-2.5 text-sm font-semibold text-[#147b7b] transition hover:bg-[#147b7b] hover:text-white">Tanya tentang produk</a>
                @endif
            </aside>
        </div>
    </main>

    @include('components.footer')
</body>

</html>
