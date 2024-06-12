<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StatistikController extends Controller
{
    public function getTransaksiAdmin()
    {
        $query = Transaksi::where('status', '!=', 0);
        $transaksis = $query->get();

        $statistikPenjualanPerPesanan = [];

        foreach ($transaksis as $transaksi) {
            $produkDipilih = explode(',', $transaksi->nama_produk);

            foreach ($produkDipilih as $produk) {
                $produk = trim($produk);
                $namaProduk = explode('(', $produk)[0];

                if (!empty($namaProduk)) {
                    if (!isset($statistikPenjualanPerPesanan[$transaksi->id_pesanan][$namaProduk])) {
                        $statistikPenjualanPerPesanan[$transaksi->id_pesanan][$namaProduk] = 1;
                    } else {
                        $statistikPenjualanPerPesanan[$transaksi->id_pesanan][$namaProduk]++;
                    }
                }
            }
        }

        return view('frontendsuperadmin.statistik', compact('statistikPenjualanPerPesanan'));
    }

    public function gettransaksiadminpendapatan()
    {
        // Ambil transaksi berdasarkan ID pesanan dan filter tanggal
        $transaksis = Transaksi::where('status', '!=', 0)->get();

        // Inisialisasi array untuk menyimpan statistik per id_pesanan
        $jumlahTransaksiPerPesanan = [];
        $statistikPerPesanan = [];

        // Loop melalui setiap transaksi
        foreach ($transaksis as $transaksi) {
            // Pisahkan nama_produk menjadi produk individu
            $produkDipilih = explode(',', $transaksi->nama_produk);

            // Hitung total transaksi per pesanan
            $idPesanan = $transaksi->id_pesanan;
            if (!isset($jumlahTransaksiPerPesanan[$idPesanan])) {
                $jumlahTransaksiPerPesanan[$idPesanan] = 1;
            } else {
                $jumlahTransaksiPerPesanan[$idPesanan]++;
            }

            // Inisialisasi array statistikPenjualan untuk transaksi ini
            $statistikPenjualan = [];

            // Loop melalui setiap produk yang dipilih dalam transaksi ini
            foreach ($produkDipilih as $produk) {
                // Hilangkan spasi di sekitar nama produk
                $produk = trim($produk);

                // Pisahkan nama produk dari jumlah hari jika ada
                $namaProduk = explode('(', $produk)[0]; // Ambil bagian nama produk sebelum '('

                // Pastikan nama produk tidak kosong
                if (!empty($namaProduk)) {
                    // Jika produk belum ada di array statistikPenjualan, tambahkan dengan nilai awal 1
                    if (!isset($statistikPenjualan[$namaProduk])) {
                        $statistikPenjualan[$namaProduk] = 1;
                    } else {
                        // Jika produk sudah ada di array statistikPenjualan, tambahkan 1 ke nilai yang ada
                        $statistikPenjualan[$namaProduk]++;
                    }
                }
            }

            // Tambahkan total_harga transaksi ke statistik pendapatan per id_pesanan
            if (!isset($statistikPerPesanan[$idPesanan])) {
                $statistikPerPesanan[$idPesanan] = [
                    'statistikPendapatan' => $transaksi->total_harga,
                    'statistikPenjualan' => $statistikPenjualan,
                ];
            } else {
                $statistikPerPesanan[$idPesanan]['statistikPendapatan'] += $transaksi->total_harga;
                // Gabungkan statistikPenjualan transaksi ini dengan statistikPenjualan yang ada
                foreach ($statistikPenjualan as $produk => $jumlah) {
                    if (!isset($statistikPerPesanan[$idPesanan]['statistikPenjualan'][$produk])) {
                        $statistikPerPesanan[$idPesanan]['statistikPenjualan'][$produk] = $jumlah;
                    } else {
                        $statistikPerPesanan[$idPesanan]['statistikPenjualan'][$produk] += $jumlah;
                    }
                }
            }
        }

        // Mengembalikan view dengan variabel yang diperlukan, termasuk total transaksi per pesanan
        return view('frontendsuperadmin.statistikpendapatan', compact('statistikPerPesanan', 'jumlahTransaksiPerPesanan'));
    }

}
