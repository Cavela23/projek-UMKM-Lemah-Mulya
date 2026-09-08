<!-- Standalone profile page, no layout -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="relative w-full h-64 bg-blue-200 rounded-b-lg overflow-hidden">
    <img src="/img/banner_1.jpg" class="w-full h-full object-cover" alt="Banner">
    <button class="absolute left-4 md:left-8 top-4 md:top-6 bg-gray-200 text-gray-800 rounded-lg px-6 py-3 text-sm md:text-base font-medium shadow-md hover:bg-gray-300" onclick="window.location.href='/'">Back</button>
    <a href="{{ url('umkm/edit') }}" class="absolute right-4 md:right-8 top-4 md:top-6 bg-blue-600 text-white rounded-lg px-6 py-3 text-sm md:text-base font-medium shadow-md hover:bg-blue-700">Edit UMKM</a>
</div>
<div class="flex flex-col md:flex-row items-center md:items-end gap-6 md:gap-8 relative -top-16 px-6 md:px-8">
    <div class="w-28 h-28 md:w-36 md:h-36 bg-white rounded-full shadow-md flex items-center justify-center overflow-hidden relative">
        <img src="{{ isset($user) && $user && !empty($user->profile_photo) ? asset('profile_photos/' . $user->profile_photo) : asset('img/user_icon.png') }}" alt="User" class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-full">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="absolute bottom-2 right-2">
            @csrf
            @method('PUT')
            <label for="profile-photo" class="bg-blue-600 w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center shadow-md cursor-pointer">
                <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                <input type="file" id="profile-photo" name="profile_photo" accept="image/*" class="hidden" onchange="this.form.submit()">
            </label>
        </form>
    </div>
    <div class="flex flex-col items-center md:items-start">
        <div class="text-xl md:text-3xl font-bold text-gray-800">{{ isset($user) && $user ? $user->name : 'Nama UMKM' }}</div>
        <div class="text-gray-600 text-sm md:text-base">{{ isset($user) && $user ? $user->email : 'umkm@email.com' }}</div>
        <div class="text-gray-500 text-sm md:text-base">{{ isset($user) && $user ? $user->nama_umkm ?? '-' : '-' }}</div>
        <div class="text-gray-500 text-sm md:text-base">{{ isset($user) && $user ? $user->alamat_umkm ?? '-' : '-' }}</div>
    </div>
</div>
<div class="flex justify-center border-b border-gray-200 mt-6">
    @if(isset($user) && $user && $user->role === 'admin')
        <button id="tab-umkm" class="px-4 py-2 text-blue-600 font-semibold border-b-2 border-blue-600 text-sm md:text-base">Daftar UMKM</button>
        <button id="tab-produk" class="px-4 py-2 text-gray-500 font-semibold border-b-2 border-transparent text-sm md:text-base hover:text-blue-600 hover:border-blue-600">Daftar Produk</button>
    @else
        <button id="tab-overview" class="px-4 py-2 text-blue-600 font-semibold border-b-2 border-blue-600 text-sm md:text-base">Ringkasan</button>
        <button id="tab-customer" class="px-4 py-2 text-gray-500 font-semibold border-b-2 border-transparent text-sm md:text-base hover:text-blue-600 hover:border-blue-600">Daftar Produk</button>
    @endif
