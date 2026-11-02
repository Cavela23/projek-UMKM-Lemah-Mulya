@php
    $isAdmin = isset($user) && $user && $user->role === 'admin';
    $profileName = isset($user) && $user ? ($user->nama_umkm ?: $user->name) : 'Profil pengguna';
    $profileImage = isset($user) && $user && $user->profile_photo
        ? asset('profile_photos/' . $user->profile_photo)
        : asset('img/user_icon.png');
    $initials = collect(explode(' ', trim($user->name ?? 'PU')))
        ->filter()
        ->take(2)
        ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
        ->implode('');
    $productsQuery = \App\Models\Produk::with('user');
    if (!$isAdmin && isset($user) && $user) {
        $productsQuery->where('user_id', $user->id);
    }
    $products = $productsQuery
        ->when(request('search_produk'), function ($query, $search) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        })
        ->latest()
        ->get();
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil pengguna - UMKM Lemahmulya</title>
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
            <nav class="flex-1 space-y-1 px-4 py-7" aria-label="Navigasi profil">
                <p class="px-3 pb-3 text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Menu utama</p>
                <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-slate-500 transition hover:bg-[#eff9f7] hover:text-[#147b7b]">
                    <span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs">⌂</span> Beranda
                </a>
                <a href="{{ route('umkm.edit') }}" class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-slate-500 transition hover:bg-[#eff9f7] hover:text-[#147b7b]">
                    <span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs">▦</span> Profil UMKM
                </a>
                <a href="{{ url('profile_page?tab=produk') }}" class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-slate-500 transition hover:bg-[#eff9f7] hover:text-[#147b7b]">
                    <span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs">◫</span> Produk saya
                </a>
                <p class="px-3 pb-2 pt-8 text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Akun</p>
                <a href="{{ url('profile_page') }}" class="flex items-center gap-3 rounded-lg bg-[#e8f6f3] px-3 py-3 text-sm font-bold text-[#147b7b]">
                    <span class="flex h-7 w-7 items-center justify-center rounded-md bg-[#147b7b] text-xs text-white">◎</span> Profil pengguna
                </a>
            </nav>
            <div class="border-t border-[#edf3f1] p-4">
                <form method="POST" action="{{ url('logout') }}">
                    @csrf
                    <button class="flex w-full items-center gap-3 rounded-lg px-3 py-3 text-left text-sm font-medium text-slate-500 transition hover:bg-red-50 hover:text-red-600">
                        <span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs">↪</span> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="flex h-[84px] items-center justify-between border-b border-[#e5eeec] bg-white px-5 sm:px-8 lg:px-11">
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" class="lg:hidden">
                        <img src="{{ asset('img/logo-web-umkm.png') }}" alt="Beranda" class="h-9 w-9 object-contain">
                    </a>
                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#147b7b]">Akun saya</p>
                        <h1 class="mt-1 text-xl font-extrabold text-[#073f3b] sm:text-2xl">Profil pengguna</h1>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" class="hidden text-sm font-medium text-slate-400 transition hover:text-[#147b7b] sm:block">Kembali ke beranda</a>
                    <div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-full bg-[#dcefeb] text-sm font-bold text-[#147b7b]">
                        @if(isset($user) && $user && $user->profile_photo)
                            <img src="{{ $profileImage }}" alt="{{ $profileName }}" class="h-full w-full object-cover">
                        @else
                            {{ $initials ?: 'PU' }}
                        @endif
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-[1180px] px-5 py-7 sm:px-8 sm:py-10 lg:px-11">
                @if(session('success'))
                    <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <ul class="list-inside list-disc space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <section class="rounded-xl border border-[#e0ece9] bg-white p-5 shadow-[0_2px_12px_rgba(27,74,70,0.04)] sm:p-7">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-4">
                            <div class="relative flex h-[68px] w-[68px] shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#e2f1ee] text-xl font-extrabold text-[#147b7b]">
                                @if(isset($user) && $user && $user->profile_photo)
                                    <img src="{{ $profileImage }}" alt="{{ $profileName }}" class="h-full w-full object-cover">
                                @else
                                    {{ $initials ?: 'PU' }}
                                @endif
                                @if(!$isAdmin && isset($user) && $user)
                                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="absolute inset-0">
                                        @csrf
                                        @method('PUT')
                                        <label for="profile-photo" class="flex h-full w-full cursor-pointer items-end justify-end p-1.5">
                                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-[#147b7b] text-xs text-white shadow">✎</span>
                                            <input type="file" id="profile-photo" name="profile_photo" accept="image/*" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                @endif
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">{{ $isAdmin ? 'Administrator' : 'Pelaku usaha' }}</p>
                                <h2 class="mt-1 text-xl font-extrabold text-[#073f3b]">{{ $profileName }}</h2>
                                <p class="mt-1 text-sm text-slate-400">{{ $user->email ?? 'email@umkm.local' }}</p>
                            </div>
                        </div>
                        @if(!$isAdmin)
                            <a href="{{ url('umkm/edit') }}" class="inline-flex h-10 items-center justify-center rounded-lg border border-[#147b7b] px-4 text-sm font-semibold text-[#147b7b] transition hover:bg-[#147b7b] hover:text-white">Edit profil usaha</a>
                        @endif
                    </div>
                </section>

                <div class="mt-7 border-b border-[#dfeae8]">
                    <nav class="flex gap-7 overflow-x-auto" aria-label="Tab profil">
                        @if($isAdmin)
                            <button type="button" data-tab="umkm" class="whitespace-nowrap border-b-2 border-[#147b7b] pb-3 text-sm font-bold text-[#147b7b]">Kelola UMKM</button>
                            <button type="button" data-tab="produk" class="whitespace-nowrap border-b-2 border-transparent pb-3 text-sm font-semibold text-slate-400 transition hover:text-[#147b7b]">Daftar produk</button>
                        @else
                            <button type="button" data-tab="overview" class="whitespace-nowrap border-b-2 border-[#147b7b] pb-3 text-sm font-bold text-[#147b7b]">Profil pengguna</button>
                            <button type="button" data-tab="produk" class="whitespace-nowrap border-b-2 border-transparent pb-3 text-sm font-semibold text-slate-400 transition hover:text-[#147b7b]">Produk saya</button>
                        @endif
                    </nav>
                </div>

                @if($isAdmin)
                    <section data-section="umkm" class="mt-7">
                        @php
                            $adminUmkms = \App\Models\User::whereIn('role', ['user', 'umkm'])
                                ->when(request('search'), function ($query, $search) {
                                    $query->where(function ($nested) use ($search) {
                                        $nested->where('nama_umkm', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->orWhere('kategori_umkm', 'like', '%' . $search . '%');
                                    });
                                })->get();
                        @endphp
                        <div class="mb-5 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                            <div><p class="text-[10px] font-bold uppercase tracking-[0.16em] text-[#147b7b]">Administrasi</p><h2 class="mt-1 text-2xl font-extrabold text-[#073f3b]">Daftar UMKM</h2></div>
                            <form method="GET" class="flex w-full max-w-sm gap-2"><input type="search" name="search" value="{{ request('search') }}" placeholder="Cari UMKM..." class="h-10 min-w-0 flex-1 rounded-lg border border-slate-200 bg-white px-3 text-sm outline-none focus:border-[#147b7b]"><button class="rounded-lg bg-[#147b7b] px-4 text-sm font-semibold text-white">Cari</button></form>
                        </div>
                        <div class="overflow-x-auto rounded-xl border border-[#e0ece9] bg-white"><table class="w-full min-w-[680px] text-left text-sm"><thead class="bg-[#f1f8f6] text-xs uppercase tracking-wide text-[#147b7b]"><tr><th class="px-5 py-4">Nama UMKM</th><th class="px-5 py-4">Email</th><th class="px-5 py-4">Kategori</th><th class="px-5 py-4">Aksi</th></tr></thead><tbody class="divide-y divide-slate-100">@forelse($adminUmkms as $umkm)<tr class="hover:bg-slate-50"><td class="px-5 py-4 font-semibold text-[#073f3b]">{{ $umkm->nama_umkm ?: $umkm->name }}</td><td class="px-5 py-4 text-slate-500">{{ $umkm->email }}</td><td class="px-5 py-4 text-slate-500">{{ $umkm->kategori_umkm ?: '-' }}</td><td class="px-5 py-4"><form method="POST" action="{{ url('umkm/' . $umkm->id) }}" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">@csrf @method('DELETE')<button class="font-semibold text-red-500 hover:text-red-700">Hapus</button></form></td></tr>@empty<tr><td colspan="4" class="px-5 py-12 text-center text-slate-400">Belum ada UMKM.</td></tr>@endforelse</tbody></table></div>
                    </section>
                @else
                    <section data-section="overview" class="mt-7">
                        <div class="mb-5"><p class="text-[10px] font-bold uppercase tracking-[0.16em] text-[#147b7b]">Informasi akun</p><h2 class="mt-1 text-2xl font-extrabold text-[#073f3b]">Informasi profil</h2></div>
                        <div class="grid gap-5 lg:grid-cols-[1.35fr_0.65fr]">
                            <div class="rounded-xl border border-[#e0ece9] bg-white p-6 shadow-[0_2px_12px_rgba(27,74,70,0.04)]">
                                <div class="grid gap-6 sm:grid-cols-2">
                                    <div><p class="text-xs text-slate-400">Nama lengkap</p><p class="mt-2 text-sm font-bold text-[#073f3b]">{{ $user->name ?? 'Belum diisi' }}</p></div>
                                    <div><p class="text-xs text-slate-400">Nomor telepon</p><p class="mt-2 text-sm font-bold text-[#073f3b]">{{ $user->phone ?? 'Belum diisi' }}</p></div>
                                    <div><p class="text-xs text-slate-400">Email</p><p class="mt-2 text-sm font-bold text-[#073f3b]">{{ $user->email ?? 'Belum diisi' }}</p></div>
                                    <div><p class="text-xs text-slate-400">Kategori usaha</p><p class="mt-2 text-sm font-bold text-[#073f3b]">{{ $user->kategori_umkm ?? 'Belum diisi' }}</p></div>
                                </div>
                                <div class="mt-7 border-t border-slate-100 pt-6"><p class="text-xs text-slate-400">Deskripsi usaha</p><p class="mt-2 text-sm leading-6 text-slate-600">{{ $user->deskripsi_umkm ?? 'Tambahkan deskripsi usaha Anda agar lebih mudah dikenal warga.' }}</p></div>
                            </div>
                            <div class="rounded-xl border border-[#e0ece9] bg-white p-6 shadow-[0_2px_12px_rgba(27,74,70,0.04)]">
                                <div class="flex items-center justify-between"><h3 class="font-bold text-[#073f3b]">Aktivitas akun</h3><span class="h-2 w-2 rounded-full bg-emerald-500"></span></div>
                                <div class="mt-6 space-y-5 text-sm"><div><p class="text-xs text-slate-400">Status akun</p><p class="mt-1 font-bold text-emerald-600">Aktif</p></div><div><p class="text-xs text-slate-400">Alamat usaha</p><p class="mt-1 font-semibold leading-5 text-[#073f3b]">{{ $user->alamat_umkm ?? 'Belum diisi' }}</p></div><div><p class="text-xs text-slate-400">Peran</p><p class="mt-1 font-semibold text-[#073f3b]">Pelaku usaha</p></div></div>
                            </div>
                        </div>
                        <div class="mt-7 rounded-xl border border-[#e0ece9] bg-white p-6 shadow-[0_2px_12px_rgba(27,74,70,0.04)]"><div class="flex items-center justify-between"><div><p class="text-[10px] font-bold uppercase tracking-[0.16em] text-[#147b7b]">Usaha yang Anda kelola</p><h2 class="mt-1 text-xl font-extrabold text-[#073f3b]">{{ $profileName }}</h2></div><a href="{{ route('umkm.edit') }}" class="text-sm font-bold text-[#147b7b] hover:underline">Edit</a></div><div class="mt-5 flex flex-col gap-4 rounded-lg bg-[#f4faf8] p-4 sm:flex-row sm:items-center"><div class="h-20 w-24 shrink-0 overflow-hidden rounded-lg bg-[#dcefeb]"><img src="{{ $profileImage }}" alt="{{ $profileName }}" class="h-full w-full object-cover"></div><div class="min-w-0"><p class="text-sm font-bold text-[#073f3b]">{{ $profileName }}</p><p class="mt-1 text-xs text-slate-500">{{ $user->kategori_umkm ?? 'Kategori usaha' }} · {{ $user->alamat_umkm ?? 'Lemahmulya' }}</p><p class="mt-2 line-clamp-2 text-xs leading-5 text-slate-500">{{ $user->deskripsi_umkm ?? 'Belum ada deskripsi usaha.' }}</p></div><a href="{{ route('umkm.edit') }}" class="sm:ml-auto inline-flex h-9 shrink-0 items-center justify-center rounded-lg bg-[#147b7b] px-4 text-xs font-bold text-white hover:bg-[#0e6262]">Profil usaha</a></div></div>
                    </section>
                @endif

                <section data-section="produk" class="mt-7 hidden">
                    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-[#147b7b]">Katalog usaha</p>
                            <h2 class="mt-1 text-2xl font-extrabold text-[#073f3b]">Produk saya</h2>
                            <p class="mt-2 text-sm text-slate-400">Kelola semua produk yang ditampilkan dari {{ $profileName }}.</p>
                        </div>
                        @if(!$isAdmin)
                            <button type="button" data-open-product-modal class="inline-flex h-10 items-center justify-center rounded-lg bg-[#147b7b] px-4 text-sm font-bold text-white shadow-sm transition hover:bg-[#0e6262]">+ Tambah produk</button>
                        @endif
                    </div>

                    <div class="rounded-xl border border-[#e0ece9] bg-white p-5 shadow-[0_2px_12px_rgba(27,74,70,0.04)] sm:p-6">
                        <div class="mb-5 flex flex-col justify-between gap-3 border-b border-slate-100 pb-5 sm:flex-row sm:items-center">
                            <div>
                                <h3 class="font-bold text-[#073f3b]">Daftar produk</h3>
                                <p class="mt-1 text-xs text-slate-400">{{ $products->count() }} produk tersedia</p>
                            </div>
                            <form method="GET" class="flex gap-2">
                                <input type="hidden" name="tab" value="produk">
                                <input type="search" name="search_produk" value="{{ request('search_produk') }}" placeholder="Cari produk..." class="h-10 w-full rounded-lg border border-slate-200 bg-[#fbfdfc] px-3 text-sm outline-none transition focus:border-[#147b7b] sm:w-56">
                                <button class="rounded-lg border border-[#147b7b] px-4 text-sm font-semibold text-[#147b7b] transition hover:bg-[#eaf6f3]">Cari</button>
                            </form>
                        </div>

                        <div class="space-y-3">
                            @forelse($products as $product)
                                @php
                                    $productImage = $product->foto_produk
                                        ? asset('profile_photos/' . $product->foto_produk)
                                        : asset('img/UMKM.png');
                                @endphp
                                <article class="group flex flex-col gap-4 rounded-lg border border-slate-100 bg-[#fbfdfc] p-3 transition hover:border-[#b8ded7] hover:bg-[#f5fbf9] sm:flex-row sm:items-center sm:p-4">
                                    <div class="h-28 w-full shrink-0 overflow-hidden rounded-lg bg-[#e6f3f0] sm:h-24 sm:w-28">
                                        <img src="{{ $productImage }}" alt="{{ $product->nama_produk }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-start justify-between gap-2">
                                            <div>
                                                <span class="inline-flex rounded-full bg-[#e2f2ef] px-2.5 py-1 text-[10px] font-bold text-[#147b7b]">{{ $product->kategori ?: 'Produk lokal' }}</span>
                                                <h3 class="mt-2 text-base font-extrabold text-[#073f3b]">{{ $product->nama_produk }}</h3>
                                            </div>
                                            @if($product->harga !== null)
                                                <p class="text-sm font-extrabold text-[#147b7b]">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                            @endif
                                        </div>
                                        <p class="mt-2 line-clamp-2 text-sm leading-5 text-slate-500">{{ $product->deskripsi ?: 'Belum ada deskripsi produk.' }}</p>
                                    </div>
                                    <div class="flex shrink-0 gap-2 sm:flex-col">
                                        <a href="{{ url('produk/edit/' . $product->id) }}" class="inline-flex h-9 flex-1 items-center justify-center rounded-lg border border-[#147b7b] px-3 text-xs font-bold text-[#147b7b] transition hover:bg-[#e2f2ef] sm:flex-none">Edit</a>
                                        <form method="POST" action="{{ route('produk.destroy', $product->id) }}" onsubmit="return confirm('Hapus produk ini?')" class="flex-1 sm:flex-none">
                                            @csrf
                                            @method('DELETE')
                                            <button class="inline-flex h-9 w-full items-center justify-center rounded-lg border border-red-200 px-3 text-xs font-bold text-red-500 transition hover:bg-red-50">Hapus</button>
                                        </form>
                                    </div>
                                </article>
                            @empty
                                <div class="rounded-lg border border-dashed border-slate-200 bg-[#fbfdfc] px-6 py-14 text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#e2f2ef] text-xl text-[#147b7b]">◫</div>
                                    <h3 class="mt-4 font-bold text-[#073f3b]">Belum ada produk</h3>
                                    <p class="mt-1 text-sm text-slate-400">Tambahkan produk pertama untuk menampilkannya di katalog usaha.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    @if(!$isAdmin)
        <div id="product-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-[#073f3b]/40 px-5 py-8">
            <div class="max-h-full w-full max-w-lg overflow-y-auto rounded-xl bg-white p-6 shadow-2xl sm:p-8">
                <div class="flex items-start justify-between"><div><p class="text-[10px] font-bold uppercase tracking-[0.16em] text-[#147b7b]">Karya baru</p><h2 class="mt-1 text-2xl font-extrabold text-[#073f3b]">Tambah produk</h2></div><button type="button" data-close-product-modal class="text-2xl text-slate-400 hover:text-slate-700" aria-label="Tutup">&times;</button></div>
                <form method="POST" action="{{ url('tambah-produk') }}" enctype="multipart/form-data" class="mt-6 space-y-4">@csrf<div><label class="mb-1.5 block text-sm font-semibold text-[#073f3b]">Nama produk</label><input type="text" name="nama_produk" required class="h-11 w-full rounded-lg border border-slate-200 px-3 text-sm"></div><div class="grid gap-4 sm:grid-cols-2"><div><label class="mb-1.5 block text-sm font-semibold text-[#073f3b]">Harga</label><input type="number" name="harga" required class="h-11 w-full rounded-lg border border-slate-200 px-3 text-sm"></div><div><label class="mb-1.5 block text-sm font-semibold text-[#073f3b]">Kategori</label><input type="text" name="kategori" required class="h-11 w-full rounded-lg border border-slate-200 px-3 text-sm"></div></div><div><label class="mb-1.5 block text-sm font-semibold text-[#073f3b]">Deskripsi</label><textarea name="deskripsi" rows="4" required class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm"></textarea></div><div><label class="mb-1.5 block text-sm font-semibold text-[#073f3b]">Foto produk</label><input type="file" name="foto_produk" accept="image/*" class="block w-full rounded-lg border border-slate-200 px-3 py-2 text-sm"></div><div class="flex justify-end gap-3 pt-2"><button type="button" data-close-product-modal class="rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-500 hover:bg-slate-100">Batal</button><button type="submit" class="rounded-lg bg-[#147b7b] px-5 py-2.5 text-sm font-bold text-white">Simpan produk</button></div></form>
            </div>
        </div>
    @endif

    <script>
        (() => {
            const tabs = [...document.querySelectorAll('[data-tab]')];
            const sections = [...document.querySelectorAll('[data-section]')];
            const activate = (name) => {
                tabs.forEach((tab) => {
                    const active = tab.dataset.tab === name;
                    tab.classList.toggle('border-[#147b7b]', active);
                    tab.classList.toggle('text-[#147b7b]', active);
                    tab.classList.toggle('font-bold', active);
                    tab.classList.toggle('border-transparent', !active);
                    tab.classList.toggle('text-slate-400', !active);
                });
                sections.forEach((section) => section.classList.toggle('hidden', section.dataset.section !== name));
            };
            tabs.forEach((tab) => tab.addEventListener('click', () => activate(tab.dataset.tab)));
            const requestedTab = new URLSearchParams(window.location.search).get('tab');
            if (requestedTab && tabs.some((tab) => tab.dataset.tab === requestedTab)) {
                activate(requestedTab);
            }
            const modal = document.getElementById('product-modal');
            document.querySelector('[data-open-product-modal]')?.addEventListener('click', () => modal?.classList.replace('hidden', 'flex'));
            document.querySelectorAll('[data-close-product-modal]').forEach((button) => button.addEventListener('click', () => modal?.classList.replace('flex', 'hidden')));
        })();
    </script>
</body>
</html>
