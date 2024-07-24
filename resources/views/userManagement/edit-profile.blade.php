@extends('layouts.master')

@section('content')
<div id="content" class="active">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#edit', function(e) {
                e.preventDefault();
                var form = $(this).closest('form'); // Find the closest form element
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

    <body>
        <div id="content" class="active">
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Edit Profile</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Edit Profile</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Edit Your Profile</h5>
                                    <form action="{{ route('update.profile') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="avatar">Avatar</label>
                                            <input type="file" name="avatar" id="avatar" class="form-control">
                                            @if (Auth::user()->avatar)
                                                <img id="avatar-image" src="{{ asset('storage/' . $user->avatar) }}"
                                                    alt="Avatar" style="max-width: 150px; border-radius: 50%;">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="text" name="nip" id="nip" class="form-control"
                                                value="{{ Auth::user()->employee->nip }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                value="{{ Auth::user()->employee->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="fakultas">Fakultas</label>
                                            <input type="text" name="fakultas" id="fakultas" class="form-control"
                                                value="{{ Auth::user()->employee->fakultas }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp">Mobile</label>
                                            <input type="text" name="no_hp" id="no_hp" class="form-control"
                                                value="{{ Auth::user()->employee->no_hp }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ Auth::user()->employee->email }}">
                                        </div>

                                        <div class="form-group d-flex justify-content-between">
                                            <a href="{{ route('user.profile.page')}}" class="btn btn-dark">Back</a>
                                            <button type="submit" class="btn btn-crt text-white" id="edit">Save Changes</button>
                                        
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</div>
@endsection
