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
        <div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" data-bs-toggle="dropdown"
                        class="nav-link d-flex align-items-center dropdown-toggle pe-md-0">
                        <span class="me-1">Keito Altaya</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="" class="dropdown-item">Profile</a>
                        <a href="" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>