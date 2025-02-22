@extends('user.index')
@section('Home')
<section id="search-destination" class="search-destination section-custom">
    <div class="container">
        <form id="wisataForm" action="{{ route('wisata.search') }}" method="GET">
            <div class="row justify-content-center align-items-center">
                <h3 class="text-center text-white parkinsans-bold f32 mb-3">From Bekasi introduced to the World</h3>

                <!-- Kategori Wisata -->
                <div class="col-md-3 col-7 mb-3">
                    <label for="kategori" class="form-label text-white parkinsans-regular">Kategori Wisata</label>
                    <select id="kategori" name="kategori" class="form-select select2">
                        <option selected disabled>Pilih Kategori</option>
                        <option value="waterpark">Waterpark</option>
                        <option value="mall">Mall</option>
                        <option value="alam">Wisata Alam</option>
                        <option value="kuliner">Kuliner</option>
                        <option value="danau">Danau</option>
                        <option value="pantai">Pantai</option>
                        <option value="sejarah">Tempat Bersejarah</option>
                        <option value="industri">Industri</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Pilih Berdasarkan -->
                <div class="col-md-3 col-5 mb-3">
                    <label for="filter" class="form-label text-white">Pilih Berdasarkan</label>
                    <select id="filter" name="filter" class="form-select select2">
                        <option selected disabled>Pilih Filter</option>
                        <option value="jarak">Jarak Terdekat</option>
                        <option value="populer">Populer</option>
                    </select>
                </div>

                <!-- Tipe Wisata -->
                <div class="col-md-3 col-9 mb-3">
                    <label for="tipe_wisata" class="form-label text-white">Tipe Wisata</label>
                    <select id="tipe_wisata" name="tipe_wisata" class="form-select select2">
                        <option selected disabled>Pilih Tipe Wisata</option>
                        @foreach($tipeWisata as $tipe)
                            <option value="{{ $tipe->slug }}">{{ $tipe->nama_type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Search -->
                <div class="col-md-2 col-3 mb-3">
                    <label class="form-label d-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <script>
            document.getElementById('wisataForm').addEventListener('submit', function(event) {
                let kategori = document.getElementById('kategori').value;
                let filter = document.getElementById('filter').value;

                if (filter === 'jarak' || filter === 'populer') {
                    this.action = "{{ route('wisata.search') }}";
                } else if (kategori) {
                    this.action = "{{ url('/kategori') }}/" + kategori;
                } else {
                    event.preventDefault();
                    alert("Silakan pilih kategori atau filter pencarian!");
                }
            });
        </script>

    </div>
</section>
<section id="hero-section" class="hero-section mb-5">
    <div class="container d-flex flex-column justify-content-center">
        <!-- Row Pertama -->
        <div class="row mt-3 justify-content-center">
            <h3 class="title-home text-center parkinsans-semibold capitalize">Berdasarkan Kategori</h3>
            <div class="col-md-3 col-6 mt-2">
                <a href="{{ route('wisata.kategori', 'waterpark') }}" class="none-decoration">
                    <div class="card card-waterpark">
                        <div class="card-body text-center text-white">
                            <h3 class="f20 parkinsans-regular">Waterpark</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mt-2">
                <a href="{{ route('wisata.kategori', 'mall') }}" class="none-decoration">
                    <div class="card card-mall">
                        <div class="card-body text-center text-white">
                            <h3 class="f20 parkinsans-regular">Mall</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mt-2">
                <a href="{{ route('wisata.kategori', 'wisata_alam') }}" class="none-decoration">
                    <div class="card card-alam">
                        <div class="card-body text-center text-white">
                            <h3 class="f20 parkinsans-regular">Wisata Alam</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mt-2">
                <a href="{{ route('wisata.kategori', 'wisata_kuliner') }}" class="none-decoration">
                    <div class="card card-kuliner">
                        <div class="card-body text-center text-white">
                            <h3 class="f20 parkinsans-regular">Wisata Kuliner</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div> <!-- Batas Row -->

        <!-- Row Kedua -->
        <div class="row justify-content-center mt-3">
            <div class="col-md-3 col-6 mt-2">
                <a href="{{ route('wisata.kategori', 'danau') }}" class="none-decoration">
                    <div class="card card-danau">
                        <div class="card-body text-center text-white">
                            <h3 class="f20 parkinsans-regular">Wisata Danau</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mt-2">
                <a href="{{ route('wisata.kategori', 'pantai') }}" class="none-decoration">
                    <div class="card card-pantai">
                        <div class="card-body text-center text-center">
                            <h3 class="f20 parkinsans-regular">Pantai</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mt-2">
                <a href="{{ route('wisata.kategori', 'tempat_bersejarah') }}" class="none-decoration">
                    <div class="card card-sejarah">
                        <div class="card-body text-center text-white">
                            <h3 class="f20 parkinsans-regular">Tempat Bersejarah</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mt-2">
                <a href="{{ route('wisata.kategori', 'sports_other') }}" class="none-decoration">
                    <div class="card card-industri">
                        <div class="card-body text-center text-white">
                            <h3 class="f20 parkinsans-regular">Sports & Other</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div> <!-- Batas Row -->
    </div>
</section>


@endsection



