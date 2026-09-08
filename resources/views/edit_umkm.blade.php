<!-- Edit UMKM Page - Tailwind Responsive -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="min-h-screen flex flex-col items-center justify-center bg-blue-50 py-8 px-4">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl md:text-3xl font-bold text-blue-700 mb-6 text-center">Edit UMKM</h2>
        <form method="POST" action="{{ url('umkm/update') }}" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label for="nama_umkm" class="block text-gray-700 font-semibold mb-2">Nama UMKM</label>
                <input type="text" id="nama_umkm" name="nama_umkm" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('nama_umkm', $user->nama_umkm ?? '') }}" required>
            </div>
            <div>
                <label for="alamat_umkm" class="block text-gray-700 font-semibold mb-2">Alamat UMKM</label>
                <input type="text" id="alamat_umkm" name="alamat_umkm" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('alamat_umkm', $user->alamat_umkm ?? '') }}" required>
            </div>
            <div>
                <label for="deskripsi_umkm" class="block text-gray-700 font-semibold mb-2">Deskripsi UMKM</label>
                <textarea id="deskripsi_umkm" name="deskripsi_umkm" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('deskripsi_umkm', $user->deskripsi_umkm ?? '') }}</textarea>
            </div>
            <div>
                <label for="phone" class="block text-gray-700 font-semibold mb-2">No Telepon</label>
                <input type="text" id="phone" name="phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('phone', $user->phone ?? '') }}" required>
            </div>
            <div>
                <label for="kategori_umkm" class="block text-gray-700 font-semibold mb-2">Kategori UMKM</label>
                <input type="text" id="kategori_umkm" name="kategori_umkm" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('kategori_umkm', $user->kategori_umkm ?? '') }}" required>
            </div>
            <div class="flex justify-between mt-8">
                <a href="{{ url('profile_page') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-300">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
