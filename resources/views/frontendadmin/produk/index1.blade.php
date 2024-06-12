@extends('layouts.admin')
 
@section('contents')
<div class="p-6">
    <h1 class="font-bold text-2xl mb-4">Home Product List</h1>
    <a href="{{ route('adminproduk.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-4 inline-block">Add Product</a>
    <hr class="my-4">
    
    @if(Session::has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
 
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Produk</th>
                    <th class="px-6 py-3">Harga</th>
                    <th class="px-6 py-3">Gambar</th>
                    <th class="px-6 py-3">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produks as $produk)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $produk->nama_produk }}</td>
                    <td class="px-6 py-4">{{ $produk->harga }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ $produk->img }}" class="w-20 h-20 object-cover rounded-md" alt="Product Image">
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <a href="{{ route('adminproduk.edit', $produk->id) }}" class="text-green-800 px-2 py-1 bg-green-200 rounded-md hover:bg-green-300">Edit</a>
                            <form action="{{ route('adminproduk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-800 px-2 py-1 bg-red-200 rounded-md hover:bg-red-300 ml-2">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center py-4" colspan="5">Product not found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
