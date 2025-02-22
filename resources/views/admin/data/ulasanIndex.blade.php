@extends('index')
@section('UlasanIndex')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Daftar Ulasan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Daftar Ulasan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr class="parkinsans-light">
                                    <th>Nama Wisata</th>
                                    <th>Nama Pengelola</th>
                                    <th>Alamat</th>
                                    <th>Kategori Wisata</th>
                                    <th>rating</th>
                                    <th>Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ulasans as $ulasan)
                                    <tr>
                                        <td>{{ $ulasan->wisata->nama_wisata ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $ulasan->user->name ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $ulasan->wisata->alamat ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $ulasan->wisata->kategori_wisata ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $ulasan->rating }}</td>
                                        <td>{{ $ulasan->ulasan }}</td>
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
