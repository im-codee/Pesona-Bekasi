@extends('index')
@section('AddTypeWisata')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Tambah Type Wisata</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Tambah Type Wisata</h3>
                </div>
                <div class="card-body mt-3">
                    <form id="typeWisataForm" action="{{ route('admin.type-wisata.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_type" class="form-label">Nama Tipe Wisata</label>
                            <input type="text" class="form-control" id="nama_type" name="nama_type" required>
                            @error('nama_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <small><b>Masukan Type/Jenis Wisata</b></small> <br>
                        <small>Contoh : <i>Cocok untuk Anak-anak, Bersama Keluarga, Bersantai, Dll</i></small>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" id="submitBtn">Simpan</button>
                            <a href="{{ route('dashboard.admin') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<script src="{{url('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
<script>
    document.getElementById('submitBtn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah Anda yakin ingin menambahkan tipe wisata ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('typeWisataForm').submit();
            }
        });
    });

    @if(session('success'))
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
    @endif
</script>

@endsection
