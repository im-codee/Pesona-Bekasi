@extends('index')
@section('ContentIndex')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Daftar Wisata</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Daftar Wisata</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr class="parkinsans-light">
                                    <th>Wisata ID</th>
                                    <th>Nama Wisata</th>
                                    <th>Desa</th>
                                    <th>Kecamatan</th>
                                    <th>Alamat</th>
                                    <th>Kategori Wisata</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>No. Telp</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wisata as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_wisata }}</td>
                                    <td>{{ $item->desa }}</td>
                                    <td>{{ $item->kecamatan }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->kategori_wisata }}</td>
                                    <td>{{ $item->latitude }}</td>
                                    <td>{{ $item->longitude }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->deskripsi }}</td>
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
