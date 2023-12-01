<x-template-principal>
    <div class="pagetitle">
        <h1>Perfil</h1>
        <hr />
    </div><!-- End Page Title -->

    <section class="section profile d-flex justify-content-center">
            <div class="col-xl-10"> <!-- Información y opciones -->
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered mb-2 d-flex justify-content-center" role="tablist"> <!-- Encabezados -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">
                                    Configuraciones especiales
                                </button>
                            </li>
                        </ul>

                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.two-factor-authentication-form')
                            </div>
                        @endif

                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <x-section-border />

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.delete-user-form')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-template-principal>
