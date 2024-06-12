@extends('layouts.admin')

@section('contents')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="font-bold text-2xl">Pengajuan Sewa</h1>
    </div>
    @if(Session::has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk (hari)</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Transfer</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800">
                        @foreach ($pengajuansewa as $transaksi)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle">{{ $transaksi->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle">{{ $transaksi->created_at->format('d F Y H:i:s') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle">{{ $transaksi->nama_produk }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle">{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 flex justify-center">
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $loop->index }}">
                                    <img src="{{ $transaksi->bukti_transfer }}" class="w-20 h-20 object-cover rounded-md cursor-pointer" alt="Product Image">
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="width: 400px; height: 200px;"> <!-- Manually set width and height -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ $transaksi->bukti_transfer }}" class="w-full object-cover" alt="Product Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                                                   
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle">
                                <p class="text-white px-4 py-2 rounded-full cursor-pointer {{ $transaksi->status == 0 ? 'bg-red-500' : 'bg-green-500' }}" data-bs-toggle="modal" data-bs-target="#statusModal{{ $loop->index }}">
                                    {{ $transaksi->status == 0 ? 'Belum diproses' : 'Diproses' }}
                                </p>

                                <!-- Modal for Status Change -->
                                <div class="modal fade" id="statusModal{{ $loop->index }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $loop->index }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="statusModalLabel{{ $loop->index }}">Ubah Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.pengajuansewastatus', $transaksi->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-4">
                                                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                                                        <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option value="0" {{ $transaksi->status == 0 ? 'selected' : '' }}>Belum diproses</option>
                                                            <option value="1" {{ $transaksi->status == 1 ? 'selected' : '' }}>Diproses</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
