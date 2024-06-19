@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container">
        <h1 class="text-center my-4">Produk dari Toko {{$user->name}}({{ session('selected_store') }})</h1>
        <div class="row">
            @foreach ($produks as $produk)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="{{ $produk->img }}" class="card-img-top" alt="{{ $produk->nama_produk }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                        <p class="card-text">Harga: Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <button onclick="kurangiProduk('{{ $produk->nama_produk }}')" class="btn btn-secondary">-</button>
                                <span id="{{ $produk->nama_produk }}-jumlah">0</span>
                                <button onclick="tambahProduk('{{ $produk->nama_produk }}')" class="btn btn-primary">+</button>
                            </div>
                            <div>
                                <label for="{{ $produk->nama_produk }}-hari">Hari:</label>
                                <input type="number" id="{{ $produk->nama_produk }}-hari" name="{{ $produk->nama_produk }}-hari" value="0" min="0" class="form-control form-control-sm" onchange="updateHari('{{ $produk->nama_produk }}')">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-footer text-muted text-center">
                            Stok tersedia
                        </div> --}}
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-4">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('detailpesanan') }}" id="btn-lanjut" class="btn btn-success disabled col-md-12">Lanjut
                        (Jumlah Item Terpilih: <span id="jumlah-item-terpilih">0</span>)</a>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        const jumlahProduk = {};

        function tambahProduk(namaProduk) {
            if (!jumlahProduk[namaProduk]) {
                jumlahProduk[namaProduk] = {
                    jumlah: 0,
                    hari: 0
                };
            }
            jumlahProduk[namaProduk].jumlah++;
            updateJumlahItemTerpilih();
        }

        function kurangiProduk(namaProduk) {
            if (!jumlahProduk[namaProduk]) {
                jumlahProduk[namaProduk] = {
                    jumlah: 0,
                    hari: 0
                };
            }
            if (jumlahProduk[namaProduk].jumlah > 0) {
                jumlahProduk[namaProduk].jumlah--;
            }
            updateJumlahItemTerpilih();
        }

        function updateHari(namaProduk) {
            const hariInput = document.getElementById(namaProduk + '-hari').value;
            jumlahProduk[namaProduk].hari = parseInt(hariInput) || 0;
            updateJumlahItemTerpilih();
        }

        function updateJumlahItemTerpilih() {
            let totalProdukTerpilih = 0;
            let totalHariTerpilih = 0;
            for (let key in jumlahProduk) {
                totalProdukTerpilih += jumlahProduk[key].jumlah;
                totalHariTerpilih += jumlahProduk[key].hari;
                document.getElementById(key + '-jumlah').innerText = jumlahProduk[key].jumlah;
            }
            document.getElementById('jumlah-item-terpilih').innerText = totalProdukTerpilih;

            const btnLanjut = document.getElementById('btn-lanjut');
            if (totalProdukTerpilih > 0) {
                btnLanjut.classList.remove('disabled');
                btnLanjut.href = "{{ route('detailpesanan') }}?produk=" + encodeURIComponent(JSON.stringify(jumlahProduk)) + "&total_hari=" + totalHariTerpilih;
            } else {
                btnLanjut.classList.add('disabled');
                btnLanjut.removeAttribute('href');
            }
        }
    </script>
    @endpush