<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('dashboard.admin')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-database-fill"></i><span>Data Center</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('admin.wisata.list')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-buildings-fill icons-sidebar"></i>Daftar Wisata</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.ulasan.list')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-chat-square-text-fill icons-sidebar"></i>Daftar Ulasan</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.pengguna.list')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-person-vcard-fill icons-sidebar"></i>Daftar Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.pengelola.list')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-person-fill-gear icons-sidebar"></i>Daftar Pengelola Konten</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.visitor')}}">
                        <i class="bi bi-circle"></i><span> | <i class="bi bi-people-fill icons-sidebar"></i>Visitor</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.type-wisata.create')}}">
                <i class="bi bi-plus-lg"></i>
                <span>Type Wisata</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('add-admin-form')}}">
                <i class="bi bi-plus-lg"></i>
                <span>Pengelola Konten</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-graph-up"></i>
                <span>Statistik</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