</div>
<div class="mt-6 md:mt-8 px-6 md:px-8">
    @if(isset($user) && $user && $user->role === 'admin')
        <div id="section-umkm" class="mt-6 md:mt-8 px-6 md:px-8">
            <div class="flex flex-col md:flex-row gap-6 md:gap-8">
                <div class="bg-gray-50 p-6 md:p-8 rounded-lg shadow-md w-full md:w-1/3">
                    <form id="search-umkm-form" method="GET" action="" class="flex flex-col gap-4">
                        <input type="text" id="search-umkm" name="search" class="w-full px-4 py-2 border rounded-lg text-sm md:text-base" placeholder="Cari UMKM..." value="{{ request('search') }}">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm md:text-base font-medium hover:bg-blue-700">Cari</button>
                    </form>
                </div>
                <div class="flex-1">
                    <div class="mb-6">
                        <span class="text-lg md:text-xl font-semibold">Daftar UMKM</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse bg-white">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left border-b text-sm md:text-base">Nama UMKM</th>
                                    <th class="px-4 py-2 text-left border-b text-sm md:text-base">Email</th>
                                    <th class="px-4 py-2 text-left border-b text-sm md:text-base">Alamat</th>
                                    <th class="px-4 py-2 text-left border-b text-sm md:text-base">Kategori</th>
                                    <th class="px-4 py-2 text-left border-b text-sm md:text-base">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $query = request('search');
                                    $umkms = \App\Models\User::where('role', 'user')
                                        ->when($query, function($q) use ($query) {
                                            $q->where(function($sub) use ($query) {
                                                $sub->where('nama_umkm', 'like', "%$query%")
                                                    ->orWhere('email', 'like', "%$query%")
                                                    ->orWhere('alamat_umkm', 'like', "%$query%")
                                                    ->orWhere('kategori_umkm', 'like', "%$query%")
                                                    ->orWhere('deskripsi_umkm', 'like', "%$query%")
                                                    ->orWhere('phone', 'like', "%$query%")
                                                    ;
                                            });
                                        })
                                        ->get();
                                @endphp
                                @forelse($umkms as $umkm)
                                <tr>
                                    <td class="px-4 py-2 border-b text-sm md:text-base">{{ $umkm->nama_umkm ?? '-' }}</td>
                                    <td class="px-4 py-2 border-b text-sm md:text-base">{{ $umkm->email }}</td>
                                    <td class="px-4 py-2 border-b text-sm md:text-base">{{ $umkm->alamat_umkm ?? '-' }}</td>
                                    <td class="px-4 py-2 border-b text-sm md:text-base">{{ $umkm->kategori_umkm ?? '-' }}</td>
                                    <td class="px-4 py-2 border-b text-sm md:text-base">
                                        <form method="POST" action="{{ url('umkm/' . $umkm->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm md:text-base font-medium hover:bg-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500 py-4 text-sm md:text-base">Belum ada UMKM.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="section-produk" class="mt-6 md:mt-8 px-6 md:px-8" style="display:none;">
            <div class="flex flex-col md:flex-row gap-6 md:gap-8 mb-4">
                <div class="bg-gray-50 p-6 md:p-8 rounded-lg shadow-md w-full md:w-1/3">
                    <form id="search-produk-form" method="GET" action="" class="flex flex-col gap-4">
                        <input type="text" id="search-produk" name="search_produk" class="w-full px-4 py-2 border rounded-lg text-sm md:text-base" placeholder="Cari Produk..." value="{{ request('search_produk') }}">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm md:text-base font-medium hover:bg-blue-700">Cari</button>
                    </form>
                </div>
                <div class="flex-1">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
                        <span class="profile-label" style="font-size:1.2em;">Daftar Produk</span>
                    </div>
                    <div style="overflow-x:auto;">
                        <table style="width:100%;border-collapse:collapse;background:#fff;">
                            <thead>
                                <tr style="background:#f3f4f6;">
                                    <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">Nama Produk</th>
                                    <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">Kategori</th>
                                    <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">Harga</th>
                                    <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">UMKM</th>
                                    <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $queryProduk = request('search_produk');
                                    $produks = \App\Models\Produk::with('user')
                                        ->when($queryProduk, function($q) use ($queryProduk) {
                                            $q->where('nama_produk', 'like', "%$queryProduk%");
                                        })
                                        ->get();
                                @endphp
                                @forelse($produks as $produk)
                                <tr>
                                    <td style="padding:10px 8px;">{{ $produk->nama_produk }}</td>
                                    <td style="padding:10px 8px;">{{ $produk->kategori ?? '-' }}</td>
                                    <td style="padding:10px 8px;">Rp {{ number_format($produk->harga,0,',','.') }}</td>
                                    <td style="padding:10px 8px;">{{ $produk->user->nama_umkm ?? $produk->user->name ?? '-' }}</td>
                                    <td style="padding:10px 8px;">
                                        <a href="{{ url('produk/edit/' . $produk->id) }}" style="background:#f59e42;color:#fff;border:none;padding:6px 14px;border-radius:6px;cursor:pointer;margin-right:6px;display:inline-block;text-align:center;">Ubah</a>
                                        <form method="POST" action="{{ url('produk/' . $produk->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:#ef4444;color:#fff;border:none;padding:6px 14px;border-radius:6px;cursor:pointer;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;color:#888;padding:16px 0;">Belum ada produk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div id="section-overview" class="mt-6 md:mt-8 px-6 md:px-8">
        <div class="mb-6">
            <span class="block text-lg md:text-xl font-semibold">Alamat UMKM</span>
            <input type="text" class="w-full px-4 py-2 border rounded-lg text-sm md:text-base" value="{{ isset($user) && $user ? $user->alamat_umkm ?? '-' : '-' }}" readonly>
        </div>
        <div class="mb-6">
            <span class="block text-lg md:text-xl font-semibold">Deskripsi UMKM</span>
            <textarea class="w-full px-4 py-2 border rounded-lg text-sm md:text-base" rows="3" readonly>{{ isset($user) && $user ? $user->deskripsi_umkm ?? '-' : '-' }}</textarea>
        </div>
        <div class="flex flex-wrap gap-6">
            <div class="flex-1 min-w-[220px]">
                <span class="block text-lg md:text-xl font-semibold">General E-mail</span>
                <input type="email" class="w-full px-4 py-2 border rounded-lg text-sm md:text-base" value="{{ isset($user) && $user ? $user->email : 'umkm@email.com' }}" readonly>
            </div>
            <div class="flex-1 min-w-[220px]">
                <span class="block text-lg md:text-xl font-semibold">Phone number</span>
                <input type="text" class="w-full px-4 py-2 border rounded-lg text-sm md:text-base" value="{{ isset($user) && $user ? $user->phone ?? '-' : '-' }}" readonly>
            </div>
        </div>
        <div class="mb-6">
            <span class="block text-lg md:text-xl font-semibold">Kategori UMKM</span>
            <input type="text" class="w-full px-4 py-2 border rounded-lg text-sm md:text-base" value="{{ isset($user) && $user ? $user->kategori_umkm ?? '-' : '-' }}" readonly>
        </div>
    @endif
