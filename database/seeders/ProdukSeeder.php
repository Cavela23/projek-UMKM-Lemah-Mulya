<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\User;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::first();
        $user2 = User::skip(1)->first();
        Produk::create([
            'nama_produk' => 'Seblak Original',
            'kategori' => 'Makanan',
            'harga' => 12000,
            'user_id' => $user1 ? $user1->id : 1,
        ]);
        Produk::create([
            'nama_produk' => 'Es Teh Manis',
            'kategori' => 'Minuman',
            'harga' => 5000,
            'user_id' => $user1 ? $user1->id : 1,
        ]);
        Produk::create([
            'nama_produk' => 'Nasi Goreng',
            'kategori' => 'Makanan',
            'harga' => 15000,
            'user_id' => $user2 ? $user2->id : 2,
        ]);
        Produk::create([
            'nama_produk' => 'Kopi Susu',
            'kategori' => 'Minuman',
            'harga' => 8000,
            'user_id' => $user2 ? $user2->id : 2,
        ]);
    }
}
