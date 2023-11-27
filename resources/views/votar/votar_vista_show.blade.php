<x-template-principal>
    <!-- Title -->
    <div class="container text-center my-3">
        <h1 class="display-4">Votaciones en curso</h1>
        <p class="lead mt-3">
            Ejerce tu derecho al voto de manera <span class="font-italic">fácil</span>, <span class="font-italic">segura</span> y <span class="font-italic">electrónica</span>.
        </p>
        <hr class="my-4">
    </div>
    <!-- End Title Section -->

    @error('voto')
        <div id="alert_voto_invalido" class="alert alert-danger alert-dismissible bg-danger text-light border-0 fade show">
            <i class="bi bi-exclamation-octagon me-1"></i>
            Ha ocurrido un error durante la votación.
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @if (session('voto_success'))
        <div id="alert_vote_success" class="alert alert-success alert-dismissible bg-success text-light border-0 fade show">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('voto_success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('voto_incorrect'))
        <div id="alert_voto_incorrect" class="alert alert-danger alert-dismissible bg-danger text-light border-0 fade show">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {{ session('voto_incorrect') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 text-center inblock">{{ $votacion->nombre }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row text-center"> <!-- Información elemental -->
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="mb-3">
                                    <div class="mb-3 d-flex align-items-center justify-content-center">
                                        <h5 class="card-title mb-0 pe-2">Información</h5>
                                        @if ($voto_bool->isEmpty())
                                            <i class="bi bi-clipboard-x pt-1 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Aún no has registrado tu voto"></i>
                                        @else
                                            <i class="bi bi-clipboard-check pt-1 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tu voto se registró correctamente"></i>
                                        @endif
                                    </div>
                                    <hr />
                                </div>

                                <div class="mb-3">
                                    <p class="card-text"><strong>Tipo:</strong> {{ $votacion->tipo }}</p>
                                    <p class="card-text"><strong>Alcance:</strong> {{ $votacion->alcance }}</p>
                                    <p class="card-text"><strong>Zona:</strong> {{ $votacion->zona }}</p>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                <div class="mb-3">
                                    <h5 class="card-title ">Descripción</h5>
                                    <hr>
                                    <p class="card-text">{{ $votacion->descripcion }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="my-3"> <!-- Candidatos y partidos -->
                            <h5 class="card-title text-center">Candidatos</h5>
                            <hr>
                            <ul class="list-group">
                                @foreach ($votacion->candidatos as $candidato)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a class="text-decoration-none text-dark" href="{{ route('votar.candidato_show', $candidato->id) }}">
                                            {{ ucwords($candidato->nombre) }}
                                        </a>
                                        <span class="badge bg-info">{{ $candidato->partido }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-1 mb-3"> <!-- Gráfica -->
                            <h5 class="card-title text-center">Gráfica</h5>
                            <hr>
                            <div class="mt-4 mb-2">
                                <div class="pb-3">
                                    @if ($votacion->votos == 0)
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="alert alert-light text-center" role="alert">
                                                <h4 class="alert-heading">¡Lo sentimos!</h4>
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

                    <div class="d-flex justify-content-center"> <!-- Formulario de votación -->
                        <div class="d-flex justify-content-between mb-4 pe-2">
                            <a href="{{ route('votar.index') }}" class="btn btn-secondary mx-2">Volver</a>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-votar">
                                Votar
                            </button>
                        </div>

                        <div class="modal fade" id="modal-votar" tabindex="-1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-scroll">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Votación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('votar.store', ['id' => $votacion->id]) }}">
                                        @csrf
                                        <div class="modal-body">
                                            <h5 class="text-center">Selecciona tu votación</h5>
                                            <hr>
                                            <ul class="list-group">
                                                @foreach ($votacion->candidatos as $key => $candidato)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div class="text-start">
                                                            <input class="form-check-input" type="radio" name="voto" value="{{ $candidato->id }}" id="voto_{{ $candidato->id }}" {{ $key === 0 ? 'checked' : '' }} required />
                                                            <label class="form-check-label text-dark" for="voto_{{ $candidato->id }}">{{ ucwords($candidato->nombre) }}</label>
                                                        </div>
                                                        <span class="badge bg-info">{{ $candidato->partido }}</span>
                                                    </li>
                                                @endforeach
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="text-start">
                                                        <input class="form-check-input" type="radio" name="voto" value="null" id="voto_nulo" required />
                                                        <label class="form-check-label text-secondary" for="voto_nulo">Anular voto</label>
                                                    </div>
                                                    <span class="badge bg-secondary">N/A</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button id="btn-cerrar-votacion" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button id="btn-votar-1" type="button" class="btn btn-primary">Votar</button>
                                        </div>
                                        <div id="alert-confirmacion-voto" class="d-flex justify-content-center px-3 my-1 d-none">
                                            <div class="alert alert-warning text-center" role="alert">
                                                <div class="alert-heading">
                                                    ¿Estás seguro de tu voto?
                                                </div>
                                                Una vez hecha la votación no podrás modificar ni eliminar tu voto.
                                                <hr />
                                                <input type="submit" class="btn btn-success" value="Votar">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <p>Fecha y hora de creación: {{ $votacion->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-template-principal>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#alert_voto_invalido').alert('close');
        }, 2500);
    });

    $(document).ready(function() {
        setTimeout(function() {
            $('#alert_vote_success').alert('close');
        }, 2000);
    });

    $(document).ready(function() {
        setTimeout(function() {
            $('#alert_voto_incorrect').alert('close');
        }, 2500);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var alert = document.getElementById('alert-confirmacion-voto');

        // Al dar click en el votón de enviar se mostrará la alerta:
        document.getElementById('btn-votar-1').addEventListener('click', function() {
            alert.classList.remove("d-none");
        });

        // Cuando el modal se cierre se volverá a agregar la clase "d-none" a la alerta:
        document.getElementById('modal-votar').addEventListener('hidden.bs.modal', function() {
            alert.classList.add("d-none");
        });
    });
</script>
