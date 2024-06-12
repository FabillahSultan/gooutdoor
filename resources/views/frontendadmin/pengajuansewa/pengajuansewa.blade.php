@extends('layouts.admin2')
@section('content')
    <div class="container-fluid">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pengajuan Sewa</h1>
        <p class="mb-4">Pengajuan Sewa Toko {{ Auth::user()->name }}</p>
        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengajuan Sewa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Nama Produk (Hari)</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Bukti Transfer</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengajuansewa as $transaksi)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $transaksi->nama }}</td>
                                    <td class="text-center">{{ $transaksi->created_at->format('d F Y H:i:s') }}</td>
                                    <td class="text-center">{{ $transaksi->nama_produk }}</td>
                                    <td class="text-center">{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <img id="bukti_transfer_{{ $loop->index }}" src="{{ $transaksi->bukti_transfer }}"
                                            style="max-width: 50px; max-height: 50px;" alt="Product Image"
                                            onclick="showModal('{{ $loop->index }}')">
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn {{ $transaksi->status == 0 ? 'btn-danger' : 'btn-success' }}"
                                            data-bs-toggle="modal" data-bs-target="#statusModal{{ $loop->index }}">
                                            {{ $transaksi->status == 0 ? 'Belum Diproses' : 'Diproses' }}
                                        </button>

                                        <!-- Modal for Status Change -->
                                        <div class="modal fade" id="statusModal{{ $loop->index }}" tabindex="-1"
                                            aria-labelledby="statusModalLabel{{ $loop->index }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="statusModalLabel{{ $transaksi->id }}">
                                                            Ubah Status</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('admin.pengajuansewastatus', $transaksi->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="text-center">
                                                                <label for="status" class="form-label">Status</label>
                                                            </div>
                                                            <div class="mb-3">
                                                                <select name="status" id="status" class="form-select"
                                                                    style="height: 30px; width: 100%">
                                                                    <option value="0"
                                                                        {{ $transaksi->status == 0 ? 'selected' : '' }}>
                                                                        Belum Diproses</option>
                                                                    <option value="1"
                                                                        {{ $transaksi->status == 1 ? 'selected' : '' }}>
                                                                        Diproses</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tambahkan modal di akhir halaman -->
                                        <div class="modal fade" id="imageModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img id="modalImage" src="" style="width: 100%;"
                                                            alt="Product Image">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <script>
                                        function updateStatus(transaksiId) {
                                            var selectedStatus = document.querySelector('input[name="status' + transaksiId + '"]:checked').value;
                                            console.log('Status yang dipilih:', selectedStatus);
                                            $('#statusModal' + transaksiId).modal('hide');
                                        }
                                    </script>
                                    <script>
                                        function showModal(index) {
                                            var imgSrc = document.getElementById('bukti_transfer_' + index).src;
                                            $('#imageModal').modal('show');
                                            document.getElementById('modalImage').src = imgSrc;
                                        }
                                    </script>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center py-4" colspan="7">Tidak Ada Pengajuan Sewa Di Toko {{ Auth::user()->name }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
