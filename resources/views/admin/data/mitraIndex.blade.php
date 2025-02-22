@extends('index')
@section('MitraIndex')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Daftar Pengelola Konten</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Daftar Pengelola Konten</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr class="parkinsans-light">
                                    <th>UID</th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Nama Wisata</th>
                                    <th>Alamat Wisata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengelolas as $pengelola)
                                    @if ($pengelola->wisata->isEmpty())
                                        <tr>
                                            <td>{{ $pengelola->id }}</td>
                                            <td>{{ $pengelola->name }}</td>
                                            <td>{{ $pengelola->email }}</td>
                                            <td>{{ $pengelola->alamat ?? 'Belum Dilengkapi' }}</td>
                                            <td>{{ $pengelola->no_hp ?? 'Belum Dilengkapi' }}</td>
                                            <td colspan="2" class="text-danger">Belum Mengupload Wisata</td>
                                        </tr>
                                    @else
                                        @foreach ($pengelola->wisata as $wisata)
                                            <tr>
                                                <td>{{ $pengelola->id }}</td>
                                                <td>{{ $pengelola->name }}</td>
                                                <td>{{ $pengelola->email }}</td>
                                                <td>{{ $pengelola->alamat ?? 'Belum Dilengkapi' }}</td>
                                                <td>{{ $pengelola->no_hp ?? 'Belum Dilengkapi' }}</td>
                                                <td>{{ $wisata->nama_wisata }}</td>
                                                <td>{{ $wisata->alamat }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection
