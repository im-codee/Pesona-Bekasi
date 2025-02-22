@extends('penyediaKonten.index')
@section('ContentCreate')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.penyedia')}}">Home</a></li>
                <li class="breadcrumb-item active">Upload Content</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Upload Content</h3>
                </div>
                <div class="card-body">
                    <form id="wisataForm" action="{{ route('penyediaKonten.wisata.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Upload Gambar -->
                        <div class="row">
                            <!-- Drag & Drop untuk foto_wisata -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Unggah Foto Wisata (Opsional)</label>
                                <div id="drop-area" class="drop-area">
                                    <p>Seret dan lepas file di sini atau klik untuk memilih</p>
                                    <input type="file" id="file-input" name="foto_wisata" hidden>
                                </div>
                                <ul id="file-list"></ul>
                                <small><b><i class="bi bi-exclamation-octagon-fill"></i> Format Gambar jpg, png, jpeg, webp, gif, avif | Ukuran Maksimal 5mb</b></small>
                            </div>
                        </div>

                        <!-- Input File Biasa untuk foto_wisata2, foto_wisata3, foto_wisata4 -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="foto_wisata2" class="form-label">Foto Wisata 2 (Opsional)</label>
                                <input type="file" class="form-control" id="foto_wisata2" name="foto_wisata2">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="foto_wisata3" class="form-label">Foto Wisata 3 (Opsional)</label>
                                <input type="file" class="form-control" id="foto_wisata3" name="foto_wisata3">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="foto_wisata4" class="form-label">Foto Wisata 4 (Opsional)</label>
                                <input type="file" class="form-control" id="foto_wisata4" name="foto_wisata4">
                            </div>
                        </div>

                        <!-- Informasi Wisata -->
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="nama_wisata" class="form-label">Nama Wisata</label>
                                <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="desa_kelurahan" class="form-label">Desa/Kelurahan</label>
                                <input type="text" class="form-control" id="desa_kelurahan" name="desa" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                        </div>

                        <!-- Kategori Wisata & Lokasi -->
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="kategori" class="form-label">Kategori Wisata</label>
                                <select class="form-select" id="kategori" name="kategori_wisata" required>
                                    <option value="waterpark">Waterpark</option>
                                    <option value="mall">Mall</option>
                                    <option value="wisata_alam">Wisata Alam</option>
                                    <option value="wisata_kuliner">Wisata Kuliner</option>
                                    <option value="danau">Danau</option>
                                    <option value="pantai">Pantai</option>
                                    <option value="tempat_bersejarah">Tempat Bersejarah</option>
                                    <option value="sport">Sport/Olahraga</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="no_telp" class="form-label">No. Telepon (Opsional)</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp">
                            </div>
                        </div>

                        <!-- Tipe Wisata (Checkbox) -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Tipe Wisata</label>
                                <div class="row">
                                    @foreach ($typeWisata as $type)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="type_wisata[]" value="{{ $type->id }}" id="type_{{ $type->id }}">
                                                <label class="form-check-label" for="type_{{ $type->id }}">{{ $type->nama_type }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="{{ $userId }}">

                        <!-- Tombol Submit -->
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" id="submitWisata">Simpan</button>
                            <a href="{{ route('wisata.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<script src="{{url('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "OK"
        });
        @endif
    });
</script>


<script>
    document.getElementById('submitWisata').addEventListener('click', function() {
        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah Anda yakin ingin menyimpan data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Simpan",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('wisataForm').submit();
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("file-input");
    const fileList = document.getElementById("file-list");

    dropArea.addEventListener("click", () => fileInput.click());

    dropArea.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropArea.classList.add("drag-over");
    });

    dropArea.addEventListener("dragleave", () => {
        dropArea.classList.remove("drag-over");
    });

    dropArea.addEventListener("drop", (e) => {
        e.preventDefault();
        dropArea.classList.remove("drag-over");

        const files = e.dataTransfer.files;
        fileInput.files = files; // Memasukkan file ke dalam input form
        updateFileList(files);
    });

    fileInput.addEventListener("change", (e) => {
        updateFileList(e.target.files);
    });

    function updateFileList(files) {
        fileList.innerHTML = "";
        if (files.length > 0) {
            const listItem = document.createElement("li");
            listItem.textContent = files[0].name;
            fileList.appendChild(listItem);
        }
    }
});
</script>

<style>
    .drop-area {
        border: 2px dashed #007bff;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .drop-area p {
        margin: 0;
        font-size: 16px;
        color: #6c757d;
    }

    .drop-area.drag-over {
        background-color: #e9ecef;
        border-color: #0056b3;
    }

    #file-list {
        margin-top: 10px;
        padding: 0;
        list-style: none;
        text-align: center;
    }

    #file-list li {
        background-color: #007bff;
        color: white;
        padding: 8px;
        border-radius: 4px;
        display: inline-block;
        margin: 5px;
        font-size: 14px;
    }
</style>


@endsection
