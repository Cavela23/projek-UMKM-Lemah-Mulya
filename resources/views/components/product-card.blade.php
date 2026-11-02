@props(['product'])

@php
    $store = $product->user;
    $phone = preg_replace('/[^0-9]/', '', $store->phone ?? '');
    if (str_starts_with($phone, '0')) {
        $phone = '62' . substr($phone, 1);
    }
    $image = $product->foto_produk
        ? asset('profile_photos/' . $product->foto_produk)
        : asset('img/UMKM.png');
@endphp

<article class="group flex h-full min-w-[272px] snap-start flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:min-w-[300px]">
    <div class="relative h-48 overflow-hidden bg-[#edf8f5]">
        <img src="{{ $image }}" alt="{{ $product->nama_produk }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <span class="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1 text-[11px] font-semibold text-[#147b7b] shadow-sm">
            {{ $product->kategori ?: 'Produk lokal' }}
            {{-- Kategori produk: $product->kategori --}}
        </span>
    </div>

    <div class="flex flex-1 flex-col p-5">
        <div class="mb-3 flex items-start justify-between gap-3">
            <div class="min-w-0">
                <p class="truncate text-xs font-medium text-slate-400">
                    {{ $store->nama_umkm ?: ($store->name ?? 'UMKM Lemahmulya') }}
                    {{-- Nama toko: $product->user->nama_umkm --}}
                </p>
                <h3 class="mt-1 line-clamp-2 text-lg font-bold leading-tight text-[#073f3b]">
                    {{ $product->nama_produk }}
                </h3>
            </div>
            @if($product->harga !== null)
                <p class="shrink-0 text-sm font-bold text-[#147b7b]">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
            @endif
        </div>

        <p class="line-clamp-2 text-sm leading-5 text-slate-500">
            {{ $product->deskripsi ?: 'Produk pilihan karya pelaku UMKM Lemahmulya.' }}
            {{-- Deskripsi produk: $product->deskripsi --}}
        </p>

        <div class="mt-auto flex items-center gap-1.5 pt-4 text-xs text-slate-400">
            <svg class="h-4 w-4 shrink-0 text-[#147b7b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z" />
                <circle cx="12" cy="9" r="2.2" stroke-width="1.8" />
            </svg>
            <span class="truncate">{{ $store->alamat_umkm ?: 'Lemahmulya' }}</span>
            {{-- Lokasi toko: $product->user->alamat_umkm --}}
        </div>

        <a href="{{ $phone ? 'https://wa.me/' . $phone : url('detail_umkm/' . ($store->id ?? '')) }}" target="{{ $phone ? '_blank' : '_self' }}" rel="{{ $phone ? 'noopener noreferrer' : '' }}" class="mt-4 inline-flex h-10 items-center justify-center rounded-lg bg-[#147b7b] px-4 text-sm font-semibold text-white transition hover:bg-[#0e6262] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b] focus-visible:ring-offset-2">
            {{ $phone ? 'Hubungi penjual' : 'Lihat detail' }}
        </a>
    </div>
</article>
