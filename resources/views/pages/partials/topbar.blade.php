<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">

    <!-- Judul Halaman -->
    <h1 class="h3 mb-0 text-white">Buku Tamu</h1>

    <!-- Spacer agar tulisan ke kiri dan user info ke kanan -->
    <ul class="navbar-nav ml-auto">

        <!-- Divider -->
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white small">
                    {{ session('admin_name') }}
                </span>

                <img class="img-profile rounded-circle"
                     src="{{ asset('template/img/undraw_profile.svg') }}">
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0 m-0">
    @csrf
    <button type="submit" class="btn btn-link dropdown-item">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </button>
</form>

            </div>
        </li>

    </ul>
</nav>
<!-- End of Topbar -->
