<x-template-nice-admin>
    <div class="card">
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
        <a class="btn btn-success" href="{{ route('candidato.index') }}">Volver</a>
        <a class="btn btn-warning" href="{{ route('candidato.edit', $candidato->id) }}">Editar</a>
        <form class="d-inline" action="{{ route('candidato.destroy', $candidato) }}" method="POST">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="Borrar">
        </form>
    </div>
</x-template-nice-admin>