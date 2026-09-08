<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail UMKM</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .produk-card img {
      width: 100%;
      max-width: 140px;
      height: 100px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 12px;
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
  <main class="max-w-7xl mx-auto pt-24 px-4 pb-12">
    <div class="flex flex-col lg:flex-row gap-6">
      <!-- Sidebar UMKM -->
      <aside class="bg-gray-100 p-6 rounded-xl shadow flex flex-col items-center w-full lg:w-1/4">
        <img src="{{ $umkm->profile_photo ? asset('profile_photos/' . $umkm->profile_photo) : asset('img/UMKM.png') }}"
             alt="Foto {{ $umkm->nama_umkm }}"
             class="w-24 h-24 object-cover rounded-full mb-4">
        <h2 class="text-lg font-semibold text-center">{{ $umkm->nama_umkm }}</h2>
        <p class="text-gray-700 text-center"><b>Kategori:</b> {{ $umkm->kategori_umkm }}</p>
        <p class="text-gray-700 text-center"><b>Alamat:</b> {{ $umkm->alamat_umkm }}</p>
        <p class="text-gray-500 text-sm text-center"><b>Email:</b> {{ $umkm->email }}</p>
        <p class="text-gray-500 text-sm text-center"><b>No HP:</b> {{ $umkm->phone }}</p>
      </aside>

      <!-- Produk UMKM -->
      <section class="flex-1">
        <h2 class="text-xl font-bold mb-6">Produk dari {{ $umkm->nama_umkm }}</h2>
        @if($produks->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
          @foreach($produks as $produk)
          <div class="produk-card bg-white rounded-xl shadow p-4 flex flex-col items-center text-center">
            <img src="{{ $produk->foto_produk ? asset('profile_photos/' . $produk->foto_produk) : asset('img/UMKM.png') }}" alt="Foto {{ $produk->nama_produk }}">
            <h3 class="text-base font-semibold mt-2">{{ $produk->nama_produk }}</h3>
            <p class="text-green-600 font-semibold text-sm">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            @php
              $nohp = $umkm->phone ?? '';
              // Hilangkan spasi dan strip
              $nohp = preg_replace('/[^0-9]/', '', $nohp);
              // Jika nomor mulai dengan 0, ganti jadi 62
              if (substr($nohp, 0, 1) === '0') {
                $nohp = '62' . substr($nohp, 1);
              }
            @endphp
            <a href="https://wa.me/{{ $nohp }}" target="_blank" class="mt-3 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Beli</a>
          </div>
          @endforeach
        </div>
        @else
          <p class="text-gray-500 text-sm">Belum ada produk untuk UMKM ini.</p>
        @endif
      </section>
    </div>
  </main>

  <!-- Script for mobile menu -->
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
