@extends('layouts.superadmin')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Statistik Pendapatan</h1>
        </div>

        <!-- Statistik Pendapatan per Pesanan -->
        @foreach($statistikPerPesanan as $idPesanan => $statistik)
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow h-100 py-2">
                        <div class="card-body">
                            @php
                                // Query transaksi_users berdasarkan $idPesanan
                                $transaksi_users = DB::table('transaksi')
                                    ->join('users', 'transaksi.id_pesanan', '=', 'users.id')
                                    ->where('transaksi.id_pesanan', $idPesanan)
                                    ->select('transaksi.id_pesanan', 'users.name')
                                    ->get();
                            @endphp

                            <!-- Tampilkan nama pengguna jika ada -->
                            @if($transaksi_users->isNotEmpty())
                                <div class="text-mb font-weight-bold text-primary text-uppercase mb-4">Toko {{ $transaksi_users[0]->name }}</div>
                            @endif

                            <div class="h6 mb-2 font-weight-bold text-gray-800">Total Pendapatan: Rp {{ number_format($statistik['statistikPendapatan'], 0, ',', '.') }}</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total Transaksi: {{ $jumlahTransaksiPerPesanan[$idPesanan] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
