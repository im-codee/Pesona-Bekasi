@extends('penyediaKonten.index')
@section('ContentIndex')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.penyedia')}}">Home</a></li>
                <li class="breadcrumb-item active">Daftar Content</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Daftar Content</h3>
                    <p class="mention">
                        <b>#</b> Daftar Konten Hanya akan menampilkan Konten yang di Upload Penyedia Konten <b></b> <br>
                        <b>#</b> <span class="badge text-bg-danger">Menghapus Konten</span> akan menghapus juga <span class="badge text-bg-danger">Ulasan</span> <b></b> <br>
                    </p>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        @forelse($wisata as $item)
                            <div class="col-md-4 col-sm-6">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ $item->foto_wisata ? asset('storage/' . $item->foto_wisata) : asset('user/img/bg-1.jpg') }}"
                                        class="card-img-top" alt="Gambar Wisata" style="height: 200px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-center Capitalize">{{ $item->nama_wisata }}</h5>
                                        <p class="card-text"><strong>ID:</strong> {{ $item->id }}</p>
                                        <p class="card-text"><strong>Lokasi:</strong> {{ $item->alamat }}</p>
                                        <p class="card-text"><strong>Ratings:</strong> {{ $item->ratings->avg('rating') ?? 'Belum ada rating' }}</p>
                                        <div class="mt-auto text-center">
                                            <a href="{{ route('penyediaKonten.wisata.show', $item->id) }}" class="btn btn-primary w-100">Lihat Detail</a>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-center mx-2 gap-2">
                                        <a href="{{route('wisata.edit', $item->id)}}" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <form action="{{ route('wisata.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger delete-btn">
                                                <i class="bi bi-trash-fill"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <h5 class="text-muted">Belum ada wisata yang diunggah.</h5>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<style>
    .mention{
        font-size: 14px;
        margin-top: 10px;
        font-style: italic;
        color: #000;
    }
    .Capitalize{
        text-transform: capitalize;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                Swal.fire({
                    title: "Konfirmasi",
                    text: "Apakah Anda yakin ingin menghapus wisata ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus",
                    cancelButtonText: "Batal",
                    dangerMode: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest(".delete-form").submit();
                    }
                });
            });
        });
    });
</script>

@endsection
