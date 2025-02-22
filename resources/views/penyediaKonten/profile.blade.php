@extends('penyediaKonten.index')
@section('Profile')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Selamat Datang di Profile Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
                <li class="breadcrumb-item">Profile Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            @php
                $user = Auth::user();
            @endphp
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img
                        src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('user/img/review-profile.png') }}"
                        alt="Profile"
                        class="rounded-circle img-profile">
                        <h2 class="f-montserrat-md f14 t-uppercase">{{ $user->name }}</h2>
                        <h3 class="f-montserrat-md f14 t-uppercase">{{ $user->email }}</h3>
                        <hr>
                    </div>
                </div>
                <div class="card pd-1">
                    <div class="card-body">
                        <div class="Device">
                            <h3 class="parkinsans-md text-center uppercase">
                                <i class="bi bi-laptop"></i> Device Info
                            </h3>

                            <h4 class="text-start f16 parkinsans-light"><b>Location:</b> <i>{{ $lokasi->lokasi ?? 'Akses Lokasi Ditolak' }}</i></h4>
                            <h4 class="text-start f16 parkinsans-light"><b>OS:</b> <i>{{ $lokasi->os ?? 'Izin Ditolak'}}</i></h4>
                            <h4 class="text-start f16 parkinsans-light"><b>Browser:</b> <i>{{ getBrowser($lokasi->browser ?? '') }}</i></h4>
                            <h4 class="text-start f16 parkinsans-light"><b>IP Address:</b> <i>{{ $lokasi->ip_address ?? 'Izin Ditolak' }}</i></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title montserrat-semibold f16 t-uppercase">Profile Details</h5>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label montserrat-md f14 t-uppercase text-dark">UID</div>
                                    <div class="col-lg-9 col-md-8 f-montserrat-md t-capitalize">{{ $user->id }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label montserrat-md f14 t-uppercase text-dark">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8 f-montserrat-md t-capitalize">{{ $user->name }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label montserrat-md f14 t-uppercase text-dark">Alamat</div>
                                    <div class="col-lg-9 col-md-8 f-montserrat-md t-capitalize">{{ $user->alamat ?? 'Belum diisi' }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label montserrat-md f14 t-uppercase text-dark">No HP</div>
                                    <div class="col-lg-9 col-md-8 f-montserrat-md t-capitalize">{{ $user->no_hp ?? 'Belum diisi' }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label montserrat-md f14 t-uppercase text-dark">Jenis Kelamin</div>
                                    <div class="col-lg-9 col-md-8 f-montserrat-md t-capitalize">{{ $user->jenis_kelamin }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label montserrat-md f14 t-uppercase text-dark">Email</div>
                                    <div class="col-lg-9 col-md-8 f-montserrat-md t-capitalize text-blue"><i>{{ $user->email }}</i></div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form action="{{ route('penyedia.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Foto Profil -->
                                    <div class="row mb-3">
                                        <label for="profile_picture" class="col-md-4 col-lg-3 col-form-label">Profile Picture</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div id="drag-drop-container"
                                                class="border p-3 text-center"
                                                style="border: 2px dashed #ccc; cursor: pointer; position: relative;">
                                                <div id="message">Drag & Drop or click to upload profile image</div>
                                                <input type="file" name="profile_picture" id="profile_picture" style="display: none;" accept="image/*">
                                                <img id="profileImagePreview"
                                                    src="{{ asset('storage/' . $user->profile_picture) }}"
                                                    alt="Profile"
                                                    class="img-fluid mt-2"
                                                    style="max-height: 200px; display: {{ $user->profile_picture ? 'block' : 'none' }}">
                                            </div>
                                            <small><b><i class="bi bi-exclamation-octagon-fill"></i> Format Gambar : jpg, png, jpeg, webp, gif, avif | Maks 5MB</b></small>
                                        </div>
                                    </div>

                                    <!-- Full Name -->
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                                        </div>
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="row mb-3">
                                        <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="no_hp" type="text" class="form-control" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                                        </div>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="row mb-3">
                                        <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="alamat" class="form-control" id="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="male" value="laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'laki-laki' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="male">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="female" value="perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'perempuan' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="female">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Save Changes Button -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="{{ route('change-password') }}" method="POST">
                                    @csrf  <!-- Token keamanan wajib -->

                                    <div class="row mb-3">
                                        <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="current_password" type="password" class="form-control" id="current_password" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="new_password" type="password" class="form-control" id="new_password" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="confirm_password" type="password" class="form-control" id="confirm_password" required>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil DiPerbarui',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok'
            });
        @endif
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dragDropContainer = document.getElementById("drag-drop-container");
            const fileInput = document.getElementById("profile_picture");
            const profileImagePreview = document.getElementById("profileImagePreview");
            const message = document.getElementById("message");

            dragDropContainer.addEventListener("click", function () {
                fileInput.click();
            });

            fileInput.addEventListener("change", function () {
                previewImage(fileInput.files[0]);
            });

            dragDropContainer.addEventListener("dragover", function (e) {
                e.preventDefault();
                dragDropContainer.style.borderColor = "#007bff";
            });

            dragDropContainer.addEventListener("dragleave", function () {
                dragDropContainer.style.borderColor = "#ccc";
            });

            dragDropContainer.addEventListener("drop", function (e) {
                e.preventDefault();
                dragDropContainer.style.borderColor = "#ccc";

                let file = e.dataTransfer.files[0];
                fileInput.files = e.dataTransfer.files;
                previewImage(file);
            });

            function previewImage(file) {
                if (file && file.type.startsWith("image/")) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        profileImagePreview.src = e.target.result;
                        profileImagePreview.style.display = "block";
                        message.style.display = "none";
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert("Hanya file gambar yang diperbolehkan!");
                }
            }
        });
    </script>

</main>

@endsection
