@extends('index')
@section('MitraIndex')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Visitor</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="title-penilaian text-center">Visitor</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr class="parkinsans-light">
                                    <th>User ID</th>
                                    <th>Lokasi</th>
                                    <th>IP Address</th>
                                    <th>OS</th>
                                    <th>Browser</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Create at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->user_id ?? 'Tidak Mendaftar' }}</td>
                                        <td>{{ $visitor->lokasi ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $visitor->ip_address }}</td>
                                        <td>{{ $visitor->os }}</td>
                                        <td>{{ $visitor->browser }}</td>
                                        <td>{{ $visitor->latitude }}</td>
                                        <td>{{ $visitor->longitude }}</td>
                                        <td>{{ $visitor->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection
