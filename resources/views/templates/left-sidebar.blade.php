@auth
    
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">SPK Beasiswa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="padding: 0; margin: 0;">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-0 mb-0 d-flex" style="padding: 15px 10px;">
            <div class="image mt-2">
            </div>
            <div class="info">
                @if(auth()->check()) <!-- Pastikan pengguna sudah login -->
                    <p class="mt-0 d-block" style="font-size: 20px; font-weight: 600; color: #ffffff;">{{ auth()->user()->name }}</p>
                @else
                    <p class="mt-0 d-block text-white" style="font-size: 14px;">Guest</p>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="padding: 0;">
                <!-- Dashboard -->
                <li class="nav-item">
                    @if(auth()->check() && auth()->user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="font-size: 16px; padding: 10px 15px;">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    @elseif(auth()->check() && auth()->user()->role == 'peserta')
                        <a href="{{ route('landing.dashboard') }}" class="nav-link {{ request()->routeIs('landing.dashboard') ? 'active' : '' }}" style="font-size: 16px; padding: 10px 15px;">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    @endif
                </li>

                @if(auth()->check() && auth()->user()->role == 'admin')

                    <!-- Master Data -->
                    <li class="nav-header" style="font-size: 0.9rem; padding: 10px 15px; text-transform: uppercase; color: #6c757d; font-weight: 600;">KELOLA DATA</li>

                    <!-- Kriteria -->
                    <li class="nav-item">
                        <a href="{{ route('admin.kriteria.index') }}" class="nav-link {{ request()->routeIs('kriteria.*') ? 'active' : '' }}" style="font-size: 16px; padding: 10px 15px;">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Kriteria</p>
                        </a>
                    </li>

                    <!-- Peserta -->
                    <li class="nav-item">
                        <a href="{{ route('admin.peserta.index') }}" class="nav-link {{ request()->routeIs('admin.peserta.*') ? 'active' : '' }}" style="font-size: 16px; padding: 10px 15px;">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Info</p>
                        </a>
                    </li>

                    <!-- Proses Seleksi -->
                    <li class="nav-header" style="font-size: 0.9rem; padding: 10px 15px; text-transform: uppercase; color: #6c757d; font-weight: 600;"></li>
                    <li class="nav-item">
                        <a href="{{ route('admin.penilaian.index') }}" class="nav-link {{ request()->routeIs('admin.penilaian.index.*') ? 'active' : '' }}" style="font-size: 16px; padding: 10px 15px;">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Penilaian
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->check() && auth()->user()->role == 'peserta')
                    <!-- Menu Peserta -->>
                    <li class="nav-item">
                            <a href="{{ route('landing.status') }}" class="nav-link {{ request()->routeIs('landing.status') ? 'active' : '' }}" style="font-size: 16px; padding: 10px 15px;">
                                <i class="nav-icon fas fa-trophy"></i>
                                <p>Hasil Beasiswa</p>
                            </a>
                    </li>
                @endif

                <!-- Logout -->
                <li class="nav-item">
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#" class="nav-link" style="font-size: 16px; padding: 10px 15px;">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
@endauth

<!-- CSS Perbaikan -->
<style>
    .main-sidebar {
        height: 100vh;
        position: fixed;
        width: 250px;
        overflow-y: auto;
        background-color: #000000;
    }

    .sidebar {
        padding: 0;
    }

    .user-panel {
        padding: 15px 10px;
        display: flex;
        align-items: center;
    }

    .user-panel .image img {
        max-width: 40px;
        height: auto;
    }

    .user-panel .info {
        margin-left: 10px;
    }

    .nav-item .nav-link {
        font-size: 16px;
        padding: 10px 15px;
        color: #ffffff;
        transition: background-color 0.3s ease;
    }

    .nav-item .nav-link:hover {
        background-color: #007bff;
        border-radius: 5px;
        color: #ffffff;
    }

    .nav-item .active {
        background-color: #007bff;
        border-left: 5px solid #ffffff;
        color: #ffffff;
    }

    @media (max-width: 992px) {
        .main-sidebar {
            width: 200px;
        }
    }

    @media (max-width: 768px) {
        .main-sidebar {
            width: 100%;
            position: relative;
        }
        .content-wrapper {
            margin-left: 0;
        }
    }
</style>