<x-template-principal>
    <h1>Ver votación</h1>
    <hr />

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 text-center">{{ $votacion->nombre }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row text-center"> <!-- Información elemental -->
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="mb-3">
                                    <h5 class="card-title ">Información</h5>
                                    <hr>
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
                                        <a class="text-decoration-none text-dark" href="{{route("candidato.show", $candidato->id)}}">
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
                                            </div>
                                        </div>
                                    @else
                                        <x-grafica_votacion :votacion="$votacion" />
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center m-3">  <!-- Opciones -->
                            <div class="d-flex justify-content-between">
                                <x-botones-opciones-ver-component tipo="votacion" id="{{$votacion->id}}" nombre="{{$votacion->nombre}}" msg="la votación" />
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
