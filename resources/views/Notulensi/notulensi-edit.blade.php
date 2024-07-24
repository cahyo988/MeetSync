<!-- notulensi-edit.blade.php -->

@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('click', '#edit', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form'); // Find the closest form element
                    Swal.fire({
                        title: "Apakah data sudah sesuai ?",
                        text: "anda masih bisa menggantinya!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, ganti"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title">Edit Notulensi</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item nonactive"><a href="{{ route('notulensi.view') }}">Notulensi</a></li>
                        <li class="breadcrumb-item nonactive"><a
                                href="{{ route('notulensi.create', ['id' => $agenda->id]) }}">Buat
                                Notulensi</a></li>
                        <li class="breadcrumb-item active">Edit Notulensi</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('notulensi.update', $notulensi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="agenda_id">Rapat Terpilih</label>

                                        <input type="text" class="form-control"
                                            value="{{ $notulensi->agenda->judul_rapat }}" readonly>
                                        <input type="hidden" name="agenda_id"
                                            value="{{ $notulensi->agenda->judul_rapat }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="agenda_id">Ketua Rapat</label>

                                        <input type="text" class="form-control" value="{{ $ketuaRapat->nama }}" readonly>
                                        <input type="hidden" name="agenda_id" value="{{ $ketuaRapat->nama }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="agenda_id">Sekretaris Rapat</label>
                                        <input type="text" class="form-control" value="{{ $sekretarisRapat->nama }}"
                                            readonly>
                                        <input type="hidden" name="agenda_id" value="{{ $sekretarisRapat->nama }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="hasil">Hasil Pembahasan</label>
                                        <textarea name="hasil" id="hasil" class="form-control">{{ $notulensi->hasil }}</textarea>
                                    </div>

                                    <div class="form-group d-flex justify-content-between">
                                        <a href="{{ URL::previous() }}" class="btn btn-dark">Back</a>
                                        <button type="submit" class="btn btn-crt text-white" id="edit">Update
                                            Notulensi</button>
                                    </div>

                                </form>
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
                    text: '{{ session('sukses') }}',
                    icon: 'success',
                });
            </script>
        @endif
    </div>
@endsection
