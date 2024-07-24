<!-- notulensi-details.blade.php -->

@extends('layouts.master')

@section('content')
    <div id="content" class="active">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <h3 class="page-title ">Notulensi Detail</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item nonactive"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item nonactive"><a
                                href="{{ route('notulensi.create', ['id' => $notulensi->agenda->id]) }}">Buat Notulensi</a>
                        </li>
                        <li class="breadcrumb-item active">Notulensi Detail</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border-color: #ad0000">
                            <div class="card-body text-center">
                                <div class="card-header text-center text-white"style="background-color:#ad0000 ">
                                    <h2 class="card-title font-weight-bold">{{ $notulensi->agenda->judul_rapat }}</h2>
                                </div>
                                <br>
                                <p><i class="fa fa-calendar 3x"></i> {{ \Carbon\Carbon::parse($notulensi->agenda->tanggal_rapat)->format('d-m-Y') }}
                                </p>
                                <div class="mb-4" >
                                    <h5><strong>Hasil Pembahasan:</strong></h5>
                                    <div class="border p-3 text-left"style="border-color: #ad0000">
                                        {{ $notulensi->hasil }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h5 ><strong>Ketua Rapat & Sekretaris Rapat:</strong></h5>
                                    <div class="border p-3">
                                        <p><strong>Ketua Rapat: </strong><i class="fa-solid fa-user"></i> {{ $ketuaRapat->nama }}</p>
                                        <p><strong>Sekretaris Rapat: </strong><i class="fa-solid fa-user"></i> {{ $sekretarisRapat->nama }}</p>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h5><strong>Peserta Rapat Yang Hadir:</strong></h5>
                                    @if ($notulensi->agenda->participants->isNotEmpty())
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="list-group text-left">
                                                    @foreach ($notulensi->agenda->participants as $participant)
                                                        @if ($participant->pivot->absensi == 1 && $loop->index % 2 == 0)
                                                            <li class="list-group-item"><i class="fa-solid fa-user"></i> {{ $participant->nama }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-group text-left">
                                                    @foreach ($notulensi->agenda->participants as $participant)
                                                        @if ($participant->pivot->absensi == 1 && $loop->index % 2 != 0)
                                                            <li class="list-group-item"><i class="fa-solid fa-user"></i> {{ $participant->nama }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        <p>Tidak ada peserta rapat yang hadir.</p>
                                    @endif
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
