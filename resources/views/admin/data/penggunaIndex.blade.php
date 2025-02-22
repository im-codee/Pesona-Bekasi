@extends('index')
@section('UserIndex')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Daftar Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Daftar Pengguna</h3>
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
                                    <th>Jenis Kelamin</th>
                                    <th>Pekerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penggunas as $pengguna)
                                    <tr>
                                        <td>{{ $pengguna->id }}</td>
                                        <td>{{ $pengguna->name }}</td>
                                        <td>{{ $pengguna->email }}</td>
                                        <td>{{ $pengguna->alamat ?? 'Belum Dilengkapi' }}</td>
                                        <td>{{ $pengguna->no_hp ?? 'Belum Dilengkapi' }}</td>
                                        <td>{{ $pengguna->jenis_kelamin ?? 'Belum Dilengkapi' }}</td>
                                        <td>{{ $pengguna->pekerjaan ?? 'Belum Dilengkapi' }}</td>
                                    </tr>
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
