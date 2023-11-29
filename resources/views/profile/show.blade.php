<x-template-principal>
    <div class="pagetitle">
        <h1>Perfil</h1>
        <hr />
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4"> <!-- Tarjeta de perfil -->
                <x-tarjeta-perfil-component />
            </div>

            <div class="col-xl-8"> <!-- Información del usuario y la cuenta. -->
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist"> <!-- Campos -->
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

                        <div class="tab-content pt-2"> <!-- Contenidos -->
                            <!-- Descripción -->
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

                            <!-- Editar perfil -->
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">
                                {{-- @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                    @livewire('profile.update-profile-information-form')

                                    <x-section-border />
                                @endif --}}
                                @livewire('user-profile-edit') <!-- Edición del perfil en livewire -->
                            </div>

                            <!-- Opciones -->
                            <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">
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

                            <!-- Cambiar contraseña -->
                            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                @livewire('user-profile-change-password') <!-- Cambio de contraseña en livewire -->
                            </div>

                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-template-principal>
