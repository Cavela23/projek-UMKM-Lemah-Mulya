<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 32px 20px;
            margin-top: 32px;
        }
    </style>
</head>
<body class="bg-white text-gray-800">
    <!-- Header -->
    <header class="w-full fixed top-0 bg-white shadow z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Left nav -->
            <nav class="hidden md:flex gap-6 text-sm font-semibold">
                <a href="/" class="hover:text-blue-600">BERANDA</a>
                <a href="/daftar_umkm" class="hover:text-blue-600">UMKM</a>
            </nav>
            <!-- Logo -->
            <div class="text-xl font-bold text-blue-900 italic">
                <img src="/img/UMKM(1).png" alt="UMKM Lemahmulya" class="h-8">
            </div>
            <!-- Right nav -->
            <nav class="hidden md:flex gap-6 text-sm font-semibold">
                <a href="/daftar_produk" class="hover:text-blue-600">PRODUK</a>
                @if(session('user_id'))
                <div class="flex items-center gap-2 relative">
                    <img src="{{ session('user_profile_photo') ? asset('storage/profile_photos/' . session('user_profile_photo')) : asset('img/user_icon.png') }}" alt="User" class="w-8 h-8 rounded-full">
                    <span>{{ session('user_name') }}</span>
                    <button id="dropdownButton" class="text-gray-600 focus:outline-none">&#9660;</button>
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <a href="{{ url('profile_page') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                        <form method="POST" action="{{ url('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
                @else
                <a href="/login" class="hover:text-blue-600">MASUK</a>
                @endif
            </nav>
            <!-- Mobile Hamburger -->
            <div class="md:hidden">
                <button id="hamburger" class="text-2xl">&#9776;</button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden flex-col bg-white px-4 py-4 space-y-2 text-sm font-semibold">
            <a href="/" class="block hover:text-blue-600">BERANDA</a>
            <a href="/daftar_umkm" class="block hover:text-blue-600">UMKM</a>
            <a href="/daftar_produk" class="block hover:text-blue-600">PRODUK</a>
            @if(session('user_id'))
            <div class="flex items-center gap-2">
                <img src="{{ session('user_profile_photo') ? asset('storage/profile_photos/' . session('user_profile_photo')) : asset('img/user_icon.png') }}" alt="User" class="w-8 h-8 rounded-full">
                <span>{{ session('user_name') }}</span>
                <button id="mobileDropdownButton" class="text-gray-600 focus:outline-none">&#9660;</button>
                <div id="mobileDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                    <a href="{{ url('profile_page') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                    <form method="POST" action="{{ url('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
            @else
            <a href="/login" class="block hover:text-blue-600">MASUK</a>
            @endif
        </div>
    </header>

    <!-- Konten -->
    <main class="max-w-7xl mx-auto px-4 py-28">
        <h2 class="text-2xl font-bold mb-8 text-center">Daftar Produk UMKM</h2>
        <form class="umkm-searchbar" method="GET" action="" style="max-width:420px;margin:0 auto 32px auto;display:flex;align-items:center;">
            <input type="text" name="q" placeholder="Cari produk, kategori, atau UMKM..." value="{{ request('q') }}" style="flex:1;padding:10px 16px;border-radius:8px 0 0 8px;border:1px solid #d1d5db;font-size:1em;outline:none;">
            <button type="submit" style="padding:10px 18px;border-radius:0 8px 8px 0;border:1px solid #4f46e5;background:#4f46e5;color:#fff;font-size:1em;cursor:pointer;">Cari</button>
        </form>
        <div class="produk-grid">
            @foreach($produks as $produk)
                @php
                    $umkm = $produk->user;
                    $nohp = $umkm->phone ?? '';
                    $nohp = preg_replace('/[^0-9]/', '', $nohp);
                    if (substr($nohp, 0, 1) === '0') {
                        $nohp = '62' . substr($nohp, 1);
                    }
                @endphp
                <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition">
                    <img src="{{ $produk->foto_produk ? asset('profile_photos/' . $produk->foto_produk) : '/img/UMKM.png' }}" alt="Foto {{ $produk->nama_produk }}" class="w-full max-w-[180px] h-[140px] object-cover rounded-xl mb-4">
                    <h3 class="text-lg font-semibold">{{ $produk->nama_produk }}</h3>
                    <p class="text-green-500 font-bold text-base">Rp {{ number_format($produk->harga,0,',','.') }}</p>
                    <p class="text-sm text-gray-600 mb-2">UMKM: {{ $produk->user->nama_umkm ?? '-' }}</p>
                    <a href="https://wa.me/{{ $nohp }}" target="_blank" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">Beli</a>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Script toggle burger -->
    <script>
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
            if (dropdownButton && dropdownMenu) {
                dropdownButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('hidden');
                });
                document.addEventListener('click', function() {
                    dropdownMenu.classList.add('hidden');
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileDropdownButton = document.getElementById('mobileDropdownButton');
            const mobileDropdownMenu = document.getElementById('mobileDropdownMenu');
            if (mobileDropdownButton && mobileDropdownMenu) {
                mobileDropdownButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileDropdownMenu.classList.toggle('hidden');
                });
                document.addEventListener('click', function() {
                    mobileDropdownMenu.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
