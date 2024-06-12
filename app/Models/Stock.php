<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'total_stok',
        'img',
        'id_user',
        
    ];

    // Relasi dengan tabel id_user
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'nama_produk', 'nama_produk');
    }
}

