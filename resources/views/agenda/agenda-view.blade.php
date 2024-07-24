@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <script>
            $(document).ready(function() {
                $(document).on('click', '#confirm', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire({
                        title: "Apakah anda yakin untuk konfirmasi?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya, Konfirmasi!",
                        cancelButtonText: "No, cancel!",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Cancelled",
                                icon: "error"
                            });
                        }
                    });
                });

                $(document).on('click', '#delete', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    Swal.fire({
                        title: "Yakin untuk menolak agenda rapat?",
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
                // $(document).on('click', '#send', function(e) {
                //     e.preventDefault();
                //     var form = $(this).closest('form');
                //     Swal.fire({
                //         title: "Yakin untuk mengirim email;",
                //         text: "data agenda rapat akan terhapus!",
                //         icon: "warning",
                //         showCancelButton: true,
                //         confirmButtonColor: "#3085d6",
                //         confirmButtonText: "Ya, Kirim email!",
                //         cancelButtonText: "Tidak, Batalkan!",

                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             form.submit();

                //         }
                //     });
                // });

                new DataTable('#angedaTabel');


            });
        </script>

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Agenda Rapat</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('agenda.create') }}" class="btn btn-crt btn-create text-white">Buat
                                    Agenda</a>
                                <div class="table-responsive">
                                    <table id="angedaTabel" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Judul</th>
                                                <th>Tempat</th>
                                                <th>Ketua</th>
                                                <th>Sekretaris</th>
                                                <th>Info</th>
                                                <th>Notulensi</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <th>SendMail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sortedAgendas = $attendedAgendas->sortBy('status');
                                            @endphp

                                            @foreach ($sortedAgendas as $agenda)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($agenda->tanggal_rapat)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $agenda->judul_rapat }}</td>
                                                    <td>{{ $agenda->lokasi }}</td>
                                                    <td>{{ $agenda->ketuaRapat->nama }}</td>
                                                    <td>{{ $agenda->employeeSekretaris->nama }}</td>
                                                    <td>
                                                        <a href="{{ route('agenda.show', $agenda->id) }}"
                                                            class="btn btn-primary btn-sm"><i
                                                                class="fa-solid fa-circle-info "></i></a>
                                                    </td>
                                                    <td>
                                                        @if (auth()->user()->employee_id == $agenda->ketua_rapat || auth()->user()->employee_id == $agenda->sekretaris_rapat)
                                                            @if (!$agenda->sudah_notulensi)
                                                                @if ($agenda->status)
                                                                    <a href="{{ route('notulensi.create', ['id' => $agenda->id]) }}"
                                                                        class="btn btn-sm btn-success btn-sm"><i
                                                                            class="fa-solid fa-plus"></i> Notulensi</a>
                                                                @endif
                                                            @else
                                                                <a href="{{ route('notulensi.show', $agenda->notulensi->id) }}"
                                                                    class="btn btn-primary btn-sm"><i
                                                                        class="fa-solid fa-eye btn-sm"></i></a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($agenda->status)
                                                            <button class="badge bg-success text-white">Accepted</button>
                                                        @else
                                                            <button class="badge bg-danger text-white">Waiting</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (auth()->user()->employee_id == $agenda->ketua_rapat)
                                                            @if (!$agenda->status)
                                                                <form class="d-inline"
                                                                    action="{{ route('agenda.confirm', $agenda->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success" id="confirm"><i
                                                                            class="fa-solid fa-check"></i></button>
                                                                </form>

                                                                <form class="d-inline ml-auto"
                                                                    action="{{ route('agenda.destroy', $agenda->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    {!! method_field('DELETE') !!}
                                                                    <button type="submit" class="btn btn-danger"
                                                                        onclick="return confirm" id="delete"><i
                                                                            class="fa-solid fa-x"></i></button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('agenda.edit', $agenda->id) }}"
                                                                    method="GET">
                                                                    <button type="submit" class="btn btn-warning"><i
                                                                            class="fa-regular fa-pen-to-square"></i></button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (auth()->user()->employee_id == $agenda->ketua_rapat || auth()->user()->employee_id == $agenda->sekretaris_rapat)
                                                            @if (!$agenda->sudah_notulensi)
                                                                @if ($agenda->status)
                                                                    <a href="{{ route('agenda.sendReminder', $agenda->id) }}"
                                                                        class="btn btn-info btn-sm" id="send"><i
                                                                            class="fa-solid fa-bell"></i> Kirim Email</a>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Judul</th>
                                                <th>Tempat</th>
                                                <th>Ketua</th>
                                                <th>Sekretaris</th>
                                                <th>Info</th>
                                                <th>Notulensi</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <th>SendMail</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    </div>
@endsection
