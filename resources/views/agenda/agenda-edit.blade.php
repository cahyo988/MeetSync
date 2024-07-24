@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('click', '#delete', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    Swal.fire({
                        title: "Yakin untuk menghapus agenda rapat?",
                        text: "data agenda rapat akan terhapus!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
            $(document).ready(function() {
                $(document).on('click', '#edit', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    Swal.fire({
                        title: "Apakah data sudah sesuai?",
                        text: "Anda masih bisa menggantinya!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Edit"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
        <div id="content" class="active">
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Edit Agenda Rapat</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('agenda.update', $agenda->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="judul_rapat">Judul Rapat</label>
                                            <input type="text" name="judul_rapat" class="form-control"
                                                value="{{ $agenda->judul_rapat }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="rencana_pembahasan">Rencana Pembahasan</label>
                                            <textarea name="rencana_pembahasan" class="form-control">{{ $agenda->rencana_pembahasan }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal_rapat">Tanggal Rapat</label>
                                            <input type="date" name="tanggal_rapat" class="form-control"
                                                value="{{ $agenda->tanggal_rapat }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="lokasi">Lokasi Rapat</label>
                                            <input type="text" name="lokasi" class="form-control"
                                                value="{{ $agenda->lokasi }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="edit">Perbarui</button>

                                    </form>
                                    <br>
                                    <div class="form-group d-flex justify-content-between">
                                        <a href="{{ URL::previous() }}" class="btn btn-dark">Back</a>
                                        <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            {!! method_field('DELETE') !!}
                                            <button type="submit" class="btn btn-danger" id="delete"
                                                onclick="return confirm">Delete</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    icon: 'success',
                });
            </script>
        @endif
        @if (session('delete'))
            <script>
                Swal.fire({
                    title: 'Hapus berhasil',
                    text: '{{ session('succes') }}',
                    icon: 'succes',
                });
            </script>
        @endif
    </div>
@endsection
