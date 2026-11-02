<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UmkmController;
use App\Models\User;
use App\Models\Produk;
use App\Http\Controllers\ProdukController;

// Halaman utama
Route::get('/', [UmkmController::class, 'index']);

use App\Http\Controllers\ProfileController;
// Route untuk update profile dari modal Bootstrap
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Auth & User
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/login', function () { return view('login_page'); });
Route::get('/register', function () { return view('register_page'); });
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    $request->session()->flush();
    return redirect('/');
})->name('logout');

// Profile
Route::get('/profile', function () {
    return 'Profil user: ' . session('user_name');
})->name('profile');
Route::get('/profile_page', function () {
    $user = null;
    if(session('user_id')) {
        $user = User::find(session('user_id'));
    }
    return view('profile', ['user' => $user]);
});
Route::post('/edit-umkm', function (\Illuminate\Http\Request $request) {
    if (!session('user_id')) return redirect('login');
    $user = User::find(session('user_id'));
    if ($user) {
        $user->alamat_umkm = $request->input('alamat_umkm');
        $user->deskripsi_umkm = $request->input('deskripsi_umkm');
        $user->phone = $request->input('phone');
        $user->kategori_umkm = $request->input('kategori_umkm');
        $user->save();
    }
    return redirect('profile_page');
});

// UMKM & Produk
Route::get('/daftar_umkm', function () {
    $q = request('q');
    $umkms = User::query();
    if ($q) {
        $umkms = $umkms->where(function($query) use ($q) {
            $query->where('nama_umkm', 'like', "%$q%")
                  ->orWhere('kategori_umkm', 'like', "%$q%")
                  ->orWhere('alamat_umkm', 'like', "%$q%")
                  ->orWhere('email', 'like', "%$q%")
                  ->orWhere('phone', 'like', "%$q%")
                  ->orWhere('name', 'like', "%$q%") ;
        });
    }
    $umkms = $umkms->get();
    $categories = User::where('role', 'user')
        ->whereNotNull('kategori_umkm')
        ->where('kategori_umkm', '!=', '')
        ->distinct()
        ->orderBy('kategori_umkm')
        ->pluck('kategori_umkm');

    return view('daftar_umkm', compact('umkms', 'categories'));
});
Route::get('umkm/edit', function() {
    if (!session('user_id')) {
        return redirect('login');
    }
    $user = User::find(session('user_id'));
    return view('edit_umkm', compact('user'));
})->name('umkm.edit');
Route::delete('/umkm/{id}', [App\Http\Controllers\UmkmController::class, 'destroy'])->name('umkm.destroy');
Route::get('/detail_umkm/{id}', function($id) {
    $umkm = User::findOrFail($id);
    $produks = Produk::where('user_id', $umkm->id)->get();
    return view('detail_umkm', compact('umkm', 'produks'));
});
Route::get('/detail_produk/{id}', function($id) {
    $produk = Produk::with('user')->findOrFail($id);
    $produkLainnya = Produk::with('user')
        ->where('id', '!=', $produk->id)
        ->where(function ($query) use ($produk) {
            $query->where('kategori', $produk->kategori)
                ->orWhere('user_id', $produk->user_id);
        })
        ->latest()
        ->take(3)
        ->get();

    return view('detail_produk', compact('produk', 'produkLainnya'));
});
Route::get('/daftar_produk', function () {
    $q = request('q');
    $produks = Produk::with('user');
    if ($q) {
        $produks = $produks->where(function($query) use ($q) {
            $query->where('nama_produk', 'like', "%$q%")
                  ->orWhere('kategori', 'like', "%$q%")
                  ->orWhere('deskripsi', 'like', "%$q%")
                  ->orWhereHas('user', function($u) use ($q) {
                      $u->where('nama_umkm', 'like', "%$q%")
                        ->orWhere('name', 'like', "%$q%")
                        ->orWhere('kategori_umkm', 'like', "%$q%")
                        ->orWhere('alamat_umkm', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%")
                        ->orWhere('phone', 'like', "%$q%") ;
                  });
        });
    }
    $produks = $produks->get();
    return view('daftar_produk', compact('produks'));
});

// Route update UMKM
Route::put('umkm/update', [UmkmController::class, 'update'])->name('umkm.update');
Route::post('umkm/update', [UmkmController::class, 'update']);

// Produk CRUD
Route::post('/tambah-produk', [ProdukController::class, 'store'])->name('produk.store');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::post('/produk/{id}/update', [ProdukController::class, 'update'])->name('produk.update');
Route::match(['put', 'patch'], '/produk/{id}', [ProdukController::class, 'update'])->name('produk.update.patch');

Route::get('produk/edit/{id}', function($id) {
    $produk = Produk::findOrFail($id);
    return view('edit_produk', compact('produk'));
});

// Kategori CRUD
use App\Http\Controllers\KategoriController;
Route::post('/kategori/tambah', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/all', [KategoriController::class, 'all'])->name('kategori.all');