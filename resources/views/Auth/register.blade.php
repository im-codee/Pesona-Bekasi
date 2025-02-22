<!DOCTYPE html>
<html lang="ID">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Icons -->
        <link href="{{asset('user/img/Logo-Bekasi.png')}}" rel="icon">
        <link href="{{asset('user/img/Logo-Bekasi.png')}}" rel="apple-touch-icon">
        <title>Pesona Bekasi | Tempat Wisata</title>

        <!--===== Library =====-->
        <!-- Google Font -->
        <link rel="preconnect" href="{{url('https://fonts.googleapis.com')}}">
        <link rel="preconnect" href="{{url('https://fonts.gstatic.com')}}" crossorigin>
        <link href="{{url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap')}}" rel="stylesheet">

        <!-- CDN Bootstrap -->
        <link href="{{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css')}}">
        <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css')}}">
        <link rel="stylesheet" href="{{url('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined')}}" />
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{asset('user/css/main.css')}}">
        <!-- Select2 CSS -->
        <link href="{{url('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css')}}" rel="stylesheet">

    </head>

    <body>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center parkinsans-regular f24">
                            <img src="{{asset('user/img/Logo-Bekasi.png')}}" class="logo-form img-fluid"> Dinas Pariwisata Bekasi
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Masukkan password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control"
                                            id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                                </div>

                                <button type="submit" class="btn btn-success w-100">Daftar</button>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <small>Sudah punya akun? <a href="{{ route('login') }}">Login</a></small>
                        </div>
                </div>
            </div>
        </div>

        <style>
            body {
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
                background-image: url("{{ asset('user/img/bg-1.jpg') }}");
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
            body::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1;
            }
            .card {
                position: relative;
                z-index: 2;
                width: 100%;
                max-width: 400px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(5px);
            }
            .logo-form{
                height: 60px;
                width: 60px;
            }
            @media screen and (max-width:480px) {
                .f24{
                    font-size: 18px;
                }
            }
        </style>


        <!-- Library -->
        <!-- Select2 JS -->
        <script src="{{url('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
        <script src="{{url('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js')}}"></script>
        <script src="{{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Custom JS -->
        <script src="{{asset('user/js/main.js')}}"></script>
        <script src="{{asset('user/js/setLocation.js')}}"></script>
    </body>
</html>
