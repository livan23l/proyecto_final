<div>
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
                            'NULL'
                        ],
                        datasets: [{
                            label: 'Votos',
                            data: [
                                @foreach ($votacion->candidatos as $candidato)
                                    {{ $candidato->pivot->votos }},
                                @endforeach
                                {{ $votacion->votos_null }}
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
</div>
