@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('click', '#edit', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Edit"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Edited!",
                                text: "Your file has been edited.",
                                icon: "success"
                            });

                            setTimeout(function() {
                                form.submit();
                            }, 2000);
                        }
                    });
                });
            });
        </script>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title">Edit Hak Akses</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item nonactive"><a href="{{ route('access_rights.index') }}">Hak Akses</a></li>
                        <li class="breadcrumb-item active">Edit Hak Akses</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('access_rights.update', $accessRight->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">

                                        <label for="role_id_atasan">Role Atasan</label>
                                        <select class="form-control" name="role_id_atasan" id="role_id_atasan">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $accessRight->role_id_atasan == $role->id ? 'selected' : '' }}>
                                                    {{ $role->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="role_id_bawahan">Role Bawahan</label>
                                        <select class="form-control" name="role_id_bawahan" id="role_id_bawahan">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $accessRight->role_id_bawahan == $role->id ? 'selected' : '' }}>
                                                    {{ $role->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <button type="submit" class="btn btn-crt text-white" id="edit">Simpan
                                            Perubahan</button>
                                        <a href="{{ route('access_rights.index') }}" class="btn btn-dark">Back</a>
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
                $('#role_id_bawahan').select2(); // Inisialisasi dropdown select2 untuk Role Bawahan
            });
        </script>
    </div>
@endsection
