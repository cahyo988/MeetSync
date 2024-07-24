@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $(document).on('click', '#delete', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    Swal.fire({
                        title: "Apakah anda ingin menghapus data ?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            form.submit();

                        }
                    });
                });
                new DataTable('#todoTable');

            });
        </script>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title">Daftar Todo</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Todo</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <a href="{{ route('todo.create') }}" class="btn btn-crt btn-create text-white">Buat
                                        Todo</a>

                                    <table class="display" style="width:100%" id="todoTable">
                                        <thead>
                                            <tr>
                                                <th>Pembuat</th>
                                                <th>Pesan</th>
                                                <th>Penerima</th>
                                                <th>Deadline</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                                <th>Reminder</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($todos as $todo)
                                                <tr>
                                                    <td>
                                                        @if ($todo->creator)
                                                            {{ $todo->creator->nama }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td class="batastabel">{{ $todo->pesan }}</td>
                                                    <td>
                                                        @if ($todo->penerima)
                                                            {{ $todo->penerima->nama }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td
                                                        style="color: {{ $todo->deadline < now()->addDays(3) ? ($todo->deadline < now() ? 'red' : 'orange') : 'black' }}">
                                                        {{ \Carbon\Carbon::parse($todo->deadline)->format('d-m-Y') }}
                                                    </td>
                                                    <td>
                                                        @if ($todo->status == 'belum_selesai')
                                                            <button class="badge bg-danger text-white">Belum
                                                                Selesai</button>
                                                        @else
                                                            <button class="badge bg-success text-white">Selesai</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (auth()->user()->employee->id == $todo->creator_id)
                                                            <a href="{{ route('todo.edit', $todo->id) }}"
                                                                class="btn btn-warning text-white"><i class="fa fa-edit sm"></i></a>
                                                            <form action="{{ route('todo.destroy', $todo->id) }}"
                                                                method="POST" style="display:inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger "
                                                                    onclick="return confirm" id="delete"><i class="fa fa-trash sm"></i></button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (auth()->user()->employee->id == $todo->creator_id)
                                                            <a href="{{ route('todo.send-reminder', $todo->id) }}"
                                                                class="btn btn-primary"><i
                                                                    class="fa-solid fa-bell"></i> Kirim Reminder</a>
                                                        @endif
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
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Sukses',
                text: '{{ session('success') }}',
                icon: 'success',
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}'
            });
        </script>
    @endif
@endsection
