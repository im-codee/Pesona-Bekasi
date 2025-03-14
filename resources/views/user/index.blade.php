<!DOCTYPE html>
<html lang="ID, EN">
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

        @include('user.header')

        @yield('Home')
        @yield('ContentList')
        @yield('ContentDetail')
        @yield('contentSearch')
        @yield('Profile')

        @include('user.footer')


        <!-- Library -->
        <!-- Select2 JS -->
        <script src="{{url('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{url('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js')}}"></script>
        <script src="{{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Custom JS -->
        <script src="{{asset('user/js/main.js')}}"></script>
        <script src="{{asset('user/js/setLocation.js')}}"></script>
    </body>
</html>
