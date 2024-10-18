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
                                    <h3 class="card-title">Data Teknisi</h3>
                                    <button
                                        class="btn btn-primary float-right"
                                        data-toggle="modal"
                                        data-target="#tambahModal">Tambah Teknisi</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>No Hp</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teknisi as $t)
                                            <tr>
                                                <td>{{ $t->nama }}</td>
                                                <td>{{ $t->no_hp }}</td>
                                                <td>
                                                    <button
                                                        class="btn btn-warning btn-sm edit"
                                                        data-id="{{ $t->id }}"
                                                        data-toggle="modal"
                                                        data-target="#editModal-{{ $t->id }}">Edit</button>
                                                    <form
                                                        action="{{ route('teknisi.destroy', $t->id) }}"
                                                        method="POST"
                                                        style="display:inline-block;">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                                    </form>

                                                    <!-- Modal Edit -->
                                                    <div
                                                        class="modal fade"
                                                        id="editModal-{{ $t->id }}"
                                                        tabindex="-1"
                                                        role="dialog"
                                                        aria-labelledby="editModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form
                                                                action="{{ route('teknisi.update', $t->id) }}"
                                                                method="POST"
                                                                id="editForm-{{ $t->id }}">
                                                                @csrf @method('PUT')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel">Edit Teknisi</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="edit-nama">Nama</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="nama"
                                                                                value="{{ $t->nama }}"
                                                                                required="required">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="edit-no_hp">No Hp</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="no_hp"
                                                                                value="{{ $t->no_hp }}"
                                                                                required="required">
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
        <form action="{{ route('teknisi.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Teknisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" required="required">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Nomor HP</label>
                        <input type="text" class="form-control" name="no_hp" required="required">
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