@extends('layouts.user')
@section('content')

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Riwayat Transaksi</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Riwayat Transaksi</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5 ">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col" style="padding-left: 3%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatTransaksi as $transaksi)
                            <tr>
                                <td>
                                    <p class="mb-0 mt-4">{{ $transaksi->nama }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ $transaksi->created_at->format('d F Y H:i:s') }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                    </p>
                                </td>
                                <td style="padding-left: 3%">
                                    @if ($transaksi->status == 0)
                                        <a href="/checkout/{{ $transaksi->id }}" class="btn btn-success mb-0 mt-3">Bayar
                                            Sekarang</a>
                                    @else
                                        <p class="mb-0 mt-4">Sudah Bayar</p>
                                    @endif
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
