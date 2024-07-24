@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('click', '#succes', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    Swal.fire({
                        title: "Berhasil Menambah Hak Akses!",
                        icon: "success"
                    });
                    setTimeout(function() {
                        form.submit();
                    }, 2000);
                });
            });
        </script>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title">Buat Hak Akses Baru</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item nonactive"><a href="{{ route('access_rights.index') }}">Hak Akses</a></li>
                        <li class="breadcrumb-item active">Buat Hak Akses</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Formulir untuk membuat hak akses baru -->
                                <form action="{{ route('access_rights.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="role_id_atasan">Role Atasan</label>
                                        <select class="form-control" name="role_id_atasan" id="role_id_atasan">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="role_id_bawahan">Role Bawahan</label>
                                        <select class="form-control select2" name="role_id_bawahan[]" id="role_id_bawahan"
                                            multiple="multiple">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <a href="{{ route('access_rights.index') }}" class="btn btn-dark">Back</a>
                                        <button type="submit" class="btn btn-crt text-white" id="succes">Tambah Hak
                                            Akses</button>
                                       
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
                $('.select2').select2(); // Ini untuk elemen role_id_bawahan
                $('#role_id_atasan').select2(); // Inisialisasi dropdown select2 untuk Role Atasan
                $('#role_id_bawahan').select2(); // Inisialisasi dropdown select2 untuk Role Bawahan
            });
        </script>
    </div>
@endsection
