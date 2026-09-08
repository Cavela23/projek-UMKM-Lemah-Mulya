<?php
use Illuminate\Support\Facades\Route;
use App\Models\Produk;

Route::get('/daftar_produk', function () {
    $produks = Produk::with('user')->get();
    return view('daftar_produk', compact('produks'));
});
