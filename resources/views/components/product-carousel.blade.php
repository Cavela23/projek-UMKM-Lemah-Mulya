@props(['products'])

<section class="relative" data-product-carousel>
    <div class="mb-6 flex items-end justify-between gap-4">
        <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#147b7b] sm:text-xs">Pilihan warga</p>
            <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-[#073f3b] sm:text-3xl">Produk lokal Lemahmulya</h2>
        </div>
        <div class="hidden gap-2 sm:flex">
            <button type="button" data-carousel-prev class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition hover:border-[#147b7b] hover:text-[#147b7b] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b]" aria-label="Produk sebelumnya">
                <span aria-hidden="true">&larr;</span>
            </button>
            <button type="button" data-carousel-next class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition hover:border-[#147b7b] hover:text-[#147b7b] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b]" aria-label="Produk berikutnya">
                <span aria-hidden="true">&rarr;</span>
            </button>
        </div>
    </div>

    @if($products->isNotEmpty())
        <div data-carousel-track class="flex snap-x snap-mandatory gap-5 overflow-x-auto pb-5 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @foreach($products as $product)
                <div class="w-[min(84vw,300px)] shrink-0">
                    @include('components.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    @else
        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center text-sm text-slate-500">
            Belum ada produk yang tersedia.
        </div>
    @endif
</section>

<script>
    document.querySelectorAll('[data-product-carousel]').forEach((carousel) => {
        const track = carousel.querySelector('[data-carousel-track]');
        const previous = carousel.querySelector('[data-carousel-prev]');
        const next = carousel.querySelector('[data-carousel-next]');

        if (!track || !previous || !next) return;

        const scrollAmount = () => Math.min(track.clientWidth * 0.85, 320);
        previous.addEventListener('click', () => track.scrollBy({ left: -scrollAmount(), behavior: 'smooth' }));
        next.addEventListener('click', () => track.scrollBy({ left: scrollAmount(), behavior: 'smooth' }));
    });
</script>
