@extends('user.index')
@section('contentSearch')

<section id="contentSearch" class="contentSearch section-custom">
    <div class="container">
        <div class="row mt-3">
            @if(isset($clusters) && count($clusters) > 0)
            @foreach($clusters as $clusterName => $wisataCluster)
                <div class="col-12">
                    <h3 class="text-dark parkinsans-bold f24">{{ $clusterName }}</h3>
                </div>
                <div class="row">
                    @foreach($wisataCluster as $item)
                    <div class="mb-2 col-md-3">
                        <div class="card">
                            <img src="{{ $item->foto_wisata ? asset('storage/' . $item->foto_wisata) : asset('user/img/default.jpg') }}"
                                class="card-img-top img-contentList"
                                alt="Gambar Wisata"
                                loading="lazy">
                            <div class="card-body">
                                <h5 class="title-content text-center">{{ $item->nama_wisata }}</h5>
                                <p class="listofcontent capitalize">
                                    <span class="parkinsans-regular f14 capitalize">Alamat: </span>
                                    {{ $item->alamat }}</p>

                                <!-- Tampilkan Jarak -->
                                <p class="listofcontent italic">
                                    <span class="parkinsans-regular f14 capitalize">Jarak:</span>
                                    <b><i class="bi bi-geo-alt"></i></b> {{ number_format($item->distance, 2) }} km
                                </p>

                                <!-- Rating -->
                                <p class="listofcontent">
                                    <span class="parkinsans-regular f14 capitalize">Rating:</span>
                                    @php
                                        $averageRating = $item->ratings->avg('rating');
                                    @endphp

                                    @if($averageRating)
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= round($averageRating) ? 'bi-star-fill text-warning' : 'bi-star text-secondary' }}"></i>
                                        @endfor
                                        ({{ number_format($averageRating, 1) }})
                                    @else
                                        Belum ada rating
                                    @endif
                                </p>

                                <!-- Tombol Aksi -->
                                <div class="text-center mt-3 mb-2">
                                    <a href="{{ route('wisata.detail', $item->id) }}" class="btn btn-primary mb-2">
                                        <i class="bi bi-info-circle-fill"></i> Detail
                                    </a>
                                    @if($item->latitude && $item->longitude)
                                        <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}"
                                            class="btn btn-success mb-2"
                                            target="_blank">
                                            <i class="bi bi-geo-alt-fill"></i> Maps
                                        </a>
                                    @else
                                        <button class="btn btn-secondary mb-2" disabled>
                                            <i class="bi bi-geo-alt-fill"></i> Maps Tidak Tersedia
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endforeach
        @else
            <div class="col-12 text-center">
                <h4 class="parkinsans-regular f20">Ups ... Tidak ditemukan wisata dalam pencarian ini.</h4>
            </div>
        @endif
        </div>
    </div>
</section>
@endsection
