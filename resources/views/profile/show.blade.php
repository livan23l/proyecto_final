<x-template-principal>
    <div class="pagetitle">
        <h1>Perfil</h1>
        <hr />
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4"> <!-- Tarjeta de perfil -->
                @livewire('tarjeta-perfil')
            </div>

            <div class="col-xl-8"> <!-- Información y opciones -->
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist"> <!-- Encabezados -->
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
                            <!-- Información de la cuenta -->
                            <div class="tab-pane fade show active profile-overview" id="profile-overview" role="tabpanel">
                                @livewire("informacion-usuario")
                            </div>

                            <!-- Editar perfil -->
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">
                                @livewire('user-profile-edit') <!-- Edición del perfil en livewire -->
                            </div>

                            <!-- Opciones -->
                            <div class="tab-pane fade pt-3 text-center" id="profile-settings" role="tabpanel">
                                <a class="btn btn-primary" href="{{route('profile.configuration', auth()->user()->id)}}">Ver configuraciones especiales</a>
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
