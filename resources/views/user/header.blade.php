<nav class="navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand parkinsans-regular" href="{{route('home')}}">
            <img src="{{ asset('user/img/Logo-Bekasi.png') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Pesona Bekasi
        </a>

        @guest
            <!-- Jika pengguna belum login, tampilkan tombol Login -->
            <a href="{{route('login')}}" class="btn btn-primary">
                <i class="bi bi-person-fill"></i> Login
            </a>
        @endguest

        @auth
            <!-- Jika pengguna sudah login, tampilkan dropdown profil -->
            <div class="dropdown">
                <button class="btn dropdown-toggle parkinsans-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background: transparent; border: none; color: inherit;">
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture ?? 'user/img/review-profile.png') }}" class="img-rounded img-dropdown">
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header text-center">
                        <h6 class="parkinsans-light capitalize">{{ Auth::user()->name }}</h6>
                        <span class="parkinsans-light"><i>{{ Auth::user()->email }}</i></span>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('user.profile')}}">
                            <i class="bi bi-person-fill-gear"></i>
                            <span class="parkinsans-light mk-3">My Profile</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="parkinsans-light mk-3">Sign Out</span>
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </div>
        @endauth
    </div>
</nav>
