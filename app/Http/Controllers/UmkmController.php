<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;

class UmkmController extends Controller
{
    // Halaman utama (welcome)
    public function index()
    {
        $umkms = User::where('role', 'user')->get();
        $products = Produk::with('user')->latest()->take(8)->get();
        $categories = User::where('role', 'user')
            ->whereNotNull('kategori_umkm')
            ->where('kategori_umkm', '!=', '')
            ->distinct()
            ->orderBy('kategori_umkm')
            ->pluck('kategori_umkm');

        return view('welcome', compact('umkms', 'products', 'categories'));
    }

    // Halaman edit UMKM
    public function edit()
    {
        $user = auth()->user();
        return view('edit_umkm', compact('user'));
    }

    // Fungsi untuk menghapus user UMKM (hanya oleh admin)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // Pastikan hanya user dengan role 'user' yang bisa dihapus
        if ($user->role !== 'user') {
            return redirect()->back()->with('error', 'Akun ini tidak dapat dihapus.');
        }
        $user->delete();
        return redirect()->back()->with('success', 'UMKM berhasil dihapus!');
    }

    // Update data UMKM
    public function update(Request $request)
    {
        $user = auth()->user();
        if (!$user && session('user_id')) {
            $user = User::find(session('user_id'));
        }
        if (!$user) {
            return redirect('login');
        }
        $user->nama_umkm = $request->input('nama_umkm');
        $user->alamat_umkm = $request->input('alamat_umkm');
        $user->deskripsi_umkm = $request->input('deskripsi_umkm');
        $user->phone = $request->input('phone');
        $user->kategori_umkm = $request->input('kategori_umkm');
        $user->save();
        return redirect('profile_page')->with('success', 'Data UMKM berhasil diupdate!');
    }
}
