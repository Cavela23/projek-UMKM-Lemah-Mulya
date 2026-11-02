@props(['umkm'])

@php
    $image = $umkm->profile_photo
        ? asset('profile_photos/' . $umkm->profile_photo)
        : asset('img/UMKM.png');
@endphp

<article class="group flex h-full min-w-0 snap-start flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
    <div class="relative h-48 overflow-hidden bg-[#edf8f5]">
        <img src="{{ $image }}" alt="{{ $umkm->nama_umkm ?: $umkm->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <span class="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1 text-[11px] font-semibold text-[#147b7b] shadow-sm">
            {{ $umkm->kategori_umkm ?: 'UMKM lokal' }}
            {{-- Kategori usaha: $umkm->kategori_umkm --}}
        </span>
    </div>
    <div class="flex flex-1 flex-col p-5">
        <p class="text-xs font-medium text-slate-400">
            {{ $umkm->nama_umkm ?: $umkm->name }}
            {{-- Nama toko: $umkm->nama_umkm --}}
        </p>
        <h3 class="mt-1 line-clamp-2 text-lg font-bold leading-tight text-[#073f3b]">{{ $umkm->nama_umkm ?: $umkm->name }}</h3>
        <p class="mt-3 line-clamp-2 text-sm leading-5 text-slate-500">
            {{ $umkm->deskripsi_umkm ?: 'Temukan produk dan karya pilihan dari usaha lokal Lemahmulya.' }}
            {{-- Deskripsi usaha: $umkm->deskripsi_umkm --}}
        </p>
        <div class="mt-auto flex items-center gap-1.5 pt-4 text-xs text-slate-400">
            <svg class="h-4 w-4 shrink-0 text-[#147b7b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z" />
                <circle cx="12" cy="9" r="2.2" stroke-width="1.8" />
            </svg>
            <span class="truncate">{{ $umkm->alamat_umkm ?: 'Lemahmulya' }}</span>
            {{-- Lokasi toko: $umkm->alamat_umkm --}}
        </div>
        <a href="{{ url('detail_umkm/' . $umkm->id) }}" class="mt-4 inline-flex h-10 items-center justify-center rounded-lg border border-[#147b7b] px-4 text-sm font-semibold text-[#147b7b] transition hover:bg-[#147b7b] hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b] focus-visible:ring-offset-2">Lihat usaha</a>
    </div>
</article>
