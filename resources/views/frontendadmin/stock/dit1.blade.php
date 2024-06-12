@extends('layouts.admin')

@section('contents')
    <div class="p-6">
        <h1 class="font-bold text-2xl mb-4">Edit Stock</h1>
        <hr class="my-4">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <form method="post" action="{{ route('adminstock.update', $stock->id) }}" enctype="multipart/form-data"
                    class="sm:col-span-4">
                    @csrf
                    @method('patch')
                    <div class="space-y-6">
                        <div class="form-group">
                            <label for="produk_id" class="block text-sm font-medium leading-6 text-gray-900">Nama Produk</label>
                            <div class="mt-1">
                                <input type="text" class="form-control" name="produk_id" id="produk_id"
                                    value="{{ $stock->nama_produk }}" readonly>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label for="total_stock" class="block text-sm font-medium leading-6 text-gray-900">Total Stock</label>
                            <div class="mt-1">
                                <input type="text" class="form-control @error('total_stock')
                                is-invalid @enderror"
                                name="total_stock" id="total_stock"
                                    value="{{ old('total_stock', $stock->total_stok) }}" placeholder="Enter Total Stock">
                                    @error('total_stock')
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
