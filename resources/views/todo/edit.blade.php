@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title">Edit Todo</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item nonactive"><a href="{{ route('todo.index') }}">Todo</a></li>
                        <li class="breadcrumb-item active">Edit Todo</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('todo.update', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="creator_id">Pembuat</label>
                                        <select name="creator_id" id="creator_id" class="form-control" readonly>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ $employee->id == $todo->creator_id ? 'selected' : '' }}>
                                                    {{ $employee->nama }} ({{ optional($employee->user->role)->role }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pesan">Pesan</label>
                                        <textarea name="pesan" id="pesan" class="form-control" rows="5" required>{{ $todo->pesan }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="penerima_id">Penerima</label>
                                        <select name="penerima_id" id="penerima_id" class="form-control">
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ $employee->id == $todo->penerima_id ? 'selected' : '' }}>
                                                    {{ $employee->nama }} ({{ optional($employee->user->role)->role }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="deadline">Deadline</label>
                                        <input type="date" name="deadline" id="deadline" class="form-control"
                                            value="{{ $todo->deadline }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="belum_selesai"
                                                {{ $todo->status == 'belum_selesai' ? 'selected' : '' }}>Belum Selesai
                                            </option>
                                            <option value="selesai" {{ $todo->status == 'selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <a href="{{ URL::previous() }}" class="btn btn-dark">Back</a>
                                        <button type="submit" class="btn btn-crt text-white" id="edit">Update
                                            todo</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#edit', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: "Apakah data sudah sesuai ?",
                    text: "anda masih bisa menggantinya!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, ganti"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
