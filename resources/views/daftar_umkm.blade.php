<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar UMKM Lemahmulya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .umkm-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 32px 20px;
            margin-top: 32px;
        }
        .umkm-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            padding: 18px 16px 16px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: box-shadow 0.2s;
        }
        .umkm-card:hover {
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.13);
        }
        .umkm-card img {
            width: 100%;
            max-width: 180px;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 12px;
        }
        .umkm-card .btn {
            margin-top: 10px;
            padding: 7px 18px;
            border-radius: 8px;
            background: #4f46e5;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }
        .umkm-searchbar {
            width: 100%;
            max-width: 420px;
            margin: 32px auto 0 auto;
            display: flex;
            align-items: center;
        }
        .umkm-searchbar input {
            flex: 1;
            padding: 10px 16px;
            border-radius: 8px 0 0 8px;
            border: 1px solid #d1d5db;
            font-size: 1em;
            outline: none;
        }
        .umkm-searchbar button {
            padding: 10px 18px;
            border-radius: 0 8px 8px 0;
            border: 1px solid #4f46e5;
            background: #4f46e5;
            color: #fff;
            font-size: 1em;
            cursor: pointer;
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

    <!-- Main Content -->
    <main class="pt-24 max-w-7xl mx-auto px-4 pb-16">
        <form class="umkm-searchbar" method="GET" action="">
            <input type="text" name="q" placeholder="Cari UMKM, kategori, atau alamat..." value="{{ request('q') }}">
            <button type="submit">Cari</button>
        </form>

        <div class="umkm-grid">
            @foreach($umkms->where('role', 'user') as $umkm)
            <div class="umkm-card">
            <img src="{{ isset($umkm) && !empty($umkm->profile_photo) ? asset('profile_photos/' . $umkm->profile_photo) : asset('img/user_icon.png') }}" alt="Foto {{ $umkm->nama_umkm ?? $umkm->name ?? '-' }}">
                <h3>{{ $umkm->nama_umkm ?? '-' }}</h3>
                <p>Kategori: {{ $umkm->kategori_umkm ?? '-' }}</p>
                <p>Alamat: {{ $umkm->alamat_umkm ?? '-' }}</p>
                <p class="text-sm text-gray-500">Email: {{ $umkm->email ?? '-' }}</p>
                <p class="text-sm text-gray-500">No HP: {{ $umkm->phone ?? '-' }}</p>
                <a href="{{ url('detail_umkm/' . $umkm->id) }}" class="btn">Selengkapnya</a>
            </div>
            @endforeach
        </div>
    </main>

    <!-- Scripts -->
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