<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Usaha - UMKM Lemahmulya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f7fbfa] text-slate-700">
    <main class="grid min-h-screen lg:grid-cols-2">
        <section class="flex items-center justify-center px-5 py-10 sm:px-10 lg:order-2 lg:px-16 xl:px-24">
            <div class="w-full max-w-[500px]">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b]" aria-label="Kembali ke beranda">
                    <img src="{{ asset('img/logo-web-umkm.png') }}" alt="" class="h-12 w-12 object-contain">
                    <span class="leading-none">
                        <strong class="block text-[13px] font-extrabold tracking-tight text-[#073f3b]">UMKM DESA LEMAHMULYA</strong>
                        <small class="mt-1 block text-[8px] font-medium tracking-[0.16em] text-[#073f3b]">RUANG UMKM LOKAL</small>
                    </span>
                </a>

                <a href="{{ url('/') }}" class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-slate-400 transition hover:text-[#147b7b]">
                    <span aria-hidden="true">←</span> Kembali ke beranda
                </a>
                <h1 class="mt-7 text-3xl font-extrabold tracking-tight text-[#073f3b] sm:text-4xl">Daftarkan usaha Anda.</h1>
                <p class="mt-3 text-sm leading-6 text-slate-500">Bergabung dengan ruang UMKM lokal dan kenalkan usaha Anda kepada warga.</p>

                @if(session('success'))
                    <div class="mt-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="mt-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('register') }}" class="mt-7 grid gap-4 sm:grid-cols-2">
                    @csrf
                    <div class="sm:col-span-2">
                        <label for="name" class="mb-2 block text-sm font-semibold text-[#073f3b]">Nama pemilik</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nama lengkap" class="h-11 w-full rounded-lg border border-slate-200 bg-white px-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-[#147b7b] focus:ring-2 focus:ring-[#147b7b]/20">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="nama_umkm" class="mb-2 block text-sm font-semibold text-[#073f3b]">Nama usaha</label>
                        <input type="text" id="nama_umkm" name="nama_umkm" value="{{ old('nama_umkm') }}" required placeholder="Nama UMKM Anda" class="h-11 w-full rounded-lg border border-slate-200 bg-white px-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-[#147b7b] focus:ring-2 focus:ring-[#147b7b]/20">
                    </div>
                    <div>
                        <label for="phone" class="mb-2 block text-sm font-semibold text-[#073f3b]">Nomor WhatsApp</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="tel" placeholder="08xxxxxxxxxx" class="h-11 w-full rounded-lg border border-slate-200 bg-white px-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-[#147b7b] focus:ring-2 focus:ring-[#147b7b]/20">
                    </div>
                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-[#073f3b]">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@email.com" class="h-11 w-full rounded-lg border border-slate-200 bg-white px-4 text-sm outline-none transition placeholder:text-slate-400">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="password" class="mb-2 block text-sm font-semibold text-[#073f3b]">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="Minimal 6 karakter" class="h-11 w-full rounded-lg border border-slate-200 bg-white px-4 pr-12 text-sm outline-none transition placeholder:text-slate-400 focus:border-[#147b7b] focus:ring-2 focus:ring-[#147b7b]/20">
                            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-[#147b7b]" aria-label="Tampilkan password">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" /><circle cx="12" cy="12" r="3" stroke-width="1.8" /></svg>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="sm:col-span-2 inline-flex h-11 items-center justify-center rounded-lg bg-[#147b7b] text-sm font-bold text-white shadow-sm transition hover:bg-[#0e6262] hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-[#147b7b] focus-visible:ring-offset-2">Daftar usaha</button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500">Sudah punya akun?
                    <a href="{{ url('login') }}" class="font-bold text-[#147b7b] transition hover:text-[#0e6262]">Masuk di sini</a>
                </p>
            </div>
        </section>

        <aside class="relative hidden overflow-hidden lg:order-1 lg:block">
            <img src="{{ asset('img/2.jpg') }}" alt="Ilustrasi komunitas UMKM" class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#073f3b]/90 via-[#073f3b]/20 to-transparent"></div>
            <div class="absolute bottom-12 left-12 right-12 text-white xl:left-16 xl:right-16">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-teal-100">Dari warga, untuk Lemahmulya</p>
                <h2 class="mt-3 text-3xl font-extrabold leading-tight xl:text-4xl">Usaha Anda,<br>kebanggaan desa.</h2>
                <p class="mt-4 max-w-md text-sm leading-6 text-teal-50">Daftarkan usaha dan biarkan lebih banyak orang menemukan karya Anda.</p>
            </div>
        </aside>
    </main>

    <script>
        document.getElementById('togglePassword')?.addEventListener('click', () => {
            const password = document.getElementById('password');
            password.type = password.type === 'password' ? 'text' : 'password';
        });
    </script>
</body>

</html>
