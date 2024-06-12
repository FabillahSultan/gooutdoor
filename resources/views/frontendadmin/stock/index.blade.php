@extends('layouts.admin2')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Stok</h1>
        <div class="d-sm-flex align-items-center justify-content-between">
            <p class="mb-4">Daftar Stok Produk Toko {{ Auth::user()->name }}</p>
            @if (Session::has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Stok Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Nama Produk</th>
                                <th style="width: 25%">Total Stock</th>
                                <th style="width: 15%">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($stocks->count() > 0)
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $stock->nama_produk }}</td>
                                    <td>{{ $stock->total_stok }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('adminstock.edit', $stock->id)}}" >Edit</a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center py-4" colspan="5">Tidak Ada Stock Produk Di Toko {{ Auth::user()->name }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
