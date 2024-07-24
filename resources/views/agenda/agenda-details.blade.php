@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header text-center">
                    <h3 class="page-title">Detail Agenda Rapat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item nonactive"><a href="{{ route('agenda.view') }}">Agenda Rapat</a></li>
                            <li class="breadcrumb-item active">Detail Agenda</li>
                        </ol>
                    </nav>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-sm" style="border-color: #ad0000">
                            <div class="card-header text-center text-white"style="background-color: #ad0000">
                                <h2 class="card-title font-weight-bold">{{ $agenda->judul_rapat }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="mb-3">
                                        <strong class="d-block">Ketua Rapat & Sekretaris Rapat:</strong>
                                        <p class="mb-0"><i class="fa-solid fa-user"></i> {{ $agenda->ketuaRapat->nama }}
                                            (Ketua) - <i class="fa-solid fa-user"></i>
                                            {{ $agenda->employeeSekretaris->nama }} (Sekretaris)</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Rencana Pembahasan:</strong>
                                        <div class="border p-3">
                                            <p><i class="fa-regular fa-note-sticky"></i> {{ $agenda->rencana_pembahasan }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong class="d-block">Lokasi dan Tanggal Rapat:</strong>
                                                <div class="border p-3">
                                                    <p class="mb-0"><i class="fa-solid fa-location-dot"
                                                            style="color: #e80000;"></i> {{ $agenda->lokasi }}<br><i
                                                            class="fa-solid fa-calendar-days"></i>
                                                        {{ date('d F Y', strtotime($agenda->tanggal_rapat)) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Peserta Rapat:</strong>
                                        {{-- @php
                                            dd($agenda->participants);
                                        @endphp --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="list-group">
                                                    @foreach ($agenda->participants->slice(0, ceil(count($agenda->participants) / 2)) as $participant)
                                                        <li class="list-group-item"><i class="fa-solid fa-user"> </i>
                                                            {{ $participant->nama }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-group">
                                                    @foreach ($agenda->participants->slice(ceil(count($agenda->participants) / 2)) as $participant)
                                                        <li class="list-group-item"><i class="fa-solid fa-user"> </i>
                                                            {{ $participant->nama }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-3 text-center">
                                        <strong>Status:</strong>
                                        <span class="badge {{ $agenda->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $agenda->status ? 'Accepted' : 'Waiting' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-left">
                                    <a href="{{ URL::previous() }}" class="btn btn-dark">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
