<div class="mb-2 col-md-3 col-6">
    <div class="card">
        <img src="{{ $item->foto_wisata ? asset('storage/' . $item->foto_wisata) : asset('user/img/default.jpg') }}"
            class="card-img-top img-contentList"
            alt="Gambar Wisata"
            loading="lazy">
        <div class="card-body">
            <h5 class="title-content text-center">{{ $item->nama_wisata }}</h5>
            <p class="listofcontent">{{ $item->alamat }}</p>

            <!-- Rating -->
            <p class="listofcontent">
                Rating:
                @if($item->rating)
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="bi {{ $i <= $item->rating ? 'bi-star-fill text-warning' : 'bi-star text-secondary' }}"></i>
                    @endfor
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
