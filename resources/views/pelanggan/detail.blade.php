@extends('layouts.main')

@section('contents')
<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-8">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3 class="card-title">Detail Pelanggan</h3>
                                    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary float-right">Kembali</a>
                                </div>

                                <!-- Form untuk detail pelanggan -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $pelanggan->nama }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pelanggan->alamat }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" value="{{ $pelanggan->status }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="paket">Paket</label>
                                        <input type="text" class="form-control" id="paket" name="paket" value="Rp. {{ number_format($pelanggan->paket, 0, ',', '.') }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- AREA CHART UNTUK REDAMAN -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Grafik Redaman</h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <!-- Menambahkan ukuran width dan height untuk canvas -->
                                        <canvas id="redamanChart" width="500" height="300" style="max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Script untuk menampilkan ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('redamanChart').getContext('2d');
        
        // Data yang dikirim dari controller
        var chartData = {!! json_encode($chartData) !!};

        var labels = chartData.map(item => item.tanggal); // Tanggal sebagai label
        var redamanData = chartData.map(item => item.redaman); // Nilai redaman

        // Membuat grafik area menggunakan Chart.js
        var redamanChart = new Chart(ctx, {
            type: 'line', // Menggunakan grafik garis
            data: {
                labels: labels,
                datasets: [{
                    label: 'Redaman',
                    data: redamanData,
                    backgroundColor: 'rgba(60,141,188,0.4)',
                    borderColor: 'rgba(60,141,188,1)',
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Memastikan grafik responsif tanpa mempertahankan aspek rasio
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10 // Menyesuaikan stepSize pada sumbu Y untuk jarak antar nilai
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top' // Menampilkan label dataset di bagian atas grafik
                    }
                }
            }
        });
    });
</script>
@endsection
