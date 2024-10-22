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

                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" 
                                                   value="{{ $pelanggan->nama }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" 
                                                   value="{{ $pelanggan->alamat }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" id="status" name="status" 
                                                   value="{{ $pelanggan->status }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="paket">Paket</label>
                                            <input type="text" class="form-control" id="paket" name="paket" 
                                                   value="Rp. {{ number_format($pelanggan->paket, 0, ',', '.') }}" readonly>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- AREA CHART -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Redaman</h3>
                                    <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                    </li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
@endsection
