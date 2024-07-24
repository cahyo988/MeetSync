@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                new DataTable('#notulensiTable');
            });
        </script>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title">List Notulensi</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" style="width:100%" id="notulensiTable">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Rapat</th>
                                                <th>Judul Rapat</th>
                                              
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notulensiview as $notulensi)
                                                @php
                                                    $isKetuaRapat = auth()->user()->employee_id == $notulensi->agenda->ketua_rapat;
                                                    $isSekretarisRapat = auth()->user()->employee_id == $notulensi->agenda->sekretaris_rapat;
                                                    $isPesertaRapat = in_array(auth()->user()->employee_id, $notulensi->agenda->participants->pluck('id')->toArray());
                                                @endphp

                                                @if ($isKetuaRapat || $isSekretarisRapat || $isPesertaRapat)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($notulensi->agenda->tanggal_rapat)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ $notulensi->agenda->judul_rapat }}</td>
                                                        <td>
                                                            <a
                                                                href="{{ route('notulensi.show', $notulensi->id) }}"class="btn btn-primary"><i
                                                                    class="fa-solid fa-eye"></i></a>
                                                            @if (auth()->user()->employee_id == $notulensi->agenda->ketua_rapat ||
                                                                    auth()->user()->employee_id == $notulensi->agenda->sekretaris_rapat)
                                                                <a
                                                                    href="{{ route('notulensi.edit', $notulensi->id) }}"class="btn btn-warning"><i
                                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
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
@endsection
