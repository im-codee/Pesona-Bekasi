@extends('penyediaKonten.index')
@section('ContentShow')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.penyedia')}}">Home</a></li>
                <li class="breadcrumb-item active">Detail Content</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Detail Content</h3>
                </div>
                <div class="card-body">
                    <!-- Gambar utama -->
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <img src="{{ $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : asset('user/img/frame.png') }}"
                                class="img-wisata-detail img-fluid rounded" alt="Gambar Wisata">
                        </div>
                    </div>

                    <!-- Gambar tambahan -->
                    <div class="row mt-3 text-center">
                        @foreach (['foto_wisata2', 'foto_wisata3', 'foto_wisata4'] as $foto)
                            @if ($wisata->$foto)
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $wisata->$foto) }}"
                                        class="img-wisata-2 img-fluid rounded" alt="Gambar Tambahan">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Informasi Wisata -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5 class="parkinsans-md f16"><strong>Nama Wisata:</strong> {{ $wisata->nama_wisata }}</h5>
                            <h5 class="parkinsans-md f16"><strong>Desa:</strong> {{ $wisata->desa }}</h5>
                            <h5 class="parkinsans-md f16"><strong>Kecamatan:</strong> {{ $wisata->kecamatan }}</h5>
                            <h5 class="parkinsans-md f16"><strong>Alamat:</strong> {{ $wisata->alamat }}</h5>
                            <h5 class="parkinsans-md f16"><strong>Kategori:</strong> {{ ucfirst($wisata->kategori_wisata) }}</h5>
                            <h5 class="parkinsans-md f16"><strong>Latitude:</strong> {{ $wisata->latitude }}</h5>
                            <h5 class="parkinsans-md f16"><strong>Longitude:</strong> {{ $wisata->longitude }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="parkinsans-md f14"><strong>Type Wisata:</strong></h5>
                            <p class="parkinsans-md f14">
                                @foreach($wisata->typeWisata as $type)
                                    ✅ <i>{{ $type->nama_type }}</i>
                                @endforeach
                            </p>
                            <h5 class="parkinsans-md f14"><strong>Deskripsi:</strong></h5>
                            <p>{{ $wisata->deskripsi ?? 'Belum ada deskripsi.' }}</p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="text-start mt-4">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $wisata->latitude }},{{ $wisata->longitude }}"
                            class="btn btn-success" target="_blank">
                            <i class="bi bi-geo-alt-fill"></i> Lihat di Maps
                        </a>
                        @if($wisata->no_telp)
                            <a href="tel:{{ $wisata->no_telp }}" class="btn btn-info">
                                <i class="bi bi-telephone-fill"></i> Hubungi
                            </a>
                        @endif
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('wisata.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<style>
    .img-wisata-detail{
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
    .img-wisata-2{
        height: 180px;
        width: 100%;
        object-fit: cover;
    }
</style>

@endsection
