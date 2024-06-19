@extends('layouts.user')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ $user->name }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">shop</a></li>
            <li class="breadcrumb-item active text-white">{{ $user->name }}</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Produk dari Toko {{ $user->name }} ({{ session('selected_store') }})</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Nothing</option>
                                    <option value="saab">Popularity</option>
                                    <option value="opel">Organic</option>
                                    <option value="audi">Fantastic</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach ($produks as $produk)
                                    <div class="col-md-6 col-lg-6 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ $produk->img }}" class="img-fluid w-100 rounded-top"
                                                    alt="{{ $produk->nama_produk }}">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">Stok Tersedia:
                                                <span id="{{ $produk->nama_produk }}-stok">{{ $produk->total_stok }}</span>
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $produk->nama_produk }}</h4>
                                                <p>Harga: Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                                                @if ($produk->total_stok > 0)
                                                    <!-- Menambahkan kondisi stok -->
                                                    <div class="mt-auto">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <button onclick="kurangiProduk('{{ $produk->nama_produk }}')"
                                                                class="btn btn-secondary">-</button>
                                                            <span id="{{ $produk->nama_produk }}-jumlah">0</span>
                                                            <button onclick="tambahProduk('{{ $produk->nama_produk }}')"
                                                                class="btn btn-primary">+</button>
                                                        </div>
                                                        <div>
                                                            <label for="{{ $produk->nama_produk }}-hari">Hari:</label>
                                                            <input type="number" id="{{ $produk->nama_produk }}-hari"
                                                                name="{{ $produk->nama_produk }}-hari" value="0"
                                                                min="0" class="form-control form-control-sm"
                                                                onchange="updateHari('{{ $produk->nama_produk }}')">
                                                        </div>
                                                    </div>
                                                @else
                                                    <p class="text-danger">Stok Habis</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <div class="row" style="margin-top: 5%">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('detailpesanan') }}" id="btn-lanjut"
                                            class="btn btn-success disabled col-md-12">Lanjut
                                            (Jumlah Item Terpilih: <span id="jumlah-item-terpilih">0</span>)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

    <script>
        const jumlahProduk = {};

        function tambahProduk(namaProduk) {
            if (!jumlahProduk[namaProduk]) {
                jumlahProduk[namaProduk] = {
                    jumlah: 0,
                    hari: 0
                };
            }

            // Ambil stok tersedia dari HTML menggunakan dataset atau atribut lainnya
            let stokTersedia = parseInt(document.getElementById(namaProduk + '-stok').innerText.trim());

            // Periksa jika jumlah yang dipilih melebihi stok yang tersedia
            if (jumlahProduk[namaProduk].jumlah >= stokTersedia) {
                alert('Anda tidak dapat memilih lebih dari stok yang tersedia');
                return; // Stop proses tambah jika melebihi stok
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
                btnLanjut.href = "{{ route('detailpesanan') }}?produk=" + encodeURIComponent(JSON.stringify(
                    jumlahProduk)) + "&total_hari=" + totalHariTerpilih;
            } else {
                btnLanjut.classList.add('disabled');
                btnLanjut.removeAttribute('href');
            }
        }
    </script>
@endsection
