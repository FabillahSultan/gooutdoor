public function gettransaksiadmin($id_pesanan)
{
    $id = auth()->id(); // Mendapatkan ID pengguna yang saat ini masuk
    // Ambil transaksi berdasarkan ID pesanan
    $transaksis = Transaksi::where('user_id', $id)
                    ->orWhere('id_pesanan', $id) // Menggunakan orWhere jika user_id dan id_pesanan seharusnya sama
                    ->where('id_pesanan', $id_pesanan)
                    ->where('status', '!=', 0) // Menambahkan kondisi untuk status selain 0
                    ->get();

    // Inisialisasi array untuk menyimpan statistik penjualan
    $statistikPenjualan = [];

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

    // Menampilkan hasil statistik
    return view('frontendadmin.statistikpenjualan.statistikpenjualan', ['statistikPenjualan' => $statistikPenjualan]);
}