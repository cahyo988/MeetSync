@extends('layouts.master')

@section('content')
<div id="content" class="active">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: "Yakin untuk menghapus akses?",
                    text: "akses akan terhapus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            title: "Deleted!",
                            text: " Acces has been deleted.",
                            icon: "success"
                        });
                        setTimeout(function() {
                            form.submit();
                        }, 3000);
                    }
                });
            });

            // Inisialisasi DataTable
            var dataTable = $('#accessRightsTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "responsive": true
            });

            // Filter ketika input search diubah
            $('#search').on('keyup', function() {
                dataTable.search(this.value).draw();
            });
        });
    </script>

    <div id="content" class="active">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title">Daftar Hak Akses</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Hak Akses</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div>
                                        <a href="{{ route('access_rights.create') }}" class="btn btn-crt btn-create text-white">Buat Akses</a>
                                    </div>
                                    <br>
                                    <table class="table table-bordered" id="accessRightsTable">
                                        <thead>
                                            <tr>
                                                <th>Role Atasan</th>
                                                <th>Role Bawahan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($accessRights as $accessRight)
                                                <tr>
                                                    <td>{{ $accessRight->roleAtasan->role }}</td>
                                                    <td>{{ $accessRight->roleBawahan->role }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('access_rights.edit', ['accessRight' => $accessRight->id]) }}"><i
                                                                class="fa-regular fa-pen-to-square"></i>Edit</a>

                                                        <form
                                                            action="{{ route('access_rights.destroy', $accessRight->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" id="delete"
                                                                onclick="return confirm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
