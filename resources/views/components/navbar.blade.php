<nav class="navbar navbar-light bg-white shadow-sm mb-4 p-3 rounded-4">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">@yield('title')</span>

        <div class="d-flex align-items-center">
            <span class="me-3">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-outline-danger">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
