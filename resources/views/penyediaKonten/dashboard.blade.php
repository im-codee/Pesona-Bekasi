@extends('penyediaKonten.index')
@section('Dashboard')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.penyedia')}}">Home</a></li>
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
                                        <h6>{{ $jumlahWisata }}</h6>
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
                                        <h6>{{ $jumlahUlasan }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title text-center parkinsans-md">Total Rating</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-heart-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($averageRating, 2) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title parkinsans-md">5 Ulasan Terbaru</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center montserrat-md">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Pengguna</th>
                                                <th scope="col">Objek Wisata</th>
                                                <th scope="col">Rating</th>
                                                <th scope="col">Dibuat pada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ulasanTerbaru as $ulasan)
                                                <tr>
                                                    <td>{{ $ulasan->user->name ?? 'Pengguna Tidak Diketahui' }}</td>
                                                    <td>{{ $ulasan->wisata->nama_wisata ?? 'Wisata Tidak Diketahui' }}</td>
                                                    <td>{{ $ulasan->rating }} ⭐</td>
                                                    <td>{{ $ulasan->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">Belum ada ulasan</td>
                                                </tr>
                                            @endforelse
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
    </script>

</main><!-- End #main -->

@endsection