</div>
<!-- Modal Edit UMKM (Bootstrap, overlay, di luar konten utama) -->
<style>
@media (max-width: 600px) {
  .modal-tambah-produk {
    max-width: 98vw !important;
    width: 98vw !important;
    transform: scale(1.12);
  }
}
</style>
<!-- Modal tambah kategori dihapus -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching untuk user biasa
    const tabOverview = document.getElementById('tab-overview');
    const tabCustomer = document.getElementById('tab-customer');
    const sectionOverview = document.getElementById('section-overview');
    const sectionProduk = document.getElementById('section-produk');

    // Tab switching untuk admin
    const tabUmkm = document.getElementById('tab-umkm');
    const tabProduk = document.getElementById('tab-produk');
    const sectionUmkm = document.getElementById('section-umkm');
    const sectionProdukAdmin = document.getElementById('section-produk');

    // Untuk user biasa
    if (tabOverview && tabCustomer && sectionOverview && sectionProduk) {
        // Cek apakah ada query search_produk di URL
        const urlParams = new URLSearchParams(window.location.search);
        const adaSearchProduk = urlParams.has('search_produk') && urlParams.get('search_produk').trim() !== '';
        if (adaSearchProduk) {
            sectionOverview.style.display = 'none';
            sectionProduk.style.display = 'block';
            tabOverview.classList.remove('border-blue-600', 'text-blue-600');
            tabCustomer.classList.add('border-blue-600', 'text-blue-600');
        } else {
            sectionOverview.style.display = 'block';
            sectionProduk.style.display = 'none';
            tabOverview.classList.add('border-blue-600', 'text-blue-600');
            tabCustomer.classList.remove('border-blue-600', 'text-blue-600');
        }
        tabOverview.addEventListener('click', function() {
            tabOverview.classList.add('border-blue-600', 'text-blue-600');
            tabCustomer.classList.remove('border-blue-600', 'text-blue-600');
            sectionOverview.style.display = 'block';
            sectionProduk.style.display = 'none';
        });
        tabCustomer.addEventListener('click', function() {
            tabCustomer.classList.add('border-blue-600', 'text-blue-600');
            tabOverview.classList.remove('border-blue-600', 'text-blue-600');
            sectionOverview.style.display = 'none';
            sectionProduk.style.display = 'block';
        });
    }

    // Untuk admin
    if (tabUmkm && tabProduk && sectionUmkm && sectionProdukAdmin) {
        // Default: tampilkan UMKM, sembunyikan produk
        sectionUmkm.style.display = 'block';
        sectionProdukAdmin.style.display = 'none';
        tabUmkm.classList.add('border-blue-600', 'text-blue-600');
        tabProduk.classList.remove('border-blue-600', 'text-blue-600');
        tabUmkm.addEventListener('click', function() {
            tabUmkm.classList.add('border-blue-600', 'text-blue-600');
            tabProduk.classList.remove('border-blue-600', 'text-blue-600');
            sectionUmkm.style.display = 'block';
            sectionProdukAdmin.style.display = 'none';
        });
        tabProduk.addEventListener('click', function() {
            tabProduk.classList.add('border-blue-600', 'text-blue-600');
            tabUmkm.classList.remove('border-blue-600', 'text-blue-600');
            sectionUmkm.style.display = 'none';
            sectionProdukAdmin.style.display = 'block';
        });
    }

    // Modal Tambah Produk
    const tambahBtn = document.querySelector('.tambah-produk-btn');
    if (tambahBtn) {
        tambahBtn.addEventListener('click', function() {
            document.getElementById('tambahProdukModal').style.display = 'flex';
        });
    }
    window.closeTambahProdukModal = function() {
        document.getElementById('tambahProdukModal').style.display = 'none';
    };
    // Jika input search produk dikosongkan, submit otomatis agar semua produk muncul
    var searchProdukInput = document.getElementById('search-produk');
    if (searchProdukInput) {
        searchProdukInput.addEventListener('input', function() {
            if (this.value.trim() === '') {
                this.form.submit();
            }
        });
    }
    var editUmkmModal = document.getElementById('editUmkmModal');
    if (editUmkmModal) {
        editUmkmModal.addEventListener('show.bs.modal', function() {
            editUmkmModal.removeAttribute('inert');
            editUmkmModal.setAttribute('aria-hidden', 'false');
        });
        editUmkmModal.addEventListener('hide.bs.modal', function() {
            editUmkmModal.setAttribute('inert', '');
            editUmkmModal.removeAttribute('aria-hidden');
        });
    }
});
</script>

