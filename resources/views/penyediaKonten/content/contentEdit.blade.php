@extends('penyediaKonten.index')
@section('ContentEdit')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.penyedia')}}">Home</a></li>
                <li class="breadcrumb-item active">Edit Content</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Edit Content</h3>
                </div>
                <div class="card-body">
                    <form id="wisataForm" action="{{ route('wisata.update', $wisata->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Upload Gambar -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Unggah Foto Wisata (Opsional)</label>
                                <div id="drop-area" class="drop-area">
                                    <p>Seret dan lepas file di sini atau klik untuk memilih</p>
                                    <input type="file" id="file-input" name="foto_wisata" hidden>
                                </div>
                                <ul id="file-list"></ul>

                                <small><b><i class="bi bi-exclamation-octagon-fill"></i> Format Gambar jpg, png, jpeg, webp, gif, avif | Ukuran Maksimal 5mb</b></small>

                                <!-- Menampilkan Gambar Lama -->
                                @if ($wisata->foto_wisata)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $wisata->foto_wisata) }}" class="img-fluid rounded" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Input File Biasa untuk foto_wisata2, foto_wisata3, foto_wisata4 -->
                        <div class="row">
                            @foreach (['foto_wisata2', 'foto_wisata3', 'foto_wisata4'] as $foto)
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ ucfirst(str_replace('_', ' ', $foto)) }} (Opsional)</label>
                                    <input type="file" class="form-control" name="{{ $foto }}">
                                    @if ($wisata->$foto)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $wisata->$foto) }}" class="img-fluid rounded" style="max-height: 100px;">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Informasi Wisata -->
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="nama_wisata" class="form-label">Nama Wisata</label>
                                <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" value="{{ $wisata->nama_wisata }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="desa_kelurahan" class="form-label">Desa/Kelurahan</label>
                                <input type="text" class="form-control" id="desa_kelurahan" name="desa" value="{{ $wisata->desa }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ $wisata->kecamatan }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $wisata->alamat }}" required>
                            </div>
                        </div>

                        <!-- Kategori Wisata & Lokasi -->
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="kategori" class="form-label">Kategori Wisata</label>
                                <select class="form-select" id="kategori" name="kategori_wisata" required>
                                    @foreach (['waterpark', 'mall', 'wisata_alam', 'wisata_kuliner', 'danau', 'pantai', 'tempat_bersejarah', 'sport', 'lainnya'] as $kategori)
                                        <option value="{{ $kategori }}" {{ $wisata->kategori_wisata == $kategori ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $kategori)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $wisata->latitude }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $wisata->longitude }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="no_telp" class="form-label">No. Telepon (Opsional)</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $wisata->no_telp }}">
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
                                                <input class="form-check-input" type="checkbox" name="type_wisata[]" value="{{ $type->id }}"
                                                    id="type_{{ $type->id }}"
                                                    {{ in_array($type->id, $selectedTypes) ? 'checked' : '' }}>
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
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $wisata->deskripsi }}</textarea>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="submitWisata">Simpan Perubahan</button>
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
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("submitWisata").addEventListener("click", function (event) {
            event.preventDefault();

            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin menyimpan perubahan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Simpan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("wisataForm").submit();
                }
            });
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
        fileInput.files = files;
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
