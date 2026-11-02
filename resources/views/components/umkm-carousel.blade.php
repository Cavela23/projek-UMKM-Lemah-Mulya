@props(['umkms'])

<section class="relative" data-product-carousel>
    <div class="mb-6 flex items-end justify-between gap-4">
        <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b] sm:text-xs">Kenali tetangga</p>
            <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-[#073f3b] sm:text-3xl">UMKM Lemahmulya</h2>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ url('/daftar_umkm') }}" class="hidden text-sm font-semibold text-[#147b7b] transition hover:text-[#0e6262] sm:inline">Lihat semua</a>
            <div class="hidden gap-2 sm:flex">
                <button type="button" data-carousel-prev class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition hover:border-[#147b7b] hover:text-[#147b7b] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b]" aria-label="UMKM sebelumnya">&larr;</button>
                <button type="button" data-carousel-next class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition hover:border-[#147b7b] hover:text-[#147b7b] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b]" aria-label="UMKM berikutnya">&rarr;</button>
            </div>
        </div>
    </div>

    @if($umkms->isNotEmpty())
        <div data-carousel-track class="flex snap-x snap-mandatory gap-5 overflow-x-auto pb-5 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @foreach($umkms as $umkm)
                <div class="w-[min(84vw,300px)] shrink-0">@include('components.umkm-card', ['umkm' => $umkm])</div>
            @endforeach
        </div>
    @else
        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center text-sm text-slate-500">Belum ada UMKM yang terdaftar.</div>
    @endif
</section>
