@extends('layouts.master')

@section('content')

    <body>
        <div id="content" class="active">
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Profile</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-header">
                                <div class="row align-items-center">
                                    <div class="col-auto profile-image">
                                        <a href="#">
                                            @if (Auth::user()->avatar)
                                                <img class="rounded-circle" src="{{ asset('storage/' . $user->avatar) }}">
                                            @else
                                                <img class="rounded-circle" alt="{{ Auth::user()->employee->nama }}" src="{{ asset('storage/avatar/profil.png') }}">
                                            @endif
                                        </a>
                                        
                                    </div>

                                    <div class="col ms-md-n2 profile-user-info">
                                        <h4 class="user-name mb-0">{{ Auth::user()->employee->nama }}</h4>
                                        <h6 class="text-muted">{{ Auth::user()->employee->fakultas }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-menu">
                                <ul class="nav nav-tabs nav-tabs-solid">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" a nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content profile-tab-cont">
                                <div class="tab-pane fade show active" id="per_details_tab">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between">
                                                        <span>Personal Details</span>
                                                        <a class="edit-link" href="{{ route('edit.profile') }}"></i>Edit</a>
                                                    </h5>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
                                                        <p class="col-sm-9">{{ Auth::user()->employee->nama }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Jabatan
                                                        </p>
                                                        <p class="col-sm-9">{{ Auth::user()->role->role }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email</p>
                                                        <p class="col-sm-9"><a href="/cdn-cgi/l/email-protection"
                                                                class="__cf_email__"
                                                                data-cfemail="a1cbcec9cfc5cec4e1c4d9c0ccd1cdc48fc2cecc">{{ Auth::user()->employee->email }}</a>
                                                        </p>
                                                    </div>

                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
                                                        <p class="col-sm-9">{{ Auth::user()->employee->no_hp }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="password_tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Change Password</h5>
                                            <div class="row">
                                                <div class="col-md-10 col-lg-6">
                                                    <form action="{{ route('change/password') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Old Password</label>
                                                            <input type="password"
                                                                class="form-control @error('current_password') is-invalid @enderror"
                                                                name="current_password"
                                                                value="{{ old('current_password') }}">
                                                            @error('current_password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <input type="password"
                                                                class="form-control @error('new_password') is-invalid @enderror"
                                                                name="new_password" value="{{ old('new_password') }}">
                                                            @error('new_password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm Password</label>
                                                            <input type="password"
                                                                class="form-control @error('new_confirm_password') is-invalid @enderror"
                                                                name="new_confirm_password"
                                                                value="{{ old('new_confirm_password') }}">
                                                            @error('new_confirm_password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
