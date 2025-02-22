@extends('user.index')
@section('ContentDetail')

<section id="contentList-Section" class="contentList-Section section-custom">
    <div class="container">
        <div class="row mt-3 mb-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center parkinsans-regular f24">Detail Content</h3>
                </div>
                <div class="card-body">
                    <!-- Gambar utama -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="{{ $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : asset('user/img/frame.png') }}"
                                class="img-wisata-detail img-fluid rounded" alt="Gambar Wisata">
                        </div>
                    </div>

                    <!-- Gambar tambahan -->
                    <div class="row mt-3 text-center">
                        @foreach (['foto_wisata2', 'foto_wisata3', 'foto_wisata4'] as $foto)
                            @if ($wisata->$foto)
                                <div class="col-md-4 col-6 mb-2">
                                    <img src="{{ asset('storage/' . $wisata->$foto) }}"
                                        class="img-wisata-2 img-fluid rounded" alt="Gambar Tambahan">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Informasi Wisata -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5 class="parkinsans-md f14"><strong>Type Wisata:</strong></h5>
                            <p class="parkinsans-md f14">
                                @foreach($wisata->typeWisata as $type)
                                    ✅ <i>{{ $type->nama_type }}</i>
                                @endforeach
                            </p>
                            <h5 class="parkinsans-regular f14"><strong>Nama Wisata:</strong> {{ $wisata->nama_wisata }}</h5>
                            <h5 class="parkinsans-regular f14"><strong>Desa:</strong> {{ $wisata->desa }}</h5>
                            <h5 class="parkinsans-regular f14"><strong>Kecamatan:</strong> {{ $wisata->kecamatan }}</h5>
                            <h5 class="parkinsans-regular f14"><strong>Alamat:</strong> {{ $wisata->alamat }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="parkinsans-regular f14"><strong>Kategori:</strong> {{ ucfirst($wisata->kategori_wisata) }}</h5>
                            <h5 class="parkinsans-regular f14"><strong>Latitude:</strong> {{ $wisata->latitude }}</h5>
                            <h5 class="parkinsans-regular f14"><strong>Longitude:</strong> {{ $wisata->longitude }}</h5>
                            <h5 class="parkinsans-md f14"><strong>Deskripsi:</strong></h5>
                            <p>{{ $wisata->deskripsi ?? 'Belum ada deskripsi.' }}</p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="text-end mt-4 mb-4">
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

                    <hr>

                    <div class="row mt-3 mb-5">
                        <h3 class="parkinsans-regular f32 text-center mt-3 mb-3">Review dari Pengguna</h3>
                        <div class="col-md-6 mb-2">
                            <h5 class="parkinsans-regular f24"><strong>Rating:</strong></h5>

                            @php
                                $totalRatings = $wisata->ratings->count();
                                $ratingCounts = [
                                    5 => $wisata->ratings->where('rating', 5)->count(),
                                    4 => $wisata->ratings->where('rating', 4)->count(),
                                    3 => $wisata->ratings->where('rating', 3)->count(),
                                    2 => $wisata->ratings->where('rating', 2)->count(),
                                    1 => $wisata->ratings->where('rating', 1)->count(),
                                ];
                            @endphp

                            @foreach ($ratingCounts as $stars => $count)
                                @php
                                    $percentage = $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0;
                                @endphp
                                <div class="d-flex align-items-center mb-1">
                                    <span class="me-2">{{ $stars }}★</span>
                                    <div class="progress flex-grow-1" style="height: 8px;">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $percentage }}%;"
                                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <span class="ms-2">{{ $count }}</span>
                                </div>
                            @endforeach

                            <!-- Total Rating -->
                            <div class="mt-2">
                                <strong class="fs-4">{{ number_format($wisata->ratings->avg('rating'), 1) }} ★</strong>
                                <span class="text-muted">({{ $totalRatings }} ulasan)</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5 class="parkinsans-regular f24"><strong>Ulasan</strong></h5>

                            <!-- Form input ulasan -->
                            <form action="{{ route('wisata.ulasan', $wisata->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label d-block parkinsans-light">Rating:</label>
                                    <div class="rating justify-content-center">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required />
                                            <label for="star{{ $i }}" title="{{ $i }} stars">★</label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="ulasan" class="form-label parkinsans-light">Ulasan:</label>
                                    <textarea name="ulasan" id="ulasan" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="text-end mb-5">
                                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                                </div>
                            </form>

                            <hr>

                            <!-- Menampilkan ulasan (5 pertama) atau pesan jika tidak ada ulasan -->
                            <div id="ulasan-list" class="mt-3">
                                @if ($wisata->ratings && $wisata->ratings->count() > 0)
                                    @foreach ($wisata->ratings->take(5) as $rating)
                                        <div class="d-flex align-items-start mb-3 ulasan-item">
                                            <!-- Foto Profil -->
                                            <img src="{{ asset('storage/' . Auth::user()->profile_picture ?? 'user/img/review-profile.png') }}"
                                                alt="User Avatar" class="rounded-circle me-3" width="50" height="50">

                                            <!-- Detail Ulasan -->
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $rating->user->name }}</h6>
                                                <div class="d-flex align-items-center">
                                                    <p class="text-warning mb-1 me-2">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="bi {{ $i <= $rating->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                        @endfor
                                                    </p>
                                                    <small class="text-muted">{{ $rating->created_at->diffForHumans() }}</small>
                                                </div>
                                                <p class="parkinsans-light mb-0">{{ $rating->ulasan }}</p>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted parkinsans-light">Belum ada ulasan untuk wisata ini.</p>
                                @endif
                            </div>

                            @if ($wisata->ratings->count() > 5)
                                <button id="load-more" class="btn btn-link">Muat Lebih Banyak</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3 mb-5">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .img-wisata-detail {
        width: 100%;
        height: 300px;
        object-fit: cover;
        object-position: center !important;
    }
    .img-wisata-2{
        height: 180px;
        width: 100%;
        object-fit: cover;
    }
    @media screen and (max-width:480px) {
        .img-wisata-detail{
            height: 180px;
        }
        .img-wisata-2{
            height: 80px;
        }
    }
    .rating {
        display: flex;
        flex-direction: row-reverse;
        gap: 5px;
    }
    .rating input {
        display: none;
    }
    .rating label {
        font-size: 32px;
        color: #ccc;
        cursor: pointer;
        transition: color 0.3s;
    }
    .rating input:checked ~ label,
    .rating label:hover,
    .rating label:hover ~ label {
        color: #ffc107;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let ulasanItems = document.querySelectorAll(".ulasan-item");
        let loadMoreBtn = document.getElementById("load-more");

        let visibleCount = 5;

        ulasanItems.forEach((item, index) => {
            if (index >= visibleCount) {
                item.style.display = "none";
            }
        });

        if (ulasanItems.length <= visibleCount) {
            loadMoreBtn?.style.display = "none";
        }

        loadMoreBtn?.addEventListener("click", function () {
            let hiddenItems = Array.from(ulasanItems).filter(item => item.style.display === "none");

            hiddenItems.slice(0, 5).forEach(item => {
                item.style.display = "block";
            });

            if (hiddenItems.length <= 5) {
                loadMoreBtn.style.display = "none";
            }
        });
    });
</script>

@endsection
