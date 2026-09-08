<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Daftar_UMKM extends Model
{
    protected $table = 'daftar_umkm';
    protected $fillable = [
        'nama_umkm',
        'nomor_hp',
        'password',
    ];
}
