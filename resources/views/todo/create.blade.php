@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('click', '#create', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
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
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title">Buat Todo</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item nonactive"><a href="{{ route('todo.index') }}">Todo</a></li>
                        <li class="breadcrumb-item active">Buat Todo</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('todo.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="creator_id">Pembuat</label>
                                        <input type="hidden" name="creator_id" value="{{ auth()->user()->employee->id }}">
                                        <input type="text" class="form-control"
                                            value="{{ auth()->user()->employee->nama }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="pesan">Pesan</label>
                                        <textarea name="pesan" id="pesan" class="form-control" rows="5" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="penerima_id">Penerima</label>
                                        <select name="penerima_id" id="penerima_id" class="form-control penerima">
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">
                                                    {{ $employee->nama }} ({{ optional($employee->user->role)->role }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="deadline">Deadline</label>
                                        <input type="date" name="deadline" id="deadline" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="belum_selesai">Belum Selesai</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <a href="{{ URL::previous() }}" class="btn btn-dark">Back</a>
                                        <button type="submit" class="btn btn-crt text-white" id="create">Buat
                                            todo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.pembuat').select2();
                $('.penerima').select2();
            });
        </script>
    </div>
@endsection
