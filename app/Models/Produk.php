<?php

// Produk.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; // Nama tabel dalam database

    protected $fillable = ['nama_produk', 'harga', 'img', 'user_id']; // Kolom yang dapat diisi

    // Relasi dengan tabel id_user
    public function stock()
    {
        return $this->hasOne(Stock::class, 'nama_produk', 'nama_produk');
    }
}

