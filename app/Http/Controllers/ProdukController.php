<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Tambah produk
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'foto_produk' => 'nullable|image|max:2048',
        ]);
        $foto_produk = null;
        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $filename = 'produk_' . ($request->user_id ?? session('user_id')) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('profile_photos');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $foto_produk = $filename;
        }
        Produk::create([
            'nama_produk' => $request->input('nama_produk'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'foto_produk' => $foto_produk,
            'user_id' => $request->user_id ?? session('user_id'),
            'kategori' => $request->input('kategori', null),
        ]);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->foto_produk) {
            $path = public_path('profile_photos/' . $produk->foto_produk);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    // Ambil data produk untuk modal edit (AJAX)
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return response()->json($produk);
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'foto_produk' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto_produk')) {
            // Hapus foto lama
            if ($produk->foto_produk) {
                $path = public_path('profile_photos/' . $produk->foto_produk);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $file = $request->file('foto_produk');
            $filename = 'produk_' . $produk->user_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('profile_photos');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $produk->foto_produk = $filename;
        }
        $produk->nama_produk = $request->input('nama_produk');
        $produk->harga = $request->input('harga');
        $produk->deskripsi = $request->input('deskripsi');
        $produk->kategori = $request->input('kategori', $produk->kategori);
        $produk->save();
        return redirect()->back()->with('success', 'Produk berhasil diupdate!');
    }
}
