<x-template-principal>
    <!-- Title -->
    <div class="container text-center my-3">
        <h1 class="display-4">Votaciones en curso</h1>
        <p class="lead mt-3">
            Ejerce tu derecho al voto de manera <i>fácil</i>, <i>segura</i> y <i>electrónica</i>.
        </p>
        <hr class="my-4">
    </div>
    <!-- End Title Section -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-11 col-xl-11">
                @if ($votaciones->isEmpty())
                    <div class="alert alert-danger text-center" role="alert">
                        <h4 class="alert-heading">¡Lo sentimos!</h4>
                        <p class="mb-2">No se ha encontrado ninguna votación.</p>
                        <p class="mb-0"><i><a href="#">Contacta al soporte</a> si crees que se trata de un error.</i></p>
                    </div>
                @else
                    @foreach ($votaciones as $votacion)
                        <div class="card">
                            <div class="card-header text-center">
                                {{ $votacion->tipo }} | {{ $votacion->alcance }} | {{ $votacion->zona }}
                            </div>
                            <div class="card-body" class="mb-0">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex align-items-center justify-content-center">
                                    @if ((\App\Models\UserVotacion::where(['user_id' => auth()->id(), 'votacion_id' => $votacion->id])->get())->isEmpty())
                                        <i class="bi bi-clipboard-x pt-1 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Aún no has registrado tu voto"></i>
                                    @else
                                        <i class="bi bi-clipboard-check pt-1 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tu voto se registró correctamente"></i>
                                    @endif
                                    <h5 class="card-title text-center mb-0 ms-2">{{ $votacion->nombre }}</h5>
                                </div>
                                <hr class="mb-0" />
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 d-flex justify-content-center align-items-center"> <!-- Descripción -->
                                        <div class="border rounded-3 py-2 ps-2 pe-3 text-center w-100 min-h-75">
                                            <h4><b>Descripción:</b></h4>
                                            {{ $votacion->descripcion }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8"> <!-- Gráfica actual -->
                                        <div class="mt-4 mb-2">
                                            <div class="pb-3">
                                                @if ($votacion->votos == 0)
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="alert alert-primary text-center" role="alert">
                                                            <h4 class="alert-heading">Lo sentimos!</h4>
                                                            <p class="mb-2">Parece que aún no se han registrado votos.</p>
                                                            <p class="mb-0"><i><a href="#">Contacta al soporte</a> si crees que se trata de un error.</i></p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <x-grafica_votacion :votacion="$votacion" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center my-4">
                                <a class="btn btn-primary" href="{{ route('votar.show', $votacion->id) }}">Ver votación</a>
                            </div>
                            <div class="card-footer text-center">
                                Fecha y hora de creación: {{ $votacion->created_at }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-template-principal>
