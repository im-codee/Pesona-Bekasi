@extends('user.index')
@section('Profile')

<section id="profile-section" class="profile-section section-custom">
    <div class="container">
        <div class="row mt-3 mb-5">
            <h3 class="parkinsans-regular f24 capitalize">Profile saya</h3>
            <div class="mb-3 col-md-3">
                <div class="card card-profile mb-3">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('user/img/review-profile.png') }}" class="img-rounded img-profile mb-3" alt="img-profile">
                    <h3 class="parkinsans-regular capitalize f24">{{ Auth::user()->name }}</h3>
                    <span class="parkinsans-light f16 italic">{{ Auth::user()->email }}</span>
                    <div class="social-media mt-2">
                        <img src="{{asset('user/img/google-logo.png')}}" class="img-rounded img-medsos">
                    </div>
                </div>
                <div class="card card-device mt-3">
                    <h3 class="parkinsans-regular f20 text-center capitalize">
                        <i class="bi bi-laptop"></i> Device's Info
                    </h3>
                    <div class="card-body">
                        <h5 class="parkinsans-regular f16 capitalize">
                            OS: <span class="parkinsans-light f14 text-green italic">{{ $lokasi->os ?? 'Permintaan Izin Ditolak' }}</span>
                        </h5>
                        <h5 class="parkinsans-regular f16 capitalize">
                            Location: <span class="parkinsans-light f14 text-green italic">{{ $lokasi->lokasi ?? 'Permintaan Izin Lokasi Ditolak' }}, {{ $lokasi->region ?? '' }}</span>
                        </h5>
                        <h5 class="parkinsans-regular f16 capitalize">
                            IP Address: <span class="parkinsans-light f14 italic">{{ $lokasi->ip_address ?? 'Permintaan Izin Ditolak' }}</span>
                        </h5>
                        <h5 class="parkinsans-regular f16 capitalize">
                            Browser: <span class="parkinsans-light text-orange f14 italic">{{ $lokasi->browser ?? 'Permintaan Izin Ditolak' }}</span>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-md-9">
                <div class="card">
                    <ul class="nav nav-tabs" id="profileTabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="detail-tab" data-bs-toggle="tab" href="#detail">Detail Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-bs-toggle="tab" href="#edit">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password">Change Password</a>
                        </li>
                    </ul>

                    <div class="tab-content p-4">
                        <!-- Detail Profile -->
                        <div class="tab-pane fade show active" id="detail">
                            <h5 class="mb-3 parkinsans-regular capitalize f18">Detail Profile</h5>
                            <div class="row">
                                <div class="col-md-2 col-4 parkinsans-light f14 capitalize"><strong>UID</strong></div>
                                <div class="col-md-10 col-8 parkinsans-light f14 capitalize">: {{ Auth::user()->id }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2 col-4 parkinsans-light f14 capitalize"><strong>Nama</strong></div>
                                <div class="col-md-10 col-8 parkinsans-light f14 capitalize">: {{ Auth::user()->name }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2 col-4 parkinsans-light f14 capitalize"><strong>Alamat</strong></div>
                                <div class="col-md-10 col-8 parkinsans-light f14 capitalize">: {{ Auth::user()->alamat ?? 'Belum dilengkapi' }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2 col-4 parkinsans-light f14 capitalize"><strong>No. HP</strong></div>
                                <div class="col-md-10 col-8 parkinsans-light f14 capitalize">: {{ Auth::user()->no_hp ?? 'Belum dilengkapi' }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2 col-4 parkinsans-light f14 capitalize"><strong>Email</strong></div>
                                <div class="col-md-10 col-8 parkinsans-light f14 capitalize text-blue italic">: {{ Auth::user()->email ?? 'Belum dilengkapi' }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2 col-4 parkinsans-light f14 capitalize"><strong>Jenis Kelamin</strong></div>
                                <div class="col-md-10 col-8 parkinsans-light f14 capitalize">: {{ Auth::user()->jenis_kelamin }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2 col-4 parkinsans-light f14 capitalize"><strong>Pekerjaan</strong></div>
                                <div class="col-md-10 col-8 parkinsans-light f14 capitalize">: {{ Auth::user()->pekerjaan ?? 'Belum dilengkapi' }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2 col-4 parkinsans-light f14 capitalize"><strong>Bergabung pada</strong></div>
                                <div class="col-md-10 col-8 parkinsans-light f14 capitalize">
                                    : {{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : 'Belum dilengkapi' }}
                                </div>
                            </div>
                        </div>

                        <!-- Edit Profile -->
                        <div class="tab-pane fade" id="edit">
                            <h5 class="mb-3 parkinsans-regular capitalize f18">Edit Profile</h5>
                            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <!-- Foto Profil dengan Drag & Drop -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">Foto Profil</label>
                                    <div class="col-md-10">
                                        <div id="drag-drop-container"
                                            class="border p-3 text-center"
                                            style="border: 2px dashed #ccc; cursor: pointer; position: relative;">
                                            <div id="message">Drag & Drop atau klik untuk upload</div>
                                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" style="display: none;">
                                            <img id="profileImagePreview"
                                                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('user/img/review-profile.png') }}"
                                                alt="Profile" class="img-fluid mt-2" style="max-height: 200px;">
                                        </div>
                                        <small><b><i class="bi bi-exclamation-octagon-fill"></i> Format Gambar : jpg, png, jpeg, webp, gif, avif | Maks 5MB</b></small>
                                    </div>
                                </div>

                                <!-- Nama -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">Nama</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                    </div>
                                </div>

                                <!-- Nomor HP -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">No HP</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', Auth::user()->no_hp) }}">
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">Alamat</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="alamat" rows="3">{{ old('alamat', Auth::user()->alamat) }}</textarea>
                                    </div>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">Jenis Kelamin</label>
                                    <div class="col-md-10">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki"
                                                {{ old('jenis_kelamin', Auth::user()->jenis_kelamin) == 'laki-laki' ? 'checked' : '' }}>
                                            <label class="form-check-label">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan"
                                                {{ old('jenis_kelamin', Auth::user()->jenis_kelamin) == 'perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label">Perempuan</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pekerjaan -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">Pekerjaan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="pekerjaan" value="{{ old('pekerjaan', Auth::user()->pekerjaan) }}">
                                    </div>
                                </div>

                                <!-- Tombol Simpan -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <!-- Change Password -->
                        <div class="tab-pane fade" id="password">
                            <h5 class="mb-3 parkinsans-regular capitalize f18">Change Password</h5>
                            <form action="{{ route('change-password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">Password Lama</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="current_password" required>
                                        @error('current_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">Password Baru</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="new_password" required>
                                        @error('new_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label parkinsans-regular capitalize">Konfirmasi Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="new_password_confirmation" required>
                                        @error('new_password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger">Ubah Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{route('home')}}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</section>

<style>
    .nav-link{
        color: #000;
        font-family: 'Parkinsans', sans-serif;
    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let dropContainer = document.getElementById('drag-drop-container');
        let fileInput = document.getElementById('profile_picture');
        let previewImage = document.getElementById('profileImagePreview');
        let message = document.getElementById('message');

        dropContainer.addEventListener('click', function () {
            fileInput.click();
        });

        dropContainer.addEventListener('dragover', function (e) {
            e.preventDefault();
            dropContainer.style.border = "2px dashed #007bff";
        });

        dropContainer.addEventListener('dragleave', function () {
            dropContainer.style.border = "2px dashed #ccc";
        });

        dropContainer.addEventListener('drop', function (e) {
            e.preventDefault();
            dropContainer.style.border = "2px dashed #ccc";

            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                updatePreview(fileInput.files[0]);
            }
        });

        fileInput.addEventListener('change', function () {
            if (fileInput.files.length > 0) {
                updatePreview(fileInput.files[0]);
            }
        });

        // Fungsi update preview
        function updatePreview(file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
            message.style.display = "none";
        }
    });
</script>


@endsection
