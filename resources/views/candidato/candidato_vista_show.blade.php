<x-template-principal>
    <div class="card rounded-4">
        <div class="card-body">
            <h1 class="card-title">Información del candidato:</h1>
            <hr />

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h2>Nombre: {{ $candidato->nombre }}</h2>
                </li>
                <li class="list-group-item">
                    <h4>Partido: {{ $candidato->partido }}</h4>
                </li>
                <li class="list-group-item">
                    <p>Fecha de Nacimiento: {{ $candidato->f_nac }}</p>
                </li>
                <li class="list-group-item">
                    <p>Descripción: {{ $candidato->descripcion }}</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="text-center">
        <x-botones-opciones-ver-component tipo="candidato" id="{{$candidato->id}}" nombre="{{$candidato->nombre}}" msg="el candidato" />
    </div>
</x-template-principal>
