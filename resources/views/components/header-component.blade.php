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
                        <!-- Imagen -->
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->profile_photo_path)
                                <img class="h-8 w-8 rounded-circle object-cover" src="/storage/{{ Auth::user()->profile_photo_path }}" alt="Imagen de perfil" />
                            @else
                                <img class="h-8 w-8 rounded-circle object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="Imagen de perfil" />
                            @endif
                            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                        </a>

                        <!-- Opciones -->
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="">
                            <li class="dropdown-header"> <!-- Nombre y Rol -->
                                <h6>{{ auth()->user()->name }}</h6>
                                <span>{{ auth()->user()->role }}</span>
                            </li>
                            <li> <!-- Divisor -->
                                <hr class="dropdown-divider">
                            </li>
                            <li> <!-- Ver perfil -->
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.show') }}"> <!-- show.blade.php -->
                                    <i class="bi bi-person"></i>
                                    <span>Ver perfil</span>
                                </a>
                            </li>
                            <li> <!-- Divisor -->
                                <hr class="dropdown-divider">
                            </li>
                            <li> <!-- Cerrar Sesión -->
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Cerrar sesión</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
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
