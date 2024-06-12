@extends('layouts.admin')

@section('contents')
    <div class="p-6">
        <h1 class="font-bold text-2xl mb-4">Edit Product</h1>
        <hr class="my-4">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-6 sm:gap-x-6">
                <form method="post" action="{{ route('adminproduk.update', $produk->id) }}" enctype="multipart/form-data"
                    class="sm:col-span-4">
                    @csrf
                    @method('patch')
                    <div class="space-y-4">
                        <div class="form-group">
                            <label for="nama_produk" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                Produk</label>
                            <div class="mt-1">
                                <input type="text"
                                    class="form-control @error('nama_produk')
                                is-invalid @enderror"
                                    name="nama_produk" id="nama_produk"
                                    value="{{ old('nama_produk', $produk->nama_produk) }}" placeholder="Enter Product Name">
                                @error('nama_produk')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="harga" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Harga
                                Produk</label>
                            <div class="mt-1">
                                <input type="text"
                                    class="form-control @error('harga')
                                is-invalid @enderror"
                                    name="harga" id="harga" value="{{ old('harga', $produk->harga) }}"
                                    placeholder="Enter Product Price">
                                @error('harga')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Gambar
                                Produk</label>
                            <div class="mt-1">
                                <input type="file"
                                    class="form-control  @error('img')
                                is-invalid @enderror"
                                    name="img" id="img" value="{{ old('img', $produk->img) }}"
                                    placeholder="Url Gambar">
                                @error('img')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-block w-full mt-10 rounded-md bg-indigo-600 px-5 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
