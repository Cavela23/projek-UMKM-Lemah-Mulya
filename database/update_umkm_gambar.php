<?php
// Jalankan script ini sekali saja untuk sinkronisasi gambar UMKM dari users ke daftar_umkm berdasarkan email

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$connection = $app->make('db')->connection();
$users = $connection->table('users')->whereNotNull('profile_photo')->get();
foreach ($users as $user) {
    $connection->table('daftar_umkm')->where('email', $user->email)
        ->update(['gambar' => $user->profile_photo]);
}
echo "Sinkronisasi gambar UMKM selesai!\n";
