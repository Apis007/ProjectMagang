@extends('layouts.main') @section('contents')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 p-0">
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <section class="content">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Redaman</h3>
                                    <button
                                        class="btn btn-primary float-right"
                                        data-toggle="modal"
                                        data-target="#tambahModal">Import</button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Port</th>
                                                <th>Redaman</th>
                                                <th>Id Pelanggan</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Paket</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($redaman as $r)
                                            <tr>
                                                <td>{{ $r->port }}</td>
                                                <td>{{ $r->redaman }}</td>
                                                <td>{{ $r->id_pelanggan }}</td>
                                                <td>{{ $r->nama }}</td>
                                                <td>{{ $r->alamat }}</td>
                                                <td>{{ $r->paket }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div
    class="modal fade"
    id="tambahModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="tambahModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('redaman.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Pilih File Excel:</label>
                        <input type="file" name="file" class="form-control-file" required="required">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        @endsection