<div>
    <!-- Header -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <!-- Logo -->
        <div class="d-flex align-items-center justify-content-between">
            <a href="/presentacion" class="logo d-flex align-items-center">
                <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">VERN</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <!-- Perfil -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-5">
                    @auth <!-- Si el usuario está autenticado -->
                        @livewire("opciones-perfil")
                    @else
                        <!-- Si el usuario no está autenticado -->
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Iniciar sesión</span>
                        </a>
                    @endauth
                </li>
            </ul>
        </nav>
    </header>
</div>