</div>
<div class="profile-section" id="section-produk" style="display:none;">

    <div class="flex flex-col md:flex-row gap-6 md:gap-8 mb-4">
        <div class="bg-gray-50 p-6 md:p-8 rounded-lg shadow-md w-full md:w-1/3">
            <form id="search-produk-form" method="GET" action="" class="flex flex-col gap-4">
                <input type="text" id="search-produk" name="search_produk" class="w-full px-4 py-2 border rounded-lg text-sm md:text-base" placeholder="Cari Produk..." value="{{ request('search_produk') }}">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm md:text-base font-medium hover:bg-blue-700">Cari</button>
            </form>
        </div>
        <div class="flex-1">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
                <span class="profile-label" style="font-size:1.2em;">Daftar Produk</span>
                @if(!(isset($user) && $user && $user->role === 'admin'))
                    <button class="tambah-produk-btn" style="position:static;padding:8px 18px;font-size:1em;" type="button">Tambah Produk</button>
                @endif
            </div>
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;background:#fff;">
            <thead>
                <tr style="background:#f3f4f6;">
                    <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">Nama Produk</th>
                    <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">Kategori</th>
                    <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">Harga</th>
                    @if(isset($user) && $user && $user->role === 'admin')
                        <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">UMKM</th>
                    @endif
                    <th style="padding:12px 8px;text-align:left;border-bottom:1px solid #e5e7eb;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $queryProduk = request('search_produk');
                    if(isset($user) && $user && $user->role === 'admin') {
                        $produks = \App\Models\Produk::with('user')
                            ->when($queryProduk, function($q) use ($queryProduk) {
                                $q->where('nama_produk', 'like', "%$queryProduk%");
                            })
                            ->get();
                    } elseif(isset($user) && $user) {
                        $produks = \App\Models\Produk::where('user_id', $user->id)
                            ->when($queryProduk, function($q) use ($queryProduk) {
                                $q->where('nama_produk', 'like', "%$queryProduk%");
                            })
                            ->get();
                    } else {
                        $produks = [];
                    }
                @endphp
                @forelse($produks as $produk)
                <tr>
                    <td style="padding:10px 8px;">{{ $produk->nama_produk }}</td>
                    <td style="padding:10px 8px;">{{ $produk->kategori ?? '-' }}</td>
                    <td style="padding:10px 8px;">Rp {{ number_format($produk->harga,0,',','.') }}</td>
                    @if(isset($user) && $user && $user->role === 'admin')
                        <td style="padding:10px 8px;">{{ $produk->user->nama_umkm ?? $produk->user->name ?? '-' }}</td>
                    @endif
                    <td style="padding:10px 8px;">
                        <a href="{{ url('produk/edit/' . $produk->id) }}" style="background:#f59e42;color:#fff;border:none;padding:6px 14px;border-radius:6px;cursor:pointer;margin-right:6px;display:inline-block;text-align:center;">Ubah</a>
                        <form method="POST" action="{{ url('produk/' . $produk->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:#ef4444;color:#fff;border:none;padding:6px 14px;border-radius:6px;cursor:pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="@if(isset($user) && $user && $user->role === 'admin') 5 @else 4 @endif" style="text-align:center;color:#888;padding:16px 0;">Belum ada produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Modal Tambah Produk (pindahkan ke luar section agar tidak terbungkus) -->
    <div id="tambahProdukModal" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.25);z-index:999;align-items:center;justify-content:center;">
        <div class="modal-tambah-produk" style="background:#fff;padding:32px 24px;border-radius:16px;max-width:430px;width:100%;box-shadow:0 2px 16px rgba(0,0,0,0.12);position:relative;">
            <h2 style="font-size:1.3rem;font-weight:700;margin-bottom:18px;">Tambah Produk</h2>
            <form method="POST" action="{{ url('tambah-produk') }}" enctype="multipart/form-data">
                @csrf
                <div style="display:flex;gap:12px;align-items:center;margin-bottom:14px;">
                    <div style="flex:1;">
                        <label class="profile-label" style="margin-bottom:4px;display:block;">Nama Produk</label>
                        <input type="text" name="nama_produk" class="profile-input" style="width:100%;" required>
                    </div>
                    <div style="flex:1;">
                        <label class="profile-label" style="margin-bottom:4px;display:block;">Harga</label>
                        <input type="number" name="harga" class="profile-input" style="width:100%;" required>
                    </div>
                </div>
                <div style="margin-bottom:14px;">
                    <label class="profile-label" style="margin-bottom:4px;display:block;">Deskripsi Produk</label>
                    <textarea name="deskripsi" class="profile-input" rows="3" style="width:100%;" required></textarea>
                </div>
                <div style="margin-bottom:14px;">
                    <label class="profile-label" style="margin-bottom:4px;display:block;">Kategori</label>
                    <input type="text" name="kategori" class="profile-input" style="width:100%;" required>
                </div>
                <div style="margin-bottom:14px;">
                    <label class="profile-label" style="margin-bottom:4px;display:block;">Foto Produk</label>
                    <input type="file" name="foto_produk" class="profile-input" accept="image/*" required>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:18px;">
                    <button type="button" onclick="closeTambahProdukModal()" style="background:#eee;color:#222;border:none;padding:8px 18px;border-radius:8px;cursor:pointer;">Batal</button>
                    <button type="submit" style="background:#2563eb;color:#fff;border:none;padding:8px 18px;border-radius:8px;cursor:pointer;">Simpan</button>
                </div>
            </form>
            <style>
            @media (max-width: 600px) {
              .modal-tambah-produk {
                max-width: 98vw !important;
                width: 98vw !important;
                transform: scale(1.12);
                /* Zoom in modal on mobile */
              }
            }
            </style>
            <button onclick="closeTambahProdukModal()" style="position:absolute;top:12px;right:16px;background:none;border:none;font-size:1.5rem;color:#888;cursor:pointer;">&times;</button>
        </div>
    </div>
