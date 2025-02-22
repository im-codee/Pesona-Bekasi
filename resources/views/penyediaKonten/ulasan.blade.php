@extends('penyediaKonten.index')
@section('Ulasan')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.penyedia')}}">Home</a></li>
                <li class="breadcrumb-item active">Ulasan Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Tabel Ulasan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">UID</th>
                                    <th scope="col">Nama Pengguna</th>
                                    <th scope="col">Objek Wisata</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Ulasan</th>
                                    <th scope="col">Create at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ratings as $ulasan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ulasan->user->id ?? 'Pengguna Tidak Diketahui' }}</td>
                                        <td>{{ $ulasan->user->name ?? 'Pengguna Tidak Diketahui' }}</td>
                                        <td>{{ $ulasan->wisata->nama_wisata ?? 'Wisata Tidak Diketahui' }}</td>
                                        <td>{{ $ulasan->rating }} ⭐</td>
                                        <td>{{ $ulasan->ulasan ?? '-' }}</td>
                                        <td>{{ $ulasan->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada ulasan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection
