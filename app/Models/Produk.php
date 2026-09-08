<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = [
        'nama_produk',
        'kategori',
        'harga',
        'user_id',
        'foto_produk',
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
