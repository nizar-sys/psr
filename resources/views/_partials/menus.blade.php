@php
    $routeActive = Route::currentRouteName();
    $level = Auth::user()?->role ?? 'masyarakat';
@endphp

<li class="nav-item mb-3">
    <a class="nav-link {{ $routeActive == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="fas fa-home"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

@if ($level == 'admin')
    <li class="nav-item mb-3">
        <a class="nav-link {{ $routeActive == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <p>
                Data Admin Petugas
            </p>
        </a>
    </li>

    <li class="nav-item mb-3">
        <a class="nav-link {{ $routeActive == 'masyarakat.index' ? 'active' : '' }}" href="{{ route('masyarakat.index') }}">
            <i class="fas fa-users"></i>
            <p>
                Data Masyarakat
            </p>
        </a>
    </li>

    <li class="nav-item mb-3">
        <a class="nav-link {{ $routeActive == 'verifikasi-pengaduan.index' ? 'active' : '' }}" href="{{ route('verifikasi-pengaduan.index') }}">
            <i class="fas fa-envelope"></i>
            <p>
                Data Pengaduan Belum Diverifikasi
            </p>
        </a>
    </li>
@endif

<li class="nav-item mb-3">
    <a class="nav-link {{ $routeActive == 'pengaduan.index' ? 'active' : '' }}" href="{{ route('pengaduan.index') }}">
        <i class="fas fa-envelope"></i>
        <p>
            Data Pengaduan
        </p>
    </a>
</li>

@if ($level != 'masyarakat')
<li class="nav-item mb-3">
    <a class="nav-link {{ $routeActive == 'laporan-pengaduan.index' ? 'active' : '' }}" href="{{ route('laporan-pengaduan.index') }}">
        <i class="fas fa-envelope"></i>
        <p>
            Laporan Data Pengaduan
        </p>
    </a>
</li>
@endif

<li class="nav-item mb-3">
    <a class="nav-link" href="{{ route('logout') }}" id="btn-logout">
        <i class="fas fa-sign-out-alt"></i>
        <p>
            Keluar
        </p>
    </a>
</li>