<script>
// Modal Edit Produk
function openEditProdukModal() {
    document.getElementById('editProdukModal').style.display = 'flex';
}
function closeEditProdukModal() {
    document.getElementById('editProdukModal').style.display = 'none';
}
// Handle klik tombol edit produk
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit-produk-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            console.log('[Edit Produk] Tombol edit diklik, id:', id);
            fetch('/produk/' + id + '/edit')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal fetch data produk. Status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('[Edit Produk] Data produk diterima:', data);
                    document.getElementById('edit_nama_produk').value = data.nama_produk;
                    document.getElementById('edit_harga').value = data.harga;
                    document.getElementById('edit_deskripsi').value = data.deskripsi ?? data.deskripsi_produk ?? '';
                    // Isi dropdown kategori jika ada data kategori
                    var kategoriSelect = document.getElementById('edit_kategori');
                    if (kategoriSelect) {
                        // Jika data.kategori ada, set value, jika tidak, kosongkan
                        let kategoriVal = data.kategori ?? '';
                        let found = false;
                        for (let i = 0; i < kategoriSelect.options.length; i++) {
                            if (kategoriSelect.options[i].value === kategoriVal) {
                                kategoriSelect.selectedIndex = i;
                                found = true;
                                break;
                            }
                        }
                        if (!found && kategoriVal) {
                            // Tambahkan option jika belum ada
                            let opt = document.createElement('option');
                            opt.value = kategoriVal;
                            opt.textContent = kategoriVal;
                            kategoriSelect.appendChild(opt);
                            kategoriSelect.value = kategoriVal;
                        }
                        if (!kategoriVal) kategoriSelect.selectedIndex = 0;
                    }
                    // Set form action
                    var form = document.getElementById('editProdukForm');
                    form.action = '/produk/' + id;
                    console.log('[Edit Produk] Modal akan dibuka');
                    openEditProdukModal();
                })
                .catch(function(err) {
                    console.error('[Edit Produk] Error:', err);
                    alert('Gagal mengambil data produk. Pastikan server berjalan dan endpoint benar.\n' + err);
                });
        });
    });
});

