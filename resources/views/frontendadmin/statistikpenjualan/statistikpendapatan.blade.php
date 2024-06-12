@extends('layouts.admin2')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Statistik Pendapatan</h1>
        <div class="d-sm-flex align-items-center justify-content-between">
            <p class="mb-4">Statistik Toko {{ Auth::user()->name }}</p>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Pendapatan</h6>
            </div>
            <form method="GET" action="{{ route('admin.statistikpendapatan', ['id_pesanan' => request('id_pesanan')]) }}">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="mb-4">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai:</label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                                value="{{ request('tanggal_mulai') }}">
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_akhir" class="form-label">Tanggal Akhir:</label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                                value="{{ request('tanggal_akhir') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-4">Tampilkan</button>
                        <h6 style="padding: 10px"> Total Pendapatan: {{ number_format($statistikPendapatan, 0, ',', '.') }}</h6>
                        <h6 style="padding: 10px"> Jumlah Transaksi: {{ $jumlahTransaksi }}</h6>
                    </div>
                </div>
            </form>
        </div>


        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan</h6>
                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#chartCollapse" aria-expanded="false" aria-controls="chartCollapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="card-body collapse show" id="chartCollapse">
                <div>
                    <canvas id="pendapatanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

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
    </script>
@endsection
