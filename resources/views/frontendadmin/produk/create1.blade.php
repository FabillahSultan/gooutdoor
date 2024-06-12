@extends('layouts.admin')

@section('contents')
    <div class="p-6">
        <h1 class="font-bold text-2xl mb-4">Add Product</h1>
        <hr class="mb-6">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                <form action="{{ route('adminproduk.store') }}" method="POST" enctype="multipart/form-data"
                    class="sm:col-span-4">
                    @csrf
                    <div>
                        <label for="nama_produk" class="block text-sm font-medium leading-6 text-gray-900">Nama
                            Produk</label>
                        <div class="mt-1">
                            <input type="text"
                                class="form-control @error('nama_produk')
                            is-invalid @enderror"
                                name="nama_produk" id="nama_produk" placeholder="Enter Product Name"
                                value="{{ old('nama_produk') }}">
                            @error('nama_produk')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="harga" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Harga</label>
                        <div class="mt-1">
                            <input type="text"
                                class="form-control @error('harga')
                             is-invalid @enderror"
                                name="harga" id="harga" placeholder="Enter Product Price" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="img" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Gambar</label>
                        <div class="mt-1">
                            <input type="file"
                                class="form-control  @error('img')
                            is-invalid @enderror"
                                name="img" id="img" placeholder="Url Image" value="{{ old('img') }}">
                            @error('img')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            </div>
        </div>
        <button type="submit"
            class="inline-block w-full mt-10 rounded-md bg-indigo-600 px-5 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </form>
    </div>
@endsection
