@extends('user.index')
@section('ContentList')

<section id="contentList-Section" class="contentList-Section section-custom">
    <div class="container">
        <div class="row mt-3">
            @if($wisataList->isEmpty())
                <div class="col-12 text-center">
                    <h4 class="parkinsans-regular f20">Ups ... Tidak ada wisata dalam kategori ini.</h4>
                    <h4 class="parkinsans-regular f16">Mungkin Wisata Belum di Upload, Stay tune yaa .. 😉</h4>
                </div>
            @else
                @foreach($wisataList as $item)
                    <div class="mb-2 col-md-3">
                        <div class="card card-contentList">
                            <img src="{{ $item->foto_wisata ? asset('storage/' . $item->foto_wisata) : asset('user/img/default.jpg') }}"
                                class="card-img-top img-contentList"
                                alt="Gambar Wisata"
                                loading="lazy">
                            <div class="card-body">
                                <h5 class="title-content text-center">{{ $item->nama_wisata }}</h5>
                                <p class="listofcontent capitalize">
                                    <span class="parkinsans-regular f14 capitalize">Alamat: </span>
                                    {{ $item->alamat }}</p>

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
                                    <a href="#"
                                        class="btn btn-primary mb-2"
                                        onclick="checkLogin(event, '{{ route('wisata.detail', $item->id) }}')">
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
            @endif
        </div>
        <div class="text-center mt-5 mb-5">
            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</section>

<script src="{{url('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
<script>
    function checkLogin(event, url) {
        @if(auth()->guest())
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Harap Login',
                text: 'Anda harus login untuk memberikan ulasan.',
                timer: 5000,
                showConfirmButton: false
            });

            setTimeout(() => {
                window.location.href = "{{ route('login') }}";
            }, 5000);
        @else
            window.location.href = url;
        @endif
    }
</script>

@endsection
