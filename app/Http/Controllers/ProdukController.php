<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    private function currentUser()
    {
        return session('user_id') ? \App\Models\User::find(session('user_id')) : null;
    }

    private function authorizeProduct(Produk $produk): void
    {
        $user = $this->currentUser();

        if (!$user) {
            abort(401);
        }

        if ($user->role !== 'admin' && (int) $produk->user_id !== (int) $user->id) {
            abort(403);
        }
    }

    // Tambah produk
    public function store(Request $request)
    {
        $user = $this->currentUser();
        if (!$user) {
            return redirect('login');
        }

        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $foto_produk = null;
        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $filename = 'produk_' . $user->id . '_' . Str::uuid() . '.' . $file->extension();
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
            'user_id' => $user->id,
            'kategori' => $request->input('kategori', null),
        ]);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $this->authorizeProduct($produk);

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
        $this->authorizeProduct($produk);

        return response()->json($produk);
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $this->authorizeProduct($produk);

        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
            $filename = 'produk_' . $produk->user_id . '_' . Str::uuid() . '.' . $file->extension();
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
