@extends('layouts.admin2')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Produk</h1>
        <div class="d-sm-flex align-items-center justify-content-between">
            <p class="mb-4">Daftar produk yang disewakan {{ Auth::user()->name }} </p>
            <a href="{{ route('adminproduk.create') }}" class="btn btn-primary btn-icon-split mb-4">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Produk</span>
            </a>
            @if (Session::has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Nama Produk</th>
                                <th style="width: 25%">Harga</th>
                                <th style="width: 25%">Gambar</th>
                                <th style="width: 15%">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produks as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <img src="{{ $produk->img }}" style="max-width: 100px; max-height: 100px;"
                                            alt="Product Image">
                                    </td>
                                    <td style="align-content: space-around">
                                        <div style="padding: 5%">
                                            <a href="{{ route('adminproduk.edit', $produk->id) }}"
                                                class="btn btn-success btn-block" style="margin-bottom: 10px;">Edit</a>
                                            <form action="{{ route('adminproduk.destroy', $produk->id) }}" method="POST"
                                                onsubmit="return confirm('Delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-google btn-block">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center py-4" colspan="5">Tidak Ada Produk Di Toko
                                        {{ Auth::user()->name }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
