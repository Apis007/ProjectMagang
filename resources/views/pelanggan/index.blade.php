@extends('layouts.main')

@section('contents')
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
                                    <h3 class="card-title">Data Teknisi</h3>
                                    <button class="btn btn-primary float-right" data-toggle="modal"
                                        data-target="#tambahModal">Tambah Pelanggan</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Status</th>
                                                <th>Paket</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pelanggan as $p)
                                            <tr>
                                                <td>{{ $p->nama }}</td>
                                                <td>{{ $p->alamat }}</td>
                                                <td>{{ $p->status }}</td>
                                                <td>Rp. {{ number_format($p->paket, 0, ',', '.') }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm edit" data-id="{{ $p->id }}"
                                                        data-toggle="modal" data-target="#editModal">Edit</button>
                                                    <form action="{{ route('pelanggan.destroy', $p->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin hapus?')">Hapus</button>
                                                    </form>
                                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{ route('pelanggan.update' , $p->id) }}"
                                                                method="POST" id="editForm">
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel">Edit
                                                                            Pelanggan</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="edit-nama">Nama</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nama" id="edit-nama"
                                                                                value="{{ $p->nama }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="edit-alamat">Alamat</label>
                                                                            <input type="text" class="form-control"
                                                                                name="alamat" id="edit-alamat"
                                                                                value="{{ $p->alamat }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="edit-status">Status</label>
                                                                            <select name="status" id="edit-status"
                                                                                class="form-control" required>
                                                                                <option value="normal"
                                                                                    {{ $p->status == 'normal' ? 'selected' : '' }}>
                                                                                    Normal</option>
                                                                                <option value="promo"
                                                                                    {{ $p->status == 'promo' ? 'selected' : '' }}>
                                                                                    Promo</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="edit-paket">Paket</label>
                                                                            <select name="paket" id="edit-paket"
                                                                                class="form-control" required>
                                                                                <option value="100000"
                                                                                    {{ $p->paket == 100000 ? 'selected' : '' }}>
                                                                                    Rp. 100000</option>
                                                                                <option value="165000"
                                                                                    {{ $p->paket == 165000 ? 'selected' : '' }}>
                                                                                    165 ribu</option>
                                                                                <option value="200000"
                                                                                    {{ $p->paket == 200000 ? 'selected' : '' }}>
                                                                                    200 ribu</option>
                                                                                <option value="220000"
                                                                                    {{ $p->paket == 220000 ? 'selected' : '' }}>
                                                                                    220 ribu</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.col-md-10 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="normal">Normal</option>
                            <option value="promo">Promo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paket">Paket</label>
                        <select name="paket" class="form-control" required>
                            <option value="100000">100 ribu</option>
                            <option value="165000">165 ribu</option>
                            <option value="200000">200 ribu</option>
                            <option value="220000">220 ribu</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->

@endsection
