<nav class="navbar navbar-expand px-3 border-bottom d-flex justify-content-between">
    <div class="d-flex align-items-center">
        <button class="btn btn-lg btn-icon" id="sidebar-toggle" type="button">
            <img src="{{ asset('images/menu.png') }}" alt="menu png">
        </button>
        <h4 class="menu-title">
            @yield('nav-title')
        </h4>
    </div>
    <div class="d-flex align-items-center justify-content-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            @method('POST')
            <button class="btn border-0 fw-bold" type="submit">
                <i class="bi bi-box-arrow-left"></i>
                Logout
            </button>
        </form>
    </div>
</nav>