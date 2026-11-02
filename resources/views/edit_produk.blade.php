@php
    $user = $produk->user;
    $productImage = $produk->foto_produk
        ? asset('profile_photos/' . $produk->foto_produk)
        : asset('img/UMKM.png');
    $profileImage = $user && $user->profile_photo
        ? asset('profile_photos/' . $user->profile_photo)
        : asset('img/user_icon.png');
    $initials = collect(explode(' ', trim($user->name ?? 'PU')))
        ->filter()
        ->take(2)
        ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
        ->implode('');
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $produk->nama_produk }} - UMKM Lemahmulya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f7faf9] text-[#263b3b]">
    <div class="flex min-h-screen">
        <aside class="hidden w-[238px] shrink-0 border-r border-[#e5eeec] bg-white lg:flex lg:flex-col">
            <a href="{{ url('/') }}" class="flex h-[84px] items-center gap-2 border-b border-[#edf3f1] px-7">
                <img src="{{ asset('img/logo-web-umkm.png') }}" alt="" class="h-10 w-10 object-contain">
                <span class="leading-tight">
                    <strong class="block text-[10px] font-extrabold tracking-tight text-[#073f3b]">UMKM DESA</strong>
                    <strong class="block text-[10px] font-extrabold tracking-tight text-[#073f3b]">LEMAHMULYA</strong>
                    <small class="mt-1 block text-[7px] tracking-[0.13em] text-slate-400">RUANG UMKM LOKAL</small>
                </span>
            </a>
            <nav class="flex-1 space-y-1 px-4 py-7" aria-label="Navigasi produk">
                <p class="px-3 pb-3 text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Menu utama</p>
                <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-slate-500 transition hover:bg-[#eff9f7] hover:text-[#147b7b]"><span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs">⌂</span> Beranda</a>
                <a href="{{ route('umkm.edit') }}" class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-slate-500 transition hover:bg-[#eff9f7] hover:text-[#147b7b]"><span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs">▦</span> Profil UMKM</a>
                <a href="{{ url('profile_page?tab=produk') }}" class="flex items-center gap-3 rounded-lg bg-[#e8f6f3] px-3 py-3 text-sm font-bold text-[#147b7b]"><span class="flex h-7 w-7 items-center justify-center rounded-md bg-[#147b7b] text-xs text-white">◫</span> Produk saya</a>
                <p class="px-3 pb-2 pt-8 text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Akun</p>
                <a href="{{ url('profile_page') }}" class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-slate-500 transition hover:bg-[#eff9f7] hover:text-[#147b7b]"><span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs">◎</span> Profil pengguna</a>
            </nav>
            <div class="border-t border-[#edf3f1] p-4">
                <form method="POST" action="{{ url('logout') }}">@csrf<button class="flex w-full items-center gap-3 rounded-lg px-3 py-3 text-left text-sm font-medium text-slate-500 transition hover:bg-red-50 hover:text-red-600"><span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs">↪</span> Keluar</button></form>
            </div>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="flex h-[84px] items-center justify-between border-b border-[#e5eeec] bg-white px-5 sm:px-8 lg:px-11">
                <div class="flex items-center gap-3">
                    <a href="{{ url('profile_page?tab=produk') }}" class="lg:hidden"><img src="{{ asset('img/logo-web-umkm.png') }}" alt="Produk saya" class="h-9 w-9 object-contain"></a>
                    <div><p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#147b7b]">Katalog usaha</p><h1 class="mt-1 text-xl font-extrabold text-[#073f3b] sm:text-2xl">Edit produk</h1></div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ url('profile_page?tab=produk') }}" class="hidden text-sm font-medium text-slate-400 transition hover:text-[#147b7b] sm:block">Kembali ke produk</a>
                    <div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-full bg-[#dcefeb] text-sm font-bold text-[#147b7b]">
                        @if($user && $user->profile_photo)<img src="{{ $profileImage }}" alt="{{ $user->name }}" class="h-full w-full object-cover">@else{{ $initials ?: 'PU' }}@endif
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-[1050px] px-5 py-7 sm:px-8 sm:py-10 lg:px-11">
                <a href="{{ url('profile_page?tab=produk') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-400 transition hover:text-[#147b7b]">← Kembali ke produk saya</a>
                <div class="mt-6 grid gap-6 lg:grid-cols-[0.72fr_1.28fr]">
                    <section class="rounded-xl border border-[#e0ece9] bg-[#eaf6f3] p-6 sm:p-7">
                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-[#147b7b]">Katalog usaha</p>
                        <h2 class="mt-3 text-2xl font-extrabold leading-tight text-[#073f3b]">Perbarui informasi produk Anda.</h2>
                        <p class="mt-4 text-sm leading-6 text-slate-600">Pastikan foto, harga, dan deskripsi produk selalu sesuai agar pelanggan mendapatkan informasi yang jelas.</p>
                        <div class="mt-8 overflow-hidden rounded-xl bg-white shadow-sm">
                            <div class="h-44 overflow-hidden bg-[#dcefeb]"><img src="{{ $productImage }}" alt="{{ $produk->nama_produk }}" class="h-full w-full object-cover"></div>
                            <div class="p-5">
                                <span class="inline-flex rounded-full bg-[#e2f2ef] px-2.5 py-1 text-[10px] font-bold text-[#147b7b]">{{ $produk->kategori ?: 'Produk lokal' }}</span>
                                <h3 class="mt-3 font-extrabold text-[#073f3b]">{{ $produk->nama_produk }}</h3>
                                @if($produk->harga !== null)<p class="mt-2 text-sm font-extrabold text-[#147b7b]">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>@endif
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-[#e0ece9] bg-white p-6 shadow-[0_2px_12px_rgba(27,74,70,0.04)] sm:p-8">
                        <div class="border-b border-slate-100 pb-5">
                            <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-[#147b7b]">Informasi produk</p>
                            <h2 class="mt-1 text-xl font-extrabold text-[#073f3b]">Edit detail produk</h2>
                            <p class="mt-2 text-sm text-slate-400">Perbarui data yang ingin ditampilkan pada katalog.</p>
                        </div>
                        @if($errors->any())
                            <div class="mt-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"><ul class="list-inside list-disc">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                        @endif
                        <form method="POST" action="{{ url('produk/' . $produk->id . '/update') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
                            @csrf
                            <div><label for="nama_produk" class="mb-2 block text-sm font-semibold text-[#073f3b]">Nama produk</label><input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required class="h-11 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm outline-none transition focus:border-[#147b7b] focus:ring-2 focus:ring-[#147b7b]/15"></div>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div><label for="kategori" class="mb-2 block text-sm font-semibold text-[#073f3b]">Kategori</label><input type="text" id="kategori" name="kategori" value="{{ old('kategori', $produk->kategori) }}" placeholder="Contoh: Makanan" class="h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none transition focus:border-[#147b7b] focus:ring-2 focus:ring-[#147b7b]/15"></div>
                                <div><label for="harga" class="mb-2 block text-sm font-semibold text-[#073f3b]">Harga</label><div class="relative"><span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-sm text-slate-400">Rp</span><input type="number" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" required class="h-11 w-full rounded-lg border border-slate-200 pl-10 pr-3 text-sm outline-none transition focus:border-[#147b7b] focus:ring-2 focus:ring-[#147b7b]/15"></div></div>
                            </div>
                            <div><label for="deskripsi" class="mb-2 block text-sm font-semibold text-[#073f3b]">Deskripsi produk</label><textarea id="deskripsi" name="deskripsi" rows="5" required class="w-full resize-y rounded-lg border border-slate-200 px-3 py-3 text-sm outline-none transition focus:border-[#147b7b] focus:ring-2 focus:ring-[#147b7b]/15">{{ old('deskripsi', $produk->deskripsi) }}</textarea></div>
                            <div><label for="foto_produk" class="mb-2 block text-sm font-semibold text-[#073f3b]">Foto produk</label><label for="foto_produk" class="flex cursor-pointer items-center gap-4 rounded-lg border border-dashed border-[#b8ded7] bg-[#f5fbf9] p-3 transition hover:border-[#147b7b]"><img src="{{ $productImage }}" alt="" class="h-16 w-16 rounded-lg object-cover"><span><span class="block text-sm font-semibold text-[#147b7b]">Ganti foto produk</span><span class="mt-1 block text-xs text-slate-400">JPG, PNG atau GIF maksimal 2MB</span></span><input type="file" id="foto_produk" name="foto_produk" accept="image/*" class="hidden"></label></div>
                            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end"><a href="{{ url('profile_page?tab=produk') }}" class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-200 px-5 text-sm font-semibold text-slate-500 transition hover:bg-slate-50">Batal</a><button type="submit" class="inline-flex h-11 items-center justify-center rounded-lg bg-[#147b7b] px-6 text-sm font-bold text-white shadow-sm transition hover:bg-[#0e6262] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b] focus-visible:ring-offset-2">Simpan perubahan</button></div>
                        </form>
                    </section>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
