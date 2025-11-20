<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        
        <!-- Vista Móvil: Cabecera del menú al colapsar -->
        <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img src="{{ asset('assets/img/team/profile-picture-3.jpg') }}" class="card-img-top rounded-circle border-white" alt="Usuario">
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">Hola, Admin</h2>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                        <x-icon name="logout" class="me-1" /> Salir
                    </a>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <x-icon name="times" />
                </a>
            </div>
        </div>

        <!-- Lista de Navegación -->
        <ul class="nav flex-column pt-3 pt-md-0">
            
            <!-- Logo / Título -->
            <li class="nav-item">
                <a href="/dashboard" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <img src="{{ asset('assets/img/brand/light.svg') }}" height="20" width="20" alt="Logo">
                    </span>
                    <span class="mt-1 ms-1 sidebar-text">QR Parking</span>
                </a>
            </li>

            <!-- Dashboard -->
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard" class="nav-link">
                    <span class="sidebar-icon"><x-icon name="dashboard" /></span>
                    <span class="sidebar-text">Resumen</span>
                </a>
            </li>

            <!-- SECCIÓN OPERACIÓN -->
            <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
            <li class="nav-item">
                <a href="/entrada" class="nav-link d-flex justify-content-between">
                    <span>
                        <span class="sidebar-icon"><x-icon name="login" /></span>
                        <span class="sidebar-text">Ingreso</span>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/salida" class="nav-link d-flex justify-content-between">
                    <span>
                        <span class="sidebar-icon"><x-icon name="logout" /></span>
                        <span class="sidebar-text">Salida</span>
                    </span>
                </a>
            </li>

            <!-- SECCIÓN GESTIÓN -->
            <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
            
            <li class="nav-item {{ request()->is('admin/solicitudes') ? 'active' : '' }}">
                <a href="/admin/solicitudes" class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <span class="sidebar-icon"><x-icon name="notification" /></span>
                        <span class="sidebar-text">Solicitudes</span>
                    </span>
                    <span class="badge badge-sm bg-danger ms-1 text-gray-800">3</span>
                </a>
            </li>
            
            <li class="nav-item {{ request()->is('admin/planes') ? 'active' : '' }}">
                <a href="/admin/planes" class="nav-link">
                    <span class="sidebar-icon"><x-icon name="money" /></span>
                    <span class="sidebar-text">Pensiones</span>
                </a>
            </li>
            
            <li class="nav-item {{ request()->is('admin/tarifas') ? 'active' : '' }}">
                <a href="/admin/tarifas" class="nav-link">
                    <span class="sidebar-icon"><x-icon name="cog" /></span>
                    <span class="sidebar-text">Tarifas</span>
                </a>
            </li>

             <li class="nav-item {{ request()->is('admin/bitacora') ? 'active' : '' }}">
                <a href="/admin/bitacora" class="nav-link">
                    <span class="sidebar-icon"><x-icon name="reportBar" /></span>
                    <span class="sidebar-text">Bitácora</span>
                </a>
            </li>

            <!-- SECCIÓN SISTEMA -->
            <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
             <li class="nav-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon text-danger"><x-icon name="logout" /></span>
                    <span class="sidebar-text text-danger">Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>