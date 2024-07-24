@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            $(document).on('click', '#succes', function(e) {
                e.preventDefault();
                var form = $(this).closest('form'); // Find the closest form element
                Swal.fire({
                    title: "Apakah data sudah sesuai ?",
                    text: "anda masih bisa menggantinya!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Buat"
                }).then((result) => {
                    if (result.isConfirmed) {

                        form.submit();

                    }
                });
            });
        </script>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title">Buat Agenda Rapat</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item nonactive"><a href="{{ route('agenda.view') }}">Agenda Rapat</a></li>
                        <li class="breadcrumb-item active">Buat Agenda Rapat</li>
                    </ul>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('agenda.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="judul_rapat">Judul Rapat</label>
                                                <input type="text" name="judul_rapat" id="judul_rapat"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="rencana_pembahasan">Rencana Pembahasan</label>
                                                <textarea name="rencana_pembahasan" id="rencana_pembahasan" class="form-control" rows="5"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_rapat">Tanggal Rapat</label>
                                                <input type="date" name="tanggal_rapat" id="tanggal_rapat"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="lokasi">Lokasi Rapat</label>
                                                <input type="text" name="lokasi" id="lokasi" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ketua_rapat">Ketua Rapat</label>
                                                <select class="form-control select2" name="ketua_rapat" id="ketua_rapat">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->employee_id }}">{{ $user->employee->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="sekretaris_rapat">Sekretaris Rapat</label>
                                                <select class="form-control select2" name="sekretaris_rapat"
                                                    id="sekretaris_rapat">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->employee_id }}">{{ $user->employee->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="peserta_rapat">Peserta Rapat</label>
                                                <select class="form-control select2" name="peserta_rapat[]"
                                                    multiple="multiple" id="peserta_rapat">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->employee_id }}">
                                                            {{ $user->employee->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Centang Semua Peserta Rapat untuk :</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="fakultas[]"
                                                        value="FTIB" id="check_ftib">
                                                    <label class="form-check-label" for="check_ftib">
                                                        FTIB
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="fakultas[]"
                                                        value="FTEIC" id="check_fteic">
                                                    <label class="form-check-label" for="check_fteic">
                                                        FTEIC
                                                    </label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <a href="{{ URL::previous() }}" class="btn btn-dark">Back</a>
                                        <button type="submit" class="btn text-white btn-crt" id="succes">Buat
                                            Agenda</button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Masukkan jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Masukkan Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

        <!-- Masukkan Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#ketua_rapat').select2();
                $('#sekretaris_rapat').select2();
                $('#peserta_rapat').select2();
            });
            $(document).ready(function() {

                $(".user-option").hide();

                $(".fakultas-checkbox").change(function() {
                    var selectedFakultas = $(this).val();
                    $(".user-option[data-fakultas='" + selectedFakultas + "']").toggle(this.checked);
                });
            });
        </script>
    </div>
@endsection
