<x-template-principal>
    <div class="card bg-light text-dark shadow rounded-4">
        <div class="card-body">
            <h1 class="card-title text-center mb-2">Información de candidato</h1>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                <h2 class="h2 mb-3">{{ ucwords($candidato->nombre) }}</h2>
            </div>

            <hr class="my-4" />

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center my-2">
                    <h2 class="h4 mb-3">Partido</h2>
                    <hr class="w-75 mx-auto" />
                    <p class="lead">{{ $candidato->partido }}</p>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center my-2">
                    <h2 class="h4 mb-3">Fecha de nacimiento</h2>
                    <hr class="w-75 mx-auto" />
                    <p class="lead">{{ \Carbon\Carbon::parse($candidato->f_nac)->format('d/m/Y') }}</p>
                </div>
            </div>
            <hr />

            <div class="row text-center">
                <h2 class="h4 mb-3">Descripción</h2>
                <p class="lead">{{ $candidato->descripcion }}</p>
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="col text-center">
                <p class="small text-muted">Última actualización: {{ $candidato->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</x-template-principal>
