@extends('layouts.admin2')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Edit Produk</h1>
        <p class="mb-4">Edit Produk {{ Auth::user()->name }}</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
            </div>
            <div id="solid">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="sbp-preview">
                            <div class="sbp-preview-content">
                                <form action="{{ route('adminproduk.update', $produk->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="mb-3">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text"
                                            class="form-control form-control-solid @error('nama_produk')
                                        is-invalid @enderror"
                                            name="nama_produk" id="nama_produk" placeholder="Masukan Nama Produk"
                                            value="{{ old('nama_produk', $produk->nama_produk) }}">
                                        @error('nama_produk')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga">Harga</label>
                                        <input type="text"
                                            class="form-control form-control-solid  @error('harga')
                                        is-invalid @enderror"
                                            name="harga" id="harga" placeholder="Masukan Harga Produk"
                                            value="{{ old('harga', $produk->harga) }}">
                                        @error('harga')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="img" class="form-label">Gambar Produk</label>
                                        <div class="input-group">
                                            <input type="file"
                                                class="form-control form-control-solid  @error('img')
                                            is-invalid @enderror"
                                                name="img" id="img" placeholder="Url Image"
                                                value="{{ old('img') }}">
                                            @error('img')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
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