@if(!(isset($user) && $user && $user->role === 'admin'))
<!-- Modal Tambah Produk -->
<div id="tambahProdukModal" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.25);z-index:999;align-items:center;justify-content:center;">
    <div style="background:#fff;padding:32px 24px;border-radius:16px;max-width:400px;width:100%;box-shadow:0 2px 16px rgba(0,0,0,0.12);position:relative;">
        <h2 style="font-size:1.3rem;font-weight:700;margin-bottom:18px;">Tambah Produk</h2>
        <form method="POST" action="{{ url('tambah-produk') }}" enctype="multipart/form-data">
            @csrf
            <label class="profile-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="profile-input" required>
            <label class="profile-label">Harga</label>
            <input type="number" name="harga" class="profile-input" required>
            <label class="profile-label">Deskripsi Produk</label>
            <textarea name="deskripsi" class="profile-input" rows="3" required></textarea>
            <label class="profile-label">Kategori</label>
            <select name="kategori" id="tambah_kategori" class="profile-input">
                <option value="">Pilih Kategori</option>
            </select>
            <label class="profile-label">Foto Produk</label>
            <input type="file" name="foto_produk" class="profile-input" accept="image/*" required>
            <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:18px;">
                <button type="button" onclick="closeTambahProdukModal()" style="background:#eee;color:#222;border:none;padding:8px 18px;border-radius:8px;cursor:pointer;">Batal</button>
                <button type="submit" style="background:#2563eb;color:#fff;border:none;padding:8px 18px;border-radius:8px;cursor:pointer;">Simpan</button>
            </div>
        </form>
        <button onclick="closeTambahProdukModal()" style="position:absolute;top:12px;right:16px;background:none;border:none;font-size:1.5rem;color:#888;cursor:pointer;">&times;</button>
    </div>
