<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex align-items-center">
                <!-- Buscador Global (Opcional) -->
                <form class="navbar-search form-inline" id="navbar-search-main">
                    <div class="input-group input-group-merge search-bar">
                        <span class="input-group-text" id="topbar-addon">
                            <x-icon name="search" class="fas fa-search" />
                        </span>
                        <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Buscar placa..." aria-label="Search" aria-describedby="topbar-addon">
                    </div>
                </form>
            </div>
            <!-- Menú de Usuario Derecha -->
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="avatar rounded-circle" alt="Image placeholder" src="{{ asset('assets/img/team/profile-picture-3.jpg') }}">
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small fw-bold text-gray-900">Administrador</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <x-icon name="user" class="me-2 text-gray-400" /> Mi Perfil
                        </a>
                        <div role="separator" class="dropdown-divider my-1"></div>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <x-icon name="logout" class="me-2 text-danger" /> Cerrar Sesión
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>