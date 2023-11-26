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
                                {{ $votacion->tipo }} | {{ $votacion->alcance }} | {{ $votacion->zona }}.
                            </div>
                            <div class="card-body">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h5 class="card-title text-center">{{ $votacion->nombre }}</h5>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 d-flex justify-content-center"> <!-- Descripción -->
                                        <div class="border rounded-3 py-3 ps-2 pe-3 text-center">
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
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <canvas id="grafica_{{ $votacion->id }}" style="max-height: 400px; 
                                                                   display: block;
                                                                   box-sizing: border-box;
                                                                   height: 400px;
                                                                   width: 443px;" width="887" height="800">
                                                        </canvas>
                                                        <script>
                                                            document.addEventListener("DOMContentLoaded", () => {
                                                                new Chart(document.querySelector('#grafica_{{ $votacion->id }}'), {
                                                                    type: 'doughnut',
                                                                    data: {
                                                                        labels: [
                                                                            @foreach ($votacion->candidatos as $candidato)
                                                                                '{{ ucfirst(explode(' ', $candidato->nombre)[0]) }}', // Solo el primer nombre capitalizado.
                                                                            @endforeach
                                                                            'NULL'
                                                                        ],
                                                                        datasets: [{
                                                                            label: 'Votos',
                                                                            data: [
                                                                                @foreach ($votacion->candidatos as $candidato)
                                                                                    {{ $candidato->pivot->votos }},
                                                                                @endforeach
                                                                                {{$votacion->votos_null}}
                                                                            ],
                                                                            backgroundColor: [
                                                                                'rgb(0, 128, 0)',
                                                                                'rgb(0, 150, 200)',
                                                                                'rgb(255, 182, 193)',
                                                                                'rgb(128, 0, 128)',
                                                                                'rgb(0, 255, 255)',
                                                                                'rgb(255, 0, 0)',
                                                                                'rgb(255, 165, 0)',
                                                                                'rgb(255, 255, 0)',
                                                                                'rgb(128, 128, 128)',
                                                                                'rgb(165, 42, 42)'
                                                                            ],
                                                                            hoverOffset: 4
                                                                        }]
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                    </div>
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
