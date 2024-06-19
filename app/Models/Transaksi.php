<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $primary_key = 'id';
    protected $fillable = [
        'id_pesanan',
        'user_id',
        'nama',
        'alamat',
        'telepon',
        'nama_produk',
        'total_harga',
        'bukti_transfer',
        'status',
    ];

    // Di model Transaksi.php
    public function Transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_pesanan');
    }
}