</div>
@endif
    </div>
</div>
<script>
// Semua script di bawah ini dijalankan setelah seluruh elemen HTML (termasuk modal) sudah ada
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabOverview = document.getElementById('tab-overview');
    const tabCustomer = document.getElementById('tab-customer');
    const sectionOverview = document.getElementById('section-overview');
    const sectionProduk = document.getElementById('section-produk');

    if (tabOverview && tabCustomer && sectionOverview && sectionProduk) {
        sectionOverview.style.display = 'block';
        sectionProduk.style.display = 'none';
        tabOverview.classList.add('border-blue-600', 'text-blue-600');
        tabCustomer.classList.remove('border-blue-600', 'text-blue-600');

        tabOverview.addEventListener('click', function() {
            tabOverview.classList.add('border-blue-600', 'text-blue-600');
            tabCustomer.classList.remove('border-blue-600', 'text-blue-600');
            sectionOverview.style.display = 'block';
            sectionProduk.style.display = 'none';
        });

        tabCustomer.addEventListener('click', function() {
            tabCustomer.classList.add('border-blue-600', 'text-blue-600');
            tabOverview.classList.remove('border-blue-600', 'text-blue-600');
            sectionOverview.style.display = 'none';
            sectionProduk.style.display = 'block';
        });
    }

    // Modal Tambah Produk
    var tambahBtn = document.querySelector('.tambah-produk-btn');
    if (tambahBtn) {
        tambahBtn.addEventListener('click', function() {
            var modal = document.getElementById('tambahProdukModal');
            if (!modal) {
                alert('Modal tambah produk tidak ditemukan di halaman.');
                return;
            }
            modal.style.display = 'flex';
            // Load kategori dari database ke dropdown tambah produk
            fetch('/kategori/all')
                .then(res => res.json())
                .then(kats => {
                    var select = document.getElementById('tambah_kategori');
                    if (select) {
                        select.innerHTML = '<option value="">Pilih Kategori</option>';
                        kats.forEach(function(kat) {
                            var opt = document.createElement('option');
                            opt.value = kat.nama_kategori;
                            opt.textContent = kat.nama_kategori;
                            select.appendChild(opt);
                        });
                    }
                });
        });
    }
    window.closeTambahProdukModal = function() {
        var modal = document.getElementById('tambahProdukModal');
        if (modal) modal.style.display = 'none';
    };
});

</script>

<!-- Bootstrap CSS (jika belum ada, tambahkan di <head> atau di sini) -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

<!-- Bootstrap JS (wajib untuk modal) -->

<script>
</script>

<!-- End profile page -->