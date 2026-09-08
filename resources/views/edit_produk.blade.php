@php /** @var \App\Models\Produk $produk */ @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .edit-produk-container { max-width: 420px; margin: 48px auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); padding: 32px 24px; }
        .profile-label { font-weight: 600; color: #222; margin-bottom: 8px; display: block; }
        .profile-input { width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #ddd; font-size: 1rem; background: #f6f6f6; margin-bottom: 18px; }
        .btn { background: #2563eb; color: #fff; border: none; border-radius: 8px; padding: 10px 24px; font-size: 1rem; font-weight: 500; cursor: pointer; }
    </style>
</head>
<body>
<div class="edit-produk-container">
    <h2 style="font-size:1.3rem;font-weight:700;margin-bottom:18px;">Edit Produk</h2>
    <form method="POST" action="{{ url('produk/' . $produk->id . '/update') }}" enctype="multipart/form-data" onsubmit="return handleSubmit(event)">
        @csrf
        <label class="profile-label">Nama Produk</label>
        <input type="text" name="nama_produk" class="profile-input" value="{{ $produk->nama_produk }}" required>
        <label class="profile-label">Harga</label>
        <input type="number" name="harga" class="profile-input" value="{{ $produk->harga }}" required>
        <label class="profile-label">Deskripsi Produk</label>
        <textarea name="deskripsi" class="profile-input" rows="3" required>{{ $produk->deskripsi }}</textarea>
        <label class="profile-label">Kategori</label>
        <input type="text" name="kategori" class="profile-input" value="{{ $produk->kategori }}">
        <label class="profile-label">Foto Produk</label>
        @if($produk->foto_produk)
            <img src="{{ asset('profile_photos/' . $produk->foto_produk) }}" alt="Foto Produk" style="width:100px;height:100px;object-fit:cover;border-radius:10px;margin-bottom:10px;display:block;">
        @endif
        <input type="file" name="foto_produk" class="profile-input" accept="image/*">
        <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:18px;">
            <a href="{{ url()->previous() }}" class="btn" style="background:#eee;color:#222;">Batal</a>
            <button type="submit" class="btn">Simpan</button>
        </div>
    </form>
</div>
<script>
function handleSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => {
        if (response.ok) {
            window.location.href = '/profile_page?success=1';
        } else {
            alert('Terjadi kesalahan saat memperbarui data.');
        }
    })
    .catch(() => {
        alert('Terjadi kesalahan saat memperbarui data.');
    });
    return false;
}
// Show alert if redirected with success
if (window.location.search.includes('success=1')) {
    alert('Data berhasil diperbarui');
}
</script>
</body>
</html>
