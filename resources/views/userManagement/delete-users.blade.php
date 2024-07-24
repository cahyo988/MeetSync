@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Delete User and Employee</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.destroy', $user->username) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete User and Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
