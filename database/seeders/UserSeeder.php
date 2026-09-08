<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Nonaktifkan foreign key checks, truncate produk & users, lalu aktifkan lagi
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('produk')->truncate();
        \App\Models\User::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '081200000000',
                'profile_photo' => null,
                'nama_umkm' => null,
                'alamat_umkm' => null,
                'deskripsi_umkm' => null,
                'kategori_umkm' => null,
            ],
            [
                'name' => 'Fauzian',
                'email' => 'test@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Seblak Sari Indah',
                'alamat_umkm' => 'Jl, sari sari jaya rt 07 rw 08',
                'kategori_umkm' => 'Makanan',
                'phone' => '081238833838',
                'profile_photo' => 'profile_1_1754054751.jpg',
            ],
            [
                'name' => 'Ilham',
                'email' => 'ilham@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Kios Sarasa',
                'alamat_umkm' => 'Jl, sari sari jaya rt 07 rw 08',
                'kategori_umkm' => 'Makanan',
                'phone' => '081221732267',
                'profile_photo' => 'profile_2_1754054902.jpg',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Warung Siti',
                'alamat_umkm' => 'Jl. Melati No. 10',
                'kategori_umkm' => 'Sembako',
                'phone' => '081234567891',
                'profile_photo' => 'profile_3_1754055000.jpg',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Budi Cell',
                'alamat_umkm' => 'Jl. Kenanga No. 5',
                'kategori_umkm' => 'Elektronik',
                'phone' => '081234567892',
                'profile_photo' => 'profile_4_1754055001.jpg',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Dewi Bakery',
                'alamat_umkm' => 'Jl. Mawar No. 2',
                'kategori_umkm' => 'Makanan',
                'phone' => '081234567893',
                'profile_photo' => 'profile_5_1754055002.jpg',
            ],
            [
                'name' => 'Agus Pratama',
                'email' => 'agus@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Agus Motor',
                'alamat_umkm' => 'Jl. Anggrek No. 7',
                'kategori_umkm' => 'Otomotif',
                'phone' => '081234567894',
                'profile_photo' => 'profile_6_1754055003.jpg',
            ],
            [
                'name' => 'Rina Marlina',
                'email' => 'rina@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Rina Fashion',
                'alamat_umkm' => 'Jl. Dahlia No. 3',
                'kategori_umkm' => 'Fashion',
                'phone' => '081234567895',
                'profile_photo' => 'profile_7_1754055004.jpg',
            ],
            [
                'name' => 'Tono Supriyadi',
                'email' => 'tono@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Toko Tono',
                'alamat_umkm' => 'Jl. Flamboyan No. 8',
                'kategori_umkm' => 'Sembako',
                'phone' => '081234567896',
                'profile_photo' => 'profile_8_1754055005.jpg',
            ],
            [
                'name' => 'Lina Agustina',
                'email' => 'lina@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Lina Salon',
                'alamat_umkm' => 'Jl. Cempaka No. 4',
                'kategori_umkm' => 'Jasa',
                'phone' => '081234567897',
                'profile_photo' => 'profile_9_1754055006.jpg',
            ],
            [
                'name' => 'Yusuf Hidayat',
                'email' => 'yusuf@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Yusuf Printing',
                'alamat_umkm' => 'Jl. Teratai No. 6',
                'kategori_umkm' => 'Percetakan',
                'phone' => '081234567898',
                'profile_photo' => 'profile_10_1754055007.jpg',
            ],
            [
                'name' => 'Sari Wulandari',
                'email' => 'sari@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Sari Florist',
                'alamat_umkm' => 'Jl. Bougenville No. 9',
                'kategori_umkm' => 'Jasa',
                'phone' => '081234567899',
                'profile_photo' => 'profile_11_1754055008.jpg',
            ],
            [
                'name' => 'Dedi Kurniawan',
                'email' => 'dedi@mail.com',
                'password' => Hash::make('password'),
                'nama_umkm' => 'Dedi Elektronik',
                'alamat_umkm' => 'Jl. Sakura No. 11',
                'kategori_umkm' => 'Elektronik',
                'phone' => '081234567900',
                'profile_photo' => 'profile_12_1754055009.jpg',
            ],
            // Tambahkan data user lain di sini jika perlu
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
