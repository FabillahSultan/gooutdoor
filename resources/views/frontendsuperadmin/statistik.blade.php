@extends('layouts.superadmin')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="row">
            @foreach ($statistikPenjualanPerPesanan as $idPesanan => $statistikPenjualan)
                @php
                    // Query transaksi_users berdasarkan $idPesanan
                    $transaksi_users = DB::table('transaksi')
                        ->join('users', 'transaksi.id_pesanan', '=', 'users.id')
                        ->where('transaksi.id_pesanan', $idPesanan)
                        ->select('transaksi.id_pesanan', 'users.name')
                        ->get();
                @endphp

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    @php
                                        $prevProductName = null;
                                    @endphp
                                    @foreach ($transaksi_users as $data)
                                        @if ($data->name !== $prevProductName)
                                            <h6 class="text-primary mb-3">Produk Terjual {{ $data->name }}</h6>
                                            @php
                                                $prevProductName = $data->name;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Nama Produk</th>
                                                    <th scope="col">Jumlah Terjual</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($statistikPenjualan as $namaProduk => $jumlahTerjual)
                                                    <tr>
                                                        <td>{{ $namaProduk }}</td>
                                                        <td class="text-center">{{ $jumlahTerjual }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
