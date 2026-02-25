<div class="sidebar bg-dark text-white p-4">


    <h5 class="mb-4 fw-bold text-white">Absensi System</h5>

    {{-- Dashboard --}}
    <a href="{{ route('dashboard') }}"
        class="nav-link text-white mb-2 {{ request()->routeIs('dashboard') ? 'active bg-primary rounded' : '' }}">
        🏠 Dashboard
    </a>

    {{-- SUPER ADMIN MENU --}}
    @role('super-admin')

    <a href="{{ route('offices.index') }}"
        class="nav-link text-white mb-2 {{ request()->routeIs('offices.*') ? 'active bg-primary rounded' : '' }}">
        🏢 Data Kantor
    </a>

    <a href="{{ route('users.index') }}"
        class="nav-link text-white mb-2 {{ request()->routeIs('users.*') ? 'active bg-primary rounded' : '' }}">
        👥 Data User
    </a>

    @endrole

    {{-- Divider --}}
    <hr class="text-secondary my-3">

    {{-- ABSENSI --}}
    <a href="{{ route('attendance.index') }}"
        class="nav-link text-white mb-2">
        📍 Absensi
    </a>
    
    
    
    <a href="{{ route('attendance.history') }}"
        class="nav-link text-white mb-2">
        📍 Riwayat Absensi
    </a>

    


    {{-- LAPORAN --}}
    <a href="#"
        class="nav-link text-white mb-2">
        📊 Laporan
    </a>

    {{-- Spacer --}}
    <div class="mt-auto">
        <hr class="text-secondary">
        <a href="{{ route('profile.edit') }}"
            class="nav-link text-white">
            ⚙ Profile
        </a>
    </div>

</div>