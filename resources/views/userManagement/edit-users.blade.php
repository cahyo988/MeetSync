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

                            form.submit();

                        }
                    });
                });
            });
        </script>

        <div class="container container-flick">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit User and Employee</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('users.update', $user->username) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Personal Details Tab -->
                                <div class="nav-tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="personal-details-tab" data-toggle="tab"
                                                href="#personal-details">Personal Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="change-password-tab" data-toggle="tab"
                                                href="#change-password">Change Password</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <!-- Personal Details Tab Content -->
                                    <div class="tab-pane active" id="personal-details">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                value="{{ $user->username }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="text" name="nip" id="nip" class="form-control"
                                                value="{{ $user->employee->nip }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                value="{{ $user->employee->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="avatar">Avatar</label>
                                            <input type="file" name="avatar" id="avatar" class="form-control">
                                            @if ($user->avatar)
                                                <img id="avatar-image" src="{{ asset('storage/' . $user->avatar) }}"
                                                    alt="Avatar" style="max-width: 150px; border-radius: 50%;">
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="fakultas">Fakultas</label>
                                            <input type="text" name="fakultas" id="fakultas" class="form-control"
                                                value="{{ $user->employee->fakultas }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="no_hp">Nomor HP</label>
                                            <input type="text" name="no_hp" id="no_hp" class="form-control"
                                                value="{{ $user->employee->no_hp }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ $user->employee->email }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="role_id">Role</label>
                                            <select name="role_id" id="role_id" class="form-control">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                        {{ $role->role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Change Password Tab Content -->
                                    <div class="tab-pane" id="change-password">
                                        <div class="form-group">
                                            <label for="password">New Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <a href="{{ route('users.index') }}" class="btn btn-dark">Back</a>
                                    <button type="submit" class="btn btn-crt text-white" id="edit">Update User and
                                        Employee</button>
                                   
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById("avatar-image").addEventListener("click", function() {
                document.getElementById("avatar-input").click();
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

        </body>
    </div>
@endsection
