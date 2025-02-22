@extends('index')
@section('Dashboard')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title text-center parkinsans-md">Total Wisata</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-buildings-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalWisata }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title text-center parkinsans-md">Jumlah Ulasan</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-chat-square-text-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalUlasan }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title text-center parkinsans-md">Penyedia Konten</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-fill-gear"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalPenyediaKonten }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title text-center parkinsans-md">Total User</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalPengguna }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title text-center parkinsans-md">Total Admin</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-fill-lock"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalAdmin }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title text-center parkinsans-md">Visitor</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalVisitor }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title parkinsans-md">5 Wisata Popular</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center montserrat-md">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Pengelola</th>
                                                <th scope="col">Objek Wisata</th>
                                                <th scope="col">Rating</th>
                                                <th scope="col">Jumlah Ulasan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($wisataPopuler as $wisata)
                                            <tr>
                                                <td>{{ $wisata->user->name ?? 'Tidak Diketahui' }}</td>
                                                <td>{{ $wisata->nama_wisata }}</td>
                                                <td>{{ number_format($wisata->ratings_avg_rating, 1) }}</td>
                                                <td>{{ $wisata->ratings_count }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Top Selling -->


                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header card-calender">
                        <h5 class="card-title text-center parkinsans-md">Calendar</h5>
                    </div>
                    <div class="card-body pb-0">
                        <div id="digital-calendar" class="text-center">
                            <div id="current-date" class="mb-2" style="font-size: 1.2em; font-weight: bold;"></div>
                            <div id="current-time" style="font-size: 1.5em; font-weight: bold; color: #007bff;"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title text-center montserrat-semibold">Browser Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="browserChart"></canvas>
                    </div>
                </div><!-- End Website Traffic -->

            </div><!-- End Right side columns -->
        </div>
    </section>

    <style>
        .card-calender{
            background-color: #1A1A1D;
            color: #fff;
            max-height: 80px;
        }
        .card-calender h5{
            color: #fff;
            font-size: 24px;
        }
    </style>

    <script>
        function updateCalendar() {
            const now = new Date();

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const currentDate = now.toLocaleDateString('id-ID', options);

            const currentTime = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            document.getElementById('current-date').textContent = currentDate;
            document.getElementById('current-time').textContent = currentTime;
        }

        setInterval(updateCalendar, 1000);

        updateCalendar();

        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('browserChart').getContext('2d');

            var browserData = @json($browserData);

            var chartData = {
                labels: Object.keys(browserData),
                datasets: [{
                    data: Object.values(browserData),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF9800', '#8E44AD'],
                }]
            };

            new Chart(ctx, {
                type: 'pie',
                data: chartData
            });
        });
    </script>

</main><!-- End #main -->

@endsection
