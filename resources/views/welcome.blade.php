<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Lemahmulya</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <button id="dropdownButton" class="text-gray-600 focus:outline-none">
                        &#9660;
                    </button>
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
                <button id="mobileDropdownButton" class="text-gray-600 focus:outline-none">
                    &#9660;
                </button>
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

    <!-- Hero Section -->
    <section class="pt-24 bg-gradient-to-r from-cyan-500 to-blue-500 text-white">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center gap-6">
            <!-- Gambar -->

            <!-- Teks -->
            <div class="flex-1 py-6 text-left">
                <h1 class="text-2xl font-bold mb-4">Selamat Datang di Website Resmi UMKM Lemahmulya</h1>
                <p class="text-base leading-relaxed">Temukan informasi, produk, dan kegiatan terbaru dari UMKM kami yang terus berkembang bersama masyarakat. Website ini menjadi etalase digital untuk memperkenalkan karya dan inovasi pelaku UMKM Desa Lemahmulya.</p>
            </div>
        </div>
    </section>

    <!-- Carousel Section -->
    <section class="py-12">
        <h2 class="text-center text-2xl font-bold mb-8">Daftar UMKM Lemahmulya</h2>
        <div class="overflow-x-auto no-scrollbar px-4">
            <div class="flex gap-6 w-max">
                <!-- Example Card -->
                @foreach($umkms->take(6) as $umkm)
                <div class="flex-shrink-0 w-64 bg-white rounded-lg shadow hover:shadow-xl transition-all p-4">
                    <img src="{{ asset('profile_photos/' . $umkm->profile_photo) }}" alt="{{ $umkm->nama_umkm }}" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-lg font-semibold">{{ $umkm->nama_umkm }}</h3>
                    <p class="text-sm text-gray-600">Kategori: {{ $umkm->kategori_umkm }}</p>
                    <p class="text-sm text-gray-600">Alamat: {{ $umkm->alamat_umkm }}</p>
                    <a href="{{ url('detail_umkm/' . $umkm->id) }}" class="text-blue-600 mt-2 inline-block">Selengkapnya</a>
                </div>
                @endforeach
                <div class="flex-shrink-0 w-64 bg-blue-100 rounded-lg flex items-center justify-center text-xl font-bold text-blue-800 cursor-pointer" onclick="window.location='{{ url('daftar_umkm') }}'">
                    JELAJAHI
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Banner with CTA -->
    <section class="relative">
        <img src="/img/banner%20daftar.jpg" alt="Banner Daftar" class="w-full object-cover">
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm py-6 bg-gray-100 text-gray-600">
        &copy; 2025 UMKM Lemahmulya. All rights reserved.
    </footer>

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

            dropdownButton.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function() {
                dropdownMenu.classList.add('hidden');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileDropdownButton = document.getElementById('mobileDropdownButton');
            const mobileDropdownMenu = document.getElementById('mobileDropdownMenu');

            if (mobileDropdownButton) {
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
