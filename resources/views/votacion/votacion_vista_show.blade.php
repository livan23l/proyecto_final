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

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 text-center">{{ $votacion->nombre }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row text-center"> <!-- Información elemental -->
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="mb-3">
                                    <h5 class="card-title ">Información de la Votación</h5>
                                    <hr>
                                </div>

                                <div class="mb-3">
                                    <p class="card-text"><strong>Tipo:</strong> {{ $votacion->tipo }}</p>
                                    <p class="card-text"><strong>Alcance:</strong> {{ $votacion->alcance }}</p>
                                    <p class="card-text"><strong>Zona:</strong> {{ $votacion->zona }}</p>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
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
                                        <a class="text-decoration-none text-dark" href="#">{{ ucwords($candidato->nombre) }}</a>
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
                                                                    '{{ ucwords($candidato->nombre) }}', // Solo el primer nombre capitalizado.
                                                                @endforeach
                                                            ],
                                                            datasets: [{
                                                                label: 'Votos',
                                                                data: [
                                                                    @foreach ($votacion->candidatos as $candidato)
                                                                        {{ $candidato->pivot->votos }},
                                                                    @endforeach
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
                    <div class="card-footer text-center">
                        <p>Fecha y hora de creación: {{ $votacion->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-template-principal>
