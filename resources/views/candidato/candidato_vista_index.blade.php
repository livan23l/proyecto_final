<x-template-nice-admin>
    <h1>Candidatos registrados:</h1>
    <table class="table">
        <thead>
            <throw>
                <td>Nombre</td>
                <td>Fecha de nacimiento</td>
                <td>Partido</td>
                <td>Descripción</td>
            </throw>
        </thead>
        <tbody>
            @foreach ($candidatos as $candidato)
                <tr>
                    <td>{{ $candidato->nombre }}</td>
                    <td>{{ $candidato->f_nac }}</td>
                    <td>{{ $candidato->partido }}</td>
                    <td>{{ $candidato->descripcion }}</td>
                    <td>
                        <a href="{{ route('candidato.show', $candidato->id) }}">
                            Ver más
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('candidato.edit', $candidato->id) }}">
                            Editar
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('candidato.destroy', $candidato) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Borrar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-template-nice-admin>
