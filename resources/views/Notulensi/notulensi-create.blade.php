@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {


                $(document).on('click', '#create', function(e) {
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
            });
        </script>
        <section>
            <div id="content" class="active">
                <div class="page-wrapper">
                    <div class="content container-fluid">
                        <div class="page-header">
                            <h3 class="page-title">Buat Notulensi Rapat</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item nonactive">Notulensi</li>
                                <li class="breadcrumb-item active">Buat Notulensi</li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form action="{{ route('notulensi.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="agenda_id">Rapat Terpilih</label>

                                                <input type="text" class="form-control"
                                                    value="{{ $agenda->judul_rapat }}" readonly>

                                                <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="hasil">Hasil Pembahasan</label>

                                                <textarea name="hasil" id="hasil" class="form-control" required maxlength="255"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="absensi">Absensi</label>
                                                <!-- Checkbox "Checklist All" -->
                                                <div class="form-check">
                                                    <input class="form-check-input checklist-all-checkbox" type="checkbox"
                                                        id="checklistAll">
                                                    <label class="form-check-label" for="checklistAll">Checklist All</label>
                                                </div>
                                                <!-- Checkbox absensi -->
                                                @foreach ($participants as $participant)
                                                    <div class="form-check">
                                                        <input class="form-check-input checkbox-absensi" type="checkbox"
                                                            name="absensi[{{ $participant->employee->id }}]"
                                                            id="absensi_{{ $participant->employee->id }}" value="on"
                                                            {{ $participant->absensi ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="absensi_{{ $participant->employee->id }}">
                                                            {{ $participant->employee->nama }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- Submit  -->
                                            <div class="form-group d-flex justify-content-between">
                                                <a href="{{ URL::previous() }}" class="btn btn-dark">Back</a>
                                                <button type="submit" class="btn btn-crt text-white" id="create">Buat
                                                    Notulensi</button>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                <script>
                    $(document).ready(function() {


                        $(document).on('click', '#checklistAll', function() {
                            // Toggle checkbox absensi berdasarkan status "Checklist All"
                            $('.checkbox-absensi').prop('checked', $(this).prop('checked'));
                        });


                    });
                </script>
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
                        $(document).ready(function() {
                            Swal.fire({
                                title: 'Hapus berhasil',
                                text: '{{ session('delete') }}',
                                icon: 'success',
                            });
                        });
                    </script>
                @endif

            </div>
    </div>
    </section>
@endsection
