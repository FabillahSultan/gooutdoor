@extends('layouts.admin2')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Edit Stock</h1>
        <p class="mb-4">Edit Produk {{ Auth::user()->name }}</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Stock</h6>
            </div>
            <div id="solid">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="sbp-preview">
                            <div class="sbp-preview-content">
                                <form action="{{ route('adminstock.update', $stock->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="mb-3">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" class="form-control form-control-solid" name="produk_id"
                                            id="produk_id" value="{{ $stock->nama_produk }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_stock">Total Stok</label>
                                        <input type="text"
                                            class="form-control form-control-solid @error('total_stock')
                                            is-invalid @enderror"
                                            name="total_stock" id="total_stock"
                                                value="{{ old('total_stock', $stock->total_stok) }}" placeholder="Enter Total Stock">
                                                @error('total_stock')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-icon-split mt-3">
                                        <span class="text">Simpan</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
