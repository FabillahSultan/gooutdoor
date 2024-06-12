@extends('layouts.admin2')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Statistik Penjualan PerProduk</h1>
        <div class="d-sm-flex align-items-center justify-content-between">
            <p class="mb-4">Statistik Toko {{ Auth::user()->name }}</p>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik</h6>
            </div>
            <form method="GET"
                action="{{ route('admin.statistikpenjualanproduk', ['id_pesanan' => request('id_pesanan')]) }}">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="mb-4">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai:</label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                                value="{{ request('tanggal_mulai') }}">
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_akhir" class="form-label">Tanggal Akhir:</label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                                value="{{ request('tanggal_akhir') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-4">Tampilkan</button>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 25%">Nama Produk</th>
                                    <th style="width: 25%">Jumlah Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $labels = [];
                                    $data = [];
                                @endphp

                                @if ($statistikPenjualan)
                                    @foreach ($statistikPenjualan as $nama_produk => $jumlah)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nama_produk }}</td>
                                            <td>{{ $jumlah }}</td>
                                        </tr>
                                        @php
                                            $labels[] = $nama_produk;
                                            $data[] = $jumlah;
                                        @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>


        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan PerProduk</h6>
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#chartCollapse"
                    aria-expanded="false" aria-controls="chartCollapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="card-body collapse show" id="chartCollapse">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!}, // Menggunakan label produk
                datasets: [{
                    label: 'Jumlah Penjualan',
                    data: {!! json_encode($data) !!}, // Menggunakan jumlah penjualan
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
