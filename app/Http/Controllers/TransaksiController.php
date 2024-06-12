<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Stock;

class TransaksiController extends Controller
{
    public function create(Request $request)
{
    // Validasi data yang diterima dari form
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'telepon' => 'required|string|max:255',
        'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
    ], [
        'nama.required' => 'Nama tidak boleh kosong',
        'alamat.required' => 'Alamat tidak boleh kosong',
        'telepon.required' => 'telepon tidak boleh kosong',
        'bukti_transfer.image' => 'File harus berupa gambar',
        'bukti_transfer.mimes' => 'Format file harus jpeg, png, jpg, gif, atau svg',
        'bukti_transfer.max' => 'Ukuran file gambar tidak boleh melebihi 2048 kilobita',
    ]);

    $user_id = auth()->id(); // Mendapatkan ID pengguna yang saat ini masuk

    if ($request->hasFile('bukti_transfer')) {
        $image = $request->file('bukti_transfer');
        $originalName = $image->getClientOriginalName();
        $imageName = time() . '_' . $originalName;
        $image->move(public_path('bukti_transfer'), $imageName); // Simpan foto ke direktori publik
        $fotoPath = url('bukti_transfer/' . $imageName);
    }
    

    // Dapatkan produk yang dipilih dari sesi
    $produkDipilih = session()->get('produkDipilih');

    // Inisialisasi total harga
    $totalHarga = 0;

    // Simpan nama produk yang dipilih dalam bentuk string terpisah dengan koma
    $namaProdukDipilih = [];

    // Hitung total harga untuk semua produk yang dipilih
    foreach ($produkDipilih as $namaProduk => $detail) {
        // Dapatkan stok produk dari tabel stocks berdasarkan nama produk
        $stock = Stock::where('nama_produk', $namaProduk)->first();

        // Kurangi jumlah stok produk berdasarkan jumlah yang dibeli
        $stock->total_stok -= $detail['jumlah'];
        // Simpan perubahan jumlah stok produk
        $stock->save();
        // Dapatkan harga produk dari database berdasarkan nama produk
        $produk = Produk::where('nama_produk', $namaProduk)->first();
        // Hitung harga total untuk produk ini
        $hargaTotalProduk = $produk->harga * $detail['jumlah'] * $detail['hari'];
        // Tambahkan harga total produk ke total harga keseluruhan
        $totalHarga += $hargaTotalProduk;

        // Buat nama produk dengan jumlah hari
        $namaProdukDenganHari = $namaProduk . ($detail['hari'] > 1 ? "({$detail['hari']})" : '');

        // Simpan nama produk dalam array
        $namaProdukDipilih[] = str_repeat($namaProdukDenganHari . ',', $detail['jumlah']);
    }

    // Gabungkan semua nama produk menjadi satu string tanpa tanda koma di belakang produk terakhir
    $namaProdukString = rtrim(implode(',', $namaProdukDipilih), ',');

    // Simpan data transaksi ke database
    $transaksi = new Transaksi();
    $transaksi->id_pesanan = session('selected_store');
    $transaksi->user_id = $user_id;
    $transaksi->nama = $request->nama;
    $transaksi->alamat = $request->alamat;
    $transaksi->telepon = $request->telepon;
    $transaksi->bukti_transfer =  $fotoPath;
    $transaksi->total_harga = $totalHarga;
    $transaksi->nama_produk = $namaProdukString; // Simpan nama produk yang dipilih dalam satu kolom
    $transaksi->status = 0; // Default status
    $transaksi->save();

    // Redirect ke halaman yang sesuai
    return redirect()->route('home')->with('Transaksi berhasil disimpan.');
}  

public function gettransaksi()
{
    $user_id = auth()->id(); // Mendapatkan ID pengguna yang saat ini masuk

    // Ambil semua transaksi dari database yang terkait dengan pengguna yang sedang login
    $riwayatTransaksi = Transaksi::where('user_id', $user_id)->get();

    // Lewati data transaksi ke view untuk ditampilkan
    return view('frontenduser.detailtransaksi', ['riwayatTransaksi' => $riwayatTransaksi]);
}

public function pengajuansewa($id_pesanan)
{
    $id = auth()->id(); // Mendapatkan ID pengguna yang saat ini masuk

    // Ambil semua transaksi dari database yang terkait dengan pengguna yang sedang login dan pesanan tertentu
    $pengajuansewa = Transaksi::where('user_id', $id)
                          ->orWhere('id_pesanan', $id) // Menggunakan orWhere jika user_id dan id_pesanan seharusnya sama
                          ->where('id_pesanan', $id_pesanan)
                          ->get();

    // Lewati data transaksi ke view untuk ditampilkan
    return view('frontendadmin.pengajuansewa.pengajuansewa', ['pengajuansewa' => $pengajuansewa]);
}

