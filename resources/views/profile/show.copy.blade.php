<x-template-principal>
    <div class="pagetitle">
        <h1>Perfil</h1>
        <hr />
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4"> <!-- Tarjeta de perfil -->
                <div class="card">
                    <div class="card-body profile-card pt-4">
                        <div class="d-flex flex-column align-items-center">
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="Profile" class="rounded-circle">
                            <h2 class="text-center">{{ auth()->user()->name }}</h2>
                            <h3 class="pt-2 pb-0 mb-0">{{ auth()->user()->role }}</h3>
                        </div>
                        <hr class="mt-3 mb-3" />
                        <div class="text-center mb-3">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <span class="text-decoration-none text-primary">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8"> <!-- Información del usuario y la cuenta. -->
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist"> <!-- Tarjetas Superiores -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">
                                    Descripción
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" tabindex="-1" role="tab">
                                    Editar perfil
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" aria-selected="false" tabindex="-1" role="tab">
                                    Opciones
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="false" tabindex="-1" role="tab">
                                    Cambiar contraseña
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <!-- Contenido "Descripción" -->
                            <div class="tab-pane fade show active profile-overview" id="profile-overview" role="tabpanel">
                                <h5 class="card-title">Acerca de mí</h5> <!-- Acerca de mí -->
                                <p class="small fst-italic">
                                    {{ auth()->user()->description }}
                                </p>

                                <h5 class="card-title">Detalles del perfil</h5>

                                <div class="row"> <!-- Nombre -->
                                    <div class="col-lg-3 col-md-4 label">Nombre</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                                </div>

                                <div class="row"> <!-- Estado -->
                                    <div class="col-lg-3 col-md-4 label">Estado</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->state }}</div>
                                </div>

                                <div class="row"> <!-- Correo -->
                                    <div class="col-lg-3 col-md-4 label ">Correo</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                </div>

                                <div class="row"> <!-- Rol -->
                                    <div class="col-lg-3 col-md-4 label ">Rol</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->role }}</div>
                                </div>

                                <div class="row"> <!-- Creación -->
                                    <div class="col-lg-3 col-md-4 label">Creación</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->created_at->format('d/m/Y') }}</div>
                                </div>
                            </div>

                            <!-- Contenido "Editar perfil" -->
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">
                                @livewire('user-profile-edit') <!-- Edición del perfil en livewire -->
                            </div>

                            <!-- Contenido "Opciones" -->
                            <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">

                            </div>

                            <!-- Contenido "Cambiar contraseña" -->
                            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                @livewire('user-profile-change-password') <!-- Cambio de contraseña en livewire -->
                            </div>

                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
        
    </section>




            {{-- 
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
        </div> --}}

</x-template-principal>
