<div>
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item"> <!-- Principal -->
                <a class="nav-link {{ request()->routeIs('presentacion') ? '' : 'collapsed' }}" href="/presentacion">
                    <i class="bi bi-grid"></i>
                    <span>Principal</span>
                </a>
            </li>

            <li class="nav-item"> <!-- Votar -->
                <a class="nav-link {{ request()->routeIs('votar.*') ? '' : 'collapsed' }}" href="/votar">
                    <i class="bi bi-file-earmark-check"></i>
                    <span>Votar</span>
                </a>
            </li>

            <li class="nav-item"> <!-- Ver noticias -->
                <a class="nav-link {{ request()->routeIs('noticias.ver') ? '' : 'collapsed' }}" href="/noticias">
                    <i class="bi bi-newspaper"></i>
                    <span>Ver noticias</span>
                </a>
            </li>

            @if (auth()->user()) <!-- Solo se mostrarán las opciones si está autenticado -->
                <li class="nav-item"> <!-- Noticia -->
                    <a class="nav-link {{ request()->routeIs('noticia.*') ? '' : 'collapsed' }}" data-bs-target="#noticias-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-vector-pen"></i><span>Noticias</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="noticias-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <!-- Opciones para ciudadano -->
                        @if (auth()->user() && auth()->user()->role == 'Ciudadano')
                            <li>
                                <a href="{{ route('noticia.periodista') }}" class="{{ request()->routeIs('noticia.periodista') ? 'active' : '' }}">
                                    <i class="bi bi-circle"></i><span>Volverme periodista</span>
                                </a>
                            </li>
                        @endif
                        <!-- Opciones para periodista -->
                        @if (auth()->user() && auth()->user()->role == 'Periodista')
                            <li>
                                <a href="{{ route('noticia.index') }}" class="{{ request()->routeIs('noticia.index') ? 'active' : '' }}">
                                    <i class="bi bi-circle"></i><span>Mis noticias</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('noticia.create') }}" class="{{ request()->routeIs('noticia.create') ? 'active' : '' }}">
                                    <i class="bi bi-circle active"></i><span>Publicar nueva</span>
                                </a>
                            </li>
                        @endif
                        <!-- Opciones para administrador -->
                        @if (auth()->user() && auth()->user()->role == 'Administrador')
                            <li>
                                <a href="#" class="">
                                    <i class="bi bi-circle active"></i><span>Validar periodistas (Sin terminar)</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user() && auth()->user()->role == 'Administrador')
                <hr />
                <li class="nav-item"> <!-- Candidato -->
                    <a class="nav-link {{ request()->routeIs('candidato.*') ? '' : 'collapsed' }}" data-bs-target="#candidatos-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-people-fill"></i><span>Candidatos</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="candidatos-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/candidato" class="{{ request()->routeIs('candidato.index') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Principal</span>
                            </a>
                        </li>
                        <li>
                            <a href="/candidato/create" class="{{ request()->routeIs('candidato.create') ? 'active' : '' }}">
                                <i class="bi bi-circle active"></i><span>Crear nuevo</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"> <!-- Votación -->
                    <a class="nav-link {{ request()->routeIs('votacion.*') ? '' : 'collapsed' }}" data-bs-target="#votaciones-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-file-bar-graph"></i><span>Votaciones</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="votaciones-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/votacion" class="{{ request()->routeIs('votacion.index') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Principal</span>
                            </a>
                        </li>
                        <li>
                            <a href="/votacion/create" class="{{ request()->routeIs('votacion.create') ? 'active' : '' }}">
                                <i class="bi bi-circle active"></i><span>Crear nueva</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </aside>
</div>