public function ubahStatus(Request $request, $id)
{
    // Validasi request
    $request->validate([
        'status' => 'required|integer',
    ]);

    // Temukan transaksi berdasarkan ID
    $transaksi = Transaksi::findOrFail($id);
    // Ubah status transaksi
    $transaksi->status = $request->status;
    $transaksi->save();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Status transaksi berhasil diubah.');
}

public function getTransaksiAdmin(Request $request, $id_pesanan)
{
    $id = auth()->id(); // Mendapatkan ID pengguna yang saat ini masuk
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalAkhir = $request->input('tanggal_akhir');

    // Ambil transaksi berdasarkan ID pesanan dan filter tanggal
    $query = Transaksi::where('user_id', $id)
                ->orWhere('id_pesanan', $id) // Menggunakan orWhere jika user_id dan id_pesanan seharusnya sama
                ->where('id_pesanan', $id_pesanan)
                ->where('status', '!=', 0); // Menambahkan kondisi untuk status selain 0

    if ($tanggalMulai && $tanggalAkhir) {
        $query->whereBetween('created_at', [$tanggalMulai, $tanggalAkhir]);
    }

    $transaksis = $query->get();

    // Inisialisasi array untuk menyimpan statistik
    $statistikPenjualan = [];

foreach ($transaksis as $transaksi) {
    $tanggalTransaksi = $transaksi->created_at->toDateString();

    // Aggregate income per date
    if (!isset($statistikPendapatanPerTanggal[$tanggalTransaksi])) {
        $statistikPendapatanPerTanggal[$tanggalTransaksi] = $transaksi->total_harga;
    } else {
        $statistikPendapatanPerTanggal[$tanggalTransaksi] += $transaksi->total_harga;
    }
}

    // Loop melalui setiap transaksi
    foreach ($transaksis as $transaksi) {
        // Pisahkan nama_produk menjadi produk individu
        $produkDipilih = explode(',', $transaksi->nama_produk);

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
    }
    return view('frontendadmin.statistikpenjualan.statistikpenjualan', compact('statistikPenjualan'));
}

public function gettransaksiadminpendapatan(Request $request, $id_pesanan)
{
    $id = auth()->id(); // Mendapatkan ID pengguna yang saat ini masuk
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalAkhir = $request->input('tanggal_akhir');

    // Ambil transaksi berdasarkan ID pesanan dan filter tanggal
    $query = Transaksi::where('user_id', $id)
                ->orWhere('id_pesanan', $id) // Menggunakan orWhere jika user_id dan id_pesanan seharusnya sama
                ->where('id_pesanan', $id_pesanan)
                ->where('status', '!=', 0); // Menambahkan kondisi untuk status selain 0

    if ($tanggalMulai && $tanggalAkhir) {
        $query->whereBetween('created_at', [$tanggalMulai, $tanggalAkhir]);
    }

    // Menghitung jumlah transaksi
    $jumlahTransaksi = $query->count();

    $transaksis = $query->get();

    // Inisialisasi array untuk menyimpan statistik
    $statistikPendapatan = 0;
    $statistikPendapatanPerTanggal = [];

foreach ($transaksis as $transaksi) {
    $tanggalTransaksi = $transaksi->created_at->toDateString();

    // Aggregate income per date
    if (!isset($statistikPendapatanPerTanggal[$tanggalTransaksi])) {
        $statistikPendapatanPerTanggal[$tanggalTransaksi] = $transaksi->total_harga;
    } else {
        $statistikPendapatanPerTanggal[$tanggalTransaksi] += $transaksi->total_harga;
    }
}

    // Loop melalui setiap transaksi
    foreach ($transaksis as $transaksi) {
        // Pisahkan nama_produk menjadi produk individu
        $produkDipilih = explode(',', $transaksi->nama_produk);

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

        // Tambahkan total_harga transaksi ke statistik pendapatan
        $statistikPendapatan += $transaksi->total_harga;
    }

    return view('frontendadmin.statistikpenjualan.statistikpendapatan', compact( 'statistikPendapatan', 'statistikPendapatanPerTanggal', 'jumlahTransaksi'));

}

}