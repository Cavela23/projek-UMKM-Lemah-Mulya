<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\kategori;

class KategoriController extends Controller
{
    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'Kategori' => 'required|string|max:100',
        ]);
        $kategori = new kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Mengambil semua kategori (untuk kebutuhan select, dsb)
    public function all()
    {
        $kategoris = kategori::all();
        return response()->json($kategoris);
    }
}
