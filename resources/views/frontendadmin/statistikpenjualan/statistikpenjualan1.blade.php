@extends('layouts.admin')

@section('contents')
    <div class="flex items-center justify-between mb-6">
        <h1 class="font-bold text-2xl">Statistik Penjualan</h1>
    </div>
    <!-- Tambahkan link ke Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container">
        <!-- Form untuk memilih jenis statistik dan id_pesanan -->
        <form method="GET" action="{{ route('admin.statistikpenjualan', ['id_pesanan' => request('id_pesanan')]) }}">
            <div class="mb-4">
                <label for="statistik" class="form-label">Pilih Statistik:</label>
                <select id="statistik" name="statistik" class="form-select">
                    <option value="penjualan" {{ request('statistik') == 'penjualan' ? 'selected' : '' }}>Statistik Penjualan</option>
                    <option value="pendapatan" {{ request('statistik') == 'pendapatan' ? 'selected' : '' }}>Statistik Pendapatan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai:</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="mb-4">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir:</label>
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
            </div>
            <button type="submit" class="btn btn-primary mb-4">Tampilkan</button>
        </form>

        @if (request('statistik') == 'pendapatan')
            <h3 class="mt-4">Total Pendapatan: {{ number_format($statistikPendapatan, 0, ',', '.') }}</h3>
            <canvas id="pendapatanChart" width="400" height="200"></canvas>
        @elseif (!empty($statistikPenjualan))
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Produk
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jumlah Penjualan
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800">
                                @foreach ($statistikPenjualan as $nama_produk => $jumlah)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $nama_produk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $jumlah }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <canvas id="penjualanChart" width="400" height="200" class="mt-6"></canvas>
        @else
            <div class="alert alert-warning mt-4" role="alert">
                Tidak ada data penjualan yang ditemukan.
            </div>
        @endif
    </div>

    <!-- Script untuk inisialisasi Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (request('statistik') == 'pendapatan')
                const pendapatanCtx = document.getElementById('pendapatanChart').getContext('2d');
                new Chart(pendapatanCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode(array_keys($statistikPendapatanPerTanggal)) !!},
                        datasets: [{
                            label: 'Pendapatan',
                            data: {!! json_encode(array_values($statistikPendapatanPerTanggal)) !!},
                            fill: true,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            }
                        },
                        interaction: {
                            mode: 'nearest',
                            axis: 'x',
                            intersect: false
                        },
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Tanggal'
                                }
                            },
                            y: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Pendapatan'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            @elseif (request('statistik') == 'penjualan')
                const penjualanCtx = document.getElementById('penjualanChart').getContext('2d');
                new Chart(penjualanCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode(array_keys($statistikPenjualan)) !!},
                        datasets: [{
                            label: 'Jumlah Penjualan',
                            data: {!! json_encode(array_values($statistikPenjualan)) !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            }
                        },
                        interaction: {
                            mode: 'nearest',
                            axis: 'x',
                            intersect: false
                        },
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Produk'
                                }
                            },
                            y: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Penjualan'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            @endif
        });
    </script>
@endsection
