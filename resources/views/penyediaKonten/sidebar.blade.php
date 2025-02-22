<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('dashboard.penyedia')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-table"></i><span>Kelola Konten</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('penyediaKonten.wisata.create')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-plus-lg icons-sidebar"></i>Tambah Konten</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('wisata.index')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-layout-text-window-reverse icons-sidebar"></i>Daftar Konten</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('penyedia.ulasan')}}">
                <i class="bi bi-chat-square-text-fill"></i>
                <span>Daftar Ulasan</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
