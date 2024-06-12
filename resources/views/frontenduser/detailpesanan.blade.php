@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Pesanan</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                <h2>Detail Pelanggan</h2>
                <!-- Form untuk input data pelanggan -->
                <form method="POST" action="{{ route('transaksi') }}" enctype="multipart/form-data" id="form-pesanan">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="telepon">Nomor Telepon:</label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon') }}" required>
                        @error('telepon')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="bukti_transfer">Foto Bukti Transfer:</label>
                        <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror" id="bukti_transfer" name="bukti_transfer" accept="image/*" onchange="previewImage(event)">
                        <img src="#" id="preview" style="display: none; max-width: 200px; margin-top: 10px;" />
                        @error('bukti_transfer')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Tombol submit -->
                    <button type="submit" class="btn btn-primary mt-3">Proses Pesanan</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Detail Pesanan</h2>
                <!-- Mengambil data produk yang dipilih dari query string -->
                @php
                    $produkDipilih = json_decode(request()->get('produk'), true);
                    $totalHari = request()->get('total_hari');
                    $totalHarga = 0; // Inisialisasi total harga
                @endphp
                <!-- Tampilkan tabel hanya jika ada produk yang dipilih -->
                @if ($produkDipilih && count($produkDipilih) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id_pesanan</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Hari</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop untuk menampilkan detail produk -->
                            @foreach ($produkDipilih as $namaProduk => $detail)
                                @php
                                    // Dapatkan harga produk dari database berdasarkan nama produk
                                    $produk = App\Models\Produk::where('nama_produk', $namaProduk)->first();
                                    // Hitung harga total untuk produk ini
                                    $hargaTotalProduk = $produk->harga * $detail['jumlah'] * $detail['hari'];
                                    // Tambahkan harga total produk ke total harga keseluruhan
                                    $totalHarga += $hargaTotalProduk;
                                @endphp
                                <tr>
                                    <td>{{ session('selected_store')}}</td>
                                    <td>{{ $namaProduk }}</td>
                                    <td>{{ $detail['jumlah'] }}</td>
                                    <td>{{ $detail['hari'] }}</td>
                                    <td>Rp {{ number_format($hargaTotalProduk, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="font-weight-bold">Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
                @else
                    <p class="alert alert-warning">Belum ada produk yang dipilih.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
