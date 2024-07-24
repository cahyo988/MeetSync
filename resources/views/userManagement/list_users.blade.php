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
                        title: "Yakin akan menghapus data?",
                        text: "You won't be able to revert this!",
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
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            setTimeout(function() {
                                form.submit();
                            }, 2000);
                        }
                    });
                });

                // Inisialisasi DataTable
                var dataTable = $('#userTable').DataTable({
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
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">List Users</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered" id="userTable">
                                            <thead>
                                                <a href="{{ route('users.create') }}"
                                                    class="btn btn-crt btn-create text-white"><span> Add User</span></a>
                                                <tr>
                                                    <th>Avatar</th>
                                                    <th>Username</th>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Fakultas</th>
                                                    <th>Nomor HP</th>
                                                    <th>Email</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>
                                                            @if ($user->avatar)
                                                                <img class="rounded-circle"
                                                                    src="{{ asset('storage/' . $user->avatar) }} "
                                                                    style="max-width: 70px; border-radius: 50%;">
                                                            @else
                                                                <img class="rounded-circle"
                                                                    alt="{{ Auth::user()->employee->nama }}"
                                                                    src="{{ asset('storage/avatar/profil.png') }}"
                                                                    style="max-width: 70px; border-radius: 50%;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->employee->nip }}</td>
                                                        <td>{{ $user->employee->nama }}</td>
                                                        <td>{{ $user->employee->fakultas }}</td>
                                                        <td>{{ $user->employee->no_hp }}</td>
                                                        <td>{{ $user->employee->email }}</td>
                                                        <td>
                                                            <a href="{{ route('users.edit', $user->username) }}"
                                                                class="btn btn-primary btn-flicker "><i
                                                                    class="fa-solid fa-pen-to-square"></i></a>
                                                            <form action="{{ route('users.destroy', $user->username) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" id="delete"
                                                                    class="btn btn-danger " onclick="return confirm"><i
                                                                        class="fa-solid fa-trash"></i></button>
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
